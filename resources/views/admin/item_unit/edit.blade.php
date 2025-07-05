@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Edit Item</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Item</h5>

                        <form action="{{ url('admin/item_unit/edit/' . $oldRecord->id) }}" method="post"
                            enctype="multipart/form-data">

                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Item Name <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="item_id" class="form-control" required>
                                        <option value="">Select Item Name</option>
                                        @foreach ($getRecord as $value)
                                            <option {{ $value->id == $oldRecord->item_id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kode Unit <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $oldRecord->kode_unit }}" name="kode_unit"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Brand <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $oldRecord->brand }}" name="brand"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Supplier <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="supplier" class="form-control" required>
                                        <option value="">Pilih Supplier</option>
                                        @foreach ($getSupplier as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $oldRecord->supplier == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->supplier_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Price Per Day <span style="color: red;">
                                        *</span></label>
                                <div class="col-sm-10">
                                    <input type="number" value="{{ $oldRecord->price_per_day }}" name="price_per_day"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="Tersedia"
                                            {{ ($oldRecord->status ?? '') == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                        </option>
                                        <option value="Disewa"
                                            {{ ($oldRecord->status ?? '') == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                                        <option value="Perawatan"
                                            {{ ($oldRecord->status ?? '') == 'Perawatan' ? 'selected' : '' }}>Perawatan
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Lokasi <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $oldRecord->lokasi }}" name="lokasi"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kondisi <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <select name="kondisi" class="form-control">
                                        <option value="Baik"
                                            {{ ($oldRecord->kondisi ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Butuh Perawatan"
                                            {{ ($oldRecord->kondisi ?? '') == 'Butuh Perawatan' ? 'selected' : '' }}>Butuh
                                            Perawatan</option>
                                        <option value="Rusak"
                                            {{ ($oldRecord->kondisi ?? '') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $oldRecord->catatan }}" name="catatan"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
