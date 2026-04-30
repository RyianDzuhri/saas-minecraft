<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Jobs\ProvisionerServerJob; // Pastikan nama Job sudah sesuai
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // CREATE INVOICE
    public function create(Server $server)
    {
        // --- TAMBAHAN LOGIKA PROTEKSI ---
        // Cari apakah server ini sudah punya riwayat pembayaran sebelumnya
        $existingPayment = Payment::where('server_id', $server->id)->latest()->first();

        if ($existingPayment) {
            // 1. Jika sudah dibayar (Paid)
            if ($existingPayment->status === 'paid') {
                return redirect()->route('dashboard')->with('error', 'Server ini sudah dibayar dan sedang aktif/diproses!');
                // (Ganti 'dashboard' dengan nama route halaman utama user kamu)
            }

            // 2. Jika invoice sudah dibuat tapi belum dibayar (Pending)
            if ($existingPayment->status === 'pending') {
                // Langsung arahkan ke link Xendit yang lama, jangan buat tagihan baru
                return redirect($existingPayment->invoice_url);
            }
        }

        // Jika belum ada pembayaran sama sekali, buat invoice baru
        $externalId = 'server_' . $server->id . '_' . Str::random(6);

        $response = Http::withBasicAuth(
            config('services.xendit.secret_key'),
            ''
        )->post('https://api.xendit.co/v2/invoices', [
            'external_id' => $externalId,
            'amount' => 10000,
            'description' => 'Server Minecraft ' . $server->name,
            'invoice_duration' => 86400,
        ]);

        $invoice = $response->json();

        // simpan payment
        Payment::create([
            'user_id' => Auth::id(),
            'server_id' => $server->id,
            'external_id' => $externalId,
            'invoice_url' => $invoice['invoice_url'],
            'amount' => 10000,
            'status' => 'pending',
        ]);

        // redirect ke halaman pembayaran
        return redirect($invoice['invoice_url']);
    }

    // WEBHOOK
    public function webhook(Request $request)
    {
        // 1. Log data masuk (Sangat berguna untuk demo UTS)
        Log::info('Xendit Webhook Received:', $request->all());

        $externalId = $request->external_id;
        $status = $request->status;

        // 2. Cari data pembayaran di database
        $payment = Payment::where('external_id', $externalId)->first();

        // 3. Proteksi agar tombol "Test and Save" Xendit tidak error 404
        if (!$payment) {
            Log::warning("Webhook received for unknown External ID: $externalId");
            return response()->json([
                'message' => 'Webhook received, but data not found in database. This is normal for Xendit Test/Dummy data.'
            ], 200); 
        }

        // 4. Logika jika pembayaran berhasil (PAID)
        if ($status === 'PAID') {
            
            // Update status pembayaran
            $payment->update([
                'status' => 'paid'
            ]);

            // Update status server menjadi provisioning (sedang disiapkan)
            $server = $payment->server;
            $server->update([
                'status' => 'provisioning'
            ]);

            // 5. EKSEKUSI DOCKER: Kirim tugas ke antrean background
            // Ini akan ditangkap oleh terminal yang menjalankan 'php artisan queue:work'
            ProvisionerServerJob::dispatch($server);

            Log::info("Payment success for ID: $externalId. Dispatching ProvisionerServerJob for Server ID: {$server->id}");
        }

        return response()->json(['success' => true], 200);
    }
}