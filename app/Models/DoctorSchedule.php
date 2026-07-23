<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $fillable = ['doctor_profile_id', 'hari', 'jam_mulai', 'jam_selesai', 'is_active'];

    public function doctorProfile()
    {
        return $this->belongsTo(DoctorProfile::class);
    }
}
