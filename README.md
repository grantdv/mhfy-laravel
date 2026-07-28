# May Harmony Find You (MHFY)

A bespoke, concierge-driven e-commerce platform designed to provide a high-touch, personalized shopping experience.

## Project Overview
MHFY operates on a "Concierge" workflow where the interaction between customer and merchant is mediated by a managed inquiry system. Instead of immediate automated checkout, customers submit inquiries that are reviewed, invoiced, and fulfilled by a human-in-the-loop process.

## Tech Stack
- **Framework:** Laravel (PHP 8.4)
- **Database:** SQLite (Development)
- **Payment Gateway:** Stripe
- **Frontend:** Tailwind CSS, Blade Templates
- **Workflow:** Concierge (Inquiry $\rightarrow$ Review $\rightarrow$ Invoice $\rightarrow$ Payment $\rightarrow$ Fulfillment)

## Directory Structure & Component Map

### `app/`
- **Models/**: Eloquent models representing the database schema.
    - `Product`: The core items offered by the concierge.
    - `OrderRequest`: The central entity for all inquiries (Product Orders or General Inquiries).
    - `OrderItem`: Individual items within a product order.
    - `User`: (Optional/Future) Customer accounts and profile management.
- **Services/`: Business logic layer to keep Controllers thin.
    - `StripeService`: Interfaces with the Stripe API for session creation and payment handling.
    - `OrderService`: Manages the state machine of an `OrderRequest` (pending $\rightarrow$ invoiced $\rightarrow$ paid).
    - `CartService`: Handles temporary session-based shopping cart logic.
- **Http/Controllers/**: Request handling and response generation.
    - `InquiryController`: Processes the guest inquiry forms.
    - `StripeWebhookController`: Listens for Stripe events to update order statuses.
    - `Admin/`: Namespace for administrative actions (Product management, Order status updates).
- **Mail/`: Email templates and logic.
    - `PaymentInvoice`: The primary communication sent to customers with a Stripe payment link.
- **Console/Commands/`: CLI tools for administrative tasks.
    - `OrderInvoiceCommand`: Manually triggers the invoicing process for a specific order.

### `database/`
- **migrations/**: Version-controlled database schema.
- **seeders/**: Initial data for product catalogs and test accounts.

### `resources/`
- **views/**: Blade templates.
    - `products/`: Public-facing catalog and product detail pages.
    - `admin/`: Administrative dashboard and management interfaces.
    - `inquiry/`: The submission and success views for the inquiry process.
    - `emails/`: HTML templates for automated outgoing communications.

### `routes/`
- `web.php`: Public and authenticated web routes.
- `api.php`: API endpoints (if applicable).

## Core Workflow
1. **Customer Inquiry:** Customer fills out a form $\rightarrow$ `OrderRequest` created (`pending`).
2. **Admin Review:** Site owner reviews the request in the dashboard.
3. **Invoicing:** Admin triggers an invoice $\rightarrow$ `OrderService` calls `StripeService` $\rightarrow$ `PaymentInvoice` email sent.
4. **Customer Payment:** Customer pays via the secure link.
5. **Webhook Update:** Stripe notifies the system $\rightarrow$ `StripeWebhookController` marks the order as `paid`.
