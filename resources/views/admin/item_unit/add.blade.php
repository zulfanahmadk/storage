@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Tambah Item</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Item</h5>

                        <form action="{{ url('admin/item_unit/add') }}" method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Item Name <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="item_id" class="form-control" required>
                                        <option value="">Pilih Item</option>
                                        @foreach ($getRecord as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kode Unit <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="" name="kode_unit" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Brand <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="" name="brand" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Supplier <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="supplier" class="form-control" required>
                                        <option value="">Pilih Supplier</option>
                                        @foreach ($getSupplier as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Price Per Day <span style="color: red;">
                                        *</span></label>
                                <div class="col-sm-10">
                                    <input type="number" value="" name="price_per_day" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" required>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Disewa">Disewa</option>
                                        <option value="Perawatan">Perawatan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Lokasi <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="" name="lokasi" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kondisi <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="kondisi" class="form-control" required>
                                        <option value="Baik">Baik</option>
                                        <option value="Butuh Perawatan">Butuh Perawatan</option>
                                        <option value="Rusak">Rusak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <input type="text" value="" name="catatan" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
