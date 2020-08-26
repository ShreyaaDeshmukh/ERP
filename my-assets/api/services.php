<?php

	header('Access-Control-Allow-Origin: *');

	#header('Content-Type:text/json');

	require_once 'includes/connection.php';

	//require_once 'includes/GCM.php';

	//require_once 'includes/push.php';

	require_once 'function.php';

	

	

	#error_reporting(E_ALL);

	#ini_set('display_errors', 1);

	$json = json_decode(file_get_contents("php://input"));
	// echo json_encode($json->apikey); die;
	// $usercheck = checkUserLicensing($con, $json);
	// $usercheck = $usercheck['data']['status'];
	// if($json->apikey=="KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R" && $usercheck=="true"){
		if($json->apikey=="KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R"){
			// echo "gg"; die
		switch($_REQUEST['action']){ 

			case 'login':

				$result = login($con,$json);

				echo json_encode($result);

				break;
			case 'multipleAddress':

				$result = multipleAddress($con,$json);

				echo json_encode($result);

				break;
			case 'forgetpassword':

				$result = forgetpassword($con,$json);

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
			
			case 'getItemPoList':
				$result = getItemPoList($con,$json);

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

			case 'updateItemPO_loop':

				$result = updateItemPO_loop($con,$json);

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
			
			case 'updatePickingQty':
				$result = updatePickingQty($con,$json);
				echo json_encode($result);
				break;
			
			case 'insertPicking':
				$result = insertPicking($con,$json);
				echo json_encode($result);
				break;
			case 'checkUnitId':
				$result = checkUnitId($con,$json);
				echo json_encode($result);
				break;	
			case 'pickCheckoutItem':
				$result = pickCheckoutItem($con,$json);
				echo json_encode($result);
				break;	
			default:

				$response['data'] = array("status"=>'false', "msg"=>"No Action selected");

				echo json_encode($response);

				break;

		}

	}else{
		// if($usercheck=="false"){
		// 	$response['data'] = array("status"=>'false', "msg"=>"Subscription Period is over, Please renew subscription.");
		// }else{
			$response['data'] = array("status"=>'false', "msg"=>"Authentication failed");
		}
		// echo json_encode($response);

	// }

	

	

?>