<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role_id',
        'company_id'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function isAdmin()
    {
        return $this->role->name == 'Admin';
    }

    public function isOwner()
    {
        return $this->role->name == 'Owner';
    }

    public function isAuditor()
    {
        return $this->role->name == 'Auditor';
    }

    public function isAccountant()
    {
        return $this->role->name == 'Accountant';
    }

    public function isManager()
    {
        return $this->role->name == 'Manager';
    }

    public function isSeller()
    {
        return $this->role->name == 'Seller';
    }
}



