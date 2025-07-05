@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Daftar Pending Invoices</h1>

    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body center">
                        <div class="card-title d-flex justify-content-between mb-3">
                            <a href="{{ url('admin/invoice/add') }}" class="btn btn-primary">Buat Invoice</a>
                            <a href="{{ url('admin/invoice/list') }}" class="btn btn-success">Lihat Semua Invoice</a>
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor Invoice</th>
                                    <th scope="col">Nama Customer</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Dibuat Oleh</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($getRecord as $value)
                                    <!-- @if ($value->status == 'Pending')
    -->
                                    <tr>
                                        <td>{{ $value->id_invoice }}</td>
                                        <td>{{ $value->getCustomer->name }}</td>
                                        <td>{{ date('d M Y', strtotime($value->start_date)) }}</td>
                                        <td>{{ date('d M Y', strtotime($value->end_date)) }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td><span class="badge bg-warning text-dark">{{ $value->status }}</span></td>
                                        <td>{{ $value->createdByUser->name ?? '-' }}</td>
                                    </tr>
                                    <!--
    @endif -->
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
