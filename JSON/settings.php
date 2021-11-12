<?php

header('Content-Type: text/html; charset=utf-8');
//ini_set('display_errors', 1);

// $my_path = realpath(dirname(__FILE__) . '/..');
// @ini_set('log_errors', 'On'); // enable or disable php error logging (use 'On' or 'Off')
// @ini_set('display_errors', 'Off'); // enable or disable public display of errors (use 'On' or 'Off')
// @ini_set('error_log', 'Errors.log.txt'); // path to server-writable log file

//require '../index.inc.php';
include('../lib/db.php'); 
 mysqli_query($link, "SET NAMES utf8");
  	$query_Settings = "SELECT  * FROM `Settings`";
	if ($result_Settings = mysqli_query($link, $query_Settings)) {
		while ($Setting = mysqli_fetch_object($result_Settings)) {
		$Name = $Setting->Name;
			$Value = $Setting->Value; 
				$Settings[] = array($Name=>$Value);
		}
	 $output = json_encode(array('Settings' => $Settings),128);
	$output  = preg_replace('/%u([0-9A-F]+)/', '&#x$1;',$output);
	$output  =html_entity_decode($output,  ENT_NOQUOTES, 'UTF-8');

		mysqli_free_result($result_Settings);
	}
 
   	echo $output;
mysqli_close($link);

?>
