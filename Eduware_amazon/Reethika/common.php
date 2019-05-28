<?php
ob_start();

@session_start();
ini_set("error_reporting",E_ALL);
error_reporting(0);
//echo(phpinfo());
if(!defined("_MAINSITEPATH_"))
    define("_MAINSITEPATH_",$_SERVER['DOCUMENT_ROOT']."/eduware_main/includes/");

global $config;

include_once _MAINSITEPATH_."config.php";
include_once $config['SiteClassPath']."class.SqlFunctions.php";
?>
