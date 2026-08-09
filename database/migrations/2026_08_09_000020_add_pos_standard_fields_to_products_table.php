<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'barcode')) {
                $table->string('barcode')->nullable()->after('code');
            }
            if (!Schema::hasColumn('products', 'cost_price')) {
                $table->decimal('cost_price', 12, 2)->default(0)->after('price');
            }
            if (!Schema::hasColumn('products', 'unit')) {
                $table->string('unit')->default('Pcs')->after('stock');
            }
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('unit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['barcode', 'cost_price', 'unit', 'description']);
        });
    }
};
