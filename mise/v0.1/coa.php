<?php

// Include database connection
include('includes/database.php');

// Check if MAC address and ISE parameters are set in the URL
if(isset($_GET['mac']) && isset($_GET['ise'])) {
    // Get the MAC address and ISE parameters from the URL
    $mac = $_GET['mac'];
    $ise = $_GET['ise'];

    // Command to execute inside the Python container
    $command = "docker exec misepy python3 /root/ise-landscape/mise/coa.py '$ise' '$mac'";

    // Execute command using shell_exec
    shell_exec($command);

    // Redirect back to coa_history.php after executing the script
    header("Location: /mise/v0.1/coa_history.php");
    exit();
} else {
    // If MAC address or ISE parameters are not set in the URL, redirect back to coa_history.php
    header("Location: /mise/v0.1/coa_history.php");
    exit();
}
?>
