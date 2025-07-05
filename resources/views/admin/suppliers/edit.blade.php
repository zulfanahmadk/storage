@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Edit Supplier</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Suppliers</h5>

                        <form action="{{ url('admin/suppliers/edit/' . $getRecord->id) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Name <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="supplier_name" value="{{ $getRecord->supplier_name }}"
                                        class="form-control required">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Email <span style="color: red;"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="supplier_email" value="{{ $getRecord->supplier_email }}"
                                        class="form-control required">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Contact Number <span style="color: red;">
                                        *</span></label>
                                <div class="col-sm-10">
                                    <input type="number" name="contact_number" value="{{ $getRecord->contact_number }}"
                                        class="form-control required">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea name="address" class="form-control">{{ $getRecord->address }}</textarea>
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
