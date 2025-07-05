<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuppliersModel;

class SuppliersController extends Controller
{
    public function list_suppliers(Request $request){
        $data['getRecord'] = SuppliersModel::get();
        return view('admin.suppliers.list', $data);
    }

    public function add_suppliers(Request $request){
        return view('admin.suppliers.add');
    }

    public function add_suppliers_update(Request $request){
        //dd($request->all());

        $save = new SuppliersModel;
        $save->supplier_name = trim($request->supplier_name);
        $save->supplier_email = trim($request->supplier_email);
        $save->contact_number = trim($request->contact_number);
        $save->address = trim($request->address);
        $save->save();

        return redirect('admin/suppliers')->with('success', 'Suppliers Successfully create.');
    }

    public function edit_suppliers($id, Request $request){
        $data['getRecord'] = SuppliersModel::find($id);
        return view('admin.suppliers.edit', $data);
    }

    public function edit_suppliers_update($id, Request $request){
        $save = SuppliersModel::find($id);
        $save->supplier_name = trim($request->supplier_name);
        $save->supplier_email = trim($request->supplier_email);
        $save->contact_number = trim($request->contact_number);
        $save->address = trim($request->address);
        $save->save();

        return redirect('admin/suppliers')->with('success', 'Suppliers Successfully updated.');
    }

    public function delete_suppliers($id, Request $request){
        $deleteRecord = SuppliersModel::find($id);
        // Apabila mau menggunakan soft delete maka aktifkan ini
        //$deleteRecord->isDeleted = 1; 
        //$deleteRecord->save();
        $deleteRecord->delete();
        return redirect()->back()->with('error', 'Item has been deleted');
    }
}