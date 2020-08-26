<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type:text/json');
	require_once 'includes/connection.php';
	//require_once 'includes/GCM.php';
	//require_once 'includes/push.php';
	require_once 'function.php';
	$countryid = $_GET['stateId'];
	//$result = getCities($con,$countryid);
	$query = "SELECT * FROM cities WHERE state_id =".$countryid."";
		$results = mysqli_query($con, $query);
		$citydata = [];
		$data = mysqli_num_rows($results); 
		if($data > 0){
			while ($row = mysqli_fetch_assoc($results)) {
				print_r($row);
				$citydata[] = $row;
			}
		}
		$response['data'] = array("status"=>'true', "data"=>$citydata);
		return $response;
	//echo json_encode($result);
				
?>