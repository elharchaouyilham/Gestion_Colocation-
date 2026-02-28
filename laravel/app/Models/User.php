<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name','email','password',
        'is_admin','reputation','role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function colocations()
    {
        return $this->belongsToMany(Colocation::class,'memberships')
            ->withPivot(['role','joined_at','left_at']);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class,'payer_id');
    }
}