# Laravel Blade Compiler Issues

## Issue 1: Missing Closing Blade Tags (Most Common)

### Problem
Laravel Blade templates with unbalanced tags (missing `@endif`, `@endforeach`, `@endfor`, `@endwhile`, `@endphp`, `@endverbatim`, etc.) cause compilation failures.

### Error Message
```
ParseError(code: 0): syntax error, unexpected end of file at .../storage/framework/views/xxx.php:xxx
```

### Example
```blade
@if(empty($cart))
    <!-- Empty cart content -->
@else
    <!-- Inquiry form -->
</div>
</div>
</body>
</html>
<!-- MISSING @endif before </body> -->
```

### Solution
Always ensure Blade control structures are properly closed:
```blade
@if(empty($cart))
    <!-- Empty cart content -->
@else
    <!-- Inquiry form -->
@endif
</div>
</div>
</body>
</html>
```

### Prevention
- Use IDEs with Blade tag pairing support
- Run `php -l resources/views/yourfile.blade.php` before deploying
- Check tag balance: `grep -c '@if' file.blade.php` vs `grep -c '@endif' file.blade.php`

### Related Fixes
- **2026-07-31**: Fixed missing `@endif` in `resources/views/inquiry.blade.php` (Session - Cart completion bug troubleshooting)

---

## Issue 2: Undefined Variables in Views (Common)

### Problem
Views using variables that aren't passed from controllers cause 500 errors.

### Error Message
```
ErrorException(code: 0): Undefined variable $cartCount at .../storage/framework/views/xxx.php:yy
```

### Example
```blade
@if($cartCount > 0)
    {{ $cartCount }}
@endif
```

If `$cartCount` isn't passed from the controller, this causes a 500 error.

### Solution 1: Pass Variable from Controller
```php
public function index(): \Illuminate\View\View
{
    $cartCount = CartService::getCartCount();
    return view('layout', compact('cartCount'));
}
```

### Solution 2: Use Null Coalescing Fallback (Recommended)
Update all views to use fallback values:
```blade
@if(isset($cartCount) && $cartCount > 0)
    {{ $cartCount ?? 0 }}
@endif
```

### Solution 3: Use View Composers
Add to `AppServiceProvider.php`:
```php
public function boot(): void
{
    $this->app['view']->composer('*', function ($view) {
        $view->data['cartCount'] = CartService::getCartCount();
    });
}
```

### Related Fixes
- **2026-07-31**: Fixed `$cartCount` undefined in navigation views
- **2026-07-31**: Added `$totalRevenue`, `$totalOrders`, `$conversionRate` to admin orders dashboard

---

## Issue 3: Trailing Newline Missing

### Problem
The Laravel Blade compiler (version 13.x) does NOT preserve trailing newlines when compiling Blade templates. This causes PHP syntax errors when the compiled view file does not end with a newline character after the closing `?>` tag.

### Error Message
```
ParseError(code: 0): syntax error, unexpected end of file at .../storage/framework/views/xxx.php:xxx
```

## Root Cause
Laravel's Blade compiler generates PHP files that end with:
```
PATH**/ ?>
```

But PHP requires all files to end with a newline character:
```
PATH**/ ?>
```

## Solution

### Immediate Fix (Manual)
After deploying code, run this script to fix all compiled views:

```bash
cd /path/to/laravel
php artisan_fix_views.php
```

### Permanent Fix (Automated)

Add this to your deployment process:

**Option 1: Post-deployment script**
```bash
php artisan_fix_views.php
```

**Option 2: Add to Plesk deployment hook**
Configure Plesk to run this script after each deployment.

**Option 3: Create a Laravel Artisan command**
```bash
php artisan make:command FixViewNewlines
```

Then in `FixViewNewlines.php`:
```php
public function handle()
{
    $compiledDir = base_path('storage/framework/views');
    $files = glob($compiledDir . '/*.php');
    $fixed = 0;
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        if (substr($content, -2) === '?>') {
            $content .= "\n";
            if (file_put_contents($file, $content) !== false) {
                $fixed++;
            }
        }
    }
    
    if ($fixed > 0) {
        $this->info("Fixed $fixed compiled view file(s).");
    }
}
```

Run with: `php artisan fix:view-newlines`

## Why This Happens
This appears to be a known issue with the Laravel Blade compiler in PHP 8.x. The compiler does not preserve the trailing newline from the source Blade template.

## Impact
- **Affected:** All Blade templates on production
- **Symptoms:** 500 errors when rendering views
- **Frequency:** Every time views are compiled or cached

## Prevention
Include `php artisan_fix_views.php` in your deployment checklist.

## Related
- Laravel Issue: Blade compiler not preserving trailing newlines
- PHP requirement: All PHP files must end with a newline character

---

## Issue 4: View Composer Method Compatibility (Laravel 11+ Only)

### Problem
Using `View::composer()` static method on older Laravel versions causes "Method does not exist" errors.

### Error Message
```
Method Illuminate\View\View::composer does not exist
```

### Example (Laravel 11+)
```php
View::composer('*', function ($view) {
    $view->share('cartCount', CartService::getCartCount());
});
```

### Solution for Older Laravel
Use container access instead:
```php
$this->app['view']->composer('*', new CartCountComposer());
```

### Related Fixes
- **2026-07-31**: Changed `View::composer()` to `$this->app['view']->composer()` for older Laravel compatibility

---

## Issue 5: Variable Name Mismatches in compact()

### Problem
Using wrong variable names in `compact()` causes "Undefined variable" errors.

### Error Message
```
compact(): Undefined variable $orderId
```

### Example
```php
public function success($order_id): \Illuminate\View\View
{
    return view('success', compact('orderId', 'cartCount')); // ERROR: $orderId doesn't exist!
}
```

### Solution
Match the actual parameter name:
```php
public function success($order_id): \Illuminate\View\View
{
    return view('success', compact('order_id', 'cartCount')); // FIXED
}
```

### Related Fixes
- **2026-07-31**: Fixed `orderId` vs `order_id` mismatch in `InquiryController::success()`

---

## Issue 6: Dashboard Statistics Missing in Admin Views

### Problem
Admin dashboard views use variables that aren't passed from controllers.

### Error Message
```
Undefined variable $totalRevenue
```

### Solution
Calculate and pass all required statistics from the controller:
```php
public function index(): \Illuminate\View\View
{
    $allOrders = OrderRequest::with('orderItems.orderRequest')->get();
    $orders = OrderRequest::latest()->paginate(10);
    
    $totalOrders = $allOrders->count();
    $paidOrders = $allOrders->where('status', 'paid')->count();
    $totalRevenue = $allOrders->where('status', 'paid')
        ->flatMap(fn($order) => $order->orderItems)->sum(fn($item) => $item->price_at_submission * $item->quantity);
    $conversionRate = $totalOrders > 0 ? round(($paidOrders / $totalOrders) * 100, 2) : 0;
    
    return view('admin.orders.index', compact('orders', 'totalOrders', 'totalRevenue', 'conversionRate'));
}
```

### Related Fixes
- **2026-07-31**: Added dashboard statistics to `OrderController::index()`

---

## Deployment Checklist

Before deploying to production:

1. **Check Blade tag balance**
   ```bash
   grep -c '@if' resources/views/**/*.blade.php
   grep -c '@endif' resources/views/**/*.blade.php
   ```

2. **Run syntax check**
   ```bash
   php -l resources/views/yourfile.blade.php
   ```

3. **Clear compiled views**
   ```bash
   php artisan view:clear
   ```

4. **Clear all caches**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

5. **After deployment, fix compiled views**
   ```bash
   php artisan fix:view-newlines
   ```

6. **Verify no 500 errors**
   - Test all major routes
   - Check `storage/logs/laravel.log`

### Problem
Laravel Blade templates with unbalanced tags (missing `@endif`, `@endforeach`, `@endfor`, `@endwhile`, `@endphp`, `@endverbatim`, etc.) cause compilation failures.

### Error Message
```
ParseError(code: 0): syntax error, unexpected end of file at .../storage/framework/views/xxx.php:xxx
```

### Example
```blade
@if(empty($cart))
    <!-- Empty cart content -->
@else
    <!-- Inquiry form -->
</div>
</div>
</body>
</html>
<!-- MISSING @endif before </body> -->
```

### Solution
Always ensure Blade control structures are properly closed:
```blade
@if(empty($cart))
    <!-- Empty cart content -->
@else
    <!-- Inquiry form -->
@endif
</div>
</div>
</body>
</html>
```

### Prevention
- Use IDEs with Blade tag pairing support
- Run `php -l resources/views/yourfile.blade.php` before deploying
- Check tag balance: `grep -c '@if' file.blade.php` vs `grep -c '@endif' file.blade.php`

---

## Issue 2: Trailing Newline Missing

### Problem
The Laravel Blade compiler (version 13.x) does NOT preserve trailing newlines when compiling Blade templates. This causes PHP syntax errors when the compiled view file does not end with a newline character after the closing `?>` tag.

### Error Message
```
ParseError(code: 0): syntax error, unexpected end of file at .../storage/framework/views/xxx.php:xxx
```

## Root Cause
Laravel's Blade compiler generates PHP files that end with:
```
PATH**/ ?>
```

But PHP requires all files to end with a newline character:
```
PATH**/ ?>
```

## Solution

### Immediate Fix (Manual)
After deploying code, run this script to fix all compiled views:

```bash
cd /path/to/laravel
php artisan_fix_views.php
```

### Permanent Fix (Automated)

Add this to your deployment process:

**Option 1: Post-deployment script**
```bash
php artisan_fix_views.php
```

**Option 2: Add to Plesk deployment hook**
Configure Plesk to run this script after each deployment.

**Option 3: Create a Laravel Artisan command**
```bash
php artisan make:command FixViewNewlines
```

Then in `FixViewNewlines.php`:
```php
public function handle()
{
    $compiledDir = base_path('storage/framework/views');
    $files = glob($compiledDir . '/*.php');
    $fixed = 0;
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        if (substr($content, -2) === '?>') {
            $content .= "\n";
            if (file_put_contents($file, $content) !== false) {
                $fixed++;
            }
        }
    }
    
    if ($fixed > 0) {
        $this->info("Fixed $fixed compiled view file(s).");
    }
}
```

Run with: `php artisan fix:view-newlines`

## Why This Happens
This appears to be a known issue with the Laravel Blade compiler in PHP 8.x. The compiler does not preserve the trailing newline from the source Blade template.

## Impact
- **Affected:** All Blade templates on production
- **Symptoms:** 500 errors when rendering views
- **Frequency:** Every time views are compiled or cached

## Prevention
Include `php artisan_fix_views.php` in your deployment checklist.

## Related
- Laravel Issue: Blade compiler not preserving trailing newlines
- PHP requirement: All PHP files must end with a newline character
