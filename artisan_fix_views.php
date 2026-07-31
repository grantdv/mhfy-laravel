#!/usr/bin/env php
<?php
// This script ensures all compiled view files end with a newline
// Run this after deploying to fix Plesk/Laravel Blade compiler issue

$compiledDir = __DIR__ . '/storage/framework/views';
$files = glob($compiledDir . '/*.php');

$fixed = 0;
foreach ($files as $file) {
    $content = file_get_contents($file);
    if (substr($content, -2) === '?>') {
        $content .= "\n";
        if (file_put_contents($file, $content) !== false) {
            echo "Fixed: " . basename($file) . "\n";
            $fixed++;
        }
    }
}

if ($fixed > 0) {
    echo "\nFixed $fixed compiled view file(s).\n";
    echo "The Laravel Blade compiler does not preserve trailing newlines.\n";
    echo "This script should be run after every deployment.\n";
} else {
    echo "All view files already have proper line endings.\n";
}
