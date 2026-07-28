<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Authenticatable;
use Illuminate\Foundation\Obligations\SendsEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
 * 
 * @method HasMany orders() - Returns all OrderRequests associated with this user's email.
 */
class User extends Model implements Authenticatable, SendsEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'shipping_address',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the orders associated with this user.
     * 
     * Note: We link orders to users via the email address.
     * 
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(OrderRequest::class, 'email', 'email');
    }
}
