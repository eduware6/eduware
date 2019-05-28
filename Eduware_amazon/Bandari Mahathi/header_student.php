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
      <button id="logout" name="logout" class="btn btn-danger square-btn-adjust">Logout</button>
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
					<li>
                        <a href="#"class='trigger'><i class="fa fa-file fa-2x"></i>Attendance<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse   closer9">
                            <li>
                                <a href="attendance_today.php">Today Attendance</a>
                            </li>
                            <li>
                                <a href="view_attendance.php">Two Weeks Attendance</a>
                            </li>
                            <li>
                                <a href="view_attendance_chart.php">Overall Attendance</a>
                            </li>
                        </ul>
                    </li>

                     <li>
                        <a  href="view_performance.php"><i class="fa fa-folder fa-2x"></i> Performance</a>
                    </li>
                    <li>
                        <a  href="downloads.php"><i class="fa fa-book fa-2x"></i> Study Material</a>
                    </li>
                    <li>
                        <a  href="#"class='trigger'><i class="fa fa-bell-o fa-2x"></i> Notifications<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse   closer9">
                            <li>
                                <a href="view_class_notification_student_parent.php">Class</a>
                            </li>
                            <li>
                                <a href="view_notifications_student.php">School</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a  href="student_profile.php"><i class="fa fa-user fa-2x"></i> Profile</a>
                    </li>
                    <li>
                        <a  href="contact_us.php"><i class="fa fa-external-link fa-2x"></i>Contact Us</a>
                    </li>
                   
                </ul>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     