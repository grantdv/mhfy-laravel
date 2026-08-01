# Design Specification: MHFY (May Harmony Find You)
**Project Goal:** Refine the current application to match the aesthetic, layout, and "vibe" of the previous site, focusing on a warm, artisan, and harmony-centric user experience.

## 1. Brand Identity & Vibe
*   **Core Sentiment:** Warm, welcoming, artisanal, and serene.
*   **Keywords:** Harmony, Ritual, Artisan, Sourced, Selection.
*   **Visual Language:** Softness through rounded corners, depth through gradients, and a dynamic, "mosaic" approach to content arrangement.

## 2. Visual Language & Style Guide

### Color Palette & Gradients
*   **Gradient Dominance:** The primary design driver is the use of linear gradients (typically 135-degree angles). 
    *   *Requirement:* Use gradients for major content blocks, buttons, and decorative elements.
    *   *Transition:* Gradients should transition between primary brand colors (e.g., transitioning from a deeper brand color to a lighter accent).
*   **Contrast:** High contrast for text over colored backgrounds (e.g., white text on dark gradient blocks).

### Typography
*   **Headings:** Large, expressive headings (e.g., `display-3` style) for impact.
*   **Body Text:** Clean, highly readable typography for descriptions and product details.
*   **Spacing:** Generous padding within content blocks to give the content "room to breathe."

### UI Components
*   **Buttons:**
    *   Rounded corners (pill-shaped or slightly rounded).
    *   Solid background colors or gradient fills.
    *   Consistent padding for a "chunky," clickable feel.
*   **Badges:** 
    *   Small, high-visibility badges used for trust signals (e.g., "Low Prices," "Fast Shipping").
    *   Use icons (e.g., FontAwesome) combined with short text.
*   **Icons:** Use a consistent icon set (FontAwesome style) for navigation (Cart, Wishlist, Account) and social proof.

## 3. Layout Architecture

### Global Elements
*   **Header:** 
    *   Sticky/Fixed position for easy navigation.
    *   Logo centered or left-aligned with a clear navigation menu.
    *   Integrated Search bar with a rounded-pill design.
    *   User utilities: Cart, Wishlist, and Account icons/dropdowns.
*   **Footer:**
    *   Multi-column layout for "Products" and "Customer Care."
    *   Social proof badges section.
    *   Copyright and legal links (Terms, Privacy) in a simplified bottom bar.

### Page Structure (Homepage)
*   **Hero Section:** 
    *   Large, high-quality background image.
    *   Centered headline and a clear, primary Call-to-Action (CTA).
    *   Impactful "Intro" pill style for the primary message.
*   **Mosaic Content Grid:** 
    *   *Requirement:* Implement a non-uniform, mosaic-style grid for storytelling.
    *   *Design:* Varying block heights and colors. Some blocks contain images, others contain "stats" (e.g., "+12"), and others contain text/links.
    *   *Flow:* This should feel like a curated gallery rather than a standard 3-column grid.
*   **Call to Action (CTA) Walls:** 
    *   Full-width sections with high-impact gradients.
    *   Large, centered text (e.g., "Tea without passion is bland").
    *   Prominent primary buttons.
*   **Dynamic Snippets:**
    *   Categorized product highlights (e.g., "Curating Exquisite Teas").
    *   Includes a "See All" link with a directional arrow icon.

## 4. UX & Interaction Requirements
*   **Visual Feedback:** Hover states for all buttons and navigation links (subtle color shifts or opacity changes).
*   **Trust Signals:** Ensure badges for shipping, returns, and pricing are visible in the footer.
*   **Navigation Flow:** Seamless transition from the "Mosaic" storytelling sections to the functional product shop.

## 5. Technical Implementation Notes (for the Coder)
*   **Framework:** Laravel / Tailwind CSS (or relevant frontend stack).
*   **Grid System:** Use CSS Grid for the Mosaic layout to allow for complex `grid-area` placements.
*   **Gradients:** Define standard brand gradients as CSS variables or Tailwind theme colors to ensure consistency across the site.
*   **Responsiveness:** Ensure the mosaic grid collapses gracefully into a single-column flow on mobile devices.
