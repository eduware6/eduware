<?php
if($_SESSION['role']=="admin")
{
	include_once 'header_admin.php';
}
else if ( $_SESSION['role']=="staff")
{
	include_once 'header_fac.php';
}
else if ($_SESSION['role']=="student")
{
	include_once 'header_student.php';
}
else if($_SESSION['role']=="parent")
{
	include_once 'header_parent.php';
}
else
{
	header("location:./index.php");
}
?>