<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPerformance extends Model
{
    protected $fillable = [
        'supplier_id',
        'evaluation_date',
        'quality_score',
        'delivery_score',
        'cost_score',
        'compliance_score',
        'overall_score',
        'comments',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
