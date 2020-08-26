<?php

	header('Access-Control-Allow-Origin: *');

	#header('Content-Type:text/json');

	require_once 'includes/connection.php';

	//require_once 'includes/GCM.php';

	//require_once 'includes/push.php';

	require_once 'function1.php';

	

	

	#error_reporting(E_ALL);

	#ini_set('display_errors', 1);

	$json = json_decode(file_get_contents("php://input"));

	if($json->apikey=="KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R"){

		switch($_REQUEST['action']){ 

			case 'login':

				$result = login($con,$json);

				echo json_encode($result);

				break;

			case 'getCities':

				$result = getCities($con,$json);

				echo json_encode($result);

				break;

			case 'getStates':

				$result = getStates($con,$json);

				echo json_encode($result);

				break;

			case 'getItemByPoRoId':

				$result = getItemByPoRoId($con,$json);

				echo json_encode($result);

				break;

			case 'getItemDetail':

				$result = getItemDetail($con,$json);

				echo json_encode($result);

				break;	

			case 'updatePurchaseOrder':

				$result = updatePurchaseOrder($con,$json);

				echo json_encode($result);

				break;					

			case 'updateItemPO':

				$result = updateItemPO($con,$json);

				echo json_encode($result);

				break;					
		
			case 'updateOrderInfo':
				$result = updateOrderInfo($con,$json);

				echo json_encode($result);
				break;
			case 'getAllLocations':
				$result = getAllLocations($con,$json);

				echo json_encode($result);
				break;
			case 'updatePutAwayLocation':
				$result = updatePutAwayLocation($con,$json);
				echo json_encode($result);
				break;
			
			case 'getTiketDetails':
				$result = getTiketDetails($con,$json);
				echo json_encode($result);
				break;
			
			case 'validatePicking':
				$result = validatePicking($con,$json);
				echo json_encode($result);
				break;
			case 'getLabelAsPerPriority':
				$result = getLabelAsPerPriority($con,$json);
				echo json_encode($result);
				break;
			
			case 'getNextLabelAsPerPriority':
				$result = getNextLabelAsPerPriority($con,$json);
				echo json_encode($result);
				break;

			case 'checkInventoryLocation':
				$result = checkInventoryLocation($con,$json);
				echo json_encode($result);
				break;
			case 'checkInventoryLocationByUnidID':
				$result = checkInventoryLocationByUnidID($con,$json);
				echo json_encode($result);
				break;
			case 'checkInventoryUnitID':
				$result = checkInventoryUnitID($con,$json);
				echo json_encode($result);
				break;	
			case 'getAllLocationsunderAisle':
				$result = getAllLocationsunderAisle($con,$json);
				echo json_encode($result);
				break;
			case 'getAllLocationsunderItem':
				$result = getAllLocationsunderItem($con,$json);
				echo json_encode($result);
				break;
			case 'checkInventoryLocationByItems':
				$result = checkInventoryLocationByItems($con,$json);
				echo json_encode($result);
				break;	
			case 'checkInventoryLocationByUnidIDByItems':
				$result = checkInventoryLocationByUnidIDByItems($con,$json);
				echo json_encode($result);
				break;
			case 'locationMove':
				$result = locationMove($con,$json);
				echo json_encode($result);
				break;
			case 'UnitIDMove':
				$result = UnitIDMove($con,$json);
				echo json_encode($result);
				break;
			case 'UnitIDAdjust':
				$result = UnitIDAdjust($con,$json);
				echo json_encode($result);
				break;			
			
			case 'insertPicking':
				$result = insertPicking($con,$json);
				echo json_encode($result);
				break;
			default:

				$response['data'] = array("status"=>'false', "msg"=>"No Action selected");

				echo json_encode($response);

				break;

		}

	}else{

		$response['data'] = array("status"=>'false', "msg"=>"Authentication failed");

		echo json_encode($response);

	}

	

	

?>