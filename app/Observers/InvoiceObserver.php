<?php

namespace App\Observers;

use App\Models\InvoiceModel;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class InvoiceObserver
{
    public function updated(InvoiceModel $invoice)
    {
        if ($invoice->isDirty('status')) {
            $status = $invoice->status;

            $type = match ($status) {
                'Approved' => 'approve_invoice',
                'Rejected' => 'reject_invoice',
                default => 'update_invoice',
            };

            ActivityLog::create([
                'user_id' => Auth::id(),
                'type' => $type,
                'reference_id' => $invoice->id,
                'description' => ucfirst(strtolower($status)) . ' invoice #' . $invoice->id_invoice,
            ]);
        }
    }

    public function created(InvoiceModel $invoice)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'type' => 'add_invoice',
            'reference_id' => $invoice->id,
            'description' => 'Menambahkan invoice #' . $invoice->id_invoice,
        ]);
    }
}