<?php
/**
 * @author IMobiGeeks
 * @category Controller
 * @desc This is a utility class
 *
 */
class Utility
{
	/**
	 * Function - urlEncode
	 * 
	 * This function is used to encode a given URL 
	 * 
	 * @param $url - it contains a url
	 * @return- it returns encoded URL
	 */
	function urlEncode($url)
	{
		$decoded_url=urldecode($url);
		$encoded_url= implode("/", array_map("rawurlencode", explode("/", $decoded_url)));
		$encode_url=str_replace("%3A",":",$encoded_url);
		$encode_url=str_replace("%23","#",$encode_url);
		$encode_url=str_replace("%3F","?",$encode_url);	
		$encode_url=str_replace("%3D","=",$encode_url);
		$encode_url=str_replace("%26","&",$encode_url);
		$encode_url=str_replace("%2C",",",$encode_url);
		
		return $encode_url;
	}
	
	/**
	 * Function - spacesEncode
	 * 
	 * This function is used to encode spaces if exist in given url
	 * 
	 * @param $url - it contains a url
	 * @return returns spaces encoded URL
	 */
	function spacesEncode($url)
	{
		$decoded_url=urldecode($url);
		$encode_url=str_replace(" ","%20",$decoded_url);
		return $encode_url;
	}
	
	/**
	 * Function - updateHTMLDescription
	 *
	 * This function is used to add font tags to the html content
	 *
	 * @param $description - it contains the description
	 * @return returns the html description by adding font tag to it
	 */
	function updateHTMLDescription($description)
	{
		$description1="<style type='text/css'>h1,h2,h3{color : #F1C40F;}h5{font-style:italic}blockquote{color:#747474;font-style:italic;}img {max-width: 100%;height: auto;}</style>";
		$description=$description1."<font style='font-family: roboto,helvetica, arial;'>" .stripslashes ( html_entity_decode(str_replace('&nbsp;', ' ',stripslashes ($description)),ENT_QUOTES,"UTF-8") )."</font>";
		return $description;
	}
	
	/**
	 * Function - getLatlang
	 * 
	 * This function is used to get latitude and longitude values based on given address 
	 * 
	 * @param $addressline1 - It contains address line 1
	 * @param $addressline2 - It contains address line 2
	 * @param $city - It contains city
	 * @param $state - It contains state
	 * @param $zipcode - - It contains zipcode
	 * @return - returns latitude and longitude values on success,
	 *                   false on invalid address
	 */
	function getLatlang($addressline1, $addressline2, $city, $state, $zipcode)
	{
		global $config;
		$address = $addressline1.",".$addressline2.",".$city.",".$state.",".$zipcode; 
		$prepAddr = str_replace(' ','+',$address);
		
		$geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&key='.$config['maps_api_key']);

		$output= json_decode($geocode);
		$maps_status=$output->status;
		$maps_error_msg=$output->error_message;
		if(!empty($output->results))
		{
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;
			return $lat."$#@".$long;
		} else if($maps_status){
			if($maps_status=="REQUEST_DENIED"){
				return "Google maps API key is invalid.";
			}else if($maps_status=="ZERO_RESULTS"){
				return "Invalid address,Please provide valid address!";
			}else if($maps_status=="INVALID_REQUESTs"){
				return "Invalid request. Missing the 'address' parameter";
			}else if($maps_status=="OVER_QUERY_LIMIT"){
				return "Google maps API QPS(query per second) limit was exceeded. please try again later";
			}else if($maps_error_msg){
				return $maps_error_msg;
			}else{
				return $maps_status;
			}
		}else if($maps_error_msg){
			return $maps_error_msg;
		}else{
			return "404";
		}
	}
	
	function format_phone($phone)
	{
		$phone = preg_replace("/[^0-9]/", "", $phone);
	
		if(strlen($phone) == 7)
			return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
		elseif(strlen($phone) == 10)
		return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
		elseif (strlen($phone) == 11) {
			return preg_replace("/([0-9a-zA-Z]{1})([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1($2) $3-$4", $phone);
		}
		else
			return  $phone;
	}
}
?>