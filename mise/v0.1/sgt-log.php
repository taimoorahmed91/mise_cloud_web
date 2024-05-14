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
    <h1>SGT Logs</h1>

    <?php


$relativeUrl = "/mise/v0.1/sgt-log.php";
header("refresh:3;url=$relativeUrl");




$logFilePath = '/var/www/html/mise/v0.1/logging/sgt-logs';
$command = 'sudo tail -500 ' . $logFilePath;
$logContent = shell_exec($command);
echo '<pre>' . htmlspecialchars($logContent) . '</pre>';







?>
</body>
</html>