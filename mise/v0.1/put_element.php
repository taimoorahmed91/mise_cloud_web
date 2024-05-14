<?php 
include('includes/database.php'); 
include('tracker.php');

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

// Check if the username and role are set in the session
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
    // Handle the case when the username or role is not set (optional)
    $username = "Unknown";
    $role = "Unknown";
} else {
    // Get the username and role from the session
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $fid = escapeshellarg($_GET['id']); // Escape the argument to prevent command injection

    // Construct the command
    $command = "sudo -S python3 /root/ise-landscape/mise/overlap.py " . $fid;

    // Execute the command
    system($command, $retval);

    // $retval is the return value of the executed command, 0 usually means success
    if ($retval === 0) {
        // Redirect to the desired page
        header("Location: /mise/v0.1/deployed_elements.php");
        exit();
    } else {
        echo "Script execution failed.";
    }
} else {
    echo "ID parameter is missing.";
}
?>
