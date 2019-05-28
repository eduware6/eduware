<?php

/**
 * SqlFunctions is class which is useful to connect mysql and excute the queries like "select","update","delete","insert" ..etc.
 * And It is reading the configuration database settings and connect the mysql .This is only class the app using for MySql DB Connection.  
 *
 * @author IMobiGeeks
 */
class MySqlFunctions {
    
    var $conLink;
    
    function __construct(){
		$this->makeConnection();
    }

	function getConvertedString($param)
    {
    	return mysqli_real_escape_string($this->conLink,$param);
    }
    /**
     * Function - insert
     *
     * This function is used to create select query based on given parameters
     *
     * @param $table - it contains table name
     * @param $fields - it contains table column names
     * @param $values - it contains values to be inserted
     *
     * @return returns - insert query result on successful insertion
     * 				  false, if insertion query fails
     */
    function insert($table,$fields,$values)
    {
    	if(count($fields)==count($values))
    	{
    		$fieldsStr=implode(", ", $fields);
    		$valuesStr=implode(",", $values);
    		$query="insert into ".$table."(".$fieldsStr.")values(".$valuesStr.")";

    		$res=$this->ExecuteQuery($query, 'insert');
    		return $res;
    	} else {
    		return false;
    	}
    
    }
     
    /**
     * Function - fetch
     *
     * This function is used to create a select query based on given parameters
     *
     * @param $table - it contains table name
     * @param $fields - it contains table fields
     * @param $condition - it contains condition
     * @return returns - all the retrieved details on success
     * 				  false, on failure
     */
    function fetch($table,$fields=null,$condition=null)
    {
    	if($fields==null)
    	{
    		$query="select * from ".$table;
    	} else {
    		$field_str=implode(",", $fields);
    		$query="select ".$field_str." from ".$table;
    		 
    	}
    	if($condition!=null)
    	{
    		$query.=" where ".$condition;
    	}
    
    	$res=$this->ExecuteQuery($query, 'select');
    	if($res)
    		return $res;
    	else
    		return false;
    }
     
    /**
     * Function - update
     *
     * This function is used to create update query based on given parameters
     *
     * @param $table - It contains table name
     * @param $data - it contains data to be update
     * @param $condition - it contains the condition
     * @return returns number of effected rows on successful updation otherwise
     *         returns false, if updation fails
     */
    function update($table,$data,$condition=null)
    {
    	$field_str="";
    	foreach($data as $field=>$value)
    	{
    		$field_str.=$field."=".$value.", ";
    	}
    	$field_str=rtrim($field_str,", ");
    	$query="update ".$table." set ".$field_str;
    	if($condition!=null)
    		$query.=" where ".$condition;
    	$res=$this->ExecuteQuery($query, 'update');
    	if($res)
    		return $res;
    	else
    		return false;
    }
     
    /**
     * Function - delete
     *
     * This function is used to prepare delete query based on given parameters
     *
     * @param $table - It contains table name
     * @param $condition - It contains condition
     * @return returns true, on successful deletion
     *                 false, on deletion failed
     */
    function delete($table,$condition=null)
    {
    	$query="delete from ".$table;
    	if($condition!=null)
    		$query.=" where ".$condition;
    
    	$res=$this->ExecuteQuery($query, 'delete');
    	if($res)
    		return $res;
    	else
    		return false;
    }
	
    /** 
     * makeConnection is method and it is for to establish a conecction to MySql 
     */
    function makeConnection(){
		global $config;
		$this->conLink=mysqli_connect($config['DBHostName'],$config['DBUserName'], $config['']) or die("Error in DB connection ".  mysqli_error($this->conLink)); 
        mysqli_select_db($this->conLink,$config['DatabaseName']);
        return true; 
     }
    
     /**
      * ExecuteQuery is method to do execute the queries based on the QueryType parameter (i.e select,insert,noofrows, update , delete) 
      * @param $Query - Its a query string 
      * @param $QueryType- It will decide which query needs to excute
      * @return - It will return appropriate respective response based on the $QueryType
      *  
      */
     function ExecuteQuery($Query,$QueryType){
     	if(!empty ($Query) && !empty($QueryType)){
     		switch(strtolower($QueryType)){
     			case "select" :
     							$Result=mysqli_query($this->conLink,$Query) or die("Error in selection query<br>".$Query."<br>".mysqli_error($this->conLink));
                     			if($Result)
                         		{
                             		$ResultSet=array();
                             		while($ResultSet1=  mysqli_fetch_array($Result))
                                 	{
                                 		$ResultSet[]=$ResultSet1;
                                 	}
									return $ResultSet;
                         		}
			                    else
			                    {
			                        return false;
			                    }
			                    break;
			    case "insert" :
			    				$Result=mysqli_query($this->conLink,$Query) or die("Error in Insertion Query <br>".$Query."<br>".mysqli_error($this->conLink));
                     			if($Result)
                         		{
                         			$LastInsertedRow=mysqli_insert_id($this->conLink);
                         			return $LastInsertedRow;
                         		}
                    			else
		                        {
		                        	return false;                         
		                        }
                     			break;
                case "update" :
                				$Result=mysqli_query($this->conLink,$Query) or die("Error in Updation Query <br>".$Query."<br>".mysqli_error($this->conLink));
                     			if($Result)
                         		{
                         			$AffectedRows=mysqli_affected_rows($this->conLink);
                         			return $AffectedRows;
                         		}
                     			else
						 		{
                             		return false;
                         		}
                     			break;
                 
                case "delete" :
                				$Result=mysqli_query($this->conLink,$Query) or die("Error in deletion query <br> ".$Query."<br>".mysqli_error($this->conLink));
                     			if($Result)
                         		{	
                         			return true;
                         		}
                     			else{
                         			return false;
                         		}
                     			break;
                     
                case "norows" :
                     			$Result=mysqli_query($this->conLink,$Query) or die("Error in no of rows Query <br>".$Query. "<br>".mysqli_error($this->conLink));
                     			if($Result)
                         		{
                         			$TotalRows=mysqli_num_rows($Result);
                         			return $TotalRows;
                         		}
                     			else
		                        {
		                         	return false;
		                        }
		                     	break;
            }
             
        }
     }
}

?>