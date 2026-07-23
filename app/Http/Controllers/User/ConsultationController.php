<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $dokterList = User::where('role', 'dokter')->with('doctorProfile')->where('is_active', true)->get();

        return view('consultations.index', compact('dokterList'));
    }

    public function create(User $dokter)
    {
        abort_unless($dokter->role === 'dokter', 404);

        return view('consultations.create', compact('dokter'));
    }

    public function store(Request $request, User $dokter)
    {
        $validated = $request->validate([
            'tanggal_konsultasi' => ['required', 'date', 'after_or_equal:today'],
            'jam_konsultasi' => ['required'],
            'metode' => ['required', 'in:chat,video_call,tatap_muka'],
            'keluhan' => ['required', 'string'],
        ]);

        Consultation::create([
            'kode_booking' => Consultation::generateKodeBooking(),
            'user_id' => Auth::id(),
            'doctor_id' => $dokter->id,
            'tanggal_konsultasi' => $validated['tanggal_konsultasi'],
            'jam_konsultasi' => $validated['jam_konsultasi'],
            'metode' => $validated['metode'],
            'keluhan' => $validated['keluhan'],
            'status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Booking konsultasi berhasil dikirim, menunggu konfirmasi dokter.');
    }

    public function beriRating(Request $request, Consultation $consultation)
    {
        abort_unless($consultation->user_id === Auth::id(), 403);
        abort_unless($consultation->status === 'selesai', 400);

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'ulasan' => ['nullable', 'string'],
        ]);

        $consultation->update($validated);

        return back()->with('success', 'Terima kasih atas penilaian Anda.');
    }
}
