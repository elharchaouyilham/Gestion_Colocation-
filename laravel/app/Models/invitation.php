<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $fillable = ['email', 'status', 'colocation_id', 'sender_id', 'reciever_id'];

    public function colocation(): BelongsTo
    {
        return $this->belongsTo(Colocation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }
}
