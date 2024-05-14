<?php include('includes/database.php'); ?>
<?php include('tracker.php'); ?>

<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>MISE Logs Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        pre {
            background-color: #f5f5f5;
            padding: 10px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <h1>Allowed Protocols Logs</h1>

    <?php


$relativeUrl = "/mise/v0.1/ap-log.php";
header("refresh:3;url=$relativeUrl");




$logFilePath = '/var/www/html/mise/v0.1/logging/ap-logs';
$command = 'sudo tail -500 ' . $logFilePath;
$logContent = shell_exec($command);
echo '<pre>' . htmlspecialchars($logContent) . '</pre>';







?>
</body>
</html>