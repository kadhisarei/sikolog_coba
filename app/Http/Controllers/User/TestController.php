<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PersonalityTest;
use App\Models\TestOption;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        $tests = PersonalityTest::where('is_active', true)->withCount('questions')->get();

        return view('tests.index', compact('tests'));
    }

    public function show(PersonalityTest $test)
    {
        $test->load('questions.options');

        return view('tests.show', compact('test'));
    }

    /**
     * Proses jawaban, hitung skor & persentase, simpan hasil.
     */
    public function submit(Request $request, PersonalityTest $test)
    {
        $request->validate([
            'jawaban' => ['required', 'array'],
            'jawaban.*' => ['required', 'integer', 'exists:test_options,id'],
        ]);

        $totalSkor = 0;
        $detail = [];

        foreach ($request->input('jawaban') as $pertanyaanId => $optionId) {
            $option = TestOption::findOrFail($optionId);
            $totalSkor += $option->skor;
            $detail[] = [
                'pertanyaan_id' => (int) $pertanyaanId,
                'option_id' => $option->id,
                'skor' => $option->skor,
            ];
        }

        $skorMaksimal = $test->hitungSkorMaksimal();
        $persentase = $skorMaksimal > 0 ? round(($totalSkor / $skorMaksimal) * 100, 2) : 0;
        $kategoriHasil = TestResult::kategoriDariPersentase($persentase);

        $result = TestResult::create([
            'user_id' => Auth::id(),
            'personality_test_id' => $test->id,
            'total_skor' => $totalSkor,
            'skor_maksimal' => $skorMaksimal,
            'persentase' => $persentase,
            'kategori_hasil' => $kategoriHasil,
            'interpretasi' => $this->buatInterpretasi($kategoriHasil, $test),
            'detail_jawaban' => $detail,
            'selesai_pada' => now(),
        ]);

        return redirect()->route('tests.result', $result)->with('success', 'Tes berhasil diselesaikan.');
    }

    public function result(TestResult $result)
    {
        abort_unless($result->user_id === Auth::id(), 403);
        $result->load('test');

        return view('tests.result', compact('result'));
    }

    protected function buatInterpretasi(string $kategori, PersonalityTest $test): string
    {
        return match ($kategori) {
            'Tinggi' => "Hasil tes {$test->judul} Anda berada pada kategori tinggi. Disarankan untuk berkonsultasi dengan psikolog/psikiater kami guna pendampingan lebih lanjut.",
            'Sedang' => "Hasil tes {$test->judul} Anda berada pada kategori sedang. Perhatikan kondisi psikologis Anda dan pertimbangkan konsultasi bila diperlukan.",
            default => "Hasil tes {$test->judul} Anda berada pada kategori rendah. Kondisi psikologis Anda relatif baik, tetap jaga kesehatan mental Anda.",
        };
    }
}
