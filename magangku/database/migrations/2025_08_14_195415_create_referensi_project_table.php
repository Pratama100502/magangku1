<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referensi_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('peserta_magang') // relasi ke tabel peserta_magang
                  ->onDelete('cascade');
            $table->string('nama_referensi_project');
            $table->string('nama_file');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referensi_project');
    }
};
