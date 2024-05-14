<?php include('includes/database.php'); ?>
<?php

$relativeUrl = "/mise/v0.1/authz.php";
header("refresh:0.1;url=$relativeUrl");
        //Assign get variable
        $id = $_GET['id'];



//Create the select query
  $query ="SELECT * from authz WHERE id = $id";
  //Get results

    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
        if($result = $mysqli->query($query)){
                //Fetch object array
                while($row = $result->fetch_assoc()) {
                        $href = $row['href'];
                        $authzid = $row['authzid'];
                }
                //Free Result set
                $result->close();
        }
  

system("sudo -S python3 /root/ise-landscape/mise/resync_authz.py  '$href'  '$authzid' ");




?>