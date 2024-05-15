<?php include('includes/database.php'); ?>
<?php include('tracker.php'); ?>
<?php
$scripts = array("dacl_data", "nad_data", "ap_data", "authz_data", "sgt_data", "policyset_data", "condition_data", "nodes");
$relativeUrl = "/mise/v0.1/deployments.php";
header("refresh:0.1;url=$relativeUrl");

//header( "refresh:1;url=http://10.48.30.213/landscape/deployments.php" );

$id = $_GET['id'];

// Create the select query
$query = "SELECT fqdn FROM deployments WHERE id = $id";

// Get results
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result = $mysqli->query($query)) {
    // Fetch object array
    while ($row = $result->fetch_assoc()) {
        $fqdn = $row['fqdn'];

        // Execute each script
        foreach ($scripts as $scriptName) {
            // Command to execute inside the Python container
            if ($scriptName === "policyset_data") {
                $command = "docker exec misepy python3 /root/ise-landscape/mise/{$scriptName}.py " . escapeshellarg($fqdn) . " " . $id;
            } else {
                $command = "docker exec misepy python3 /root/ise-landscape/mise/{$scriptName}.py " . escapeshellarg($fqdn);
            }
            // Execute command using shell_exec
            shell_exec($command);
        }
    }
    // Free Result set
    $result->close();
}

// Script to fetch policyset authentication
$query = "SELECT * FROM policyset WHERE inheritid = $id";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result = $mysqli->query($query)) {
    // Fetch object array
    while ($row = $result->fetch_assoc()) {
        $isename = $row['isename'];
        $policysetid = $row['policysetid'];
        $policyset = $row['policyset'];

        // Command to execute inside the Python container
        $command = "docker exec misepy python3 /root/ise-landscape/mise/authentication.py '$isename' '$policysetid' '$policyset'";
        // Execute command using shell_exec
        shell_exec($command);
    }
    // Free Result set
    $result->close();
}

// Script to fetch policyset authorization
$query = "SELECT * FROM policyset WHERE inheritid = $id";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result = $mysqli->query($query)) {
    // Fetch object array
    while ($row = $result->fetch_assoc()) {
        $isename = $row['isename'];
        $policysetid = $row['policysetid'];
        $policyset = $row['policyset'];

        // Command to execute inside the Python container
        $command = "docker exec misepy python3 /root/ise-landscape/mise/authorization.py '$isename' '$policysetid' '$policyset'";
        // Execute command using shell_exec
        shell_exec($command);
    }
    // Free Result set
    $result->close();
}

// Script to set fetched to yes
$command = "docker exec misepy python3 /root/ise-landscape/mise/fetched_yes.py $id";
// Execute command using shell_exec
shell_exec($command);

// Script to send webex after completion
$command = "docker exec misepy python3 /root/ise-landscape/mise/webex-populate.py $id";
// Execute command using shell_exec
shell_exec($command);

// Script to cleanup inheritid
$query = "UPDATE policyset set inheritid = NULL";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
// Free Result set
$result->close();

?>
