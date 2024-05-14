<?php include('includes/database.php'); ?>
<?php include('tracker.php'); ?>

<?php
session_start();

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "C1sc0123@";
$database = "mise";

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform the database query to check credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Credentials are valid, retrieve user information
        $user = mysqli_fetch_assoc($result);

        // Set session variables
        $_SESSION["login"] = true;
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Credentials are invalid, display an error message
        $error = "Invalid username or password.";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="The design system sponsored by Cisco Brand">
    <meta name="image" content="http://cisco-ui.cisco.com/assets/img/uikit-1200x630%402x.png">
    <meta itemprop="name" content="Cisco UI Kit">
    <meta itemprop="description" content="The design system sponsored by Cisco Brand">
    <meta itemprop="image" content="http://cisco-ui.cisco.com">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Cisco UI Kit">
    <meta name="twitter:description" content="The design system sponsored by Cisco Brand">
    <meta property="og:title" content="Cisco UI Kit">
    <meta property="og:description" content="The design system sponsored by Cisco Brand">
    <meta property="og:image" content="https://cisco-ui.cisco.com/assets/img/uikit-1200x630%402x.png">
    <meta property="og:url" content="http://cisco-ui.cisco.com">
    <meta property="og:site_name" content="Cisco UI Kit">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png" sizes="196x196">
    <link rel="icon" type="image/png" href="img/favicon.png" sizes="96x96">
    <link rel="icon" type="image/png" href="img/favicon.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicon.png" sizes="16x16">
    <link rel="icon" type="image/png" href="img/favicon.png" sizes="128x128">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <meta name="application-name" content="Cisco UI Kit">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="img/mstile.png">
    <meta name="msapplication-square70x70logo" content="img/mstile.png">
    <meta name="msapplication-square150x150logo" content="img/mstile.png">
    <meta name="msapplication-wide310x150logo" content="img/mstile.png">
    <meta name="msapplication-square310x310logo" content="img/mstile.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>MISE &middot; Login</title>

    <link rel="stylesheet" href="css/cui-standard.min.css">

    <script src="https://code.jquery.com/jquery-3.0.0.min.js"
        integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
    <script src="./public/js/styleguide.js"></script>
    <script src="public/js/sidebar.js"></script>
</head>

<body class="cui">
    <nav class="header" id="styleguideheader" role="navigation">
        <div class="container-fluid">
            <div class="header-panels">
                <div class="header-panel hidden-md-down">
                    <a class="header__logo" href="https://www.cisco.com" target="_blank">
                        <span class="icon-cisco"></span>
                    </a>
                    <h1 class="header__title">
                        <span>MISE Portal</span>
                    </h1>
                </div>
                <div class="header-panel header-panel--center base-margin-left base-margin-right hidden-lg-up">
                    <a class="header__logo" href="http://www.cisco.com" target="_blank">
                        <span class="icon-cisco"></span>
                    </a>
                </div>
                <div class="header-panel header-panel--right hidden-md-down">
                    <a href="dashboard.php" class="header-item" title="MISE Home"><span class="icon-home"></span></a>
                    <div id="themeSwitcher" class="dropdown dropdown--left dropdown--offset-qtr header-item">
                        <a class="header-toolbar__link">Theme</a>
                        <div class="dropdown__menu">
                            <a id="theme-default" class="selected">Default</a>
                            <a id="theme-dark">Dark</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="content content--alt">
        <div class="container-fluid">
        <div class="panel panel--loose panel--secondary dbl-padding">
    <div class="row">
        <div class="col-md-8">
            <h4 class="no-margin">Welcome to</h4>
            <h1 class="display-0">
                <span class="text-primary">Cisco</span><span>MISE</span>
            </h1>
            <p class="lead">Your solution to multiple ISE Deployments</p>
        </div>
        <div class="col-md-4">
            <img src="public/img/iheartcisco.png">
        </div>
    </div>
</div>

            <div class="section">
                <form role="form" method="post" action="">
                    <div class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 265px;">
                        <h2 class="subtitle">Login</h2>
                        <hr>
                        <div class="section">
                            <?php if (isset($error)): ?>
                                <div class="alert alert--danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <div class="form-group base-margin-bottom">
                                <div class="form-group base-margin-bottom">
                                    <div class="form-group__text">
                                        <input name="username" required="" type="text">
                                        <label for="input-type-text">Username</label>
                                    </div>
                                </div>
                                <div class="form-group base-margin-bottom">
                                    <div class="form-group__text">
                                        <input name="password" required="" type="password">
                                        <label for="input-type-password">Password</label>
                                    </div>
                                    <input type="submit" class="btn btn--success" value="Login" style="margin-top: 10px;" name="submit" />
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
            <footer class="footer">
                <div class="footer__links">
                    <ul class="list list--inline">
                        <li><a href="http://www.cisco.com/cisco/web/siteassets/contacts/index.html"
                                target="_blank">Contacts</a></li>
                        <li><a href="https://secure.opinionlab.com/ccc01/o.asp?id=jBjOhqOJ" target="_blank">Feedback</a>
                        </li>
                        <li><a href="https://www.cisco.com/c/en/us/about/help.html" target="_blank">Help</a>
                        </li>
                        <li><a href="http://www.cisco.com/c/en/us/about/sitemap.html" target="_blank">Site
                                Map</a>
                        </li>
                        <li><a href="https://www.cisco.com/c/en/us/about/legal/terms-conditions.html"
                                target="_blank">Terms & Conditions</a></li>
                        </li>
                        <li><a href="https://www.cisco.com/c/en/us/about/legal/privacy-full.html"
                                target="_blank">Privacy Statement</a></li>
                        <li><a href="https://www.cisco.com/c/en/us/about/legal/privacy-full.html#cookies"
                                target="_blank">Cookie Policy</a></li>
                        <li><a href="https://www.cisco.com/c/en/us/about/legal/trademarks.html"
                                target="_blank">Trademarks</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
