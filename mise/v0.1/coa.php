<?php include('includes/database.php'); ?>
<?php

$relativeUrl = "/mise/v0.1/coa_history.php";
header("refresh:0.1;url=$relativeUrl");
        //Assign get variable
        $mac = $_GET['mac'];
        $ise = $_GET['ise'];



 

system("sudo -S python3 /root/ise-landscape/mise/coa.py  '$ise'  '$mac' ");




?>