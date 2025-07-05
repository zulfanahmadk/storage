<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Models\InvoiceDetailModel;
use App\Models\CustomersModel;
use App\Models\ItemUnitModel;

class InvoiceController extends Controller
{
    public function list_invoice(Request $request){
        $data['getRecord'] = InvoiceModel::get();
        $data['getRecord'] = InvoiceModel::with(['createdByUser', 'updatedByUser'])->get();
        return view('admin.invoice.list', $data);
    }

    public function dash_invoice(Request $request){
        $data['getRecord'] = InvoiceModel::get();
        $data['getRecord'] = InvoiceModel::with(['createdByUser', 'updatedByUser'])->get();
        return view('admin.invoice.dash', $data);
    }

    public function manager_dash_invoice(Request $request){
        $data['getRecord'] = InvoiceModel::get();
        return view('admin.manager.invoice.dash', $data);
    }

    public function add_invoice(Request $request){
        $data['getRecord'] = CustomersModel::get();
        $data['getItem'] = ItemUnitModel::where('status', 'Tersedia')
               ->where('kondisi', 'Baik')
               ->get();
        return view('admin.invoice.add', $data);
    }


    // public function add_invoice_store(Request $request){
    //     $SaveUpdate = new InvoiceModel;
    
    //     $tanggal = date('Ymd');
    //     $countToday = InvoiceModel::whereDate('created_at', now()->toDateString())->count() + 1;
    //     $nomorUrut = str_pad($countToday, 2, '0', STR_PAD_LEFT);
    //     $generateId = 'INV-' . $tanggal . '-' . $nomorUrut;
    
    //     $SaveUpdate->id_invoice = $generateId;
    //     $SaveUpdate->customer_id = $request->customer_id;
    //     $SaveUpdate->start_date = $request->start_date;
    //     $SaveUpdate->end_date = $request->end_date;
    //     $SaveUpdate->description = $request->description;
    //     $SaveUpdate->save();
    
    //     return redirect('admin/invoice')->with('success', 'Invoice successfully requested');
    // }

    public function add_invoice_store(Request $request)
    {
        // Simpan invoice utama
        $invoice = new InvoiceModel;

        $tanggal = date('Ymd');
        $countToday = InvoiceModel::whereDate('created_at', now()->toDateString())->count() + 1;
        $nomorUrut = str_pad($countToday, 2, '0', STR_PAD_LEFT);
        $generateId = 'INV-' . $tanggal . '-' . $nomorUrut;

        $invoice->id_invoice = $generateId;
        $invoice->customer_id = $request->customer_id;
        $invoice->start_date = $request->start_date;
        $invoice->end_date = $request->end_date;
        $invoice->description = $request->description;
        $invoice->save();

        // Simpan detail alat yang disewa
        $itemIds = $request->item_id;
        $rentalDays = $request->rental_days;
        $subtotals = $request->sub_total;

        for ($i = 0; $i < count($itemIds); $i++) {
            $detail = new InvoiceDetailModel;

            $detail->id_invoice = $generateId;
            $detail->item_id = $itemIds[$i];
            $detail->rental_days = $rentalDays[$i];
            $detail->sub_total = $subtotals[$i];
            $detail->save();

            // Update status item jadi "Disewa"
            ItemUnitModel::where('id', $itemIds[$i])
                ->update(['status' => 'Disewa']);
        }

        return redirect('admin/invoice')->with('success', 'Invoice successfully requested');
    }

    

    public function print_invoice($id, Request $request){
        $data['invoice'] = InvoiceModel::with('getCustomer')->findOrFail($id);
        $data['invoice_detail'] = InvoiceDetailModel::with('item_unit')->where('id_invoice', $data['invoice']->id_invoice)->get();
        return view('admin.invoice.print', $data);
    }

    public function verify(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Approved,Rejected',
        'note' => 'nullable|string',
    ]);

    $invoice = InvoiceModel::findOrFail($id);
    $invoice->status = $request->status;
    $invoice->note = $request->note;

    // Tambahkan waktu verifikasi
    $invoice->approve_at = now();

    $invoice->save();

    return redirect()->back()->with('success', 'Status invoice berhasil diperbarui.');
}



    
}