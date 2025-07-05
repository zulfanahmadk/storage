<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetailModel extends Model
{
    use HasFactory;

    protected $table = 'invoice_detail';

    // Relasi ke tabel item_unit
    public function item_unit()
    {
        return $this->belongsTo(ItemUnitModel::class, 'item_id');
    }

    // ✅ Tambahkan relasi ke tabel invoices
    public function invoice()
    {
        return $this->belongsTo(InvoiceModel::class, 'invoice_id');
    }

    public function item()
    {
        return $this->belongsTo(ItemUnitModel::class, 'item_id', 'id');
    }
}
