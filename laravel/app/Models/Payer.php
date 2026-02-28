<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'reciever_id',
        'colocation_id',
        'montant',
        'paid_at'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'montant' => 'decimal:2'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}