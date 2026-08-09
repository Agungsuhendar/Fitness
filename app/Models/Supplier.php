<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function ensureTable()
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('suppliers')) {
                \Illuminate\Support\Facades\Schema::create('suppliers', function ($table) {
                    $table->id();
                    $table->string('name')->unique();
                    $table->string('phone')->nullable();
                    $table->string('email')->nullable();
                    $table->text('address')->nullable();
                    $table->text('notes')->nullable();
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
            }

            // Automatically sync suppliers from real purchase_orders table
            if (\Illuminate\Support\Facades\Schema::hasTable('purchase_orders')) {
                $existingPos = \Illuminate\Support\Facades\DB::table('purchase_orders')
                    ->select('supplier_name', 'supplier_phone')
                    ->whereNotNull('supplier_name')
                    ->distinct()
                    ->get();

                foreach ($existingPos as $po) {
                    if (!empty($po->supplier_name)) {
                        self::firstOrCreate(
                            ['name' => $po->supplier_name],
                            ['phone' => $po->supplier_phone ?? null, 'is_active' => true]
                        );
                    }
                }
            }
        } catch (\Throwable $e) {}
    }
}
