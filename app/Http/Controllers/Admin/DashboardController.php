<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::where('role', 'user')->count();
        $totalDokter = User::where('role', 'dokter')->count();
        $totalKonsultasi = Consultation::count();
        $konsultasiSelesai = Consultation::where('status', 'selesai')->count();

        $tingkatPenyelesaian = $totalKonsultasi > 0
            ? round(($konsultasiSelesai / $totalKonsultasi) * 100, 2)
            : 0;

        // performa tiap dokter (persentase kinerja)
        $dokterList = User::where('role', 'dokter')->with('doctorProfile')->get()->map(function ($dokter) {
            return [
                'id' => $dokter->id,
                'name' => $dokter->name,
                'jenis' => optional($dokter->doctorProfile)->jenis,
                'total_konsultasi' => $dokter->consultationsAsDoctor()->count(),
                'persentase_kinerja' => $dokter->persentaseKinerjaDokter(),
            ];
        });

        // progres tes tiap user (persentase)
        $userList = User::where('role', 'user')->get()->map(function ($u) {
            return [
                'id' => $u->id,
                'name' => $u->name,
                'persentase_progres_tes' => $u->persentaseProgresTes(),
            ];
        });

        return view('admin.dashboard', compact(
            'totalUser', 'totalDokter', 'totalKonsultasi',
            'konsultasiSelesai', 'tingkatPenyelesaian', 'dokterList', 'userList'
        ));
    }
}
