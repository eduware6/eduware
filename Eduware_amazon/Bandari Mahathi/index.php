<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
    <style>
    body
    {
            background-image:url("img/image5.jpg");
    } 
</style>
<?php 
session_start();
/**
 * @author   IMobiGeeks
 * @category View
 * @desc View for displaying the Login page using which user can login by providing credentials
 */

   include 'includes/common.php';
   //echo phpinfo();

?>
</head>
<body>
    <b><center>
    <font phase="Times New Roman"color="white" size="20%">
    Eduware</b><br>
    </font>
    <center><br>
	<!-- <br>
        <img src="img/ks_logo.jpg"  width="10%" height="15%"><br><br>
	<br> -->
	
    <font phase="Times New Roman"color="white" size="5%">
    <div style="background-color: lightseagreen; height:8%; width:20%; margin-top:0%; margin-right:-10; align:left;padding: 1%;">  
    <b>Sign in</b>
	
    </font><br>  </center>

    <div style="background-color: white; height:40%; width:20%; margin-top:0%; margin-right:-10;  align:left; 
         padding: 1%">  
       <form method="post" action="login_model.php" role="form"  enctype="multipart/form-data" onsubmit="return onSubmitLogin();">
        
       <br>
       <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span> 
        <input type="text"  id="unm" name="unm" placeholder="Enter Username" class="form-control" required autofocus>
       </div><br>
       <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
       <input type="password"  id="pwd" name="pwd" placeholder="Enter password" class="form-control" required><br>
       </div><br><br>
       <input type="radio" name="usertype" value="student" class="form-check-input" >Student &nbsp;&nbsp;
        <input type="radio" name="usertype" value="parent" class="form-check-input" >Parent  &nbsp;&nbsp;
        <input type="radio" name="usertype" value="staff"  class="form-check-input" >Teacher<br><br>
       <button type="submit" id="login" name="login" value="submit" class="btn btn-primary" style="width:50%">LogIn</button>
       <span id="error_Msg"><?php if(isset($errorMsg)) echo  $errorMsg; ?></span>
       </div>
    </div>  
    </form>
<!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    
    
</body>
</html>