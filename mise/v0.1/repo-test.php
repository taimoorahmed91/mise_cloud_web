<?php

// Include database connection
include('includes/database.php');
include('tracker.php');

// Assign get variable (Not used in this script)

// Command to execute inside the Python container
$command = "docker exec misepy python3 /root/ise-landscape/mise/repo-check.py";

// Execute command using shell_exec
$output = shell_exec($command);

// Set default alert class and message
$alertClass = 'alert--info';
$alertMessage = '';

// Check the output and send appropriate response
if (strpos($output, "SFTP connection successful!") !== false) {
    $alertClass = 'alert--success';
    $alertMessage = 'SFTP connection successful!';
} else {
    $alertClass = 'alert--error';
    $alertMessage = 'SFTP connection failed.';
}

// Output JavaScript alert and redirect
echo '<script>
    setTimeout(function() {
        alert("' . $alertMessage . '");
        window.history.go(-1);
    }, 0);
</script>';

?>
