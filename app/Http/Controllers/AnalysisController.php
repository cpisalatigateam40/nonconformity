<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Nonconformity;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index()
    {
        $nonconformities = Nonconformity::get();

        $allpoint = $nonconformities->sum('point') + $nonconformities->count();

        $counts = [
            'all' => $nonconformities->count(),
            'close' => $nonconformities->where('status', 1)->count(),
            'open' => $nonconformities->where('status', 0)->count(),
            'point' => $allpoint,
        ];

        $departments = Department::with('nonconformities')->get();

        foreach ($departments as $department) {
            $ncs = $department->nonconformities;

            // Total findings
            $total = $ncs->count();

            // Closed nonconformities
            $closed = $ncs->where('status', 1)->count();

            // Percentage of closed vs total
            $percentage = $total > 0 ? round(($closed / $total) * 100, 1) : 0;

            // Completion time in days (sum)
            $totalCompletionDays = 0;

            foreach ($ncs as $nc) {
                if ($nc->found_date && $nc->corrective_date) {
                    $found = \Carbon\Carbon::parse($nc->found_date);
                    $corrective = \Carbon\Carbon::parse($nc->corrective_date);
                    $diffDays = ceil($found->diffInMinutes($corrective) / (60 * 24)); // round up to days
                    $totalCompletionDays += $diffDays;
                }
            }

            // Total points = total findings + sum of points
            $totalPoints = $total + $ncs->sum('point');

            // Attach computed data to department model
            $department->total_findings = $total;
            $department->closed_findings = $closed;
            $department->percentage_closed = $percentage;
            $department->completion_days = $totalCompletionDays;
            $department->total_points = $totalPoints;
        }

        return view('analysis.index', [
            'count' => $counts,
            'departments' => $departments,
        ]);
    }
}
