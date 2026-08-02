<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('target_audience');
            $table->text('description');
            $table->json('features')->nullable();
            $table->json('benefits')->nullable();
            $table->json('curriculum')->nullable();
            $table->unsignedInteger('price_start')->default(0);
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('badge')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
