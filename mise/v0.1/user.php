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

if ($role !== "Admin") {
    header("Location: 401.php");
    exit(); // Make sure to exit the script after the redirect
}
?>

<?php
  //Create the select query
  $query ="SELECT * from users ORDER BY id";
  //Get results
  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
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

    <title>MISE &middot; Existing Users</title>

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
                <nav class="col-lg-3 col-xl-2 sidebar hidden-md-down dbl-margin-top" role="navigation"
                    style="max-width: 12%;">
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
                        <h2> Users Info</h2>
                        <thead>
                            <tr>
 
                                <th class="hidden-lg-down">ID</th>
                                <th class="hidden-lg-down">First Name</th>
                                <th class="hidden-lg-down">Last Name</th>
                                <th class="hidden-lg-down">Username</th>
                                <th class="hidden-lg-down">Role</th>
                                <th class="hidden-lg-down" ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            //Check if at least one row is found
                            if($result->num_rows > 0) {
                            //Loop through results
                            while($row = $result->fetch_assoc()){
                              //Display customer info
                              $output ='<tr>';
                              $output .='<td>'.$row['id'].'</td>';
                              $output .='<td>'.$row['first_name'].'</td>';
                              $output .='<td>'.$row['last_name'].'</td>';
                              $output .='<td>'.$row['username'].'</td>';
                              $output .='<td>'.$row['role'].'</td>';
                              $output .='<td><a href="delete_user.php?id='.$row['id'].'" class="btn btn--danger focus" >Delete</a></td>';

                              $output .='</tr>';
                              
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
                <footer class="footer">
                    <div class="footer__links">
                        <ul class="list list--inline">
                            <li><a href="http://www.cisco.com/cisco/web/siteassets/contacts/index.html"
                                    target="_blank">Contacts</a></li>
                            <li><a href="https://secure.opinionlab.com/ccc01/o.asp?id=jBjOhqOJ"
                                    target="_blank">Feedback</a>
                            </li>
                            <li><a href="https://www.cisco.com/c/en/us/about/help.html" target="_blank">Help</a></li>
                            <li><a href="http://www.cisco.com/c/en/us/about/sitemap.html" target="_blank">Site Map</a>
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
