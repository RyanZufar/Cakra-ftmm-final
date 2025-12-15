<?php

namespace App\Http\Controllers\StafFakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FactPengajuan;

class FactPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $availableYears = FactPengajuan::select('termin')
            ->get()
            ->map(function($item) {
                return explode('-', $item->termin)[0];
            })
            ->unique()
            ->sortDesc()
            ->values();

        if ($availableYears->isEmpty()) {
            $availableYears = collect([date('Y')]);
        }

        $defaultYear = $availableYears->first();
        $tahun = $request->input('tahun', $defaultYear);
        
        if (!$availableYears->contains($tahun)) {
            $tahun = $defaultYear;
        }

        $bulanSaatIni = date('n');
        $semesterDefault = ($bulanSaatIni >= 7 && $bulanSaatIni <= 12) ? '2' : '1';
        $semesterPilih = $request->input('termin', $semesterDefault);
        
        $kodeTermin = $tahun . '-' . $semesterPilih;
        $queryFact = FactPengajuan::with('ormawa')->where('termin', $kodeTermin);
        $totalDanaTermin = (clone $queryFact)->sum('total_dana_diajukan');
        $countOrmawaAktif = (clone $queryFact)->distinct('ormawa_id')->count('ormawa_id');
        $avgDanaPerOrmawa = $countOrmawaAktif > 0 ? $totalDanaTermin / $countOrmawaAktif : 0;

        $ormawaTeraktif = (clone $queryFact)
            ->select('ormawa_id', DB::raw('count(*) as total_pengajuan'))
            ->groupBy('ormawa_id')
            ->orderByDesc('total_pengajuan')
            ->first();

        $distribusiMahasiswa = (clone $queryFact)
            ->select('user_pengaju_id', DB::raw('count(*) as frekuensi'))
            ->groupBy('user_pengaju_id')
            ->get();
        $avgPengajuanUser = $distribusiMahasiswa->avg('frekuensi') ?? 0;
        $totalSampleMahasiswa = $distribusiMahasiswa->count();
        $chartDanaOrmawa = (clone $queryFact)
            ->select('ormawa_id', DB::raw('sum(total_dana_diajukan) as total_dana'))
            ->groupBy('ormawa_id')
            ->orderByDesc('total_dana')
            ->take(6)
            ->get();

        $allDanaData = (clone $queryFact)
            ->select('ormawa_id', DB::raw('sum(total_dana_diajukan) as total_dana'))
            ->groupBy('ormawa_id')
            ->orderByDesc('total_dana')
            ->get();

        $totalGlobal = $allDanaData->sum('total_dana');
        $pieChartData = [];
        $currentPercent = 0;
        $colors = ['#3b82f6', '#a855f7', '#ec4899', '#eab308', '#22c55e', '#ef4444']; 

        foreach($allDanaData->take(5) as $index => $item) {
            $percent = $totalGlobal > 0 ? ($item->total_dana / $totalGlobal) * 100 : 0;
            $pieChartData[] = [
                'label' => $item->ormawa->nama_ormawa,
                'value' => $item->total_dana,
                'percent' => round($percent, 1),
                'color' => $colors[$index] ?? '#cbd5e1',
                'start' => $currentPercent,
                'end' => $currentPercent + $percent
            ];
            $currentPercent += $percent;
        }

        if ($totalGlobal > 0 && $currentPercent < 100) {
            $remaining = $totalGlobal - $allDanaData->take(5)->sum('total_dana');
            if ($remaining > 0) {
                $pieChartData[] = [
                    'label' => 'Lainnya',
                    'value' => $remaining,
                    'percent' => round(100 - $currentPercent, 1),
                    'color' => '#64748b',
                    'start' => $currentPercent,
                    'end' => 100
                ];
            }
        }

        $rankingOrmawa = (clone $queryFact)
            ->select('ormawa_id', DB::raw('count(*) as jumlah_pengajuan'), DB::raw('sum(total_dana_diajukan) as total_dana'))
            ->groupBy('ormawa_id')
            ->orderByDesc('jumlah_pengajuan')
            ->get();

        return view('staf_fakultas.analisis_pengajuan', compact(
            'user', 'totalDanaTermin', 'avgDanaPerOrmawa', 'ormawaTeraktif',
            'avgPengajuanUser', 'chartDanaOrmawa', 'pieChartData', 'rankingOrmawa',
            'semesterPilih', 'tahun', 'totalSampleMahasiswa',
            'availableYears'
        ));
    }
}