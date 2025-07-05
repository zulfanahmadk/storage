<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemUnitModel extends Model
{
    use HasFactory;

    protected $table = 'item_unit';

    // Relasi ke tabel items
    public function item()
    {
        return $this->belongsTo(ItemModel::class, 'item_id');
    }

    // Relasi ke tabel suppliers
    public function supplierData()
    {
        return $this->belongsTo(SuppliersModel::class, 'supplier');
    }

    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_by'); // pastikan kamu punya kolom ini
    }

}
