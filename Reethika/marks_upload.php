<?php 
/**
 * @author   IMobiGeeks
 * @desc uploading the excel file in 'repository/ACR/Events/' path
 */


include 'includes/common.php';
include_once $config['SiteClassPath']."class.ResourceUpload.php";
include_once $config['SiteClassPath']."class.Marks.php";
global $config;
if($_FILES)
{
		$examtype=$_REQUEST["exam"];
		$classtype=$_REQUEST["class_id"];
		$sectiontype=$_REQUEST["section"];
		$file_type=strtolower(str_replace('-', '', $examtype."_".$classtype."_".$sectiontype));
		//var_dump($file_type);exit;
		$objResource=new ResourceUpload();
		$fileurl=$objResource->uploadFile($_FILES, 'excel1',"student_marks");
		$objMarks=new Marks();
		$res=$objMarks->insertFile($fileurl,$file_type);
		if($res)
		{
			$prevfile=explode("$#%", $res);
			$_SESSION['prevfile']=$prevfile[1];
			
			header("Location:marks_parse.php?type=".$file_type."&exam_id=".$examtype."&class_id=".$sectiontype);
		} 	
}

?>