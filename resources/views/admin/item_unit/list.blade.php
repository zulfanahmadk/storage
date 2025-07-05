@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Item Unit List</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ url('admin/item_unit/add') }}" class="btn btn-primary">Tambah Item</a>
                        </h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nama Item</th>
                                    <th>Kode Unit</th>
                                    <th>Brand</th>
                                    <th>Supplier</th>
                                    <th>Price Per Day</th>
                                    <th>Status Alat</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi</th>
                                    <th>Catatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->item->name ?? '-' }}</td>
                                        <td>{{ $value->kode_unit }}</td>
                                        <td>{{ $value->brand }}</td>
                                        <td>{{ $value->supplierData->supplier_name ?? '-' }}</td>
                                        <td>Rp. {{ number_format($value->price_per_day, 0, ',', '.') }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>{{ $value->lokasi }}</td>
                                        <td>{{ $value->kondisi }}</td>
                                        <td>{{ $value->catatan }}</td>
                                        <td>
                                            <a href="{{ url('admin/item_unit/edit/' . $value->id) }}"
                                                class="btn btn-success" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="{{ url('admin/item_unit/delete/' . $value->id) }}"
                                                class="btn btn-danger" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
