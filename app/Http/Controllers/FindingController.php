<?php

namespace App\Http\Controllers;

use App\Models\Nonconformity;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FindingController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('department', 'asc')->get();

        return view('finding.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggalTemuan' => 'nullable|date',
            'picTemuan' => 'required|uuid',
            'fotoBefore' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsiTemuan' => 'required|string',
            'keteranganTemuan' => 'required|string',
            'lokasiTemuan' => 'required|string',
        ]);

        $department = Department::where('uuid', $request->picTemuan)->firstOrFail();
        
        $fotoPath = $request->file('fotoBefore')->store('nonconformities', 'public');

        Nonconformity::create([
            'uuid' => Str::uuid(),
            'document_number' => 'DOC-' . now()->format('YmdHis'),
            'found_date' => $request->tanggalTemuan ?? now(),
            'department_uuid' => $department->uuid,
            'nonconformity_documentiation' => $fotoPath,
            'description' => $request->deskripsiTemuan,
            'information' => $request->keteranganTemuan,
            'location' => $request->lokasiTemuan,

            // 'corrective_documentation' => '-',
            // 'corrective_date' => now(),
            // 'point' => 0,
            'status' => 0,
        ]);

        return redirect()
            ->route('finding.create')
            ->with('success', 'Temuan berhasil disimpan!');
    }

}