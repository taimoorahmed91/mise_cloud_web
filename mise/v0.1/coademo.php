<!DOCTYPE html>
<html>
<head>
    <title>Button Form</title>
</head>
<body>
    <form method="GET" action="coademo.php">
        <label for="value1">Enter value 1:</label>
        <input type="text" id="value1" name="value1">
        <br>
        <label for="value2">Enter value 2:</label>
        <input type="text" id="value2" name="value2">
        <br>
        <button type="submit" name="button" value="1">Button 1</button>
        <button type="submit" name="button" value="2">Button 2</button>
    </form>

    <?php
    if(isset($_GET['button'])) {
        $value1 = $_GET['value1'];
        $value2 = $_GET['value2'];
        $button = $_GET['button'];

        if ($button == 1) {
            // Button 1 was clicked, redirect to page1.php
            header("Location: page1.php?value1=$value1&value2=$value2");
            exit();
        } elseif ($button == 2) {
            // Button 2 was clicked, redirect to page2.php
            header("Location: page2.php?value1=$value1&value2=$value2");
            exit();
        }
    }
    ?>
</body>
</html>
