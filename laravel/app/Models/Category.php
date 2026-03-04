<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'colocation_id'];

    /**
     * The colocation that owns this category.
     */
    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }

    /**
     * Expenses assigned to this specific category.
     */
    public function expenses(): HasMany
    {
        // Using 'categorie_id' to match your expense migration spelling
        return $this->hasMany(Expense::class, 'categorie_id');
    }
}
