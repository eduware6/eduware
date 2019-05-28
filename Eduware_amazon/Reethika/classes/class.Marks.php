<?php

/**
 * @author   IMobiGeeks
 * @category Controller
 * @desc Class is used to manage HilldayIndividualSchedules like insert, update, delete and retrieving Events
 */
include_once 'class.Util.php';
class Marks extends MySqlFunctions {
	
	/**
	 * Constructor
	 *
	 * it will call Parent class constructor i.e MySqlFunctions Class Constructor  and establish the database connection
	 */
	function __construct() {
		date_default_timezone_set('America/New_York');
		global $config;
		$this->markstable=$config['marks_table'];
		$this->examstable=$config['exams_table'];
		$this->studenttable=$config['student_table'];
		$this->classestable=$config['classes_table'];
		$this->exceltable=$config['excel_files_urls_table'];
		parent::__construct();
	}


	function getExamsList()
	{
		$selectRows=$this->fetch($this->examstable);
		if($selectRows){
			return $selectRows;
		}
		else{
			return false;
		}
	}

	function getClassesList()
	{
		$query="select DISTINCT (class_name)from ".$this->classestable;
		$selectRows=$this->ExecuteQuery($query,"select");
		if($selectRows){
			return $selectRows;
		}
		else{
			return false;
		}
	}

	function getSectionsByClassName($classname)
	{
		$condition="class_name='".$classname."'";
		$selectRows=$this->fetch($this->classestable,null,$condition);
		if($selectRows){
			return $selectRows;
		}
		else{
			return false;
		}
	}
	
	/**
	 * Function - insertFile
	 *
	 * This function is used for store filename, type in database. if type doesn't exists,data will be insert and
	 * if type exist, data will be updated
	 *
	 * @param $filename - to contains filename
	 * @param $type - to contains type for file
	 * @return it will return, primary key field value of inserted row on successful insertion, or
	 *           number of effected rows on successful updation
	 */
	function insertFile($filename,$type)
	{
		$isexist = $this->alreadyexist($type);
		if(!$isexist){
			$fields=array('filename','type');
			$values=array('"'.trim ( $filename ).'"','"'. $type .'"');
			
			$instrow=$this->insert($this->exceltable, $fields, $values);
			return $instrow;
		}
		else
		{
			$condition="type='" .$type."'";
			$selectRows=$this->fetch($this->exceltable,null,$condition);
				
			if($selectRows){
				$prevfile= $selectRows[0]['filename'];
			}
			$condition="type='" . $type."'";
			$data=array('filename'=>'"'.trim ( $filename ).'"');
			$updaterow=$this->update($this->exceltable, $data, $condition);
			return $updaterow."$#%".$prevfile;
		}
	}
	
	/**
	 * Function - alreadyexist
	 *
	 * Method to check wheather link details are exist or not
	 *
	 * @param $type - it contains the type of url
	 * @return true, if any record retrieved
	 *         false, if no record retrieved
	 */
	function alreadyexist($type)
	{
		$condition="type='" .$type."'";
		$selectRows=$this->fetch($this->exceltable,null,$condition);
		if($selectRows){
			return true;
		}
		else{
			return false;
		}
	
	}
	

	function getFileName($type)
	{
		$condition="type='" .$type."'";
		$selectRows=$this->fetch($this->exceltable,null,$condition);
	
		if($selectRows){
			return $selectRows;
		}
		else{
			return false;
		}
	}
	

	function addMarks($exam_id,$class_id,$student_id,$subject_code,$marks){
		$fields=array('exam_id','class_id','stud_id','subject_code','marks','date_of_creation','date_of_modified');
		$values=array('"'.trim ( $exam_id ).'"','"'.trim ( $class_id ).'"','"'.trim ( $student_id ).'"','"'.trim ( $subject_code ).'"','"'.trim ( $marks ).'"','now()','now()');
		$instrow=$this->insert($this->markstable, $fields, $values);
		return $instrow;
			
	}

	function getMarksList($exam_id,$student_id)
	{
		$selectCondition="exam_id='".$exam_id."' and stud_id='".$student_id."'";
		$selectRows = $this->fetch($this->markstable,null,$selectCondition);
		if($selectRows){
			return $selectRows;
		}
		else{
			return false;
		}
	}
	
	function isStudentExistByID($student_id){
		$selectCondition="s_rn='".$student_id."'";
		$fields=array('s_rn');
		$selectRows=$this->fetch($this->studenttable,$fields,$selectCondition);
		if($selectRows)
			return true;
		else
			return false;
	}
	
	/**
	 * Function - removeKeys
	 *
	 * This function is used to remove the keys from array
	 *
	 * @param $array - it contains array
	 *
	 * @return - returns array without key
	 */
	
	function removeKeys( array $array )
	{
		$array = array_values( $array );
		foreach ( $array as &$value )
		{
			if ( is_array( $value ) )
			{
				$value = $this->removeKeys( $value );
			}
		}
		return $array;
	}
	

}