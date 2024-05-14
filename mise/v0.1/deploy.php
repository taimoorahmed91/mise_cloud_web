<?php

// Include database connection
include('includes/database.php');

// Script to fetch policyset authorization
$query = "SELECT * FROM deployments WHERE marked = 'yes'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

// Check if the query result is empty
if ($result->num_rows > 0) {
    // Redirect to deploy-history.php
    $relativeUrl = "/mise/v0.1/deploy-history.php";
    header("refresh:0.1;url=$relativeUrl");

    // Fetch object array
    while ($row = $result->fetch_assoc()) {
        $fqdn = $row['fqdn'];
        echo $fqdn;
        
        // Command to execute inside the Python container for deployment
        $command = "sudo -S docker exec misepy python3 /root/ise-landscape/mise/deploy.py '$fqdn'";
        
        // Execute command using shell_exec
        shell_exec($command);
    }
    
    // Free result set
    $result->close();

    // Execute other Python scripts
    system("sudo -S docker exec misepy python3 /root/ise-landscape/mise/deployment_journal.py");
    system("sudo -S docker exec misepy python3 /root/ise-landscape/mise/clear_queue.py");
    system("sudo -S docker exec misepy python3 /root/ise-landscape/mise/clear_deployment.py");
    system("sudo -S docker exec misepy python3 /root/ise-landscape/mise/webex-alert.py");

} else {
    // No deployments found
    echo "<script>alert('No deployments found. Please make sure to mark the node for deployment first');</script>";	
    $relativeUrl2 = "/mise/v0.1/deployment_phase3.php";
    header("refresh:0.1;url=$relativeUrl2");
}
?>
