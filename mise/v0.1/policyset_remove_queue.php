<?php include('includes/database.php'); ?>
<?php

 
$relativeUrl = "/mise/v0.1/policyset.php";
header("refresh:0.1;url=$relativeUrl");

        //Assign get variable
        $id = $_GET['id'];


system("sudo -S python3 /root/ise-landscape/mise/policyset_remove_queue.py  $id ");


?>