<?php

// Include database connection
include('includes/database.php');

// Check if MAC address parameter is set in the URL
if(isset($_GET['mac'])) {
    // Get the MAC address from the URL
    $mac = $_GET['mac'];

    // Command to execute inside the Python container
    $command = "sudo -S docker exec misepy python3 /root/ise-landscape/mise/coaall.py '$mac'";

    // Execute command using shell_exec
    shell_exec($command);

    // Redirect back to coa_history.php after executing the script
    header("Location: /mise/v0.1/coa_history.php");
    exit();
} else {
    // If MAC address parameter is not set in the URL, redirect back to coa_history.php
    header("Location: /mise/v0.1/coa_history.php");
    exit();
}
?>
