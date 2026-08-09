<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number',
        'supplier_name',
        'supplier_phone',
        'order_date',
        'expected_delivery_date',
        'status',
        'payment_status',
        'total_amount',
        'notes',
        'created_by',
        'received_at',
    ];

    protected $casts = [
        'order_date' => 'date',
        'expected_delivery_date' => 'date',
        'received_at' => 'datetime',
    ];

    public static function ensureTable()
    {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('purchase_orders')) {
                \Illuminate\Support\Facades\Schema::create('purchase_orders', function ($table) {
                    $table->id();
                    $table->string('po_number')->unique();
                    $table->string('supplier_name');
                    $table->string('supplier_phone')->nullable();
                    $table->date('order_date');
                    $table->date('expected_delivery_date')->nullable();
                    $table->string('status')->default('draft');
                    $table->string('payment_status')->default('unpaid');
                    $table->decimal('total_amount', 15, 2)->default(0);
                    $table->text('notes')->nullable();
                    $table->string('created_by')->nullable();
                    $table->timestamp('received_at')->nullable();
                    $table->timestamps();
                });
            }

            if (!\Illuminate\Support\Facades\Schema::hasTable('purchase_order_items')) {
                \Illuminate\Support\Facades\Schema::create('purchase_order_items', function ($table) {
                    $table->id();
                    $table->unsignedBigInteger('purchase_order_id');
                    $table->unsignedBigInteger('product_id')->nullable();
                    $table->string('product_name');
                    $table->integer('qty_ordered')->default(1);
                    $table->integer('qty_received')->default(0);
                    $table->integer('qty_rejected')->default(0);
                    $table->string('reject_reason')->nullable();
                    $table->decimal('cost_price', 15, 2)->default(0);
                    $table->decimal('subtotal', 15, 2)->default(0);
                    $table->timestamps();
                });
            } else {
                try {
                    \Illuminate\Support\Facades\Schema::table('purchase_order_items', function ($table) {
                        if (!\Illuminate\Support\Facades\Schema::hasColumn('purchase_order_items', 'qty_rejected')) {
                            $table->integer('qty_rejected')->default(0);
                        }
                        if (!\Illuminate\Support\Facades\Schema::hasColumn('purchase_order_items', 'reject_reason')) {
                            $table->string('reject_reason')->nullable();
                        }
                    });
                } catch (\Throwable $t) {}
            }

            // Ensure products table has standard POS columns on SQLite & MySQL
            if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
                \Illuminate\Support\Facades\Schema::table('products', function ($table) {
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('products', 'barcode')) {
                        $table->string('barcode')->nullable();
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('products', 'cost_price')) {
                        $table->decimal('cost_price', 12, 2)->default(0);
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('products', 'unit')) {
                        $table->string('unit')->default('Pcs');
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('products', 'description')) {
                        $table->text('description')->nullable();
                    }
                });
            }
        } catch (\Throwable $t) {}
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }
}
