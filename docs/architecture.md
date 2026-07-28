# Architecture Overview: May Harmony Find You (MHFY)

This document provides a high-level overview of the MHFY platform's architecture, design patterns, and core workflow.

## Core Philosophy: The Concierge Model
MHFY is built on a "Concierge" workflow. Unlike traditional e-commerce where a customer automatically checks out and receives a shipping confirmation, MHFY prioritizes a high-touch, human-mediated experience.

1.  **Inquiry:** The customer submits a request (Product Order or General Inquiry).
2.  **Review:** An administrator reviews the request.
3.  **Invoicing:** A payment link is manually or programmatically triggered and emailed to the customer.
4.  **Payment:** The customer pays via Stripe.
5.  **Fulfillment:** The concierge team fulfills the order.

## System Architecture

The application follows a standard Laravel architecture with a clear separation of concerns:

### 1. Models (Data Layer)
The core data entities of the system:
- `Product`: Represents items available in the catalog. Includes attributes for price, stock quantity, and "active" status.
- `OrderRequest`: The central entity. It captures every customer interaction, whether it's a product purchase or a general message. It tracks status (`pending`, `invoiced`, `paid`) and links to Stripe sessions.
- `OrderItem`: Represents the specific products and quantities within a `product_order` type request.
- `User`: Handles profile information and (optionally) order history for customers who choose to create an account.

### 2. Services (Business Logic Layer)
To keep controllers thin, core logic is encapsulated in Service classes:
- `StripeService`: Handles all interactions with the Stripe API, specifically creating Checkout Sessions and managing payment metadata.
- `OrderService`: Manages the state machine of an `OrderRequest`. It handles the transition from `pending` to `invoiced`, triggers payment emails, and manages stock logic (including backorders).
- `CartService`: Manages temporary session-based cart data for guest users.

### 3. Controllers (Request Handling)
Controllers handle HTTP requests and return views or JSON:
- `InquiryController`: Manages the submission of inquiries and the success feedback loop.
- `StripeWebhookController`: Listens for Stripe events and updates `OrderRequest` statuses.
- `ProductController`: Manages the public catalog and the admin product management.
- `ProfileController`: Manages user-specific account details.
- `OrderHistoryController`: Provides a view of past customer interactions.

### 4. Migrations (Database Schema)
The schema is designed to support a flexible inquiry system. Every request is treated as an `OrderRequest`, allowing the concierge to handle both product sales and general messages through a unified interface. 

The production environment utilizes **PostgreSQL** to leverage its advanced data integrity, reliability, and superior JSONB support for potentially complex future product attributes.

## Data Flow: The Checkout Process

1.  **Frontend:** User adds items to the `CartService` and submits the `InquiryController@store` form.
2.  **Backend (OrderService):**
    - Validates the cart.
    - Creates an `OrderRequest` with `pending` status.
    - If it's a product order, it decrements stock and creates `OrderItem` records.
3.  **Backend (Admin):** Admin reviews the order and triggers the `OrderInvoiceCommand` (or a button in the dashboard).
4.  **Backend (OrderService + StripeService):**
    - `OrderService` updates the order to `invoiced`.
    - `StripeService` creates a Checkout Session.
    - `Mail::send` triggers the `PaymentInvoice` email.
5.  **Stripe Webhook:** Once the customer pays, Stripe hits the `StripeWebhookController`, which updates the order to `paid`.
