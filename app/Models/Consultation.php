<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'kode_booking', 'user_id', 'doctor_id', 'tanggal_konsultasi',
        'jam_konsultasi', 'metode', 'keluhan', 'status',
        'catatan_dokter', 'rating', 'ulasan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_konsultasi' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public static function generateKodeBooking(): string
    {
        return 'MC-'.strtoupper(uniqid());
    }
}
