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
            $lockFilePath = __DIR__ . '/locks/' . $scriptName . '.lock';

            // Check if the lock file exists
            if (file_exists($lockFilePath)) {
                die("Another instance of '{$scriptName}' is already running.");
            }

            // Create the lock file
            file_put_contents($lockFilePath, '');

            // Execute the Python script
            if ($scriptName === "policyset_data") {
                $command = "sudo -S python3 /root/ise-landscape/mise/{$scriptName}.py " . escapeshellarg($fqdn) . " " . $id;
            } else {
                $command = "sudo -S python3 /root/ise-landscape/mise/{$scriptName}.py " . escapeshellarg($fqdn);
            }
            system($command);

            // Delete the lock file
            unlink($lockFilePath);
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

        system("sudo -S python3 /root/ise-landscape/mise/authentication.py '$isename' '$policysetid' '$policyset'");
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

        system("sudo -S python3 /root/ise-landscape/mise/authorization.py '$isename' '$policysetid' '$policyset'");
    }
    // Free Result set
    $result->close();
}



### script to set fetched to yes
system("sudo -S python3 /root/ise-landscape/mise/fetched_yes.py $id"); 

### script to send wenex after completion
system("sudo -S python3 /root/ise-landscape/mise/webex-populate.py $id");

### script to cleanup inheritit
//Create the select query
  $query ="UPDATE policyset set inheritid = NULL ";
  //Get results
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
                //Free Result set
             
             
?>

