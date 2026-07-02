<?php
$content = file_get_contents('resources/views/tugas/teacher_detail.blade.php');
preg_match('/<style>.*?<\/style>/s', $content, $matches);
if (isset($matches[0])) {
    $style = $matches[0];
    $content = str_replace($style, '', $content);
    $content = str_replace("@section('content')", "@section('content')\n" . $style, $content);
    file_put_contents('resources/views/tugas/teacher_detail.blade.php', $content);
}

$content2 = file_get_contents('resources/views/tugas/index.blade.php');
preg_match('/<style>.*?<\/style>/s', $content2, $matches2);
if (isset($matches2[0])) {
    $style2 = $matches2[0];
    $content2 = str_replace($style2, '', $content2);
    $content2 = str_replace("@section('content')", "@section('content')\n" . $style2, $content2);
    file_put_contents('resources/views/tugas/index.blade.php', $content2);
}
echo 'Moved style blocks successfully';
?>
