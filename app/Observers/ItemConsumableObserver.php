<?php

namespace App\Observers;

use App\Models\ItemModel;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ItemConsumableObserver
{
    public function created(ItemModel $item)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type' => 'add_consumable',
            'reference_id' => $item->id,
            'description' => 'Menambahkan item consumable ' . $item->name,
        ]);
    }

    public function updated(ItemModel $item)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type' => 'update_consumable',
            'reference_id' => $item->id,
            'description' => 'Mengubah item consumable ' . $item->name,
        ]);
    }
}