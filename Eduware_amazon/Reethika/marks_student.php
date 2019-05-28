<?php 
/**
 * @author   IMobiGeeks
 * @desc uploading the excel file in 'repository/ACR/Events/' path
 */


include 'includes/common.php';
include_once $config['SiteClassPath']."class.Marks.php";
global $config;
		$exam_id=$_REQUEST["exam_id"];
		$student_id=$_REQUEST["student_id"];
		$objMarks=new Marks();
        $result=$objMarks->getMarksList($exam_id, $student_id);
        //var_dump($student_id);
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
        echo json_encode($result); 


?>