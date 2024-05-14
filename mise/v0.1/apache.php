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
    <h1>Apache Access Logs</h1>

    <?php


$relativeUrl = "/mise/v0.1/apache.php";
header("refresh:3;url=$relativeUrl");




$logFilePath = '/var/log/apache2/access.log';
$command = 'sudo tail -500 ' . $logFilePath;
$logContent = shell_exec($command);
echo '<pre>' . htmlspecialchars($logContent) . '</pre>';







?>
</body>
</html>