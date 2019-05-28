<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
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
    #error_Msg {
    color: #ff0000;
    }
</style>
<script>
function onSubmitLogin(){
		var userName=document.getElementById("unm").value;
		var password = document.getElementById("pwd").value;
		var bool=true;
		if(userName==""){
				document.getElementById("unm").style.border="1px #ff0000 solid";
				bool=false;
		}
		if(password==""){
			document.getElementById("pwd").style.border="1px #ff0000 solid";
			bool=false;
		}
		if(!bool){
			document.getElementById("error_Msg").innerHTML="Please enter username and password to login";
			return false;
		}
		return true;
}
</script>

<?php
        include './Database/Controler.php';
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

    <div style="background-color: white; height:35%; width:20%; margin-top:0%; margin-right:-10;  align:left; 
         padding: 1%">  
       <form method="post" role="form" action="admin_login_model.php"   enctype="multipart/form-data" onsubmit="return onSubmitLogin();">
       <br> 
       <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
       <input type="text"  id="unm" name="unm"  placeholder="Enter Username" class="form-control" required autofocus><br>
       </div><br>
       <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
       <input type="password"  id="pwd" name="pwd" placeholder="Enter password" class="form-control" required><br>
       </div><br> 
       
       <!--<input type="radio" name="usertype" value="admin" class="form-check-input" checked="checked">Admin &nbsp;<br><br>-->
       <button type="submit" id="login" name="login" value="submit" class="btn btn-primary" style="width:50%">LogIn
       </button>
       </div>
    </div>  
    </form>
    <p class="clear-fix"></p>
       <span id="error_Msg">Please enter valid username and password</span>
       </div>
<!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    
    
</body>
</html>