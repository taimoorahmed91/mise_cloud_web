<?php include('includes/database.php'); ?>
<?php include('tracker.php'); ?>

<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit();
}

// Check if the username and role are set in the session
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
    // Handle the case when the username or role is not set (optional)
    $username = "Unknown";
    $role = "Unknown";
} else {
    // Get the username and role from the session
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];
}
?>
<?php

if ($role !== "Admin") {
    header("Location: 401.php");
    exit(); // Make sure to exit the script after the redirect
}
?>

<?php
	//Assign get variable
	$id = $_GET['id'];



    // Check the value of 'first_name' for the user with the specified ID
    $selectQuery = "SELECT first_name FROM users WHERE id = $id";
    $result = $mysqli->query($selectQuery);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $first_name = $row['first_name'];
    
        // Check if the 'first_name' value is "default"
        if ($first_name !== 'default') {
            // Perform the deletion
            $deleteQuery = "DELETE FROM users WHERE id = $id";
            if ($mysqli->query($deleteQuery)) {
                $response = "User deleted successfully.";
            } else {
                $response = "Error deleting user: " . $mysqli->error;
            }
        } else {
            $response = "Default user can not be deleted.";
        }
    } else {
        $response = "User not found.";
    }
    
    // Output the response
    echo '<script>
    setTimeout(function() {
        alert("' . $response . '");
        window.history.go(-1);
    }, 0);
</script>';
    


    $relativeUrl = "/mise/v0.1/user.php";
    header("refresh:0.1;url=$relativeUrl");
	
?>