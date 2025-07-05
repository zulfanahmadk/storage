@extends('admin.layouts.app')
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .card,
        .card * {
            visibility: visible;
        }

        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .btn,
        .bi-arrow-left,
        .pagetitle a {
            display: none !important;
        }
    }
</style>
@section('content')
    <div class="pagetitle">
        <h1>INVOICE</h1>
        <a href="{{ url('admin/invoice/list') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card-title">

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h2>INVOICE</h2>
                                <p><strong>No: </strong>{{ $invoice->id_invoice }}</p>
                                <p><strong>Pengajuan:</strong> {{ date('d M Y', strtotime($invoice->created_at)) }}</p>
                                <p><strong>Approval:</strong> {{ date('d M Y', strtotime($invoice->approve_at)) }}</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h4><strong>PT. Dwikappa Asri Utama</strong></h4>
                                <p>
                                    Jl. Cipongporang No.19, Cilampeni, Kec. Katapang, <br>Kabupaten Bandung, Jawa Barat
                                    40921<br>
                                    Bandung, Indonesia<br>
                                    Telp: (022) 88886252
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>Nama Customer:</strong> {{ $invoice->getCustomer->name }}</p>
                                <p><strong>Alamat:</strong> {{ $invoice->getCustomer->address }}</p>
                                <p><strong>Telepon:</strong> {{ $invoice->getCustomer->contact_number }}</p>
                            </div>
                        </div>

                        @php
                            $no = 1;
                            $subtotal = 0;
                        @endphp

                        <table class="table table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Unit</th>
                                    <th>Rental Days</th>
                                    <th>Price Per Day</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice_detail as $value)
                                    @php $subtotal += $value->sub_total; @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->item_unit->kode_unit }}</td>
                                        <td>{{ $value->rental_days }} hari</td>
                                        <td>Rp {{ number_format($value->item_unit->price_per_day, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($value->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Catatan atau info tambahan -->
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>PPN (11%)</th>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Grand Total</strong></th>
                                        <td><strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-title text-end">
                            <a href="#" onclick="window.print()" class="btn btn-success mb-3"><i
                                    class="bi bi-printer"></i> Print Invoice</a>
                        </div>

                        <p class="text-center mt-4">@ {{ now()->format('Y') }} - <a href="https://www.dwikappa.co.id/">PT
                                Dwikappa Asri Utama</a></p>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
