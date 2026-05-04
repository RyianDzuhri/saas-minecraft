<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckPayments extends Command
{
    protected $signature = 'payments:check';
    protected $description = 'Check payments from Xendit API';

    public function handle()
    {
        $apiKey = config('services.xendit.secret_key');

        $response = Http::withBasicAuth($apiKey, '')
            ->get('https://api.xendit.co/v2/invoices');

        if ($response->failed()) {
            $this->error('Gagal ambil data dari API');
            return;
        }

        $data = $response->json();

        if (empty($data)) {
            $this->warn('Tidak ada data pembayaran');
            return;
        }

        $rows = [];

        foreach ($data as $item) {
            $rows[] = [
                'External ID'   => $item['external_id'] ?? '-',
                'Status'        => $item['status'] ?? '-',
                'Amount'        => 'Rp ' . number_format($item['amount'] ?? 0),
                'Paid At'       => $item['paid_at'] ?? '-',
                'Method'        => $item['payment_method'] ?? '-',
                'Channel'       => $item['payment_channel'] ?? '-',
            ];
        }

        $this->table(
            ['External ID', 'Status', 'Amount', 'Paid At', 'Method', 'Channel'],
            $rows
        );

        $this->info('Selesai ambil data');
    }
}