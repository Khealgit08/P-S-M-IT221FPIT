<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'status',
        'certification',
        'certification_expiry',
        'compliance_status',
    ];

    public function performances()
    {
        return $this->hasMany(SupplierPerformance::class);
    }

    public function communications()
    {
        return $this->hasMany(SupplierCommunication::class);
    }

    public function classifications()
    {
        return $this->hasMany(SupplierClassification::class);
    }

    public function audits()
    {
        return $this->hasMany(SupplierAudit::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}