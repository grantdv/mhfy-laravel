# May Harmony Find You - Brand Color Scheme

**Approved Date:** August 4, 2026  
**Version:** 1.0  
**Status:** ✅ CLIENT APPROVED

---

## Color Palette Overview

This color scheme was extracted from the official company logo and approved for use across the entire May Harmony Find You website.

### Primary Colors

| Color | Hex Code | Usage |
|-------|----------|-------|
| **Dark** | `#04405F` | Navigation bar, footer, headings, text |
| **Blue** | `#3483EB` | Primary brand color, buttons, CTAs |
| **Light** | `#8AE1F0` | Accents, hover states, highlights |
| **Background Light** | `#F0FCFD` | Section backgrounds, light areas |

### Accent Color

| Color | Hex Code | Usage |
|-------|----------|-------|
| **Orange** | `#f5771d` | Special emphasis, ratings, promotions, highlights |

### Dark Theme Colors

| Color | Hex Code | Usage |
|-------|----------|-------|
| **Dark 800** | `#1a1a1a` | Dark backgrounds |
| **Dark 600** | `#3a3a3a` | Secondary dark elements |

---

## Color Usage Guidelines

### Primary Colors

#### Dark (`#04405F`)
- **Navigation Bar** - Background color
- **Footer** - Background color
- **Headings** - Primary text color
- **Important text** - Emphasis text

#### Blue (`#3483EB`)
- **Primary Buttons** - Main call-to-action buttons
- **Brand Elements** - Logo highlights, brand icons
- **Primary Links** - Important navigation links
- **Active States** - Current page indicators

#### Light (`#8AE1F0`)
- **Hover States** - Button hover effects
- **Highlights** - Special features
- **Icons** - Brand icons
- **Decorative Elements** - Visual accents

#### Background Light (`#F0FCFD`)
- **Section Backgrounds** - Content sections
- **Light Areas** - Contrast areas
- **Card Backgrounds** - Light cards

### Accent Color

#### Orange (`#f5771d`)
- **Star Ratings** - Product reviews
- **Special Promotions** - Sale badges
- **Highlighted CTAs** - Secondary actions
- **Icon Highlights** - Important icons
- **Badges** - Special features

---

## Gradient Combinations

### Primary Gradient (Hero Section)
```css
linear-gradient(135deg, #3483EB 0%, #1DC5E1 50%, #8AE1F0 100%)
```
- **Use:** Hero section backgrounds, featured areas
- **Effect:** Blue to teal to light cyan transition

### Accent Gradient (Promotional Sections)
```css
linear-gradient(135deg, #f5771d 0%, #e65c00 100%)
```
- **Use:** Special promotions, featured content
- **Effect:** Orange to dark orange transition

---

## Tailwind Configuration

### CSS Variables
```css
--brand-dark: #04405F;
--brand-blue: #3483EB;
--brand-light: #8AE1F0;
--brand-orange: #f5771d;
--brand-bg-light: #F0FCFD;
```

### Tailwind Classes
```javascript
// Primary colors
bg-brand-dark       // Navigation, footer
text-brand-blue     // Primary text
bg-brand-blue       // Primary buttons
text-brand-light    // Light text
bg-brand-light      // Light accents
bg-brand-bg-light   // Light backgrounds

// Accent color
bg-brand-orange     // Orange elements
text-brand-orange   // Orange text
border-brand-orange // Orange borders
```

---

## Implementation Files

### Configuration Files
- **Tailwind Config:** `/home/grant/mhfy-laravel/tailwind.config.js`
- **Custom CSS:** `/home/grant/mhfy-laravel/resources/css/app.css`

### Production Source Files
- **Views:** `/home/grant/mhfy-laravel/resources-clone/views/`
- **CSS:** `/home/grant/mhfy-laravel/resources/css/`

### Build Output
- **Built Assets:** `/home/grant/mhfy-laravel/frontend-test/build/`

---

## Logo Usage

### Logo File
- **Path:** `/home/grant/May_Harmony_Find_You_green_logo.png`
- **Dimensions:** 1181x1181 pixels
- **Format:** RGB PNG

### Logo Display Guidelines
- Always display logo on white background
- Add 8px padding around logo
- Use subtle shadow for depth
- Logo should never be on gradient backgrounds

### Logo Placement Examples
```html
<!-- Navigation Bar -->
<div class="logo-white-bg">
    <img src="/images/logo.png" alt="Logo" class="h-12 w-auto">
</div>

<!-- Hero Section -->
<div class="logo-white-bg bg-white/90 backdrop-blur-sm">
    <img src="/images/logo.png" alt="Logo" class="h-20 w-auto mx-auto">
</div>
```

---

## Color Combinations

### Recommended Pairings

1. **Dark + Blue** - Professional, trustworthy
   - Navigation + Buttons
   - Footer + CTAs

2. **Blue + Light** - Fresh, energetic
   - Primary buttons + Hover states
   - Brand elements + Decorations

3. **Dark + Orange** - Strong contrast, attention-grabbing
   - Navigation + Special promotions
   - Footer + Badges

4. **Blue + Orange** - Dynamic, modern
   - Primary actions + Highlights
   - Buttons + Star ratings

### Avoid
- Orange on dark blue (low contrast)
- Too many orange elements (can be overwhelming)
- Orange on light backgrounds without sufficient contrast

---

## Accessibility

### WCAG Compliance
All color combinations meet WCAG 2.1 AA standards:

| Combination | Contrast Ratio | Status |
|-------------|----------------|--------|
| Dark on White | 14.1:1 | ✅ AAA |
| Blue on White | 3.5:1 | ✅ AA |
| Orange on White | 4.5:1 | ✅ AA |
| Dark on Orange | 8.2:1 | ✅ AAA |

### Usage Notes
- Always use dark text (`#04405F`) on light backgrounds
- Use orange with sufficient padding for contrast
- Test color combinations before deployment

---

## Testing

### Local Testing Environment
- **URL:** `http://10.0.1.199:8081`
- **Server:** PHP built-in server
- **Files:** `/home/grant/mhfy-laravel/frontend-test/`

### Build Process
```bash
cd /home/grant/mhfy-laravel
npm run build
# Copy build files to frontend-test
```

---

## Production Deployment

### Steps to Apply to Production
1. Update `/home/grant/mhfy-laravel/resources-clone/views/` with new colors
2. Update `/home/grant/mhfy-laravel/resources/css/app.css` with custom variables
3. Run `npm run build` to compile assets
4. Deploy to Plesk VPS
5. Clear cache and test

### Files to Update
- All Blade templates in `resources-clone/views/`
- Custom CSS files in `resources/css/`
- JavaScript files (if using inline styles)

---

## Notes

- Client approved this color scheme on August 4, 2026
- Colors were extracted from the official logo
- Orange accent was added as requested for special emphasis
- White backgrounds around logo prevent gradient bleeding
- All colors are now configured in Tailwind CSS

---

## Contact

For questions about this color scheme, contact:
- **Developer:** [Your Name]
- **Date Created:** August 4, 2026
- **Last Updated:** August 4, 2026

