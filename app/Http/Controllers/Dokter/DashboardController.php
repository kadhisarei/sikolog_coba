<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dokter = Auth::user();
        $konsultasiMendatang = $dokter->consultationsAsDoctor()
            ->whereIn('status', ['pending', 'dikonfirmasi'])
            ->orderBy('tanggal_konsultasi')
            ->take(10)->get();

        $totalKonsultasi = $dokter->consultationsAsDoctor()->count();
        $selesai = $dokter->consultationsAsDoctor()->where('status', 'selesai')->count();
        $rataRating = $dokter->consultationsAsDoctor()->whereNotNull('rating')->avg('rating');
        $persentaseKinerja = $dokter->persentaseKinerjaDokter();

        return view('dokter.dashboard', compact(
            'konsultasiMendatang', 'totalKonsultasi', 'selesai', 'rataRating', 'persentaseKinerja'
        ));
    }
}
