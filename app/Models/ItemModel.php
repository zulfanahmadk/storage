<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;

    protected $table = 'item_consumable';

    protected $fillable = [
        'name',
        'category',
        'specification',
        'unit',
        'stock',
        'price',
        'created_by',
        'created_by_name',
    ];

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function creatorName()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by_name', 'name', 'name');
    }
}
