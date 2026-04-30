<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $servers = $user->servers;

        return view('servers.index', compact('servers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // generate port otomatis
        $port = Server::max('port') ?? 25565;
        $port++;

        $server = Server::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'world_name' => 'world_' . Auth::id() . '_' . time(),
            'port' => $port,
            'status' => 'pending',
            'version' => 'latest',
        ]);

        return redirect('/servers')->with('success', 'Server berhasil dibuat');
    }

    // HAPUS SERVER
    public function destroy(Server $server)
    {
        // 1. Proteksi Keamanan: Pastikan yang menghapus adalah pemilik aslinya
        if ($server->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Hapus Kontainer Docker (Jika server sudah aktif / punya container_id)
        if ($server->container_id) {
            try {
                // Perintah: docker rm -f <container_id>
                $process = new \Symfony\Component\Process\Process(['docker', 'rm', '-f', $server->container_id]);
                $process->run();
                
                Log::info("Docker Container {$server->container_id} berhasil dihapus saat user menghapus server.");
            } catch (\Exception $e) {
                // Catat di log jika gagal hapus docker, tapi biarkan proses hapus DB tetap lanjut
                Log::error("Gagal menghapus Docker Container {$server->container_id}: " . $e->getMessage());
            }
        }

        // 3. Hapus data dari Database
        $server->delete();

        // 4. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Server berhasil dihapus permanen!');
    }
}