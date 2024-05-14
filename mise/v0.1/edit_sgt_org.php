<?php include('includes/database.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit File</title>
</head>
<body>
    <h2>Edit File</h2>
    <h3>This is SGT page</h3>

    <?php
    $folder = 'sgt'; // Set the folder name to 'SGT'

    function getFileLocation($folder, $fileName) {
        $baseDir = '/var/www/html/mise/v0.1/configs/';
        return $baseDir . 'sgt/' . $fileName;
    }

    // Check if the 'id' parameter exists in the URL
    if (isset($_GET['id'])) {
        $file_name = $_GET['id'];

        if (!empty($file_name)) {
            $file_path = getFileLocation($folder, $file_name);

            if (file_exists($file_path)) {
                $file_contents = file_get_contents($file_path);
                $file_lines = file($file_path);
                $num_lines = count($file_lines);
                $rows = $num_lines + 5;

                // Display the form
                ?>
                <form method="post">
                    <textarea name="file_contents" rows="<?php echo $rows; ?>" cols="100%"><?php echo htmlspecialchars($file_contents); ?></textarea><br>
                    <input type="hidden" name="file_path" value="<?php echo htmlspecialchars($file_path); ?>">
                    <label for="new_file_name">Enter New File Name:</label>
                    <input type="text" id="new_file_name" name="new_file_name"><br>
                    <button type="submit" name="save_btn">Save as New File</button>
                </form>
                <?php
            } else {
                echo "<p>Error: The file does not exist.</p>";
            }
        }
    }

    if (isset($_POST['save_btn'])) {
        $file_contents = $_POST['file_contents'];
        $file_path = $_POST['file_path'];
        $new_file_name = $_POST['new_file_name'];

        if (empty($file_contents) || empty($file_path) || empty($new_file_name)) {
            echo "<p>Error: Please fill all fields.</p>";
        } else {
            $new_file_path = getFileLocation($folder, $new_file_name);

            if (file_exists($new_file_path)) {
                echo "<p>Error: A file with the same name already exists. Please choose a different name.</p>";
            } else {
                // Save the edited contents to the new file
                if (file_put_contents($new_file_path, $file_contents) !== false) {
                    // Insert the file name into the database table
                    $sql = "INSERT INTO sgt (sgt,sgtid,isename) VALUES ('$new_file_name','$new_file_name','MISE')";
                    if ($mysqli->query($sql) === TRUE) {
                        echo "<p>File has been successfully saved as: " . htmlspecialchars($new_file_name) . "</p>";
                    } else {
                        echo "<p>Error: Unable to save the file name to the database.</p>";
                    }
                } else {
                    echo "<p>Error: Unable to save the file. Please check the file path and permissions.</p>";
                }
            }
        }
    }

    $mysqli->close(); // Close the database connection
    ?>
</body>
</html>
