@extends('admin.layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Daftar Pending Invoices</h1>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="">Invoice</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body center">
                        <div class="card-title d-flex justify-content-between mb-3">
                            <a href="{{ url('manager/invoice/add') }}" class="btn btn-primary">Buat Invoice</a>
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice ID</th>
                                    <th>Customer Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getRecord->sortByDesc('created_at') as $value)
                                    <tr>
                                        <th>{{ $value->id }}</th>
                                        <td>{{ $value->id_invoice }}</td>
                                        <td>{{ $value->getCustomer->name }}</td>
                                        <td>{{ date('d M Y', strtotime($value->start_date)) }}</td>
                                        <td>{{ date('d M Y', strtotime($value->end_date)) }}</td>
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
                                        <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            @if ($value->status == 'Pending')
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#verifyModal{{ $value->id }}">
                                                    Verifikasi
                                                </button>
                                            @else
                                                <em>-</em>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            @foreach ($getRecord as $value)
                                @if ($value->status == 'Pending')
                                    <!-- Modal -->
                                    <div class="modal fade" id="verifyModal{{ $value->id }}" tabindex="-1"
                                        aria-labelledby="verifyModalLabel{{ $value->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ url('manager/invoice/verify/' . $value->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="verifyModalLabel{{ $value->id }}">
                                                            Verifikasi Invoice #{{ $value->id_invoice }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="note" class="form-label">Catatan
                                                                (Opsional)
                                                            </label>
                                                            <textarea name="note" class="form-control" rows="3"></textarea>
                                                        </div>

                                                        <div class="d-flex justify-content-between">
                                                            <button type="submit" name="status" value="Approved"
                                                                class="btn btn-success">Approve</button>
                                                            <button type="submit" name="status" value="Rejected"
                                                                class="btn btn-danger">Reject</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
