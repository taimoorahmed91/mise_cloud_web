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

// Query for DACLs
$query_dacl = "SELECT * FROM dacl WHERE queue = 'yes'";
$result_dacl = $mysqli->query($query_dacl) or die($mysqli->error.__LINE__);

// Query for Authorization profiles
$query_authz = "SELECT * FROM authz WHERE queue = 'yes'";
$result_authz = $mysqli->query($query_authz) or die($mysqli->error.__LINE__);

// Query for Allowed Protocols
$query_ap = "SELECT * FROM ap WHERE queue = 'yes'";
$result_ap = $mysqli->query($query_ap) or die($mysqli->error.__LINE__);

// Query for SGTs
$query_sgt = "SELECT * FROM sgt WHERE queue = 'yes'";
$result_sgt = $mysqli->query($query_sgt) or die($mysqli->error.__LINE__);

// Query for NADs
$query_nad = "SELECT * FROM nad WHERE queue = 'yes'";
$result_nad = $mysqli->query($query_nad) or die($mysqli->error.__LINE__);


// Query for Cond
$query_cond = "SELECT * FROM cond WHERE queue = 'yes'";
$result_cond = $mysqli->query($query_cond) or die($mysqli->error.__LINE__);


// Query for policysets
$query_policyset = "SELECT * FROM policyset WHERE queue = 'yes'";
$result_policyset = $mysqli->query($query_policyset) or die($mysqli->error.__LINE__);

// Query for authentications
$query_authentication = "SELECT * FROM authentication WHERE queue = 'yes'";
$result_authentication = $mysqli->query($query_authentication) or die($mysqli->error.__LINE__);

$query_authorization = "SELECT * FROM authorization WHERE queue = 'yes'";
$result_authorization = $mysqli->query($query_authorization) or die($mysqli->error.__LINE__);
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

    <title>MISE &middot; Deploy </title>

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
                <nav class="col-lg-3 col-xl-2 sidebar hidden-md-down dbl-margin-top" role="navigation" style="max-width: 12%;">

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
                                <span class="icon-profile-settings"></span>
                                <span>Administration</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="webex-integration.php">WEBEX Integration</a></li>
                                <li class="sidebar__item"><a href="TBD">Email configurations</a></li>
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
                                <li class="sidebar__item"><a href="dacl.php">Downloadbale ACL</a></li>
                                <li class="sidebar__item"><a href="nad.php">NAD Groups</a></li>
                                <li class="sidebar__item"><a href="sgt.php">Security Group TAG (SGT)</a></li>
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
                                <li class="sidebar__item"><a href="checkout.php">Deploy</a></li>
                                <li class="sidebar__item"><a href="deploy-history.php">Deployment History</a></li>
                            </ul>
                        </li>
                        <li class="sidebar__drawer">
                            <a tabindex="0" title="Endpoint Management">
                                <span class="icon-pc"></span>
                                <span>Endpoint Management</span>
                            </a>
                            <ul>
                                <li class="sidebar__item"><a href="TBD.php">TBD</a></li>
                                <li class="sidebar__item"><a href="TBD.php">TBD</a></li>
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
                            <a tabindex="0" title="Troubleshoot and Logging">
                                <span class="icon-analysis"></span>
                                <span>TShoot and Logs</span>
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


                    </ul>
                </nav>
             </div>
             <hr>
            <div class="section">
            <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> Allowed Protocols</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_ap->num_rows > 0) {
                            //Loop through results
                            while($row = $result_ap->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['ap'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> Authorization Profiles</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_authz->num_rows > 0) {
                            //Loop through results
                            while($row = $result_authz->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['authz'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>
                <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> Downloadbale ACLs</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_dacl->num_rows > 0) {
                            //Loop through results
                            while($row = $result_dacl->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['dacl'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>
                    <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> NAD Groups</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_nad->num_rows > 0) {
                            //Loop through results
                            while($row = $result_nad->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['nad'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>
                    <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> Secure Group TAG (SGT)</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_sgt->num_rows > 0) {
                            //Loop through results
                            while($row = $result_sgt->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['sgt'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>
                    <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> Policy Sets</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_policyset->num_rows > 0) {
                            //Loop through results
                            while($row = $result_policyset->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['policyset'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>
                    <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2>Authentication Rules</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_authentication->num_rows > 0) {
                            //Loop through results
                            while($row = $result_authentication->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['authentication'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>
                    <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> Authorization Rules</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_authorization->num_rows > 0) {
                            //Loop through results
                            while($row = $result_authorization->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['authorization'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>


                    <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <table class="table table--lined table--selectable">
                    <h2> Library Condition</h2>
                        <thead>
                            <tr>
                                    <th class="hidden-md-down">ID </span></th>
                                    <th class="hidden-md-down">Name</th>
                                    <th class="hidden-md-down">Source ISE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result_cond->num_rows > 0) {
                            //Loop through results
                            while($row = $result_cond->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['cond'].'</td>';
                              $output .='<td>'.$row['isename'].'</td>';

                              
                              //Echo output
                              echo $output;
                            }
                          } else {
                            echo "Sorry, no entries were found";
                          }
                          ?>
                            </tbody>
                        </table>
                    </div>
                    <div  class="panel panel--loose panel--raised base-margin-bottom" style="padding-left: 235px;"> 
                    <a href="deployment_phase3.php" class="btn btn--success" style="color:white">Next</a>
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
