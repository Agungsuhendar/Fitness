<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category'); // Tips Renang, Manfaat Renang, Persiapan TNI, Parenting, Kesehatan
            $table->text('excerpt');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('author')->default('Coach Head Les Renang Jogja');
            $table->integer('reading_time')->default(4);
            $table->unsignedInteger('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
