<?php

namespace App\Http\Controllers;

use App\Models\Nonconformity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
    public function index($uuid = null)
    {
        $user = Auth::user();
        if ($user->hasRole('Auditee')) {
            $nonconformities = Nonconformity::with('department')->where('department_uuid', $user->department_uuid)->get();
        } else {
            $nonconformities = Nonconformity::with('department')->get();
        }

        return view('repair.create', [
            'nonconformities' => $nonconformities,
            'selectedUuid' => $uuid, // pass the preselected UUID to the view
        ]);
    }

    public function updateRepair(Request $request)
    {

        $request->validate([
            'asset_uuid' => 'required|uuid',
            'foto_after' => 'nullable|image|max:2048',
            'tanggal_perbaikan' => 'nullable|string'
        ]);

        $asset = Nonconformity::where('uuid', $request->asset_uuid)->firstOrFail();

        if ($request->filled('tanggal_perbaikan')) {
            // Parse using the correct input format (d/m/Y, H.i.s)
            $correctiveDate = Carbon::createFromFormat('d/m/Y, H.i.s', $request->tanggal_perbaikan)
                ->format('Y-m-d H:i:s');
        }

        if ($request->hasFile('foto_after')) {
            $filename = time() . '_' . $request->file('foto_after')->getClientOriginalName();
            $path = $request->file('foto_after')->storeAs('perbaikan', $filename, 'public');
        }

        $asset->update([
            'corrective_documentation' => $path,
            'corrective_date' => $correctiveDate,
            'status' => 1
        ]);

        // return redirect()->back()->with('success', 'Data perbaikan berhasil diperbarui.');

        return redirect()
            ->route('recap.index')
            ->with('success', 'Data perbaikan berhasil diperbarui.');
    }
}
