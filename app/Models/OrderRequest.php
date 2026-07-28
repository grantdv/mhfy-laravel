<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Represents a customer inquiry or order request.
 * 
 * This is the central entity of the concierge workflow. It captures both
 * product-based orders and general inquiries.
 * 
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $shipping_address
 * @property string $status - The lifecycle of the request: pending, invoiced, paid.
 * @property string $type - The category of the request: product_order, general_inquiry.
 * @property string|null $message - Optional message for general inquiries.
 * @property string|null $stripe_session_id - The ID of the Stripe checkout session for payments.
 * 
 * @method HasMany orderItems() - Returns the items associated with this order request.
 */
class OrderRequest extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'shipping_address',
        'status',
        'type',
        'message',
        'stripe_session_id',
    ];

    /**
     * Get the items belonging to the order request.
     * 
     * @return HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
