# Laravel Blade Compiler Issue - Trailing Newline

## Problem
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
