@extends('admin.layouts.app')
@section('content')

    <div class="pagetitle d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <div class="mt-2 mt-md-0">
            <div class="card shadow-sm" style="background-color: #d1c4e9; border-radius: 12px;">
                <div class="card-body px-3 py-2 text-center">
                    <div id="clock" style="font-weight: bold; font-size: 16px;">--:--:--</div>
                    <div id="day" style="font-size: 14px; font-weight: 600;">Loading...</div>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <script>
        function updateClock() {
            const now = new Date();

            // Ambil jam, menit, detik
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');

            const time = `${hours}:${minutes}:${seconds}`;

            // Hari dan bulan dalam Bahasa Indonesia
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            const dayName = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const fullDate = `${dayName}, ${date} ${month} ${year}`;

            document.getElementById('clock').innerText = time;
            document.getElementById('day').innerText = fullDate;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card" style="background-color: #d1c4e9; overflow: hidden;">
                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| Bulan Ini</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rp. {{ number_format($revenueThisMonth, 0, ',', '.') }}</h6>

                                        @php
                                            $growthRounded = round($revenueGrowth, 1);
                                            $growthColor = 'text-warning';
                                            $growthText = 'Stabil dibanding bulan lalu';

                                            if ($growthRounded > 0) {
                                                $growthColor = 'text-success';
                                                $growthText = 'Naik dibanding bulan lalu';
                                            } elseif ($growthRounded < 0) {
                                                $growthColor = 'text-danger';
                                                $growthText = 'Turun dibanding bulan lalu';
                                            }
                                        @endphp

                                        <span class="{{ $growthColor }} small pt-1 fw-bold">
                                            {{ $growthRounded }}%
                                        </span>
                                        <span class="small pt-2 ps-1">
                                            {{ $growthText }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Available Units -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card" style="background-color: #d1c4e9; overflow: hidden;">
                            <div class="card-body">
                                <h5 class="card-title">Unit Tersedia</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box"></i>
                                    </div>
                                    <div class="ps-3">
                                        @php
                                            $unitColor = 'text-success';
                                            $unitStatus = 'Unit Aman';

                                            if ($availableUnits == 0) {
                                                $unitColor = 'text-danger';
                                                $unitStatus = 'Unit Tidak Tersedia';
                                            } elseif ($availableUnits <= 3) {
                                                $unitColor = 'text-danger';
                                                $unitStatus = 'Unit kritis';
                                            } elseif ($availableUnits <= 6) {
                                                $unitColor = 'text-warning';
                                                $unitStatus = 'Unit menipis';
                                            }
                                        @endphp

                                        <h6 class="{{ $unitColor }}">{{ $availableUnits }}</h6>
                                        <span class="small pt-2 ps-1 {{ $unitColor }}">{{ $unitStatus }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->is_role == 2 && isset($invoicesPending) && count($invoicesPending) > 0)
                        <div class="card border-start border-4 border-primary shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold">
                                    <i class="bi bi-hourglass-split me-1"></i> Menunggu Persetujuan Manager
                                </h5>

                                <div class="list-group list-group-flush">
                                    @foreach ($invoicesPending as $invoice)
                                        <a href="{{ url('manager/invoice/' . $invoice->id) }}"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-bold mb-1">
                                                    Invoice #{{ $invoice->id_invoice }}
                                                </div>
                                                <small class="text-muted">
                                                    Diajukan
                                                    {{ \Carbon\Carbon::parse($invoice->created_at)->diffForHumans() }}
                                                </small>
                                            </div>
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Recent Sales</h5>

                                <table class="table table-border datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Invoice ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentInvoices as $invoice)
                                            <tr>
                                                <th scope="row"><a href="#">{{ $invoice->id_invoice }}</a></th>
                                                <td>{{ $invoice->getCustomer->name ?? 'Unknown' }}</td>
                                                <td>
                                                    @if ($invoice->details->count() > 0)
                                                        @foreach ($invoice->details as $detail)
                                                            {{ $detail->item->kode_unit ?? '??' }}
                                                        @endforeach
                                                    @else
                                                        <em>-</em>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $totalSubTotal = $invoice->details->sum('sub_total');
                                                    @endphp
                                                    Rp. {{ number_format($totalSubTotal, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if ($invoice->status == 'Approved')
                                                        <span class="badge bg-success">{{ $invoice->status }}</span>
                                                    @elseif($invoice->status == 'Pending')
                                                        <span class="badge bg-warning">{{ $invoice->status }}</span>
                                                    @elseif($invoice->status == 'Rejected')
                                                        <span class="badge bg-danger">{{ $invoice->status }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $invoice->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Recent Activity -->
                    <div class="col-12 mt-4">
                        <div class="card recent-activity overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Recent Activity</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Aktivitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activities as $activity)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($activity->created_at)->translatedFormat('d F Y H:i:s') }}
                                                </td>
                                                <td>{{ $activity->user->name ?? 'Unknown' }} - {!! $activity->description !!}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
            </div><!-- End Right side columns -->

        </div>
    </section>

@endsection
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
