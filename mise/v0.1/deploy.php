<?php include('includes/database.php'); ?>

<?php


$relativeUrl = "/mise/v0.1/deploy-history.php";
header("refresh:0.1;url=$relativeUrl");
// Script to fetch policyset authorization
$query = "SELECT * FROM deployments WHERE marked = 'yes'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

// Check if the query result is empty
if ($result->num_rows > 0) {
    //header("refresh:10;url=http://10.48.30.213/landscape/checkout.php");
    $relativeUrl = "/mise/v0.1/deploy-history.php";
    header("refresh:0.1;url=$relativeUrl");

    // Fetch object array
    while ($row = $result->fetch_assoc()) {
        $fqdn = $row['fqdn'];
        echo $fqdn;
        system("sudo -S python3 /root/ise-landscape/mise/deploy.py  '$fqdn' ");
    }
    
    // Free result set
    $result->close();

    system("sudo -S python3 /root/ise-landscape/mise/deployment_journal.py");
    system("sudo -S python3 /root/ise-landscape/mise/clear_queue.py");
    system("sudo -S python3 /root/ise-landscape/mise/clear_deployment.py");
    system("sudo -S python3 /root/ise-landscape/mise/webex-alert.py");

} else {
	echo "<script>alert('No deployments found. Please make sure to mark the node for deployment first');</script>";	
    //echo "No deployments found. Please mark a node for deployment first"; // Add an appropriate message here or handle as desired
    //header("refresh:1;url=http://10.48.30.213/landscape/deployment_phase1.php");
    $relativeUrl2 = "/mise/v0.1/deployment_phase3.php";
    header("refresh:0.1;url=$relativeUrl2");
}
?>

