<?php
$compiledDir = __DIR__ . '/storage/framework/views';
$files = glob($compiledDir . '/*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    if (substr($content, -2) === '?>') {
        $content .= "\n";
        file_put_contents($file, $content);
        echo "Fixed: " . basename($file) . "\n";
    }
}
echo "Done.\n";
