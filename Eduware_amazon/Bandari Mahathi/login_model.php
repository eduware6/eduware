<?php 
/**
 * @author   IMobiGeeks
 * @category model
 * @desc get the values from login form
 *       check for authentication
 *       if user authenticated, store organization_id and name into session and navigate to home.php
 *       and if user authentication fails, navigate to login_error.php
 */

include 'includes/common.php';
include_once $config ['SiteClassPath'] . "class.Authentication.php";

if ($_POST) {
	$user_name = $_POST ["unm"];
	$user_password = $_POST ["pwd"];
	$usertype = $_POST ["usertype"];
	if ($user_name != null && $user_password != null) {
		$objAuthentication = new Authentication();
		
		if($usertype == "student"  || $usertype == "parent"){
			$res = $objAuthentication->userAuthenticate ( $user_name, $user_password,$usertype );
			if ($res) {
				$_SESSION["ufac_id"] = $res [0] ['s_enrl'];
				$_SESSION["s_rn"] = $res [0] ['s_rn'];
				$_SESSION["s_enrl"] = $res [0] ['s_enrl'];
				$_SESSION["fac_name"] = $res [0] ['fnm'];
				$_SESSION["role"] = $usertype;
				header ( "location:dashboard.php" );
			} else {
				header ( "location:login_error.php" );
			}
		}else if($usertype == "staff"){
			$res = $objAuthentication->userAuthenticate ( $user_name, $user_password,$usertype );
			if ($res) {
				$_SESSION["ufac_id"] = $res [0] ['ufac_id'];
				$_SESSION["fac_name"] = $res [0] ['fac_name'];
				$_SESSION["role"] = $usertype;
				header ( "location:dashboard.php" );
			} else {
				header ( "location:login_error.php" );
			}
		}else{
			header ( "location:login_error.php" );
		}
		
	
	}
}
?>