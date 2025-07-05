<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemModel;
use App\Models\ItemUnitModel;
use App\Models\SuppliersModel;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function item(Request $request){
        $data['getRecord'] = ItemModel::get();
        return view('admin.item.list', $data);
    }

    public function add_item(Request $request){
        return view('admin.item.add');
    }

    public function add_update(Request $request){
        $SaveUpdate = new ItemModel;
        $SaveUpdate->name = $request->name;
        $SaveUpdate->category = $request->category;
        $SaveUpdate->specification = $request->specification;
        $SaveUpdate->unit = $request->unit;
        $SaveUpdate->stock = $request->stock ?? 0;
        $SaveUpdate->price = $request->price ?? 0;
        $SaveUpdate->created_by = Auth::id();
        $SaveUpdate->created_by_name = Auth::user()->name;
        $SaveUpdate->save();

        return redirect('admin/item')->with('success', 'Item successfully saved');
    }

    public function edit_item($id){
        $data['getRecord'] = ItemModel::find($id);
        return view('admin.item.edit', $data); 
    }

    public function add_update_edit($id = '', Request $request){
        if(!empty($id)){
            $SaveUpdate = ItemModel::find($id);
            $SaveUpdate->created_by = Auth::id();
            $SaveUpdate->created_by_name = Auth::user()->name;
        }else{
            $SaveUpdate = new ItemModel;
        }

        $SaveUpdate->name = $request->name;
        $SaveUpdate->category = $request->category;
        $SaveUpdate->specification = $request->specification;
        $SaveUpdate->unit = $request->unit;
        $SaveUpdate->username = $request->username;
        $SaveUpdate->stock = $request->stock ?? 0;
        $SaveUpdate->price = $request->price ?? 0;
        $SaveUpdate->save();

        return redirect('admin/item')->with('success', 'Item successfully update');
    }

    public function delete_item($id){
        $deleteRecord = ItemModel::find($id);
        $deleteRecord->delete();
        return redirect()->back()->with('success', 'Item has been deleted');
    }

    public function list_item_unit() {
        $data['getRecord'] = ItemUnitModel::with(['item', 'supplierData'])->get();
        return view('admin.item_unit.list', $data);
    }

    public function add_item_unit(){
        $data['getRecord'] = ItemModel::get();
        $data['getSupplier'] = SuppliersModel::get();
        return view('admin.item_unit.add', $data);
    }

    public function add_item_store(Request $request){
        $SaveUpdate = new ItemUnitModel;
        $SaveUpdate->item_id = $request->item_id;
        $SaveUpdate->kode_unit = $request->kode_unit;
        $SaveUpdate->brand = $request->brand;
        $SaveUpdate->supplier = $request->supplier;
        $SaveUpdate->price_per_day = $request->price_per_day;
        $SaveUpdate->status = $request->status;
        $SaveUpdate->lokasi = $request->lokasi;
        $SaveUpdate->kondisi = $request->kondisi;
        $SaveUpdate->catatan = $request->catatan;
        $SaveUpdate->save();

        return redirect('admin/item_unit')->with('success', 'Item Unit successfully saved');
    }

    public function delete_item_unit(Request $request, $id){
        $deleteRecord = ItemUnitModel::find($id);
        $deleteRecord->delete();
        return redirect()->back()->with('error', 'Item has been deleted');
    }

    public function edit_item_unit($id, Request $request )
    {
        $data['oldRecord'] = ItemUnitModel::with('supplierData')->find($id);
        $data['getRecord'] = ItemModel::get();
        $data['getSupplier'] = SuppliersModel::get(); // ✅ ini penting!
        return view('admin.item_unit.edit', $data); 
    }

    public function edit_item_unit_update($id, Request $request){
        $SaveUpdate = ItemUnitModel::find($id);
        $SaveUpdate->item_id = $request->item_id;
        $SaveUpdate->kode_unit = $request->kode_unit;
        $SaveUpdate->brand = $request->brand;
        $SaveUpdate->supplier = $request->supplier;
        $SaveUpdate->price_per_day = $request->price_per_day;
        $SaveUpdate->status = $request->status;
        $SaveUpdate->lokasi = $request->lokasi;
        $SaveUpdate->kondisi = $request->kondisi;
        $SaveUpdate->catatan = $request->catatan;
        $SaveUpdate->save();

        return redirect('admin/item_unit')->with('success', 'Item Unit successfully updated');
    }
}
