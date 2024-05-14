<?php include('includes/database.php'); ?>
<?php
session_start();

$username = $_SESSION["username"];


$role = $_SESSION["role"];


// Get the current page URL
$pageUrl = $_SERVER['PHP_SELF'];

// Get the visitor's IP address
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Get the User Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Get the Referrer
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// Get the Session ID
$sessionId = session_id();

// Get the HTTP method
$httpMethod = $_SERVER['REQUEST_METHOD'];

// Get the query parameters
$queryParams = $_SERVER['QUERY_STRING'];

// Get the server name
$serverName = $_SERVER['SERVER_NAME'];

// Get the server port
$serverPort = $_SERVER['SERVER_PORT'];

// Get the request URI
$requestUri = $_SERVER['REQUEST_URI'];

// Get the cookies
$cookies = $_COOKIE;

// Get the current timestamp
$timestamp = date('Y-m-d H:i:s');

// Format the log entry
$logEntry = $timestamp . " - Username: " . $username . " - Role: " . $role . " - Page: " . $pageUrl . " - IP: " . $ipAddress . " - User Agent: " . $userAgent . " - Referrer: " . $referrer . " - Session ID: " . $sessionId . " - HTTP Method: " . $httpMethod . " - Query Params: " . $queryParams . " - Server Name: " . $serverName . " - Server Port: " . $serverPort . " - Request URI: " . $requestUri . " - Cookies: " . json_encode($cookies) . "\n";

// Append the log entry to a file
file_put_contents("page_logs.txt", $logEntry, FILE_APPEND);



?>
