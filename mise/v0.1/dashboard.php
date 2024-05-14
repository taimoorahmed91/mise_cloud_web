<?php include('includes/database.php'); ?>
<?php include('tracker.php'); ?>

<?php
$relativeUrl = "/mise/v0.1/dashboard.php";
header("refresh:30;url=$relativeUrl");
?>
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
  // Create the select query
  $query = "SELECT name,fqdn,action,frequency from scheduler WHERE scheduler = 'yes' ORDER by id desc LIMIT 1 ";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name_scheduler = $row['name'];
    $fqdn_scheduler = explode('/', $row['fqdn'])[1];
    $action_scheduler = str_replace('.sh', '', $row['action']);
    $every_scheduler = round($row['frequency'] / 3600);

  } else {
    $cubes = 0; // Default value if no data is found
  }
?>



<?php
  // Create the select query
  $query = "SELECT name,comments,time from deployhistory ORDER BY id DESC limit 1 ";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name1 = $row['name'];
    $comments1 = $row['comments'];
    $time1 = $row['time'];
  } else {
    $cubes = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT name,comments,time from deployhistory ORDER BY id DESC limit 1 OFFSET 1 ";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name2 = $row['name'];
    $comments2 = $row['comments'];
    $time2 = $row['time'];
  } else {
    $cubes = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT name,comments,time from deployhistory ORDER BY id DESC limit 1 OFFSET 2";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name3 = $row['name'];
    $comments3 = $row['comments'];
    $time3 = $row['time'];
  } else {
    $cubes = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT name,comments,time from deployhistory ORDER BY id DESC limit 1  OFFSET 3";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name4 = $row['name'];
    $comments4 = $row['comments'];
    $time4 = $row['time'];
  } else {
    $cubes = 0; // Default value if no data is found
  }
?>






<?php
  // Create the select query
  $query = "SELECT COUNT(*) as cubes from deployments";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cubes = $row['cubes'];
  } else {
    $cubes = 0; // Default value if no data is found
  }
?>


<?php
  // Create the select query
  $query = "SELECT COUNT(*) as cubes from deployments where reachable = 'yes'";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cubes_reachable = $row['cubes'];
  } else {
    $cubes_reachable = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT COUNT(*) as cubes FROM `deployments`  WHERE fetched = 'yes'";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cubes_fetched = $row['cubes'];
  } else {
    $cubes_fetched = 0; // Default value if no data is found
  }
?>



<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from ap";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_ap = $row['percentage'];
  } else {
    $percentage_ap = 0; // Default value if no data is found
  }
?>


<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from dacl";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_dacl = $row['percentage'];
  } else {
    $percentage_dacl = 0; // Default value if no data is found
  }
?>
<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from authz";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_authz = $row['percentage'];
  } else {
    $percentage_authz = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from sgt";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_sgt = $row['percentage'];
  } else {
    $percentage_sgt = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from nad";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_nad = $row['percentage'];
  } else {
    $percentage_nad = 0; // Default value if no data is found
  }
?>
<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from policyset";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_policyset = $row['percentage'];
  } else {
    $percentage_policyset = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from authentication";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_authentication = $row['percentage'];
  } else {
    $percentage_authentication = 0; // Default value if no data is found
  }
?>

<?php
  // Create the select query
  $query = "SELECT COUNT(*) as percentage from authorization";
  // Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $percentage_authorization = $row['percentage'];
  } else {
    $percentage_authorization = 0; // Default value if no data is found
  }
?>

<?php
$percentage_total = $percentage_ap + $percentage_dacl + $percentage_authz + $percentage_sgt + $percentage_nad + $percentage_policyset + $percentage_authentication + $percentage_authorization;

?>

<?php


$ap_value = round(($percentage_ap / $percentage_total) * 100);
$dacl_value = round(($percentage_dacl / $percentage_total) * 100);
$authz_value = round(($percentage_authz / $percentage_total) * 100);
$sgt_value = round(($percentage_sgt / $percentage_total) * 100);
$nad_value = round(($percentage_nad / $percentage_total) * 100);
$policyset_value = round(($percentage_policyset / $percentage_total) * 100);
$authentication_value = round(($percentage_authentication / $percentage_total) * 100);
$authorization_value = round(($percentage_authorization / $percentage_total) * 100);
$cube_value= round(($cubes_fetched / $cubes) * 100);
$cubes_reachable_value = round(($cubes_reachable / $cubes) * 100);
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

    <title>MISE &middot; Dashboard</title>

    <link rel="stylesheet" href="css/cui-standard.min.css">

    <script src="https://code.jquery.com/jquery-3.0.0.min.js"
        integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
    <script src="public/js/styleguide.js"></script>
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
                    
                    <a href="dashboard.php" class="header-item" title="MISE Home" ><span class="icon-home" ></span></a>
                    <a  class="header-item" title="MISE Home" ><span></span></a>
                    <?php echo $username; ?> (<?php echo $role; ?>)
                    
                    <div id="themeSwitcher" class="dropdown dropdown--left dropdown--offset-qtr header-item">
                        
                        <a class="header-toolbar__link">Theme</a>
                        <div class="dropdown__menu">
                            <a id="theme-default" class="selected">Default</a>
                            <a id="theme-dark">Dark</a>
                        </div>
                    </div>
                    <a href="logout.php" class="header-item" title="Logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="content content--alt">
        <div class="container-fluid">
            <div class="row">

                <!-- Sidebar -->
                <nav class="col-lg-3 col-xl-2 sidebar hidden-md-down dbl-margin-top" role="navigation">
                    <div class="base-margin">

                        <div class="text-bold"></div>
                        <div></div>

                    </div>
                    
                    <ul id="rootSidebar">
                        <li class="sidebar__item selected">
                            <a tabindex="0" title="Dashboard" href="dashboard.php">
                                <span class="icon-home"></span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Administration">
                                <span class="icon-admin"></span>
                                <span>Administration</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="webex-integration.php">WEBEX Integration</a></li>
                                <li class="sidebar__item"><a href="TBD">Email configurations</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Users">
                                <span class="icon-user"></span>
                                <span>Users</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="add_user.php">Add User</a></li>
                                <li class="sidebar__item"><a href="user.php">Existing Users</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="ISE Cubes">
                                <span class="icon-configurations"></span>
                                <span>ISE Cubes</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="provision.php">Add New</a></li>
                                <li class="sidebar__item"><a href="deployments.php">View Existing</a></li>
                                <li class="sidebar__item"><a href="nodes.php">Nodes Info</a></li>
                                <li class="sidebar__item"><a href="credentials.php">Credential Manager</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Policy Elements">
                                <span class="icon-features"></span>
                                <span>Policy Elements</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="ap.php">Allowed Protocols</a></li>
                                <li class="sidebar__item"><a href="authz.php">Authorization Profiles</a></li>
                                <li class="sidebar__item"><a href="dacl.php">Downloadable ACL</a></li>
                                <li class="sidebar__item"><a href="nad.php">NAD Groups</a></li>
                                <li class="sidebar__item"><a href="sgt.php">Security Group TAG (SGT)</a></li>
                                <li class="sidebar__item"><a href="condition.php">Conditions</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Policies">
                                <span class="icon-contact-card"></span>
                                <span>Policies</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="policyset.php">Policy Sets</a></li>
                                <li class="sidebar__item"><a href="authentication.php">Authentication Rules</a></li>
                                <li class="sidebar__item"><a href="authorization.php">Authorization Rules</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Deployments">
                                <span class="icon-sign-in"></span>
                                <span>Deployments</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="checkout.php">Queued</a></li>
                                <li class="sidebar__item"><a href="checkout.php">Deploy</a></li>
                                <li class="sidebar__item"><a href="deploy-history.php">Deployment History</a></li>
                                <li class="sidebar__item"><a href="deployed_elements.php">Deployed Elements</a></li>
                                <li class="sidebar__item"><a href="coa_history.php">CoA History</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Endpoint Management">
                                <span class="icon-pc"></span>
                                <span>Endpoint Management</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="TBD.php">TBD</a></li>
                                <li class="sidebar__item"><a href="send_coa.php">CoA</a></li>
                            </ul>
                        </li>

                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Guest Management">
                                <span class="icon-too-slow"></span>
                                <span>Guest Management</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="TBD.php">TBD</a></li>
                                <li class="sidebar__item"><a href="TBD.php">TBD</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Scheduler">
                                <span class="icon-calendar"></span>
                                <span>Scheduler</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="new_schedule.php">Create Populate Scheduler</a></li>
                                <li class="sidebar__item"><a href="schedule.php">View Populate Scheduler</a></li>
                                <li class="sidebar__item"><a href="new_deploy_schedule.php">Create Deploy Scheduler</a></li>
                                <li class="sidebar__item"><a href="deploy_schedule.php">View Deploy Scheduler</a></li>
                                <li class="sidebar__item"><a href="create_backup_schedule.php">Create Backup Schedule</a></li>
                                <li class="sidebar__item"><a href="backup-schedule.php">View Backup Schedule</a></li>
                            </ul>
                        </li>

                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Repository">
                                <span class="icon-folder"></span>
                                <span>Repository</span>
                            </a>
                            <ul>
                               <li class="sidebar__item"><a href="repo-view.php">Manage</a></li>

                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Certificate Management">
                                <span class="icon-lock"></span>
                                <span>Certificate Management</span>
                            </a>
                            <ul>
                               <li class="sidebar__item"><a href="csr.php">Manage</a></li>
                            </ul>
                        </li>




                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Logging">
                                <span class="icon-analysis"></span>
                                <span>Loggings</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="ap-log.php">Allow Protocols</a></li>
                                <li class="sidebar__item"><a href="dacl-log.php">DACL</a></li>
                                <li class="sidebar__item"><a href="authz-log.php">Authorization</a></li>
                                <li class="sidebar__item"><a href="sgt-log.php">SGT</a></li>
                                <li class="sidebar__item"><a href="nad-log.php">NAD</a></li>
                                <li class="sidebar__item"><a href="policyset-log.php">Policy</a></li>
                                <li class="sidebar__item"><a href="apache2.php">Apache Error</a></li>
                                <li class="sidebar__item"><a href="apache.php">Apache Access</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Troubleshoot">
                                <span class="icon-tools"></span>
                                <span>Troubleshoot</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="ping.php">Ping Test</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__item selected">
                            <a tabindex="0" title="Instructions" href="instructions.php">
                                <span class="icon-clipboard"></span>
                                <span>Instructions</span>
                            </a>
                        </li>
                        <li class="sidebar__item selected">
                            <a tabindex="0" title="contact us" href="contact.php">
                                <span class="icon-add-contact"></span>
                                <span>Contact Us</span>
                            </a>
                        </li>
                        <li class="sidebar__item selected">
                            <a tabindex="0" title="make a wish" href="https://forms.office.com/r/ryRrW7BvQJ" target="_blank">
                                <span class="icon-draw"></span>
                                <span>Make a wish</span>
                            </a>
                        </li>


                    </ul>
                </nav>

                <div class="col-12 col-lg-9 col-xl-10">
                    <div class="section">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="panel panel--loose panel--raised base-margin-bottom">
                                    <h2 class="subtitle">ISE CUBES</h2>

                                    <hr>
                                    <div class="section">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="gauge-container">
                                                    <div class="gauge gauge--primary gauge--large" data-percentage="<?php echo $cube_value; ?>">
                                                        <div class="gauge__circle">
                                                            <div class="mask full">
                                                                <div class="fill"></div>
                                                            </div>
                                                            <div class="mask half">
                                                                <div class="fill"></div>
                                                                <div class="fill fix"></div>
                                                            </div>
                                                        </div>
                                                        <div class="gauge__inset">
                                                            <div class="gauge__percentage"><?php echo $cubes; ?><sup
                                                                    class="text-size-30"></sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="gauge__label">ISE Deployments Registered</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="gauge-container">
                                                    <div class="gauge gauge--primary gauge--large" data-percentage="<?php echo $cubes_reachable_value; ?>">
                                                        <div class="gauge__circle">
                                                            <div class="mask full">
                                                                <div class="fill"></div>
                                                            </div>
                                                            <div class="mask half">
                                                                <div class="fill"></div>
                                                                <div class="fill fix"></div>
                                                            </div>
                                                        </div>
                                                        <div class="gauge__inset">
                                                            <div class="gauge__percentage"><?php echo $cubes_reachable_value; ?><sup
                                                                    class="text-size-20">%</sup></div>
                                                        </div>
                                                    </div>
                                                    <div class="gauge__label">Reachable ISE Deployments</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="base-margin-bottom">
                                                    <div class="subheader no-margin">Total Number of Elements Pulled</div>
                                                    <div class="display-3"><?php echo $percentage_total; ?></div>
                                                </div>
                                                <div class="progressbar progressbar--warning dbl-padding-bottom"
                                                    data-percentage="48">
                                                    <div class="progressbar__fill"></div>
                                                    <div class="progressbar__label">
                                                        <b>50%</b>
                                                        <span class="text-right">Deployed Elements*</span>
                                                    </div>
                                                </div>
                                                <div class="progressbar progressbar--warning" data-percentage="23">
                                                    <div class="progressbar__fill"></div>
                                                    <div class="progressbar__label">
                                                        <b>100</b>
                                                        <span class="text-right">Guest Accounts Imported*</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="panel panel--loose panel--raised">
                                    <h2 class="subtitle">Policy Element Count</h2>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="half-margin-top">
                                                    <div class="text-size-16">Allowed Protocols</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $ap_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of Allowed Protocols: <?php echo $percentage_ap; ?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="half-margin-top">
                                                    <div class="text-size-16">Downloadbale ACLs</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $dacl_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of Downloadbale ACLs: <?php echo $percentage_dacl; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="half-margin-top">
                                                    <div class="text-size-16">Authorization Profiles</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $authz_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of Downloadbale ACLs: <?php echo $percentage_authz; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="half-margin-top">
                                                    <div class="text-size-16">SGT</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $sgt_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of Secure Group Tag (SGT): <?php echo $percentage_sgt; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="flex-fluid half-margin-top">
                                                    <div class="text-size-16">NAD Groups</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $nad_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of NAD Groups: <?php echo $percentage_nad; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="half-margin-top">
                                                    <div class="text-size-16">Policy Sets</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $policyset_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of Policy Sets: <?php echo $percentage_policyset; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="half-margin-top">
                                                    <div class="text-size-16">Authentication Rules</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $authentication_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of Authentication Policies: <?php echo $percentage_authentication; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel--bordered hover-emboss--large base-margin-bottom">
                                                <div class="half-margin-top">
                                                    <div class="text-size-16">Authorization Rules</div>
                                                    <div class="progressbar progressbar--success" data-percentage="<?php echo $authorization_value; ?>">
                                                        <div class="progressbar__fill"></div>
                                                        <div class="progressbar__label">
                                                            <span class="text-right">Total Number of Authorization Policies: <?php echo $percentage_authorization; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="panel panel--loose panel--raised base-margin-bottom ">
                                    <h2 class="subtitle">Deployment History</h2>
                                    <hr>
                                    <div class="timeline">
                                        <div class="timeline__item">
                                            <div class="timeline__icon">
                                            </div>
                                            <div class="timeline__content">
                                                <div class="flex-center-vertical">
                                                    <div class="text-bold flex-fluid"><?php echo $name1; ?></div>
                                                </div>
                                                <div>Comments Added: <?php echo $comments1; ?><br>
                                                    Deployment Time: <?php echo $time1; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline__item">
                                            <div class="timeline__icon">
                                            </div>
                                            <div class="timeline__content">
                                                <div class="flex-center-vertical">
                                                    <div class="text-bold flex-fluid"><?php echo $name2; ?></div>
                                                </div>
                                                <div>Comments Added: <?php echo $comments2; ?> <br> Deployment Time: <?php echo $time2; ?></div>
                                            </div>
                                        </div>
                                        <div class="timeline__item">
                                            <div class="timeline__icon">
                                            </div>
                                            <div class="timeline__content">
                                                <div class="flex-center-vertical">
                                                    <div class="text-bold flex-fluid"><?php echo $name3; ?></div>
                                                </div>
                                                <div>Comments Added: <?php echo $comments3; ?> <br> Deployment Time: <?php echo $time3; ?></div>
                                            </div>
                                        </div>

                                        

                                        <div class="timeline__item">
                                            <div class="timeline__icon">
                                            </div>
                                            <div class="timeline__content">
                                                <div class="flex-center-vertical">
                                                    <div class="text-bold flex-fluid"><?php echo $name4; ?></div>
                                                </div>
                                                <div>Comments Added: <?php echo $comments4; ?><br>Deployment Time: <?php echo $time4; ?></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel panel--loose panel--raised">
                                    <h2 class="subtitle">Scheduler In progress</h2>
                                    <hr>
                                    <div class="timeline">
                                        <div class="timeline__item">
                                            <div class="timeline__icon">
                                            </div>
                                            <div class="timeline__content">
                                                <div class="flex-center-vertical">
                                                    <div class="text-bold flex-fluid">Scheduler Name: <?php echo $name_scheduler; ?></div>
                                                </div>
                                                <div>ISE Cube: <?php echo $fqdn_scheduler; ?> <>
                                                    Action in progress: <?php echo $action_scheduler; ?> <br> Running Every: <?php echo $every_scheduler; ?> Hour(s)
                                                </div>
                                            </div>
                                        </div>
                                        
                                        

                                        

                                        
                                    </div>

                                </div>
                                
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="footer__links">
                    <ul class="list list--inline">
                        <li><a href="http://www.cisco.com/cisco/web/siteassets/contacts/index.html"
                                target="_blank">Contacts</a></li>
                        <li><a href="https://secure.opinionlab.com/ccc01/o.asp?id=jBjOhqOJ" target="_blank">Feedback</a>
                        </li>
                        <li><a href="https://www.cisco.com/c/en/us/about/help.html" target="_blank">Help</a></li>
                        <li><a href="http://www.cisco.com/c/en/us/about/sitemap.html" target="_blank">Site Map</a></li>
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
