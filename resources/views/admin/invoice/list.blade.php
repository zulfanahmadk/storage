@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Invoices List</h1>

    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><a href="{{ url('admin/invoice') }}" class="btn btn-primary"><i
                                    class="bi bi-arrow-left"></i> Kembali</a></div>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Invoice ID</th>
                                    <th scope="col">Nama Customer</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Waktu Approve</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Update By</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->id_invoice }}</td>
                                        <td>{{ $value->getCustomer->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->start_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->end_date)) }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>
                                            @if ($value->status == 'Pending')
                                                <span class="badge bg-warning text-dark">{{ $value->status }}</span>
                                            @elseif($value->status == 'Approved')
                                                <span class="badge bg-success">{{ $value->status }}</span>
                                            @elseif($value->status == 'Rejected')
                                                <span class="badge bg-danger">{{ $value->status }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $value->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $value->approve_at ? \Carbon\Carbon::parse($value->approve_at)->translatedFormat('H:i - d F Y') : '-' }}
                                        </td>
                                        <td>{{ $value->createdByUser->name ?? '-' }}</td>
                                        <td>{{ $value->updatedByUser->name ?? '-' }}</td>
                                        <td>{{ $value->note }}</td>
                                        <td>
                                            @if ($value->status == 'Approved')
                                                <a href="{{ url('admin/invoice/list/print/' . $value->id) }}"
                                                    class="btn btn-success">
                                                    <i class="bi bi-file-earmark-plus"></i> Invoice
                                                </a>
                                            @endif
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
