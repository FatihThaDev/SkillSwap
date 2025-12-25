<?php
// Simple test file to verify PHP is working on InfinityFree
echo "PHP is working!<br>";
echo "Server: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Current Directory: " . __DIR__ . "<br>";
echo "<br>Files in root:<br>";
$files = scandir(__DIR__);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "- " . $file . "<br>";
    }
}
?>

