<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable()->comment('Gelar atau jabatan, misal: S.Pd., S.Or.');
            $table->string('specialty')->comment('Spesialisasi, misal: Head Coach & Spesialis Anak');
            $table->text('description')->nullable();
            $table->string('photo')->nullable()->comment('Path gambar foto pelatih');
            $table->string('color')->default('#0077b6')->comment('Warna border ring foto (hex)');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
