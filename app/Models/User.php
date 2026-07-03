<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\BotInvestment;
use App\Models\CryptoInvestment;
use App\Models\DemoTrade;
use App\Models\KycVerification;
use App\Models\RealEstateInvestment;
use App\Models\StockInvestment;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'phone',
        'country',
        'password',
        'balance',
        'crypto_balance',
        'demo_balance',
        'is_bot_active',
        'kyc_status',
        'referral_code',
        'referred_by',
        'referral_earnings',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
    public function kyc()
    {
        return $this->hasOne(KycVerification::class, 'user_id');
    }

    public function botInvestments()
    {
        return $this->hasMany(BotInvestment::class);
    }

    public function stockInvestments()
    {
        return $this->hasMany(StockInvestment::class);
    }

    public function cryptoInvestments()
    {
        return $this->hasMany(CryptoInvestment::class);
    }

    public function realEstateInvestments()
    {
        return $this->hasMany(RealEstateInvestment::class);
    }

    public function demoTrades()
    {
        return $this->hasMany(DemoTrade::class);
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }
}

