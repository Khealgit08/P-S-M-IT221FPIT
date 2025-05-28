<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'supplier_id',
        'title',
        'terms',
        'sla',
        'start_date',
        'end_date',
        'payment_terms',
        'discount_terms',
        'payment_due_date',
        'payment_alert_sent',
        'status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
