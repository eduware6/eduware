<?php 
/**
 * @author   IMobiGeeks
 * @desc parsing the uploaded excel file and stores the details in database by calling addCongressionalDetails() function
 */

include 'includes/common.php';
include_once $config['SiteClassPath']."class.Marks.php";

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Excel_Parsing/');   // ../../../Classes/
date_default_timezone_set('America/New_York');
/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$eventobj=new Marks();
if($_REQUEST["type"]){
    $filename=$eventobj->getFileName($_REQUEST["type"]);

}
$exam_id=$_REQUEST["exam_id"];
$class_id=$_REQUEST["class_id"];
$error="";

$inputFileName = './'.$filename[0]['filename'];

$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


$firstrow=current($sheetData);
$subjects=array_values($firstrow);
//var_dump($subjects[0]);exit;
$count=2;
//var_dump((strcasecmp(trim($firstrow['A']), 'STUDENT_RNO') == 0));exit;
if((strcasecmp(trim($firstrow['A']), 'STUDENT_RNO') == 0) )
{
	
	array_shift($sheetData);
	foreach ($sheetData as $sheet)
	{
		$row=$count++;
		
		if(trim($sheet['A'])=="")
		{
			$error.="'STUDENT_RNO' is empty in ".$row." row<br/>";
		}
		
	}

	
	if($error=="")
	{
		foreach ($sheetData as $sheet)
		{
			$cnt=count($sheet);
			$event=array_slice($sheet, 0,1);
			$student_id=$sheet['A'];
			$attendees=array_slice($sheet,1,$cnt-1);
			$tot_attendees=$eventobj->removeKeys($attendees);
			//var_dump($tot_attendees);exit;
			$today = strtotime($todays_date);
			$attendeecnt=count($tot_attendees);
			$isstudent_id=$eventobj->isStudentExistByID($student_id);
                for($i=0;$i<$attendeecnt;$i+=1)
                {
                    if($tot_attendees[$i]!=""  && $isstudent_id)
                    {
					    $mapping_res=$eventobj->addMarks($exam_id,$class_id,$class_id,$student_id,$subjects[$i+1],$tot_attendees[$i]);
                    } else { 
                        continue;
                    }
                }
		}
	}
	else
	{
		$insert=$eventobj->insertFile($_SESSION['prevfile'], 'events_excel_upload');
		if($insert)
		{
			$_SESSION['prevfile']="";
		}
		$_SESSION ['excel_error']=$error;
	}
}
else
{
	$insert=$eventobj->insertFile($_SESSION['prevfile'], 'events_excel_upload');
	if($insert)
	{
		$_SESSION['prevfile']="";
	}
	$_SESSION ['excel_error'] = $config['excelfile_error'];
} 

header("Location:marks_list.php");

?>