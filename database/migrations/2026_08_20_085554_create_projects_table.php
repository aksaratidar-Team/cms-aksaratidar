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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('title');
            $table->string('slug')->unique(); // URL-friendly, wajib unik
            $table->text('description');
            $table->enum('status', ['On Going', 'Completed'])->default('On Going');
            $table->json('technologies')->nullable(); // Array teknologi (React, Laravel, dll)
            $table->string('cover_image'); // Thumbnail utama
            $table->json('gallery')->nullable(); // Kumpulan gambar pendukung
            $table->date('start_date');
            $table->date('completion_date')->nullable(); // Boleh kosong jika On Going
            $table->string('project_url')->nullable(); // Link eksternal opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
