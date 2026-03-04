<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    protected $fillable = ['title', 'amount', 'date', 'payer_id', 'categorie_id', 'colocation_id'];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }

    // The person who fronted the money
    public function payer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    // Assumes you have a Category model based on 'categorie_id'
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    // The people who owe a split of this expense
    public function sharedPayers(): HasMany
    {
        return $this->hasMany(Payer::class);
    }
}
