<?php
// Update app.blade.php and navbar branding EduLearn -> SMA N 1 Cepogo

$files = [
    'resources/views/layouts/app.blade.php',
    'resources/views/components/navbar.blade.php',
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    $content = str_replace('EduLearn', 'SMA N 1 Cepogo', $content);
    file_put_contents($file, $content);
    echo "Updated: $file\n";
}

// Update APP_NAME in .env
$env = file_get_contents('.env');
$env = preg_replace('/^APP_NAME=.*/m', 'APP_NAME="SMA N 1 Cepogo"', $env);
file_put_contents('.env', $env);
echo "Updated .env\n";

// Also update teal color references in navbar component to orange
$navbarFile = 'resources/views/components/navbar.blade.php';
$navbar = file_get_contents($navbarFile);
$navbar = str_replace('teal-500', 'orange-500', $navbar);
$navbar = str_replace('teal-600', 'orange-600', $navbar);
$navbar = str_replace('teal-700', 'orange-700', $navbar);
$navbar = str_replace('teal-100', 'orange-100', $navbar);
$navbar = str_replace('teal-200', 'orange-200', $navbar);
file_put_contents($navbarFile, $navbar);
echo "Navbar teal->orange done\n";
echo "All branding done!\n";
