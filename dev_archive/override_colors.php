<?php
/**
 * Override teal/green CSS classes to orange throughout the project
 * Targets: app.css global styles and all blade templates
 */

$cssFile = 'resources/css/app.css';
$css = file_get_contents($cssFile);

// Replace teal color references in CSS
$replacements = [
    '#0d9488' => '#e87722',  // teal-600 hex
    '#0f766e' => '#c45e10',  // teal-700 hex
    '#14b8a6' => '#f97316',  // teal-500 hex
    '#99f6e4' => '#fed7aa',  // teal-200 hex
    '#ccfbf1' => '#ffedd5',  // teal-100 hex
    'teal-50'  => 'orange-50',
    'teal-100' => 'orange-100',
    'teal-200' => 'orange-200',
    'teal-300' => 'orange-300',
    'teal-400' => 'orange-400',
    'teal-500' => 'orange-500',
    'teal-600' => 'orange-600',
    'teal-700' => 'orange-700',
    'teal-800' => 'orange-800',
    'teal-900' => 'orange-900',
    'green-600' => 'orange-600',
];

foreach ($replacements as $from => $to) {
    $css = str_replace($from, $to, $css);
}

// Add CSS variable overrides at the end
$css .= "\n\n/* ===== SMA N 1 Cepogo Theme Overrides ===== */\n";
$css .= ":root {\n";
$css .= "    --color-primary: #e87722;\n";
$css .= "    --color-primary-dark: #c45e10;\n";
$css .= "    --color-primary-light: #fff3e8;\n";
$css .= "}\n";

$css .= <<<CSS

/* Button primary override */
.btn-primary,
button[type=\"submit\"].btn,
a.btn-primary {
    background: linear-gradient(135deg, #e87722, #c45e10) !important;
    border-color: #e87722 !important;
    color: white !important;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #c45e10, #9a4a0d) !important;
}

/* Input focus ring override */
.input:focus,
input:focus,
select:focus,
textarea:focus {
    --tw-ring-color: rgba(232, 119, 34, 0.5) !important;
    border-color: #e87722 !important;
}

/* Checkbox / radio orange */
input[type="checkbox"]:checked,
input[type="radio"]:checked {
    background-color: #e87722 !important;
    border-color: #e87722 !important;
}

/* Link accent override */
a.text-teal-600, .text-teal-600 { color: #e87722 !important; }
a.text-teal-500, .text-teal-500 { color: #f97316 !important; }
a.hover\\:text-teal-700:hover   { color: #c45e10 !important; }
CSS;

file_put_contents($cssFile, $css);
echo "CSS overrides applied: " . strlen($css) . " bytes\n";

// Also update dashboard.blade.php - replace teal with orange
$dashFile = 'resources/views/dashboard.blade.php';
$dash = file_get_contents($dashFile);
$dash = str_replace('teal-600', 'orange-600', $dash);
$dash = str_replace('teal-500', 'orange-500', $dash);
$dash = str_replace('teal-100', 'orange-100', $dash);
$dash = str_replace('teal-50',  'orange-50',  $dash);
$dash = str_replace('teal-200', 'orange-200', $dash);
$dash = str_replace('text-teal', 'text-orange', $dash);
$dash = str_replace('bg-teal',   'bg-orange',   $dash);
$dash = str_replace('border-teal', 'border-orange', $dash);
$dash = str_replace('from-teal', 'from-orange', $dash);
$dash = str_replace('to-teal',   'to-orange',   $dash);
$dash = str_replace('ring-teal', 'ring-orange', $dash);
file_put_contents($dashFile, $dash);
echo "Dashboard teal->orange done\n";

echo "Color overrides complete!\n";
