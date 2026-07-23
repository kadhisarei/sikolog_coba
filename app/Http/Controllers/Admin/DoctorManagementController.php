<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorManagementController extends Controller
{
    public function index()
    {
        $dokter = User::where('role', 'dokter')->with('doctorProfile')->latest()->paginate(10);

        return view('admin.dokter.index', compact('dokter'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'jenis' => ['required', 'in:psikolog,psikiater'],
            'str_number' => ['nullable', 'string', 'max:100'],
            'spesialisasi' => ['nullable', 'string', 'max:255'],
            'pengalaman_tahun' => ['nullable', 'integer', 'min:0'],
            'bio' => ['nullable', 'string'],
            'tarif_konsultasi' => ['nullable', 'numeric', 'min:0'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'dokter',
        ]);

        DoctorProfile::create([
            'user_id' => $user->id,
            'jenis' => $validated['jenis'],
            'str_number' => $validated['str_number'] ?? null,
            'spesialisasi' => $validated['spesialisasi'] ?? null,
            'pengalaman_tahun' => $validated['pengalaman_tahun'] ?? 0,
            'bio' => $validated['bio'] ?? null,
            'tarif_konsultasi' => $validated['tarif_konsultasi'] ?? 0,
            'is_verified' => true,
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Akun dokter berhasil dibuat.');
    }

    public function destroy(User $dokter)
    {
        $dokter->delete();

        return back()->with('success', 'Akun dokter dihapus.');
    }
}
