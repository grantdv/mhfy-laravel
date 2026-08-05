<?php
$views = [
    'welcome' => '/home/grant/mhfy-laravel/resources-clone/views/welcome.blade.php',
    'home' => '/home/grant/mhfy-laravel/resources-clone/views/welcome.blade.php',
];

$path = $views[$_GET['page'] ?? 'welcome'];
if (file_exists($path)) {
    header('Content-Type: text/html; charset=utf-8');
    echo file_get_contents($path);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>May Harmony Find You - Local Testing</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; padding: 20px; background: #f9f9f9; color: #222; }
        .container { max-width: 800px; margin: 0 auto; }
        h1 { color: #333; }
        .nav { margin: 20px 0; }
        .nav a { margin-right: 10px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .nav a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>May Harmony Find You - Local Frontend Testing</h1>
        <p>Make your UI/UX changes in <code>resources-clone/views</code> and refresh to see them.</p>
        <div class="nav">
            <a href="?page=welcome">View Welcome Page</a>
            <a href="/build/assets/app-BZmijWrE.css">View CSS</a>
            <a href="/build/assets/app-B9qO1Jfl.js">View JS</a>
            <a href="/resources-clone/views">Browse All Templates</a>
        </div>
    </div>
</body>
</html>
