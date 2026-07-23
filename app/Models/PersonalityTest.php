<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalityTest extends Model
{
    protected $fillable = ['judul', 'slug', 'kategori', 'deskripsi', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function questions()
    {
        return $this->hasMany(TestQuestion::class)->orderBy('urutan');
    }

    public function results()
    {
        return $this->hasMany(TestResult::class);
    }

    /**
     * Skor maksimal yang mungkin didapat dari tes ini
     * (jumlah skor tertinggi dari tiap pertanyaan).
     */
    public function hitungSkorMaksimal(): int
    {
        $max = 0;
        foreach ($this->questions as $question) {
            $max += optional($question->options()->orderByDesc('skor')->first())->skor ?? 0;
        }

        return $max;
    }
}
