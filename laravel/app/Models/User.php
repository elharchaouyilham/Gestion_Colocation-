<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'reputation',
        'status',
        'banned_at',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'banned_at' => 'datetime',
        'reputation' => 'integer',
        'role_id' => 'integer',
    ];

    /**
     * Check if the user is an admin based on role_id.
     * Assuming 1 = Admin, 2 = User.
     */
    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    /**
     * The role assigned to the user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Colocations created/owned by the user.
     */
    public function ownedColocations(): HasMany
    {
        return $this->hasMany(Colocation::class, 'owner_id');
    }

    /**
     * Memberships linking the user to various colocations.
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Invitations sent by this user.
     */
    public function sentInvitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'sender_id');
    }

    /**
     * Invitations received by this user.
     */
    public function receivedInvitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'reciever_id');
    }

    /**
     * Expenses originally paid by this user.
     */
    public function expensesPaid(): HasMany
    {
        return $this->hasMany(Expense::class, 'payer_id');
    }
}
