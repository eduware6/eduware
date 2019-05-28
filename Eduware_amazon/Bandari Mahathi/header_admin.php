<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eduware</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><img src="img/logo.jpg"  width="20%" height="100%" style="border-radius:10%">&nbsp;Eduware</a> 
            </div>
 <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><!-- Last access : 30 May 2014 &nbsp; -->
     
      <form method="post"> 
<!--       <button id="site_map" name="site_map" class="btn btn-danger square-btn-adjust">Site Map</button>
 -->      <button id="logoutAdmin" name="logoutAdmin" class="btn btn-danger square-btn-adjust">Logout</button>
      </form>
 </div>
        </nav>   
           <!-- /. NAV TOP  -->
         <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="dashboard.php"><i class="fa fa-home fa-2x"></i>Home Page</a>
                    </li>
	

                    <li><a href="#"class='trigger'><i class="fa fa-envelope fa-2x"></i>Send Notifications<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse   closer9 ">
                                    <li>
                                        <a href="add_notification.php">Add Notification</a>
                                    </li>
                                    
                                    <li>
                                        <a href="view_notifications.php">Sent Notifications</a>
                                    </li>
                                    
                                </ul>
                    </li>
                    <li>
                        <a  href="#"class='trigger'><i class="fa fa-pencil-square-o fa-2x"></i>Received Queries<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level  collapse   closer9 ">
                                    <li>
                                        <a href="view_query_admin.php">Respond</a>
                                    </li>
                                    
                                    <li>
                                        <a href="view_responded_admin.php">Responded</a>
                                    </li>
                                </ul>
                    </li>
                    <li>
                        <a  href="contact_us.php"><i class="fa fa-external-link fa-2x"></i>Contact Us</a>
                    </li>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    
        