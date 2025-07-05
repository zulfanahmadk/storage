<?php

namespace App\Observers;

use App\Models\ItemUnitModel;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ItemUnitObserver
{
    public function created(ItemUnitModel $item)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type' => 'add_item',
            'reference_id' => $item->id,
            'description' => 'Menambahkan item unit <strong>' . $item->kode_unit . '</strong>',
        ]);
    }

    public function updated(ItemUnitModel $item)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type' => 'edit_item',
            'reference_id' => $item->id,
            'description' => 'Mengedit item unit <strong>' . $item->kode_unit . '</strong>',
        ]);
    }

    public function deleted(ItemUnitModel $item)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type' => 'delete_item',
            'reference_id' => $item->id,
            'description' => 'Menghapus item unit <strong>' . $item->kode_unit . '</strong>',
        ]);
    }
}
