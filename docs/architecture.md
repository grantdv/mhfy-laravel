# MHFY Architecture Documentation

## Overview

MHFY (May Harmony Find You) is a concierge e-commerce platform that implements a unique checkout flow where customers submit product inquiries rather than direct payments. This document outlines the system architecture, data models, and key services.

## System Architecture

### High-Level Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                     Customer Interface                        │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────────┐  │
│  │   Catalog   │  │    Cart     │  │   Inquiry Form      │  │
│  │  (Products) │  │  (Session)  │  │  (Checkout)         │  │
│  └─────────────┘  └─────────────┘  └─────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                    Laravel Application                        │
│  ┌──────────────────────────────────────────────────────┐   │
│  │ Controllers                                           │   │
│  │ ├── InquiryController (Guest Checkout)                │   │
│  │ ├── CartController (Session Management)               │   │
│  │ ├── ProductController (Catalog Display)               │   │
│  │ └── Admin Controllers (Order/Product Management)      │   │
│  └──────────────────────────────────────────────────────┘   │
│                              │                               │
│  ┌──────────────────────────────────────────────────────┐   │
│  │ Services                                              │   │
│  │ ├── CartService (Session-based Cart)                  │   │
│  │ ├── OrderService (Order Business Logic)               │   │
│  │ └── StripeService (Payment Integration)               │   │
│  └──────────────────────────────────────────────────────┘   │
│                              │                               │
│  ┌──────────────────────────────────────────────────────┐   │
│  │ Models (Eloquent)                                     │   │
│  │ ├── Product (with relationships)                      │   │
│  │ ├── OrderRequest (with items)                         │   │
│  │ └── OrderItem (line items)                            │   │
│  └──────────────────────────────────────────────────────┘   │
│                              │                               │
│  ┌──────────────────────────────────────────────────────┐   │
│  │ Database (SQLite/PostgreSQL)                          │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                    External Services                          │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────────────┐  │
│  │   Stripe    │  │   Email     │  │   Admin Dashboard   │  │
│  │  (Payments) │  │  (Mailables)│  │  (Order Management) │  │
│  └─────────────┘  └─────────────┘  └─────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
```

## Data Models

### Product Model

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Standard Laravel model with stock_quantity, is_backordered, is_active fields
    // Relationships: orderItems()
}
```

**Fields:**
- `id` - Primary key
- `name` - Product name (string)
- `description` - Product description (text)
- `price` - Product price (decimal)
- `image` - Product image path (string)
- `stock_quantity` - Current stock level (integer)
- `is_backordered` - Whether backorders are allowed (boolean)
- `is_active` - Whether product is active (boolean)

### OrderRequest Model

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    // Represents a customer inquiry or order
    // Relationships: orderItems(), customer()
}
```

**Fields:**
- `id` - Primary key
- `full_name` - Customer name (string)
- `email` - Customer email (string)
- `shipping_address` - Shipping address (text)
- `message` - Customer message (nullable text)
- `type` - Order type: `product_order` or `general_inquiry`
- `stripe_session_id` - Stripe checkout session ID (nullable)
- `created_at` - Created timestamp
- `updated_at` - Updated timestamp

### OrderItem Model

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Represents a line item in an order
    // Relationships: orderRequest(), product()
}
```

**Fields:**
- `id` - Primary key
- `order_request_id` - Foreign key to order requests
- `product_id` - Foreign key to products
- `name` - Product name (string)
- `quantity` - Quantity ordered (integer)
- `price` - Price at time of order (decimal)
- `is_backordered` - Whether item is backordered (boolean)
- `created_at` - Created timestamp
- `updated_at` - Updated timestamp

## Key Services

### CartService

Manages session-based shopping cart for guest users.

```php
namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    // Static method for views/routes to get cart count
    public static function getCartCount(): int
    
    // Get cart items from session
    public function getCart(): array
    
    // Add product to cart with details
    public function addProduct(int $productId, int $quantity, 
                               ?string $name = null, 
                               ?float $price = null, 
                               ?string $image = null): void
    
    // Clear cart
    public function clear(): void
}
```

**Features:**
- Session-based storage
- Stores product details (name, price, image) for proper display
- Supports quantity updates
- Supports product removal

### OrderService

Manages order business logic and workflow.

```php
namespace App\Services;

class OrderService
{
    // Create order from cart items
    public function createOrder(array $customerData, array $cartItems): OrderRequest
    
    // Update order status
    public function updateStatus(OrderRequest $order, string $status): void
    
    // Generate Stripe session
    public function generateStripeSession(OrderRequest $order): string
}
```

**Workflow:**
1. Create order with `pending` status
2. Add items to order
3. Update status to `invoiced` when admin triggers payment
4. Update status to `paid` when Stripe webhook confirms payment

### StripeService

Handles Stripe payment integration.

```php
namespace App\Services;

use Stripe\StripeClient;

class StripeService
{
    // Create Stripe checkout session
    public function createCheckoutSession(OrderRequest $order): string
    
    // Send payment link via email
    public function sendPaymentEmail(OrderRequest $order, string $sessionUrl): void
}
```

**Features:**
- Creates Stripe Checkout Sessions
- Sends payment links via email
- Handles webhook verification

## Navigation Architecture

### Public Pages
All public pages include:
- Cart icon with item count badge
- Product catalog link
- Contact us link
- Consistent branding ("May Harmony Find You")

### Admin Pages
Admin dashboard includes:
- Order management interface
- Product catalog management
- Customer inquiries view
- Payment tracking

## Email Templates

### Payment Invoice
Professional email template for payment requests:
- Company branding
- Order summary
- Payment link
- Professional styling

## Security Considerations

- CSRF protection on all forms
- Input validation on all user inputs
- Secure Stripe webhook verification
- Session-based cart (no persistent storage)
- Protected admin routes with authentication

## Future Enhancements

- Customer account system (voluntary)
- Order history for logged-in users
- Email notifications for order status
- Advanced reporting and analytics
- Multi-currency support
- International shipping options

