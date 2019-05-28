<?php
/**

 * @author IMobiGeeks

 * @desc This file is used to configure global variables and database details

 *

 */

/**
 *  Global Varaible Settings  
 */
$config['SiteClassPath']=$_SERVER['DOCUMENT_ROOT']."/eduware_main/includes/classes/";

/**
 *  Database Local Settings 
 */
$config['DBHostName']="localhost";
$config['DBUserName']="root";
$config['DBPassword']="root";
$config['DatabaseName']="sams";
$config['repository_url']="repository/Eduware/";


/**
 * Table names
 */
$config['faculty_table']="faculty";
$config['marks_table']="marks";
$config['exams_table']="exams_master";
$config['student_table']='student';
$config['classes_table']="classes_master";
$config['excel_files_urls_table']='excel_files_urls';
?>
