<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FactAktivitasPetugas;
use Carbon\Carbon;

class VisualisasiController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        $startId = (int) str_replace('-', '', $startDate);
        $endId = (int) str_replace('-', '', $endDate);

        $petugasIds = \App\Models\User::where('role_id', '!=', 1)->pluck('user_id');

        $query = FactAktivitasPetugas::with('user')
            ->whereBetween('waktu_id', [$startId, $endId])
            ->whereIn('user_id', $petugasIds);

        $factData = $query->get();

        $totalAktivitas = $factData->sum('jumlah_transisi');
        $totalRevisi = $factData->where('is_revisi', true)->count();

        $mvpGroup = $factData->groupBy('user_id')->sortByDesc(function ($rows) {
            return $rows->count();
        })->first();

        $mvp = null;
        if ($mvpGroup) {
            $mvp = (object) [
                'user' => $mvpGroup->first()->user,
                'total' => $mvpGroup->count()
            ];
        }

        $chartData = $factData->groupBy('tanggal');
        $chartLabels = [];
        $chartValues = [];

        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);
        foreach ($period as $date) {
            $d = $date->format('Y-m-d');
            $chartLabels[] = $date->format('d M');
            $chartValues[] = isset($chartData[$d]) ? $chartData[$d]->sum('jumlah_transisi') : 0;
        }

        $kinerjaPetugas = $factData->groupBy('user_id')->map(function ($items) {
            $user = $items->first()->user;
            $total = $items->sum('jumlah_transisi');
            $revisi = $items->where('is_revisi', true)->count();
            $rasio = $total > 0 ? round(($revisi / $total) * 100, 1) : 0;
            $label = 'Needs Improvement';
            if ($rasio < 15) $label = 'Excellent';
            elseif ($rasio < 30) $label = 'Good';

            return (object) [
                'name' => $user->name,
                'user' => $user,
                'total_screening' => $total,
                'total' => $total,
                'jumlah_revisi' => $revisi,
                'rasio_revisi' => $rasio,
                'label' => $label
            ];
        })->sortByDesc('total');

        $leaderboard = $kinerjaPetugas;

        return view('admin.visualisasi.index', compact(
            'startDate', 'endDate', 'totalAktivitas', 'totalRevisi', 
            'mvp', 'chartLabels', 'chartValues', 'leaderboard', 'kinerjaPetugas'
        ));
    }
}