<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StorageDummySeeder extends Seeder
{
    public function run(): void
    {
        // Customers
        DB::table('customers')->insert([
            [
                'name' => 'PT. Karya Mandiri',
                'contact_number' => '08123456789',
                'address' => 'Jl. Merdeka No.123',
                'doctor_name' => 'dr. Budi',
                'doctor_address' => 'RS Citra Sehat',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Suppliers
        DB::table('suppliers')->insert([
            [
                'supplier_name' => 'PT. Sumber Jaya',
                'supplier_email' => 'supplier@sumberjaya.co.id',
                'contact_number' => '082212345678',
                'address' => 'Jl. Industri No.10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Items
        DB::table('item')->insert([
            [
                'name' => 'Excavator Hitachi ZX200',
                'category' => 'Alat Berat Tipe 1',
                'machine_type' => 'Diesel',
                'specification' => '200 HP, bucket 1m3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Item Consumables
        DB::table('item_consumable')->insert([
            [
                'created_by' => 1,
                'created_by_name' => 'Zulfan Admin',
                'name' => 'Oli Mesin Shell 5L',
                'category' => 'Pelumas',
                'specification' => 'SAE 15W-40',
                'unit' => 'Liter',
                'stock' => 50,
                'price' => 250000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Item Units
        DB::table('item_unit')->insert([
            [
                'created_by' => 1,
                'item_id' => 1,
                'kode_unit' => 'EXC-001',
                'brand' => 'Hitachi',
                'supplier' => 'PT. Sumber Jaya',
                'price_per_day' => 1500000,
                'status' => 'Tersedia',
                'lokasi' => 'Gudang A',
                'kondisi' => 'Baik',
                'catatan' => 'Unit baru servis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Invoices
        DB::table('invoices')->insert([
            [
                'id_invoice' => 'INV-001',
                'customer_id' => '1',
                'start_date' => '2025-07-01',
                'end_date' => '2025-07-03',
                'description' => 'Sewa Excavator 2 hari',
                'status' => 'Approved',
                'approve_at' => Carbon::now(),
                'note' => 'Pembayaran via transfer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ]);

        // Invoice Details
        DB::table('invoice_detail')->insert([
            [
                'id_invoice' => 'INV-001',
                'item_id' => 1,
                'rental_days' => 2,
                'sub_total' => 3000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Activity Logs — pakai reference_id = id invoice (1)
        DB::table('activity_logs')->insert([
            [
                'user_id' => 1,
                'type' => 'Create',
                'reference_id' => '1',
                'description' => 'Membuat invoice INV-001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'type' => 'Update',
                'reference_id' => '1',
                'description' => 'Mengubah status invoice INV-001 menjadi Approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'type' => 'Create',
                'reference_id' => '1',
                'description' => 'Menambahkan detail unit ke invoice INV-001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
