<?php
$html = file_get_contents(__DIR__ . '/frontend/index.html');

if ($_SERVER['SERVER_NAME'] !== 'localhost' && $_SERVER['SERVER_NAME'] !== '127.0.0.1') {
    $html = str_replace('src="utils/', 'src="/frontend/utils/', $html);
    $html = str_replace('src="services/', 'src="/frontend/services/', $html);
    $html = str_replace('src="assets/', 'src="/frontend/assets/', $html);
    $html = str_replace('href="utils/', 'href="/frontend/utils/', $html);
    $html = str_replace('href="services/', 'href="/frontend/services/', $html);
    $html = str_replace('href="assets/', 'href="/frontend/assets/', $html);
}

echo $html;

