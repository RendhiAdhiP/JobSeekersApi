<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Society extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;
    protected $guarded = [];


    public function regional(){
        return $this->belongsTo(Regional::class);
    }

    public function validation(){
        return $this->hasMany(Validation::class);
    }

    public function jobApply(){
        return $this->hasMany(JobApplySociety::class);
    }

    public function jobPosition(){
        return $this->hasMany(JobApplyPosition::class);
    }

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id',
        'id_card_number',
        'regional_id',
        'login_tokens'
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
            'password' => 'hashed',
        ];
    }
}
