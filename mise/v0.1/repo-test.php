<?php include('includes/database.php'); ?>
<?php include('tracker.php'); ?>

<?php

// Assign get variable

// Create the select query

$command = "sudo -S python3 /root/ise-landscape/mise/repo-check.py";
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

echo '<script>
    setTimeout(function() {
        alert("' . $alertMessage . '");
        window.history.go(-1);
    }, 0);
</script>';

?>
