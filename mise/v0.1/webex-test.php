<?php include('includes/database.php'); ?>
<?php

 
$relativeUrl = "/mise/v0.1/webex-integration.php";
header("refresh:0.1;url=$relativeUrl");




system("sudo -S python3 /root/ise-landscape/mise/webex-test.py  ");


?>