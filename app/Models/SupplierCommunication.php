<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierCommunication extends Model
{
    protected $fillable = [
        'supplier_id',
        'communication_date',
        'type',
        'subject',
        'content',
        'response',
        'handled_by',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
