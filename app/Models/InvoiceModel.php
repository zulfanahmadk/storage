<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    public function getCustomer()
    {
        return $this->belongsTo(CustomersModel::class, 'customer_id');
    }

    public function getItem()
    {
        return $this->belongsTo(ItemUnitModel::class, 'item_id');
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetailModel::class, 'id_invoice', 'id_invoice');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by'); // pastikan nama model user kamu adalah `User`
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted()
    {

        static::creating(function ($invoice) {
            if (auth()->check()) {
                $invoice->created_by = auth()->id();
            }
        });

        static::updating(function ($invoice) {
            if (auth()->check()) {
                $invoice->updated_by = auth()->id();
            }
        });
    }

    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
