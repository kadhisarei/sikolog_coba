<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Concerns\HasTeams;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;



/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Team|null $currentTeam
 * @property-read Collection<int, Team> $ownedTeams
 * @property-read Collection<int, Membership> $teamMemberships
 * @property-read Collection<int, Team> $teams
 */
#[Fillable(['name', 'email', 'password', 'current_team_id'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
 use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'avatar', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ================= Relasi =================
    public function doctorProfile()
    {
        return $this->hasOne(DoctorProfile::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function consultationsAsUser()
    {
        return $this->hasMany(Consultation::class, 'user_id');
    }

    public function consultationsAsDoctor()
    {
        return $this->hasMany(Consultation::class, 'doctor_id');
    }

    // ================= Helper Role =================
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDokter(): bool
    {
        return $this->role === 'dokter';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Persentase progres tes yang sudah diselesaikan user
     * dibanding total tes aktif yang tersedia di sistem.
     */
    public function persentaseProgresTes(): float
    {
        $totalTesAktif = PersonalityTest::where('is_active', true)->count();
        if ($totalTesAktif === 0) {
            return 0;
        }
        $sudahDikerjakan = $this->testResults()->distinct('personality_test_id')->count('personality_test_id');

        return round(($sudahDikerjakan / $totalTesAktif) * 100, 2);
    }

    /**
     * Persentase performa dokter: gabungan tingkat kepuasan (rating)
     * dan tingkat penyelesaian konsultasi (completion rate).
     */
    public function persentaseKinerjaDokter(): float
    {
        $konsultasi = $this->consultationsAsDoctor();
        $total = $konsultasi->count();
        if ($total === 0) {
            return 0;
        }

        $selesai = (clone $konsultasi)->where('status', 'selesai')->count();
        $completionRate = ($selesai / $total) * 100;

        $rataRating = (clone $konsultasi)->whereNotNull('rating')->avg('rating') ?? 0;
        $ratingRate = ($rataRating / 5) * 100;

        // bobot: 50% completion rate, 50% rating kepuasan
        return round(($completionRate * 0.5) + ($ratingRate * 0.5), 2);
    }
}
