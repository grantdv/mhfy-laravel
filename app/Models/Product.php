<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Represents a product available in the concierge catalog.
 * 
 * Includes tracking for stock quantity and a "backordered" flag to 
 * handle situations where customers request items currently out of stock.
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property float $price
 * @property int $stock_quantity
 * @property string|null $image
 * @property bool $is_active
 * 
 * @method HasMany orderItems() - Returns all order items associated with this product.
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'image',
        'is_active',
    ];

    /**
     * Boot the model.
     * 
     * Automatically generates a URL-friendly slug from the product name 
     * if one is not provided during creation.
     */
    protected static function booted(): void
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get the order items associated with this product.
     * 
     * @return HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
