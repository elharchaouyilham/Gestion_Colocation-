<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    protected $fillable = [
        'title','amount','date',
        'payer_id','category_id','colocation_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
