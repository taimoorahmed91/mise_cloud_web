<?php

// Include database connection
include('includes/database.php');

// Assign get variable
$id = $_GET['id'];

// Create the select query
$query = "SELECT * FROM deployments WHERE id = $id";

// Get results
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result = $mysqli->query($query)) {
    // Fetch object array
    while ($row = $result->fetch_assoc()) {
        $fqdn = $row['fqdn'];
    }
    // Free result set
    $result->close();
}

// Command to execute inside the Python container
$command = "sudo -S docker exec misepy python3 /root/ise-landscape/mise/verify_deployment.py '$fqdn'";
$output = shell_exec($command);

// Set default alert class and message
$alertClass = 'alert--info';
$alertMessage = '';

// Check the output and send appropriate response
if (strpos($output, "version") !== false) {
    http_response_code(200);
    $alertClass = 'alert--success';
    $alertMessage = 'Deployment looks good, it is responding to API calls';
    $query2 = "UPDATE deployments SET reachable='yes' WHERE id = $id";
    $result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
} elseif (strpos($output, "Unauthorized") !== false) {
    http_response_code(401);
    $alertClass = 'alert--warning';
    $alertMessage = 'You need to check credentials, received a 401 Unauthorized response';
    $query3 = "UPDATE deployments SET reachable='no' WHERE id = $id";
    $mysqli->query($query3) or die($mysqli->error.__LINE__);
    
} else {
    http_response_code(500);
    $alertClass = 'alert--error';
    $alertMessage = 'ISE deployment needs checking, check ERS and API Gateway Config';
    $query3 = "UPDATE deployments SET reachable='no' WHERE id = $id";
    $result3 = $mysqli->query($query3) or die($mysqli->error.__LINE__);
}

echo '<script>
    setTimeout(function() {
        alert("' . $alertMessage . '");
        window.history.go(-1);
    }, 0);
</script>';

?>
