<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsReceiptNote extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'received_by',
        'received_date',
        'items', // JSON or serialized
        'remarks',
        'status',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
