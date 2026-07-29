<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Represents a platform user.
 * 
 * Currently supports optional account creation for customers to manage 
 * their profile and view their historical order inquiries.
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $shipping_address
 * @property string|null $phone_number
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * 
 * @method HasMany orders() - Returns all OrderRequests associated with this user's email.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'shipping_address',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * 
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the orders associated with this user.
     * 
     * Note: We link orders to users via the email address.
     * 
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(OrderRequest::class, 'email', 'email');
    }
}
