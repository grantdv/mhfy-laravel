# MHFY (May Harmony Find You) - Concierge E-Commerce Platform

A Laravel-based concierge e-commerce platform that allows customers to submit product inquiries via a guest-friendly checkout flow.

## 🎯 Core Features

### Concierge Workflow
1. **Customer Inquiry**: Customers submit a form → `OrderRequest` created (`pending`)
2. **Admin Review**: Site owner reviews the inquiry
3. **Invoicing**: Admin triggers payment link → `OrderService` → `StripeService` → Email to customer
4. **Customer Payment**: Customer clicks email link and pays via Stripe
5. **Webhook Update**: Stripe webhook → `StripeWebhookController` marks order as `paid`

### Key Features
- ✅ Guest-friendly checkout (no forced account creation)
- ✅ Session-based shopping cart with product details
- ✅ Product catalog with images and inventory tracking
- ✅ Admin dashboard for order management
- ✅ Stripe payment integration
- ✅ Email invoicing system
- ✅ Backorder support for out-of-stock items

## 🚀 Quick Start

### Local Development
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

### Production Deployment
The application is deployed via Plesk-managed Laravel extension on VPS.
Git operations must be done through the Plesk interface.

## 📁 Project Structure

```
app/
├── Console/Commands/
│   └── OrderInvoiceCommand.php      # Artisan command to trigger invoicing
├── Http/Controllers/
│   ├── Admin/                       # Admin dashboard controllers
│   │   ├── DashboardController.php
│   │   ├── OrderController.php
│   │   └── ProductController.php
│   ├── CartController.php           # Shopping cart operations
│   ├── ContactController.php        # Contact form handling
│   ├── InquiryController.php        # Inquiry checkout flow
│   ├── OrderHistoryController.php   # Customer order history
│   ├── ProductController.php        # Product catalog
│   ├── ProfileController.php        # User profile management
│   └── StripeWebhookController.php  # Stripe webhook handling
├── Mail/
│   └── PaymentInvoice.php           # Payment invoice email template
├── Models/
│   ├── OrderItem.php                # Order items
│   ├── OrderRequest.php             # Order requests
│   ├── Product.php                  # Products
│   └── User.php                     # User model
├── Providers/
│   └── AppServiceProvider.php       # Service provider registration
└── Services/
    ├── CartService.php              # Shopping cart management
    ├── OrderService.php             # Order business logic
    └── StripeService.php            # Stripe integration
```

## 🛠️ Technology Stack

- **Backend**: Laravel 13.23.0 (PHP 8.4)
- **Database**: SQLite (development), PostgreSQL (production)
- **Payment**: Stripe PHP SDK
- **Frontend**: Blade templates with Tailwind CSS
- **Email**: Laravel Mailables

## 📊 Database Schema

### Products Table
- `id` - Primary key
- `name` - Product name
- `description` - Product description
- `price` - Product price
- `image` - Product image path
- `stock_quantity` - Current stock level
- `is_backordered` - Whether backorders are allowed
- `is_active` - Whether product is active

### Order Requests Table
- `id` - Primary key
- `full_name` - Customer name
- `email` - Customer email
- `shipping_address` - Shipping address
- `message` - Customer message (nullable)
- `type` - Order type (`product_order` or `general_inquiry`)
- `created_at` - Created timestamp
- `updated_at` - Updated timestamp

### Order Items Table
- `id` - Primary key
- `order_request_id` - Foreign key to order requests
- `product_id` - Foreign key to products
- `name` - Product name
- `quantity` - Quantity ordered
- `price` - Price at time of order
- `is_backordered` - Whether item is backordered

### Users Table (Extended)
- All standard Laravel auth fields
- `details` - JSON field for user details

## 🎨 Cart System

### Implementation
The cart system uses Laravel's session storage to track products during the guest checkout flow:

- **CartService**: Manages cart state with `getCart()`, `addProduct()`, and `clear()` methods
- **CartController**: Handles cart operations via routes (`cart.add`, `cart.show`, `cart.clear`)
- **Product Details**: Cart stores product details (`name`, `price`, `image`) for proper display

### Usage
```php
// Add to cart
$cartService->addProduct($productId, $quantity, $name, $price, $image);

// Get cart
$cart = $cartService->getCart();

// Get cart count
$count = $cartService->getCartCount();

// Clear cart
$cartService->clear();
```

## 🔄 Navigation Improvements

All public pages now include:
- Cart icon with item count badge
- Product catalog link
- Contact us link
- Consistent branding ("May Harmony Find You")

## 🐛 Recent Fixes

### Cart System
- Fixed `CartController` to pass product details when adding items
- Added `CartService::getCartCount()` static method for use in routes
- Fixed `cart.blade.php` ParseError by using proper Blade `@if/@else` structure
- Added cart count badge to all public pages

### Product Display
- Added product images to catalog, product details, and cart pages
- Fixed product display to show stock status and backorder flags

### Navigation
- Added cart icon to all public pages (Welcome, Products, Cart, Inquiry)
- Fixed navigation to use `$cartCount` variable passed from controllers
- Implemented null-safe operators for `auth()->user()` calls

### Admin Dashboard
- Created centralized `/admin` landing page with navigation cards
- Added product CRUD operations with image upload
- Added order management interface

### Documentation
- Updated README with cart system implementation
- Updated architecture docs with navigation improvements
- Added comprehensive product display features documentation

## 📝 License

This project is proprietary software.

## 👥 Contact

For inquiries, please use the contact form on the website.

