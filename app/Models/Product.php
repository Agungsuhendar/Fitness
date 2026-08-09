<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'barcode',
        'name',
        'category',
        'price',
        'cost_price',
        'stock',
        'unit',
        'image',
        'description',
        'is_track_stock',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock' => 'integer',
        'is_track_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getProfitAmountAttribute()
    {
        return max(0, $this->price - $this->cost_price);
    }

    public function getProfitMarginAttribute()
    {
        if ($this->price <= 0) return 0;
        return round((($this->price - $this->cost_price) / $this->price) * 100, 1);
    }

    public function isLowStock($threshold = 5)
    {
        if (isset($this->is_track_stock) && !$this->is_track_stock) return false;
        return $this->stock <= $threshold;
    }

    /**
     * Recalculate HPP (Cost Price) using Moving Average formula:
     * New HPP = ((Current Stock * Current HPP) + (New Qty * New Cost Price)) / (Current Stock + New Qty)
     */
    public function recalculateMovingAverageHpp($newQty, $newCostPrice)
    {
        if (class_exists('\App\Models\PurchaseOrder') && method_exists('\App\Models\PurchaseOrder', 'ensureTable')) {
            \App\Models\PurchaseOrder::ensureTable();
        }

        $currentStock = max(0, (int)$this->stock);
        $currentHpp = (float)($this->cost_price ?? 0);
        $newQty = max(1, (int)$newQty);
        $newCostPrice = (float)$newCostPrice;

        $totalValue = ($currentStock * $currentHpp) + ($newQty * $newCostPrice);
        $totalQty = $currentStock + $newQty;

        $newAverageHpp = $totalQty > 0 ? ($totalValue / $totalQty) : $newCostPrice;

        try {
            $this->cost_price = round($newAverageHpp, 2);
            $this->stock = $totalQty;
            $this->save();
        } catch (\Throwable $e) {
            $this->stock = $totalQty;
            $this->save();
        }

        return round($newAverageHpp, 2);
    }
}
