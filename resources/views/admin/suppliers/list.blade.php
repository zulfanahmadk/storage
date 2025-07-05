@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Suppliers List</h1>

    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ url('admin/suppliers/add') }}" class="btn btn-primary"> Add New Supplier</a>
                        </h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->supplier_name }}</td>
                                        <td>{{ $value->supplier_email }}</td>
                                        <td>{{ $value->contact_number }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>

                                            <a href="{{ url('admin/suppliers/edit/' . $value->id) }}"
                                                class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                            <a href="{{ url('admin/suppliers/delete/' . $value->id) }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete?')"><i
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
