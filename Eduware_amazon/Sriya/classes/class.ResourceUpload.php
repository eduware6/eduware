<?php
/**
 * @author IMobiGeeks
 * @category Controller
 * @desc This class is used to upload the given resource in filesystem
 *
 */
include_once 'class.Util.php';
class ResourceUpload {
	
	function __construct() {
        global $config;
        
    }
	/**
	 * Function - uploadFile
	 * 
	 * This function is used to upload a file in file system
	 * 
	 * @param $file - it contains file information to be uploaded
	 * @param $attr_name - it contains file attribute name parameter
	 * @param $filetype - it contains file type
	 * @param $menutype - it contains type of the functionaity
	 * 
	 * @return - returns file path after uploaded into the filesystem 
	 */
	function uploadFile($file,$attr_name,$menutype=null)
	{
		global $config;
		date_default_timezone_set('America/New_York');
		$path="./".$config['repository_url'].$menutype."/";
				
		$gdate = date('ymdhis', time());
		
		$filename = $file[$attr_name]['name'];
		
		$filename=explode(".",$filename);
		$filename=mt_rand().$gdate.".".$filename[1];
		
		$v4uuid = $this->generate_uuid();
		$dest_path=$this->createDirectories($v4uuid,$path);
		$repositoryPath=$dest_path.$filename;
	
		move_uploaded_file($file[$attr_name]['tmp_name'],$repositoryPath);
		
		$repositoryPath=ltrim($repositoryPath,'.');
		return $repositoryPath;
	}
	
	
	/**
	 * Function - generate_uuid
	 * 
	 * This function is used to generate a UUID to create a folder structure
	 * 
	 * @return - returns generated UUID
	 */
	function generate_uuid() {
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		 
		// 32 bits for "time_low"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff),
		 
		// 16 bits for "time_mid"
		mt_rand(0, 0xffff),
		 
		// 16 bits for "time_hi_and_version",
		// four most significant bits holds version number 4
		mt_rand(0, 0x0fff) | 0x4000,
		 
		// 16 bits, 8 bits for "clk_seq_hi_res",
		// 8 bits for "clk_seq_low",
		// two most significant bits holds zero and one for variant DCE1.1
		mt_rand(0, 0x3fff) | 0x8000,
		 
		// 48 bits for "node"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}
	
	/**
	 * Function - createDirectories
	 * 
	 * This function is used to create directories in file system based on given UUID
	 *  
	 * @param $uuid - It contains uuid
	 * @return - returns path of the newly created folder structure
	 */
	function createDirectories($uuid,$path)
	{
	//	$path="./repository/";
		$uuid_str=explode("-",$uuid);
		foreach($uuid_str as $str)
		{
			$path.=$str."/";
		}
		if(!file_exists($path))				//if given $target path is not exist
		{
			if (!mkdir($path,0777,true))		// making directory with all permissions
				echo -1;
		}
		return $path;
	}
	
	/**
	 * Function - deleteResource
	 * 
	 * This function is used to delete the given resource and its folder structure
	 * 
	 * @param - 
	 */
	function deleteResource($path)
	{
		if(substr($path,-1) == '/')
		{
			$path = substr($path,0,-1);
		}
		if(!is_readable($path))
		{
			// return false and exit the function echo "not readable";
			return false;
		
			// ... else if the path is readable
		} else {
			if(is_file($path))
			{
				@unlink($path);
				$lastoccurence=strrpos($path,'/');
				$path=substr($path,0,$lastoccurence);
				$this->deleteResource($path);
			} else {
				@rmdir($path);
				$lastoccurence=strrpos($path,'/');
				$path=substr($path,0,$lastoccurence);
				$this->deleteResource($path);
			}
		}
		
	}
}