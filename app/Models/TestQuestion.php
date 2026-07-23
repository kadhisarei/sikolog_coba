<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $fillable = ['personality_test_id', 'pertanyaan', 'dimensi', 'urutan'];

    public function test()
    {
        return $this->belongsTo(PersonalityTest::class, 'personality_test_id');
    }

    public function options()
    {
        return $this->hasMany(TestOption::class);
    }
}
