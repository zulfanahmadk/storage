<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('type');
            $table->string('reference_id')->nullable();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('contact_number')->nullable();
            $table->text('address')->nullable();
            $table->string('doctor_name')->nullable();
            $table->text('doctor_address')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_invoice')->nullable();
            $table->string('customer_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->dateTime('approve_at')->nullable();
            $table->text('note')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_invoice')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('rental_days')->nullable();
            $table->decimal('sub_total', 12, 2)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->enum('category', ['Alat Berat Tipe 1','Alat Berat Tipe 2','Alat Berat Tipe 3']);
            $table->enum('machine_type', ['Diesel','Hybrid','Electric']);
            $table->text('specification')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('item_consumable', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('created_by_name')->nullable();
            $table->string('name');
            $table->string('category', 100)->nullable();
            $table->string('specification')->nullable();
            $table->string('unit', 50)->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('price', 12, 2)->default(0.00);
            $table->timestamps();
        });

        Schema::create('item_unit', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('kode_unit')->unique()->nullable();
            $table->string('brand')->nullable();
            $table->string('supplier')->nullable();
            $table->integer('price_per_day')->nullable();
            $table->enum('status', ['Tersedia','Disewa','Perawatan'])->default('Tersedia');
            $table->string('lokasi')->nullable();
            $table->enum('kondisi', ['Baik','Butuh Perawatan','Rusak'])->default('Baik');
            $table->text('catatan')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->tinyInteger('is_role')->default(1)->comment('1:Admin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_detail');
        Schema::dropIfExists('item');
        Schema::dropIfExists('item_consumable');
        Schema::dropIfExists('item_unit');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('users');
    }
};
