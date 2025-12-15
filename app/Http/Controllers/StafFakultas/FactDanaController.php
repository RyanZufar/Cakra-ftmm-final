<?php

namespace App\Http\Controllers\StafFakultas;

use App\Http\Controllers\Controller;
use App\Models\FactDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FactDanaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $availableYears = FactDana::select('termin')
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

        $inputTermin = $request->input('termin', 'Termin2'); 
        if ($inputTermin === 'Annual') {
            $queryFact = FactDana::with('ormawa')->where('termin', 'LIKE', $tahun . '-%');
            $labelCard4 = "Total Tahunan";
            $subLabelCard4 = "Akumulasi Tahun " . $tahun;
            $badgeTermin = "Tahunan";
        } elseif ($inputTermin === 'Termin1') {
            $queryFact = FactDana::with('ormawa')->where('termin', $tahun . '-1');
            $labelCard4 = "Total Termin 1";
            $subLabelCard4 = "Februari - Juni";
            $badgeTermin = "Termin 1";
        } else {
            $queryFact = FactDana::with('ormawa')->where('termin', $tahun . '-2');
            $labelCard4 = "Total Termin 2";
            $subLabelCard4 = "Juli - November";
            $badgeTermin = "Termin 2";
        }

        $totalDisetujui = (clone $queryFact)->sum('dana_disetujui');
        $totalDicairkan = (clone $queryFact)->sum('dana_dicairkan'); 
        $persenSerap = $totalDisetujui > 0 ? ($totalDicairkan / $totalDisetujui) * 100 : 0;
        $dataT1 = FactDana::where('termin', $tahun . '-1')->sum('dana_dicairkan');
        $dataT2 = FactDana::where('termin', $tahun . '-2')->sum('dana_dicairkan');

        $diffAmount = $totalDicairkan; 
        $growth = 0;
        
        if ($inputTermin === 'Termin2') {
             $diffAmount = $dataT2 - $dataT1;
             if ($dataT1 > 0) {
                $growth = (($dataT2 - $dataT1) / $dataT1) * 100;
            } elseif ($dataT2 > 0) {
                $growth = 100;
            }
        }
        $puncak = ($dataT2 >= $dataT1) ? 'Termin 2' : 'Termin 1';
        $topSpender = (clone $queryFact)
            ->select('ormawa_id', DB::raw('sum(dana_dicairkan) as total'), DB::raw('count(*) as kegiatan'))
            ->groupBy('ormawa_id')
            ->orderByDesc('total')
            ->with('ormawa')
            ->first();
            
        $topSpenderShare = ($totalDicairkan > 0 && $topSpender) ? ($topSpender->total / $totalDicairkan) * 100 : 0;
        $barData = ['Termin 1' => $dataT1, 'Termin 2' => $dataT2];
        $maxBar = max($barData) > 0 ? max($barData) : 1;
        $chartComparison = (clone $queryFact)
            ->select('ormawa_id', 
                DB::raw('sum(dana_disetujui) as rab'), 
                DB::raw('sum(dana_dicairkan) as realisasi')
            )
            ->groupBy('ormawa_id')
            ->orderByDesc('rab')
            ->take(6)
            ->get();

        $tableData = (clone $queryFact)
            ->select('ormawa_id',
                DB::raw('count(*) as jumlah_kegiatan'),
                DB::raw('sum(dana_disetujui) as total_rab'),
                DB::raw('sum(dana_dicairkan) as total_realisasi'),
                DB::raw('sum(jumlah_item_rab) as total_item_rab'),
                DB::raw('sum(jumlah_item_lpj) as total_item_lpj')
            )
            ->groupBy('ormawa_id')
            ->orderByDesc('total_rab')
            ->get();

        return view('staf_fakultas.analisis_dana', compact(
            'user', 'tahun', 'availableYears', 'inputTermin',
            'totalDisetujui', 'totalDicairkan', 'persenSerap',
            'chartComparison', 'tableData',
            'growth', 'diffAmount', 'puncak', 
            'topSpender', 'topSpenderShare',
            'barData', 'maxBar',
            'labelCard4', 'subLabelCard4', 'badgeTermin'
        ));
    }
}