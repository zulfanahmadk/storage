@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Consumable Item List</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ url('admin/item/add') }}" class="btn btn-primary"> Tambah Barang</a>
                        </h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Specification</th>
                                    <th>Unit</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->category }}</td>
                                        <td>{{ $value->specification }}</td>
                                        <td>{{ $value->unit }}</td>
                                        <td>{{ $value->stock }}</td>
                                        <td>Rp. {{ number_format($value->price, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ url('admin/item/edit/' . $value->id) }}" class="btn btn-success"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="{{ url('admin/item/delete/' . $value->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Delete this item?')"><i
                                                    class="bi bi-trash"></i></a>
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
