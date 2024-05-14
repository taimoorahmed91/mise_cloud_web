<?php

// Include database connection
include('includes/database.php');

$relativeUrl = "/mise/v0.1/webex-integration.php";
header("refresh:0.1;url=$relativeUrl");

// Command to execute inside the Python container
$command = "sudo -S docker exec misepy python3 /root/ise-landscape/mise/webex-test.py";

// Execute command using shell_exec
shell_exec($command);

?>
