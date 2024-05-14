<?php

$id = $_GET['id'];


$file_path1= '/var/www/html/mise/v0.1/configs/dacl/'; // Path to the file to be downloaded
$file_path = $file_path1.$id;

$file_name = basename($file_path); // Get the base name of the file

// Set the appropriate headers for the file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
header('Content-Length: ' . filesize($file_path));

// Read the file and output it to the browser
readfile($file_path);