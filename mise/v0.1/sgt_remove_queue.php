<?php

// Include database connection
include('includes/database.php');

$relativeUrl = "/mise/v0.1/sgt.php";
header("refresh:0.1;url=$relativeUrl");

// Check if ID is set in the URL
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Command to execute inside the Python container
    $command = "docker exec misepy python3 /root/ise-landscape/mise/sgt_remove_queue.py $id";

    // Execute command using shell_exec
    shell_exec($command);
} else {
    echo "ID parameter is missing.";
}

?>
