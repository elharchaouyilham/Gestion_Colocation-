<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colocation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id', 'status'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'membership')
            ->withPivot(['role', 'joined_at', 'left_at']);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
