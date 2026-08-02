<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('city'); // DIY (Yogyakarta, Sleman, Bantul), Semarang, Solo, Magelang, Klaten
            $table->text('address');
            $table->text('map_embed_url')->nullable();
            $table->json('features')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
