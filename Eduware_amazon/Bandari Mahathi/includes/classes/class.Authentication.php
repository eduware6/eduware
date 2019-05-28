<?php
/**
 * @author IMobiGeeks
 * @category Controller
 * @desc This class is used to Manage the Organization details like inserting, deleting, updating and retrieving.
 * 
 */
include_once 'class.Util.php';
class Authentication extends MySqlFunctions {
	
	/**
	 * Constructor
	 *
	 * it will call Parent class constructor i.e MySqlFunctions Class Constructor and establish the database connection
	 */
	function __construct() {
		global $config;
		$this->table=$config['student_table'];
		$this->admintable=$config['faculty_table'];
		parent::__construct();
	}
	
	/**
	 * Function - addOrganizationInfoDetails
	 *
	 * This Function is used to add Organization details
	 *
	 * @param $organization_name - it contains organization_name
	 * @param $addressLine1 - It contains addressline1
	 * @param $addressLine2 - it contains addressLine2
	 * @param $zip - it contains zipcode
	 * @param $emailId - it contains emailid
	 * @param $administrator_username - it contains administrator username
	 * @param $administrator_password - it contains administrator password
	 * @param $organization_logo_URL - it contains organization logo url
	 * @return returns int val, with primary key field value of inserted row  on successful insertion,
	 *         returns false if insertion failed
	 */
	function addOrganizationInfoDetails($organization_name, $addressLine1, $addressLine2, $zip, $emailId, $administrator_username, $administrator_password, $organization_logo_URL) {
		$selectRows = $this->getOrganizationInfoDetails ( $organization_name );
		$selectRows2 = $this->getOrganizationuserDetails ( $administrator_username );
		if ($selectRows) {
			return false;
		} else if ($selectRows2) {
			return false;
		} else {
			$fields=array('organization_name','addressLine1','addressLine2','zip','emailId','administrator_username','administrator_password','dateOfCreation','dateOfLastModified','organization_logo_URL');
			$values=array('"'.$organization_name.'"','"'.$addressLine1.'"','"'.$addressLine2.'"','"'.$zip.'"','"'.$emailId.'"','"'.$administrator_username.'"','"'.$administrator_password.'"','now()','now()','"'.$organization_logo_URL.'"');
			
			$instrow=$this->insert($this->table, $fields, $values);
			
			return $instrow;
		}
	}
	
	/**
	 * Function - getOrganizationInfoDetails
	 *
	 * This function is used to get Organization details based on organization_name
	 *
	 * @param $organization_name - it contains organization name
	 * @return - returns array with selected organization details, if no rows selected return false
	 */
	function getOrganizationInfoDetails($organization_name) {
		$condition="organization_name='" . $organization_name . "'";
		$selectRows=$this->fetch($this->table,null,$condition);
		if ($selectRows) {
			return $selectRows;
		} else {
			return false;
		}
	
	}
	
	/**
	 * Function - getOrganizationuserDetails
	 *
	 * This function is used to get Organization details based on administrator username
	 *
	 * @param $administrator_username
	 * @return - returns array with selected organization details, if no rows selected return false
	 */
	function getOrganizationuserDetails($administrator_username) {
		$condition="administrator_username='" . $administrator_username . "'";
		$selectRows=$this->fetch($this->table,null,$condition);
		
		if ($selectRows) {
			return $selectRows;
		} else {
			return false;
		}
	
	}
	
	/**
	 * Function - getOrganizationInfoDetailsById
	 *
	 * This function is used to get organization details from databse based on organization_id
	 *
	 * @param $organization_id - It will contains organization id
	 * @return - returns array with selected organization details, if no rows selected return false
	 */
	function getOrganizationInfoDetailsById($organization_id) {
		$condition="organization_id=" . $organization_id;
		$selectRows=$this->fetch($this->table,null,$condition);
		
		if ($selectRows) {
			return $selectRows;
		} else {
			return false;
		}
	
	}
	
	/**
	 * Function - getAllOrganizationInfoDetails
	 *
	 * This Function is called when organization page loads on the view. This function is used to get Organizations details
	 *
	 * @return - returns array with all organization details, if no rows selected return false
	 */
	function getAllOrganizationInfoDetails() {
		$selectRows=$this->fetch($this->table);
		if ($selectRows) {
			return $selectRows;
		} else {
			return false;
		}
	
	}
	
	/**
	 * Function - getAllOrganizations
	 *
	 * This function is retrieves organization service related information and returns result as a array 
	 * @return - it will return array with following values
	 *           - organization_id
	 *           - organization_name
	 *           - emailId
	 */
	function getAllOrganizations() {
		$selectRows=$this->fetch($this->table);
		if ($selectRows) {
			$ResultSet = array ();
			foreach ( $selectRows as $obj ) {
				$ResultSet [] = array ($obj ['organization_id'], $obj ['organization_name'], $obj ['emailId'] );
			}
			$Result = array ("statuscode" => 200, "result" => $ResultSet );
			return $Result;
		} else {
			$Result = array ("statuscode" => 200, "result" => array() );
			return $Result;
		}
	
	}
	
	/**
	 * Function - userAuthenticate
	 *
	 * This Function is called when user enters the login credentials and submit the login page. This Function used to check the given user credentials are correct or not.
	 *
	 * @param $user_name - it contains username
	 * @param $user_password - it contains user password
	 * @return - it will return user authentication details, if authentication fails return false
	 */
	function userAuthenticate($user_name, $user_password,$type) {
		if($type == "student"){
			$condition="s_rn='" . $user_name . "' and student_password='" . $user_password . "'";
			$selectRows=$this->fetch($this->table,null,$condition);
		}else if($type == "parent"){
			$condition="s_rn='" . $user_name . "' and parent_password='" . $user_password . "'";	
			$selectRows=$this->fetch($this->table,null,$condition);
		}else{
			$condition="email='" . $user_name . "' and password='" . $user_password . "'";	
			$selectRows=$this->fetch($this->admintable,null,$condition);
		}
			
		if ($selectRows) {
			return $selectRows;
		} else {
			return false;
		}
	
	}
	function userAuthenticateAdmin($user_name,$user_password,$type) {
		var_dump($user_name);
		if($type == "admin"){
			$condition="email='" . $user_name . "' and password='" . $user_password . "'";	
			$selectRows=$this->fetch($this->admintable,null,$condition);
		}
		
		if ($selectRows) {
			return $selectRows;
		} else {
			return false;
		}
	
	}
	/**
	 * Function - updateOrganizationInfoDetails
	 *
	 * This Function is called when admin updates the organization info and submits the page in the view. This Function is used to update organization details
	 *
	 * @param $organization_name- it contains organization name
	 * @param $addressLine1 - it contains address line1
	 * @param $addressLine2 - it contains address line2
	 * @param $zip - it contains zip code
	 * @param $emailId - it contains email id
	 * @param $organization_logo_URL - it contains organization_logo_url
	 * @param $username - it contains username
	 * @param $password - it contains password
	 * @return - return number of effeted rows on successful updation,
	 *           return false, if updation fails
	 */
	function updateOrganizationInfoDetails($organization_name, $addressLine1, $addressLine2, $zip, $emailId, $organization_logo_URL, $username, $password) {
		$condition="organization_name='" . $organization_name . "'";
		$data=array('addressLine1'=>'"'.$addressLine1.'"','addressLine2'=>'"'.$addressLine2.'"','zip'=>'"'.$zip.'"','emailId'=>'"'.$emailId.'"','dateOfLastModified'=>'now()','organization_logo_URL'=>'"'.$organization_logo_URL.'"','administrator_username'=>'"'.$username.'"','administrator_password'=>'"'.$password.'"');
		$updaterow=$this->update($this->table, $data,$condition);
		
		return $updaterow;
	}
	
	
	/**
	 * Function - getInitialContent
	 *
	 * This function is retrieves organization details, social settings details and banner image details
	 *
	 * @return - it will return array with following values
	 *           - organization_details
	 *           - social_settings
	 *           - banner_details
	 */
	function getInitialContent()
	{
		/**
		 * organization details
		 */
		$utilObj=new Utility();
		$ResultSet = array ();
		$selectRows=$this->fetch($this->table);
		if ($selectRows) {
			foreach ( $selectRows as $obj ) {
				$ResultSet = array ($obj ['organization_id'], $obj ['organization_name'], $obj ['emailId'] );
			}
			$organization=$ResultSet;
		} else {
			$organization=array();
		}
	
		$main_result=array("status_code"=>200,"result"=>$organization);
		return $main_result;
	}
}

?>
