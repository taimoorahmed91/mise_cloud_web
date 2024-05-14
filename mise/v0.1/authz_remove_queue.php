<?php

// Include database connection
include('includes/database.php');

// Check if ID is set in the URL
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Command to execute inside the Python container
    $command = "docker exec misepy python3 /root/ise-landscape/mise/authz_remove_queue.py $id";

    // Execute command using shell_exec
    shell_exec($command);

    // Redirect back to authz.php after removing from the queue
    header("Location: /mise/v0.1/authz.php");
    exit();
} else {
    // If ID is not set in the URL, redirect back to authz.php
    header("Location: /mise/v0.1/authz.php");
    exit();
}
?>
