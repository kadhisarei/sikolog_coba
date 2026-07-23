<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'user_id', 'personality_test_id', 'total_skor', 'skor_maksimal',
        'persentase', 'kategori_hasil', 'interpretasi', 'detail_jawaban', 'selesai_pada',
    ];

    protected function casts(): array
    {
        return [
            'detail_jawaban' => 'array',
            'selesai_pada' => 'datetime',
            'persentase' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(PersonalityTest::class, 'personality_test_id');
    }

    /**
     * Tentukan kategori hasil berdasarkan persentase skor.
     */
    public static function kategoriDariPersentase(float $persentase): string
    {
        return match (true) {
            $persentase >= 75 => 'Tinggi',
            $persentase >= 40 => 'Sedang',
            default => 'Rendah',
        };
    }
}
