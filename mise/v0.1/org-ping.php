<?php
// Define variables
$ipAddress = "";
$fqdn = "";
$result = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user inputs
    $ipAddress = $_POST["ipAddress"];
    $fqdn = $_POST["fqdn"];

    // Validate inputs (optional)
    // You can perform additional validation if needed

    // Execute ping command
    $pingCommand = "ping -c 4 $fqdn"; // Modify the command according to your system
    $result = shell_exec($pingCommand);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ping FQDN</title>
</head>
<body>
    <h2>Ping FQDN</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="ipAddress">IP Address:</label>
        <input type="text" name="ipAddress" id="ipAddress" value="<?php echo $ipAddress; ?>"><br><br>

        <label for="fqdn">FQDN:</label>
        <input type="text" name="fqdn" id="fqdn" value="<?php echo $fqdn; ?>"><br><br>

        <input type="submit" value="Ping"><br><br>
    </form>

    <h3>Ping Result:</h3>
    <pre><?php echo $result; ?></pre>
</body>
</html>
