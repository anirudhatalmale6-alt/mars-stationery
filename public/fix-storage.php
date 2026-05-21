<?php
if ($_GET['key'] ?? '' !== 'mars2026fix') {
    http_response_code(404);
    exit;
}

echo "<h2>Storage Symlink Fix</h2>";

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (is_link($link)) {
    echo "<p>Symlink already exists: " . readlink($link) . "</p>";
    echo "<p>Checking if it works...</p>";
    if (is_dir($link)) {
        echo "<p style='color:green'>Symlink is working correctly!</p>";
    } else {
        echo "<p style='color:red'>Symlink exists but is broken. Removing and recreating...</p>";
        unlink($link);
    }
}

if (!is_link($link)) {
    if (is_dir($link)) {
        echo "<p style='color:orange'>A real directory exists at public/storage. This needs to be a symlink instead.</p>";
        echo "<p>Please delete the public/storage directory and run this script again.</p>";
    } else {
        $result = symlink($target, $link);
        if ($result) {
            echo "<p style='color:green'>Symlink created successfully!</p>";
        } else {
            echo "<p style='color:red'>Failed to create symlink. Trying alternative method...</p>";
            exec("ln -sf " . escapeshellarg($target) . " " . escapeshellarg($link), $output, $code);
            if ($code === 0) {
                echo "<p style='color:green'>Symlink created via shell command!</p>";
            } else {
                echo "<p style='color:red'>Could not create symlink. Your hosting may not support symlinks.</p>";
                echo "<p>Alternative: In cPanel File Manager, go to the public/ folder and create a symbolic link named 'storage' pointing to '../storage/app/public'</p>";
            }
        }
    }
}

echo "<h3>Testing image access:</h3>";
$productsDir = $target . '/products';
if (is_dir($productsDir)) {
    $files = scandir($productsDir);
    $images = array_filter($files, fn($f) => !in_array($f, ['.', '..']));
    echo "<p>Found " . count($images) . " files in storage/app/public/products/</p>";
    foreach (array_slice($images, 0, 3) as $img) {
        echo "<p><img src='/storage/products/$img' style='max-height:100px'> $img</p>";
    }
} else {
    echo "<p style='color:red'>Products directory not found at: $productsDir</p>";
}

echo "<hr><p style='color:gray'>Done. You can delete this file after confirming images work.</p>";
