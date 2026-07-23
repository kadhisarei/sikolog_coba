<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestOption extends Model
{
    protected $fillable = ['test_question_id', 'label_jawaban', 'skor'];

    public function question()
    {
        return $this->belongsTo(TestQuestion::class, 'test_question_id');
    }
}
