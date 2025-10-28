<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Nonconformity;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        // --- Get all distinct years from found_date ---
        $years = Nonconformity::selectRaw('YEAR(found_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // --- Filters ---
        $selectedYear = $request->input('tahun', now()->year);
        $selectedMonth = $request->input('bulan', now()->month);
        $periode = $request->input('periode', 'bulanan'); // default monthly

        $query = Nonconformity::query();

        if ($periode === 'bulanan') {
            $query->whereYear('found_date', $selectedYear)
                ->whereMonth('found_date', $selectedMonth);
        } else {
            $query->whereYear('found_date', $selectedYear);
        }

        $nonconformities = $query->with('department')->get();

        $allpoint = $nonconformities->sum('point') + $nonconformities->count();
        $counts = [
            'all' => $nonconformities->count(),
            'close' => $nonconformities->where('status', 1)->count(),
            'open' => $nonconformities->where('status', 0)->count(),
            'point' => $allpoint,
        ];

        // --- Group by Department for Analysis ---
        $departments = Department::with(['nonconformities' => function ($q) use ($periode, $selectedYear, $selectedMonth) {
            if ($periode === 'bulanan') {
                $q->whereYear('found_date', $selectedYear)
                    ->whereMonth('found_date', $selectedMonth);
            } else {
                $q->whereYear('found_date', $selectedYear);
            }
        }])->get();

        foreach ($departments as $department) {
            $ncs = $department->nonconformities;

            $total = $ncs->count();
            $closed = $ncs->where('status', 1)->count();
            $percentage = $total > 0 ? round(($closed / $total) * 100, 1) : 0;

            // Compute total completion days
            $totalCompletionDays = 0;
            foreach ($ncs as $nc) {
                if ($nc->found_date && $nc->corrective_date) {
                    $found = \Carbon\Carbon::parse($nc->found_date);
                    $corrective = \Carbon\Carbon::parse($nc->corrective_date);
                    $diffDays = $found->diffInMinutes($corrective) / (60 * 24);
                    $totalCompletionDays += ($diffDays < 1) ? 0 : ceil($diffDays);
                }
            }

            $totalPoints = $total + $ncs->sum('point');

            $department->total_findings = $total;
            $department->closed_findings = $closed;
            $department->percentage_closed = $percentage;
            $department->totalCompletionDays = $totalCompletionDays;
            $department->totalPoints = $totalPoints;
        }

        return view('analysis.index', [
            'count' => $counts,
            'departments' => $departments,
            'years' => $years,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
            'periode' => $periode,
        ]);
    }
}
