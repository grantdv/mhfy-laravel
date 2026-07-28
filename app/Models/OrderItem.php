<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represents a specific product entry within an OrderRequest.
 * 
 * Captures the price and quantity at the moment of inquiry to preserve 
 * historical records even if product prices change later.
 * 
 * @property int $order_request_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price_at_submission
 * @property bool $is_backordered
 * 
 * @method BelongsTo orderRequest() - The parent inquiry request.
 * @method BelongsTo product() - The product definition.
 */
class OrderItem extends Model
{
    protected $fillable = [
        'order_request_id',
        'product_id',
        'quantity',
        'price_at_submission',
        'is_backordered',
    ];

    /**
     * Get the order request this item belongs to.
     * 
     * @return BelongsTo
     */
    public function orderRequest(): BelongsTo
    {
        return $this->belongsTo(OrderRequest::class);
    }

    /**
     * Get the product associated with this item.
     * 
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
