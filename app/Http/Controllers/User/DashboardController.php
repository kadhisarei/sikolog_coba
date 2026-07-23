<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PersonalityTest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $persentaseProgres = $user->persentaseProgresTes();
        $riwayatKonsultasi = $user->consultationsAsUser()->latest()->take(5)->get();
        $riwayatTes = $user->testResults()->with('test')->latest()->take(5)->get();
        $totalTesAktif = PersonalityTest::where('is_active', true)->count();

        return view('user.dashboard', compact(
            'persentaseProgres', 'riwayatKonsultasi', 'riwayatTes', 'totalTesAktif'
        ));
    }
}
