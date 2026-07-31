# Production Deployment Checklist

## Before Deploying to Production

### 1. Code Review
- [ ] Run `git status` to ensure only intended files are changed
- [ ] Run `git diff` to review all changes
- [ ] Check for syntax errors: `php -l app/**/*.php`
- [ ] Check Blade syntax: `php -l resources/views/**/*.blade.php`

### 2. Bug Fixes (Latest)
- [ ] **2026-07-31**: Admin orders dashboard statistics (OrderController)
- [ ] **2026-07-31**: Cart count undefined in navigation (isset() && fallback)
- [ ] **2026-07-31**: inquiry.blade.php missing @endif tag
- [ ] **2026-07-31**: InquiryController variable name mismatch (orderId vs order_id)
- [ ] **2026-07-31**: View composer compatibility (container access vs static method)

### 3. Database Migrations
- [ ] Run `php artisan migrate --force` if migrations pending

### 4. Environment Variables
- [ ] Verify `.env` is committed (or ensure `.env` is in .gitignore)
- [ ] Check `.env.production` matches production requirements

## Deployment Steps (Plesk)

### 1. Pull Latest Code
1. Use Plesk File Manager to connect to server
2. Navigate to `~/httpdocs`
3. Run: `git pull origin master`

### 2. Install Dependencies
```bash
cd ~/httpdocs
composer install --no-dev --optimize-autoloader
```

### 3. Clear All Caches
```bash
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### 4. Fix Compiled Views (Critical!)
```bash
php artisan fix:view-newlines
```

If this command doesn't exist, manually fix:
```bash
find storage/framework/views -name "*.php" -exec sh -c '
  if [ "$(tail -c 2 "$1" | od -An -tx1 | tr -d " ")" = "7d 0a" ]; then
    echo "File already has newline: $1"
  elif [ "$(tail -c 2 "$1" | od -An -tx1 | tr -d " ")" = "7d" ]; then
    echo "Adding newline to: $1"
    echo "" >> "$1"
  fi
' _ {} \;
```

### 5. Restart Web Server
- Use Plesk to restart Apache/Nginx

### 6. Verify Deployment
- [ ] Visit homepage: `https://mayharmonyfindyou.com/`
- [ ] Visit admin dashboard: `https://mayharmonyfindyou.com/admin`
- [ ] Visit admin orders: `https://mayharmonyfindyou.com/admin/orders`
- [ ] Check logs: `tail -f ~/httpdocs/storage/logs/laravel.log`
- [ ] Verify no 500 errors in logs

## Post-Deployment Verification

### Critical Routes to Test
- [ ] Homepage: `/`
- [ ] Products page: `/products`
- [ ] Product detail: `/products/{id}`
- [ ] Cart page: `/cart`
- [ ] Inquiry form: `/contact`
- [ ] Admin dashboard: `/admin`
- [ ] Admin orders: `/admin/orders`
- [ ] Checkout: `/cart/complete`

### Check Logs
```bash
tail -n 50 ~/httpdocs/storage/logs/laravel.log
```

Look for:
- ✅ No errors
- ✅ No "Undefined variable" errors
- ✅ No "Method does not exist" errors
- ✅ No "syntax error" messages

### Common Issues & Fixes

#### Issue: 500 Error - Undefined variable $cartCount
**Fix:** Clear compiled views
```bash
rm -rf ~/httpdocs/storage/framework/views/*
```

#### Issue: 500 Error - Method does not exist
**Fix:** This is a code issue, not a cache issue. Pull latest code from GitHub.

#### Issue: Views not updating
**Fix:** Clear all caches and compiled views
```bash
php artisan view:clear
php artisan cache:clear
rm -rf ~/httpdocs/storage/framework/views/*
```

## Rollback Procedure

If deployment fails:

1. **Rollback via Git**
   ```bash
   cd ~/httpdocs
   git checkout HEAD~1
   git reset --hard HEAD~1
   ```

2. **Clear caches**
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

3. **Restart web server**

## Emergency Contacts

- **Grant Davis** (Developer)
- **Plesk Support** (Managed hosting)
- **Laravel Documentation**: https://laravel.com/docs

---

## Recent Bug Fixes Summary

### 2026-07-31 Fixes

1. **Admin Orders Dashboard** - Added missing statistics variables
   - `$totalRevenue`
   - `$totalOrders`
   - `$conversionRate`
   - `$lowStockProducts`
   - `$recentOrders`

2. **Cart Count Navigation** - Added fallback for undefined variable
   - Changed `@if($cartCount > 0)` to `@if(isset($cartCount) && $cartCount > 0)`
   - Changed `{{ $cartCount }}` to `{{ $cartCount ?? 0 }}`

3. **inquiry.blade.php** - Added missing @endif tag
   - Fixed unbalanced Blade tags

4. **InquiryController** - Fixed variable name mismatch
   - Changed `compact('orderId')` to `compact('order_id')`

5. **View Composer** - Fixed Laravel version compatibility
   - Changed `View::composer()` to `$this->app['view']->composer()`

### How to Apply Fixes

1. **Pull latest code:**
   ```bash
   cd ~/httpdocs
   git pull origin master
   ```

2. **Clear compiled views:**
   ```bash
   rm -rf ~/httpdocs/storage/framework/views/*
   ```

3. **Clear all caches:**
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

4. **Restart web server** (via Plesk)

---

## Notes

- Always test on staging before production
- Keep backup of old code before deploying
- Document all changes in `docs/bug-fixes.md`
- Check logs after each deployment
