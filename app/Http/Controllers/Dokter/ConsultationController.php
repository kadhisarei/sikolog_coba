<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $konsultasi = Auth::user()->consultationsAsDoctor()->with('user')->latest()->paginate(10);

        return view('dokter.konsultasi.index', compact('konsultasi'));
    }

    public function updateStatus(Request $request, Consultation $consultation)
    {
        abort_unless($consultation->doctor_id === Auth::id(), 403);

        $validated = $request->validate([
            'status' => ['required', 'in:dikonfirmasi,berlangsung,selesai,dibatalkan'],
            'catatan_dokter' => ['nullable', 'string'],
        ]);

        $consultation->update($validated);

        return back()->with('success', 'Status konsultasi diperbarui.');
    }
}
