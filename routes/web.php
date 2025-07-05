<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\InvoiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login']);
Route::get('forgot', [AuthController::class, 'forgot']);
Route::post('login_post', [AuthController::class, 'login_post']);
Route::post('forgot_post', [AuthController::class, 'forgot_post']);
Route::get('reset/{token}', [AuthController::class, 'getReset']);
Route::post('reset/{token}', [AuthController::class, 'postReset']);
Route::middleware(['role:1'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/customers', [CustomersController::class, 'customers']);
    Route::get('admin/customers/add', [CustomersController::class, 'add_customers']);
    Route::post('admin/customers/add', [CustomersController::class, 'insert_add_customers']);
    Route::get('admin/customers/edit/{id}', [CustomersController::class, 'edit_customers']);
    Route::post('admin/customers/edit/{id}', [CustomersController::class, 'update_customers']);
    Route::get('admin/customers/delete/{id}', [CustomersController::class, 'delete_customers']);
    
    // Item Start
    Route::get('admin/item', [ItemController::class, 'item']);
    Route::get('admin/item/add', [ItemController::class, 'add_item']);
    Route::post('admin/item/add', [ItemController::class, 'add_update']);
    Route::get('admin/item/edit/{id}', [ItemController::class, 'edit_item']);
    Route::post('admin/item/edit/{id}', [ItemController::class, 'add_update_edit']);
    Route::get('admin/item/delete/{id}', [ItemController::class, 'delete_item']);
    // Item Ends
    
    Route::get('admin/item_unit', [ItemController::class, 'list_item_unit']);
    Route::get('admin/item_unit/add', [ItemController::class, 'add_item_unit']);
    Route::post('admin/item_unit/add', [ItemController::class, 'add_item_store']);
    Route::get('admin/item_unit/edit/{id}', [ItemController::class, 'edit_item_unit']);
    Route::get('admin/item_unit/delete/{id}', [ItemController::class, 'delete_item_unit']);
    Route::post('admin/item_unit/edit/{id}', [ItemController::class, 'edit_item_unit_update']);

    //Suppliers Start
    Route::get('admin/suppliers', [SuppliersController::class, 'list_suppliers']);
    Route::get('admin/suppliers/add', [SuppliersController::class, 'add_suppliers']);
    Route::post('admin/suppliers/add', [SuppliersController::class, 'add_suppliers_update']);
    Route::get('admin/suppliers/edit/{id}', [SuppliersController::class, 'edit_suppliers']);
    Route::post('admin/suppliers/edit/{id}', [SuppliersController::class, 'edit_suppliers_update']);
    Route::get('admin/suppliers/delete/{id}', [SuppliersController::class, 'delete_suppliers']);
    //Suppliers End

    //Invoice Start
    Route::get('admin/invoice/list', [InvoiceController::class, 'list_invoice']);
    Route::get('admin/invoice', [InvoiceController::class, 'dash_invoice']);
    Route::get('admin/invoice/add', [InvoiceController::class, 'add_invoice']);
    Route::post('admin/invoice/add', [InvoiceController::class, 'add_invoice_store']);
    Route::get('admin/invoice/list/print/{id}', [InvoiceController::class, 'print_invoice']);


});


Route::middleware(['role:2'])->group(function () {
    Route::get('manager/dashboard', [DashboardController::class, 'manager_dashboard']);
    Route::get('manager/invoice', [InvoiceController::class, 'manager_dash_invoice']);
    Route::post('manager/invoice/verify/{id}', [InvoiceController::class, 'verify']);

    Route::post('manager/invoice/add', [InvoiceController::class, 'add_invoice_store']);
    Route::get('manager/invoice/add', [InvoiceController::class, 'add_invoice']);
    Route::post('manager/invoice/store', [InvoiceController::class, 'manager_invoice_store'])->name('manager.invoice.store');

    
});
Route::get('logout', [AuthController::class, 'logout']);

