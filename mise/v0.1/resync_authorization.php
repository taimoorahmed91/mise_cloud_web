<?php

// Include database connection
include('includes/database.php');

$relativeUrl = "/mise/v0.1/authorization.php";
header("refresh:0.1;url=$relativeUrl");

// Check if ID is set in the URL
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Create the select query
    $query = "SELECT * FROM authorization WHERE id = $id";

    // Get results
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

    if($result = $mysqli->query($query)) {
        // Fetch object array
        while($row = $result->fetch_assoc()) {
            $href = $row['href'];
            $authorizationid = $row['authorizationid'];
        }
        // Free Result set
        $result->close();
    }

    // Command to execute inside the Python container
    $command = "docker exec misepy python3 /root/ise-landscape/mise/resync_authorization.py '$href' '$authorizationid'";

    // Execute command using shell_exec
    shell_exec($command);
} else {
    echo "ID parameter is missing.";
}

?>
