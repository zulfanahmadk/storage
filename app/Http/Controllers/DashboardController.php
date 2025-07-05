<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceModel;
use App\Models\InvoiceDetailModel;
use App\Models\ItemUnitModel;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return $this->renderDashboard('admin.dashboard.list');
    }

    public function manager_dashboard()
    {
        return $this->renderDashboard('admin.manager.dashboard.list');
    }

    private function renderDashboard($viewPath)
    {
        // Grafik Harian & Bulanan
        $invoices = DB::table('invoices')
            ->select('id', 'created_at')
            ->orderBy('created_at')
            ->get();

        $dailyLabels = [];
        $dailyCounts = [];
        $monthlyLabels = [];
        $monthlyCounts = [];

        $invoices->groupBy(function ($inv) {
            return Carbon::parse($inv->created_at)->format('Y-m-d');
        })->each(function ($group, $date) use (&$dailyLabels, &$dailyCounts) {
            $dailyLabels[] = $date;
            $dailyCounts[] = count($group);
        });

        $invoices->groupBy(function ($inv) {
            return Carbon::parse($inv->created_at)->format('Y-m');
        })->each(function ($group, $month) use (&$monthlyLabels, &$monthlyCounts) {
            $monthlyLabels[] = $month;
            $monthlyCounts[] = count($group);
        });

        // Revenue & Statistik
        $currentMonth = Carbon::now()->format('Y-m');
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');

        $revenueThisMonth = InvoiceDetailModel::where('created_at', 'like', "$currentMonth%")->sum('sub_total');
        $revenueLastMonth = InvoiceDetailModel::where('created_at', 'like', "$lastMonth%")->sum('sub_total');

        $revenueGrowth = $revenueLastMonth > 0
            ? (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100
            : 0;

        // Data tambahan
        $invoicesPending = InvoiceModel::where('status', 'Pending')->latest()->get();
        $availableUnits  = ItemUnitModel::where('status', 'Tersedia')->count();
        $recentInvoices  = InvoiceModel::with(['getCustomer', 'details.item'])
            ->where('status', 'Approved')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil log aktivitas terbaru dari tabel log
        $activities = ActivityLog::with('user')
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        // Kirim ke view
        return view($viewPath, compact(
            'dailyLabels',
            'dailyCounts',
            'monthlyLabels',
            'monthlyCounts',
            'revenueThisMonth',
            'revenueGrowth',
            'invoicesPending',
            'availableUnits',
            'recentInvoices',
            'activities'
        ));
    }
}
