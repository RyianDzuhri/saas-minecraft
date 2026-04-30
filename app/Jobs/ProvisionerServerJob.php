<?php

namespace App\Jobs;

use App\Models\Server;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;

class ProvisionerServerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function handle(): void
    {
        // 1. Definisikan nama kontainer agar unik
        $containerName = 'mc_server_id_' . $this->server->id;
        
        // Kita memetakan port dari database ke port default Minecraft (25565)
        // 2. Susun perintah Docker Run (Versi Stable 1.21.11)
        $command = [
            'docker', 'run', '-d',
            '--name', $containerName,
            '-p', $this->server->port . ':25565',
            
            // Limit Resource Docker (Sangat disarankan untuk AWS t2.micro/t3.micro)
            '-m', '450m',                 // Batas RAM sistem
            '--cpus', '0.5',              // Batas CPU (50%)
            
            // Environment Variables Minecraft
            '-e', 'EULA=TRUE',            // Menyetujui EULA Mojang
            '-e', 'VERSION=1.21.11',      // Mengunci versi ke 1.21.11
            '-e', 'TYPE=VANILLA',         // Server Vanilla murni
            '-e', 'MEMORY=450M',          // Limit RAM di level Java
            '-e', 'ONLINE_MODE=FALSE',    // Izinkan Legacy Launcher / Non-Premium
            
            'itzg/minecraft-server'
        ];

        $process = new Process($command);
        $process->setTimeout(300); // 5 menit batas waktu
        $process->run();

        // 3. Error Handling
        if (!$process->isSuccessful()) {
            Log::error('Docker Error (ID ' . $this->server->id . '): ' . $process->getErrorOutput());
            $this->server->update(['status' => 'failed']);
            throw new ProcessFailedException($process);
        }

        // 4. Update Database jika sukses
        $containerId = trim($process->getOutput());
        $this->server->update([
            'status' => 'active',
            'container_id' => substr($containerId, 0, 12),
            'ip' => env('SERVER_PUBLIC_IP'),
        ]);

        Log::info('Minecraft Server Active! ID Kontainer: ' . $containerId);
    }
}