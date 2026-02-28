<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'date',
        'payer_id',
        'category_id',
        'colocation_id'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}