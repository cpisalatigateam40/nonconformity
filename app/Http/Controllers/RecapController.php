<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Nonconformity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    public function index()
    {
        $nonconformities = Nonconformity::with('department')->get();

        // Add calculated completion_time for each item
        foreach ($nonconformities as $item) {
            if ($item->found_date && $item->corrective_date) {
                $found = \Carbon\Carbon::parse($item->found_date);
                $corrective = \Carbon\Carbon::parse($item->corrective_date);
                $hours = ceil($found->diffInMinutes($corrective) / 60); // minimum 1 hour
                $item->completion_time = $hours;
            } else {
                $item->completion_time = null; // or 0 if you prefer
            }
        }

        $counts = [
            'all' => $nonconformities->count(),
            'open' => $nonconformities->where('status', 0)->count(),
            'close' => $nonconformities->where('status', 1)->count(),
        ];

        return view('recap.index', [
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
