<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();

            // relasi user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // data server
            $table->string('name');
            $table->string('world_name');
            $table->integer('port')->unique();
            $table->string('ip')->nullable();

            // provisioning
            $table->string('container_id')->nullable();

            // status lifecycle (DITAMBAHKAN: provisioning dan failed)
            $table->enum('status', ['pending', 'provisioning', 'active', 'stopped', 'failed', 'deleted'])
                ->default('pending');

            $table->string('version')->default('latest');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};