<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Nonconformity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::select('uuid', 'abbrivation')->orderBy('abbrivation')->get();

        $query = Nonconformity::with('department');

        // Apply filter
        if ($request->filled('department_uuid')) {
            $query->where('department_uuid', $request->department_uuid);
        }

        $nonconformities = $query->get();

        foreach ($nonconformities as $item) {
            if ($item->found_date && $item->corrective_date) {
                $found = \Carbon\Carbon::parse($item->found_date);
                $corrective = \Carbon\Carbon::parse($item->corrective_date);
                $item->completion_time = ceil($found->diffInMinutes($corrective) / 60);
            } else {
                $item->completion_time = null;
            }
        }

        $counts = [
            'all' => $nonconformities->count(),
            'open' => $nonconformities->where('status', 0)->count(),
            'close' => $nonconformities->where('status', 1)->count(),
        ];

        return view('recap.index', [
            'departments' => $departments,
            'count' => $counts,
            'nonconformities' => $nonconformities
        ]);
    }



    public function departmentStats()
    {
        $departments = Department::with('nonconformities')->get();

        $stats = $departments->map(function ($dept) {
            $nonconformities = $dept->nonconformities;

            $total = $nonconformities->count();
            $closed = $nonconformities->where('status', 'Closed')->count();
            $percentage = $total > 0 ? round(($closed / $total) * 100) : 0;

            // Total and average completion time
            $totalHours = 0;
            $closedData = $nonconformities->where('status', 'Closed');
            foreach ($closedData as $item) {
                if ($item->found_date && $item->corrective_date) {
                    $start = Carbon::parse($item->found_date);
                    $end = Carbon::parse($item->corrective_date);
                    $diffHours = ceil($end->diffInHours($start));
                    $totalHours += $diffHours;
                }
            }

            $avgHours = $closed > 0 ? round($totalHours / $closed) : 0;
            $avgDays = round($avgHours / 24, 1);

            // Total points (base + additional)
            $totalPoinTambahan = $closedData->sum('point');
            $totalPoin = $total + $totalPoinTambahan;

            return [
                'department' => $dept->abbrivation ?? $dept->department,
                'total' => $total,
                'closed' => $closed,
                'percentage' => $percentage,
                'total_hours' => $totalHours,
                'avg_days' => $avgDays,
                'total_poin' => $totalPoin,
            ];
        });

        return response()->json($stats);
    }
}
