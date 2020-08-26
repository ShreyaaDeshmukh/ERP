<?php

require_once 'PHPMailer-master/class.phpmailer.php';

require_once 'PHPMailer-master/class.smtp.php';

require_once 'includes/connection.php';

#error_reporting(E_ALL);

#ini_set('display_errors', 1);

define("NUMBER_OF_USERS", 25000);

#define("WEBSITE_URL", "http://52.210.212.195/Streattag/");

	/*Function: login 

	* Create By: Rizwan

	* Create Date: 14 November 2018

	* @Params: User Credentials

	* @Output: User Data with Success Code

	*/

	 function login($con, $json){ 

		$username = $json->data->{'username'};

		$password = $json->data->{'password'};

		if($username!='' && $password!=''){

			$getData = mysqli_query($con,"SELECT * FROM user_login where username = '".$username."' AND password = '".md5("gef".$password)."'");

			if(mysqli_num_rows($getData) > 0)

			{

				$userdata = [];

				while ($row = mysqli_fetch_assoc($getData)) {

					$userdata[] = $row;

				}

				$response['data'] = array("status"=>"true","message"=>'Login Successfully', "data"=>$userdata);

			}else{

				$response['data'] = array("status"=>"false","message"=>'Invalid Credentials');

			}	

		}else{

			$response['data'] = array("status"=>"false","message"=>'Request parameter Required');

		}

		

		return $response;

	}

	

	function leaderBoard($con, $json){

		$query = "SELECT * FROM user_points WHERE isDeleted = 0 ORDER BY points DESC";

		$results = mysqli_query($con, $query);

		$leaderboarddata = [];

		while ($row = mysqli_fetch_assoc($results)) {

			$leaderboarddata[] = $row;

		}

		$response['data'] = array("status"=>'true', "data"=>$leaderboarddata);

		return $response;

	}



	function getCities($con, $json){

		$stateId = $json->data->{'state_id'};

		$query = "SELECT * FROM cities WHERE state_id =".$stateId."";

		$results = mysqli_query($con, $query);

		$citydata = [];

			while ($row = mysqli_fetch_assoc($results)) {

				$citydata[] = $row;

			}

		$response['data'] = array("status"=>'true', "data"=>$citydata);

		return $response;

	}



	function getStates($con, $json){

		$country_id = $json->data->{'country_id'};

		$query = "SELECT * FROM states WHERE country_id =".$country_id."";

		$results = mysqli_query($con, $query);

		$citydata = [];

			while ($row = mysqli_fetch_assoc($results)) {

				$citydata[] = $row;

			}

		$response['data'] = array("status"=>'true', "data"=>$citydata);

		return $response;

	}

	

	/*Function: getItemByPoRoId 

	* Create By: Rizwan

	* Create Date: 21 November 2018

	* @Params: Purchase and Receipt Order Number

	* @Output: Item Array

	*/

	function getItemByPoRoId($con, $json){

		$po = $json->data->{'po'};

		if($po!=""){

			$query = "SELECT purchase_id FROM product_purchase WHERE purchase_id = '".$po."'";

			$results = mysqli_query($con, $query);

			if(mysqli_num_rows($results)>0){

				//fetching purchaser id producs

				#$query2 = "SELECT product_id FROM product_purchase_details WHERE purchase_id = '".$po."'";

				$query2 = "SELECT a.product_id, pi.product_name,a.purchase_detail_id FROM product_purchase_details as a, product_information as pi WHERE pi.product_id = a.product_id AND a.purchase_id = '".$po."'";

				$results2 = mysqli_query($con, $query2);

				$productids = [];

				while ($row = mysqli_fetch_assoc($results2)) {

					$productids[] = $row;

				}

				$response['data'] = array("status"=>'true', "data"=>$productids, "order_type"=>"purchase");

			}else{

				//check if this is reciept 

				$query = "SELECT receipt_id FROM product_receipt WHERE receipt_id = '".$po."'";

				$results = mysqli_query($con, $query);	

				if(mysqli_num_rows($results)>0){

					//fetching purchaser id producs

					$query2 = "SELECT a.product_id, pi.product_name,a.receipt_detail_id as purchase_detail_id FROM product_receipt_details as a, product_information as pi WHERE pi.product_id = a.product_id AND a.receipt_id = '".$po."'";

					$results2 = mysqli_query($con, $query2);

					$productids = [];

					while ($row = mysqli_fetch_assoc($results2)) {

						$productids[] = $row;

					}

					$response['data'] = array("status"=>'true', "data"=>$productids, "order_type"=>"purchase");

				}else{

					$response['data'] = array("status"=>"false","message"=>'No Record Found');

				}

			}

		}else{

			$response['data'] = array("status"=>"false","message"=>'Request parameter Required');

		}

		return $response;

	}

	



	/*Function: getItemDetail 

	* Create By: Rizwan

	* Create Date: 22 November 2018

	* @Params: Item id

	* @Output: Item Array

	*/



	function getItemDetail($con, $json){

		$product_id = $json->data->{'product_id'};
		$po = $json->data->{'po'};
		$order_type = $json->data->{'order_type'};
		$purchase_detail_id = $json->data->{'purchase_detail_id'};
		if($product_id!="" && $po!=""){
			if($order_type=="purchase"){
			 $query = "SELECT a.product_id, a.supplier_id, a.category_id, a.product_name, a.cartoon_quantity, a.pallet_quantity, a.innercart_quantity, a.lot_flag, a.expiry_flag, b.quantity, b.rate, b.total_amount, a.image, b.unit, ifnull((select SUM(total_quantity) from purchase_receipt_order where purchase_id = '".$po."'),'0') as total_quantity_received,a.unit_values FROM product_information as a, product_purchase_details as b WHERE a.product_id = b.product_id AND a.product_id = ".$product_id."  AND b.purchase_id = '".$po."' AND a.status = 1 AND b.purchase_detail_id = '".$purchase_detail_id."'";
			}else if($order_type=="receipt"){
				$query = "SELECT a.product_id, a.supplier_id, a.category_id, a.product_name, a.cartoon_quantity, a.pallet_quantity, a.innercart_quantity, a.lot_flag, a.expiry_flag, b.quantity, b.rate, b.total_amount, a.image, b.unit, b.unit,  ifnull((select SUM(total_quantity) from purchase_receipt_order where purchase_id = '".$po."'),'0') as total_quantity_received,a.unit_values FROM product_information as a, product_receipt_details as b WHERE a.product_id = b.product_id AND a.product_id = ".$product_id."  AND b.receipt_id = '".$po."' AND a.status = 1 AND b.receipt_detail_id = '".$purchase_detail_id."'";
			}

			$results = mysqli_query($con, $query);

			$productinfo = [];

			if(mysqli_num_rows($results)>0){

				while ($row = mysqli_fetch_assoc($results)) {

					$productinfo[] = $row;

				}

				$querySelect = "SELECT SUM(total_quantity) as totalQuantityReceivedYet FROM purchase_receipt_order WHERE product_id = ".$product_id." AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."'";
				$results = mysqli_query($con, $querySelect);
				$dataQuantity = mysqli_fetch_array($results);
				if($dataQuantity['totalQuantityReceivedYet']!="null" && $dataQuantity['totalQuantityReceivedYet']!=null){
					$ttlRcvd = $dataQuantity['totalQuantityReceivedYet'];
				}else{
					$ttlRcvd = 0;
				}
				$productinfo[0]['total_quantity_received'] = $ttlRcvd;
				$response['data'] = array("status"=>'true', "data"=>$productinfo);

			}else{

				$response['data'] = array("status"=>"false","message"=>'No Product Found');

			}

		}else{

			$response['data'] = array("status"=>"false","message"=>'Request parameter Required');

		}

		return $response;

	}





	/*Function: updatePurchaseOrder 

	* Create By: Rizwan

	* Create Date: 22 November 2018

	* @Params: Item id and order id

	* @Output: Output with status

	*/

	function updatePurchaseOrder($con, $json){

		$po = $json->data->{'po'};

		$product_id = $json->data->{'product_id'};

		$type = $json->data->{'type'};

		$label = $json->data->{'label'};

		$serial_number = $json->data->{'serial_number'};

		$expiry_date = $json->data->{'expiry_date'};

		$quantity_receipt = $json->data->{'quantity_receipt'};
		
		$purchase_detail_id = $json->data->{'purchase_detail_id'};

		if($po!="" && $product_id!="" && $type!=""){

			if($type==1){

				//update label here

				$query = "UPDATE product_receipt_details SET label = '".$label."' WHERE receipt_id = ".$po." AND product_id=".$product_id." AND purchase_detail_id = '".$purchase_detail_id."'";

				$update = mysqli_query($con, $query);

				if(mysqli_affected_rows($update)>0){

					$response['data'] = array("status"=>"true","message"=>'Updated Successfully');

				}else{

					$response['data'] = array("status"=>"false","message"=>'Not updated');

				}

			}elseif($type==2){

				//update lott, serial number and expiry date here

			}else{

				//nothing to do

			}

		}else{

			$response['data'] = array("status"=>"false","message"=>'Request parameter Required');

		}

		return $response;

	}


	function updateItemPO($con, $json){
		$product_id = $json->data->{'product_id'};
		$po = $json->data->{'po'};
		$cartoon_quantity = $json->data->{'cartoon_quantity'};
		$pallet_quantity = $json->data->{'pallet_quantity'};
		$innercart_quantity = $json->data->{'innercart_quantity'};
		$itemquantity = $json->data->{'itemquantity'};
		$order_type = $json->data->{'order_type'};
		$total_quantity = $json->data->{'total_quantity'};

		$serial_number = $json->data->{'serial_number'};
		$expiry_date = $json->data->{'expiry_date'};
		$sell_date = $json->data->{'sell_date'};
		$unit_values = $json->data->{'unit_values'};
		$purchase_detail_id = $json->data->{'purchase_detail_id'};
		$user_id = $json->data->{'user_id'};
												 

		$totalQuantityReceived = 0;
		$queryArr = [];
		foreach($itemquantity as $qty){
			/*if($qty->per=="CARTON"){
				$totalQuantityReceived +=  $qty->qty * $cartoon_quantity;	
			}else if($qty->per=="PALLET"){
				$totalQuantityReceived +=  $qty->qty * $pallet_quantity;
			}else{
				$totalQuantityReceived += $qty->qty;
			}*/
			if($order_type=='purchase'){
				$query = "SELECT * FROM purchase_receipt_order WHERE unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND quantity = '".$qty->qty."' AND is_deleted = 0 AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND serial_number=''";
				$results = mysqli_query($con, $query);
				$dataQuantity = mysqli_fetch_array($results);
				if(sizeof($dataQuantity)>0){
					 $updatequery = "UPDATE purchase_receipt_order SET user_id = ".$user_id.", serial_number = '".$serial_number."', expiry_date = '".$expiry_date."', sell_date = '".$sell_date."' WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND quantity = '".$qty->qty."'";
					 mysqli_query($con, $updatequery);
					
				}else{
					# $updatequery = "UPDATE purchase_receipt_order SET is_deleted = 1 WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND quantity = '".$qty->qty."'";
					
					$updateQuery = "DELETE FROM `purchase_receipt_order` WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND quantity = '".$qty->qty."'";	
					 mysqli_query($con, $updatequery);	
		
					$insertQuery = "INSERT INTO purchase_receipt_order(`purchase_id`, `type`, `unit`, `per`, `per2`, `per3`, `quantity`, `label`, `product_id`, `total_quantity`, `serial_number`, `expiry_date`, `purchase_detail_id`, `sell_date`, `user_id`) VALUES('".$po."', 1, '".$qty->unit."', '".$qty->per."', '".$qty->per2."', '".$qty->per3."', ".$qty->qty.", '".$qty->label."', ".$product_id.", ".$total_quantity.", '".$serial_number."', '".$expiry_date."', '".$purchase_detail_id."', '".$sell_date."', '".$user_id."')";
					 
				}				
			}else if($order_type=='receipt'){
			 	$insertQuery = "INSERT INTO purchase_receipt_order(`receipt_id`, `type`, `unit`, `per`, `per2`, `per3`, `quantity`, `label`, `product_id`, `total_quantity`, `serial_number`, `expiry_date`, `purchase_detail_id`, `sell_date`) VALUES('".$po."', 2, '".$qty->unit."', '".$qty->per."', '".$qty->per2."', '".$qty->per3."', ".$qty->qty.", '".$qty->label."', ".$product_id.", ".$total_quantity.", '".$serial_number."', '".$expiry_date."', '".$purchase_detail_id."', '".$sell_date."')";	
			}
			//
			$queryArr[] = $insertQuery;
		}
		#print_r($queryArr);die;
		if($total_quantity<=0){
			$response['data'] = array("status"=>"false","message"=>'No product quantity found.');
			return $response;
		}
		foreach($queryArr as $qrr){
			#echo $qrr.'<br>';
			mysqli_query($con, $qrr);
		}
		$query = "UPDATE product_information SET cartoon_quantity = '".$cartoon_quantity."', pallet_quantity = '".$pallet_quantity."', innercart_quantity = '".$innercart_quantity."',unit_values='".$unit_values."' WHERE product_id = ".$product_id."";
		mysqli_query($con, $query);
		/*if($order_type=='purchase'){
			$updateQuery = "UPDATE product_purchase_details SET quantity_receipt = ".$totalQuantityReceived." WHERE purchase_id = ".$po." AND product_id=".$product_id."";
		}else if($order_type=='receipt'){
			$updateQuery = "UPDATE product_receipt_details SET quantity_receipt = ".$totalQuantityReceived." WHERE receipt_id = ".$po." AND product_id=".$product_id."";
		}
		mysqli_query($con, $updateQuery);	*/

		 $querySelect = "SELECT SUM(total_quantity) as totalQuantityReceivedYet FROM purchase_receipt_order WHERE product_id = ".$product_id." AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."'";
		$results = mysqli_query($con, $querySelect);
		$dataQuantity = mysqli_fetch_array($results);
		if($dataQuantity['totalQuantityReceivedYet']!="null" && $dataQuantity['totalQuantityReceivedYet']!=null){
			$ttlRcvd = $dataQuantity['totalQuantityReceivedYet'];
		}else{
			$ttlRcvd = 0;
		}
		$response['data'] = array("status"=>"true","message"=>'Order Successfully', "totalQuantity"=>$ttlRcvd);
		return $response;	
	}


	function updateOrderInfo($con, $json){
		$product_id = $json->data->{'product_id'};
		$po = $json->data->{'po'};
		$order_type = $json->data->{'order_type'};
		$serial_number = $json->data->{'serial_number'};
		$expiry_date = $json->data->{'expiry_date'};
		$purchase_detail_id = $json->data->{'purchase_detail_id'};
		$lot = $json->data->{'lot'};
		if($order_type == 'purchase'){
			$updateQuery = "UPDATE product_purchase_details SET serial_number = '".$serial_number."', expiry_date = '".$expiry_date."', lot='".$lot."' WHERE purchase_id = '".$po."' AND product_id = '".$product_id."' AND purchase_detail_id = '".$purchase_detail_id."'";
		}elseif($order_type == 'receipt'){
			$updateQuery = "UPDATE product_receipt_details SET serial_number = '".$serial_number."', expiry_date = '".$expiry_date."', lot='".$lot."' WHERE receipt_id = '".$po."' AND product_id = '".$product_id."' AND receipt_detail_id = '".$purchase_detail_id."'";
		}
		mysqli_query($con, $updateQuery);
		$response['data'] = array("status"=>"true","message"=>'Order Successfully');
		return $response;
	}
	
	function getAllLocations($con, $json){
		$query = "SELECT id, location_name, location_unique_key FROM locations WHERE is_deleted = 0";
		$result = mysqli_query($con, $query);
		$locationInfo = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$locationInfo[] = $row;
		}
		$response['data'] = array("status"=>"true","locations"=>$locationInfo);
		return $response;		
	}
	
	function updatePutAwayLocation($con, $json){
		$label = $json->data->{'label'};
		$location_unique_key = $json->data->{'location_unique_key'};
		$user_id = $json->data->{'user_id'};
		
		
		 $selectQuery = "SELECT product_id FROM purchase_receipt_order WHERE label = '".$label."'";
		$results = mysqli_query($con, $selectQuery);
		$productId = mysqli_fetch_array($results);
		#print_r($productId);die;
		
		$selectquery = "SELECT * FROM inventory_locations WHERE label = '".$label."'";
		$results = mysqli_query($con, $selectquery);
		$dataQuantity = mysqli_fetch_array($results);
		if(sizeof($dataQuantity)>0){
			$insertQuery = "UPDATE inventory_locations SET location_unique_key = '".$location_unique_key."', updated_at = NOW(), updated_by = '".$user_id."', product_id = '".$productId['product_id']."' WHERE label = '".$label."'";
		}else{	
			$insertQuery = "INSERT INTO inventory_locations(`label`, `location_unique_key`, `created_at`, `updated_at`, `created_by`, `updated_by`, `product_id`) VALUES('".$label."','".$location_unique_key."',NOW(),NOW(),'".$user_id."','".$user_id."','".$productId['product_id']."')";
		}
		mysqli_query($con, $insertQuery);
		$response['data'] = array("status"=>"true","message"=>'Order added Successfully');
		return $response;
	}

		function getTiketDetails($con, $json){
			$pt = $json->data->{'pt'};
			if($pt!=''){
				#echo $query = "SELECT product_ticket_details.*, product_information.product_name, product_picking_order.picked_quantity FROM product_ticket_details JOIN product_information ON product_information.product_id = product_ticket_details.product_id LEFT JOIN product_picking_order ON product_ticket_details.ticket_detail_id = product_picking_order.ticket_detail_id WHERE product_ticket_details.ticket_id= '".$pt."' AND product_ticket_details.picking_status!='picked'";
				$query = "SELECT product_ticket_details.*, product_information.product_name, SUM(product_picking_order.picked_quantity) as picked_quantity FROM product_ticket_details JOIN product_information ON product_information.product_id = product_ticket_details.product_id LEFT JOIN product_picking_order ON product_ticket_details.ticket_detail_id = product_picking_order.ticket_detail_id WHERE product_ticket_details.ticket_id= '".$pt."' AND product_ticket_details.picking_status!='picked' GROUP BY product_ticket_details.ticket_detail_id";
				$result = mysqli_query($con, $query);
				$ticketInfo = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$ticketInfo[] = $row;
				}
				if(sizeof($ticketInfo)>0){
					$response['data'] = array("status"=>"true","locations"=>$ticketInfo);
				}else{
					$response['data'] = array("status"=>"false","msg"=>"No ticket found.");
				}
			}else{
				$response['data'] = array("status"=>"false","message"=>'Request Parameter missing');
			}
			return $response;
		}
		
		function validatePicking($con, $json){
			$pt = $json->data->{'pt'};
			$location_unique_key = $json->data->{'location_unique_key'};
			$product_id = $json->data->{'product_id'};
			$label = $json->data->{'label'};
			if($pt!='' && $location_unique_key!='' && $label!=''){
				$query = "SELECT a.* FROM inventory_locations as a WHERE a.label = '".$label."' AND a.location_unique_key = '".$location_unique_key."' AND a.product_id = '".$product_id."'";
				$result = mysqli_query($con, $query);
				$ticketInfo = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$ticketInfo[] = $row;
				}
				if(sizeof($ticketInfo)>0){
					$response['data'] = array("status"=>"true","locations"=>$ticketInfo);
				}else{
					$response['data'] = array("status"=>"false","msg"=>"You are picking either from wrong location or wrong product");
				}
			}else{
				$response['data'] = array("status"=>"false","message"=>'Request Parameter missing');
			}
			return $response;
		}
		
		function getLabelAsPerPriority($con, $json){
			$product_id = $json->data->{'product_id'};
			$label = $json->data->{'label'};
			if($product_id!="" && $label!=""){
				 $query = "SELECT * FROM purchase_receipt_order JOIN inventory_locations ON inventory_locations.label = purchase_receipt_order.label WHERE purchase_receipt_order.is_deleted = 0 AND purchase_receipt_order.expiry_date!='' AND purchase_receipt_order.product_id = ".$product_id." ORDER BY purchase_receipt_order.sell_date ASC";
				$result = mysqli_query($con, $query);
				$purchaseInfo = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$purchaseInfo[] = $row;
				}
				if($purchaseInfo[0]['label']==$label){
					$response['data'] = array("status"=>"true","msg"=>'You can scan this Unit Id.');
				}else{
					$response['data'] = array("status"=>"false","data"=>$purchaseInfo[0], "msg"=>"You must use this Unit Id as it will expire earlier. Please go to location - ".$purchaseInfo[0]['location_unique_key'], "flag" => 1);
				}
			}else{
				$response['data'] = array("status"=>"false","msg"=>'Request Parameter missing');
			}
			return $response;
		}

		
		function getNextLabelAsPerPriority($con, $json){
			$product_id = $json->data->{'product_id'};
			$label = $json->data->{'label'};
			if($product_id!="" && $label!=""){
				 $query = "SELECT * FROM purchase_receipt_order JOIN inventory_locations ON inventory_locations.label = purchase_receipt_order.label WHERE purchase_receipt_order.is_deleted = 0 AND purchase_receipt_order.expiry_date!='' AND purchase_receipt_order.product_id = ".$product_id." ORDER BY purchase_receipt_order.sell_date ASC";
				$result = mysqli_query($con, $query);
				$purchaseInfo = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$purchaseInfo[] = $row;
				}
				if($purchaseInfo[0]['label']==$label){
					$response['data'] = array("status"=>"true","msg"=>'You can scan this Unit Id.');
				}else{
					$response['data'] = array("status"=>"false","data"=>$purchaseInfo[0], "msg"=>"You must use this Unit Id as it will expire earlier. Please go to location - ".$purchaseInfo[0]['location_unique_key'], "flag" => 1);
				}
			}else{
				$response['data'] = array("status"=>"false","msg"=>'Request Parameter missing');
			}
			return $response;
		}

		function checkInventoryLocation($con, $json){
			$numberOfUnitIds = $json->data->{'numberOfUnitIds'};
			$location_unique_key = $json->data->{'location_unique_key'};
			
			$selectquery = "SELECT * FROM inventory_locations WHERE location_unique_key = '".$location_unique_key."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) == $numberOfUnitIds){
				$message = "Matched";
				$status = "true";
			}else{	
				$message = "Not Matched";
				$status = "false";
			}
			
			$response['data'] = array("status"=>$status,"message"=>$message, "numberOfUnitIds"=> mysqli_num_rows($results));
			return $response;
		}


		function checkInventoryLocationByUnidID($con, $json){
			$unitid = $json->data->{'unitid'};
			$location_unique_key = $json->data->{'location_unique_key'};
			
			$selectquery = "SELECT * FROM inventory_locations WHERE location_unique_key = '".$location_unique_key."' and label = '".$unitid."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) > 0){
				$message = "Matched";
				$status = "true";
				$locationInfo = [];
			}else{	
				$message = "Not Matched";
				$status = "false";

				$selectquery_forResponse = "SELECT * FROM inventory_locations WHERE label = '".$unitid."'";
				$results_forResponse = mysqli_query($con, $selectquery_forResponse);

				$locationInfo = [];
				while ($row = mysqli_fetch_assoc($results_forResponse)) {
					$locationInfo[] = $row;
				}


			}
			
			$response['data'] = array("status"=>$status,"message"=>$message,"location"=>$locationInfo);
			return $response;
		}


		function checkInventoryUnitID($con, $json){
			$unitid = $json->data->{'unitid'};
			$qtyofeaches = $json->data->{'qtyofeaches'};
			
			$selectquery = "SELECT sum(total_quantity) as total_quantity FROM purchase_receipt_order WHERE label = '".$unitid."' GROUP BY label";
			$results = mysqli_query($con, $selectquery);
			
			$row = mysqli_fetch_assoc($results);

			if($row['total_quantity'] == $qtyofeaches){
				$message = "Matched";
				$status = "true";
			}
			else{
				$message = "Not Matched";
				$status = "false";
			}
			
			$response['data'] = array("status"=>$status,"message"=>$message, "qtyofeaches"=> $row['total_quantity']);
			return $response;
		}


		function getAllLocationsunderAisle($con, $json){
			$location_unique_key = $json->data->{'location_unique_key'};
			$rowlocations = [];
			
			$selectquery = "SELECT id FROM aislelocations WHERE location_unique_key = '".$location_unique_key."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) > 0){

			$row = mysqli_fetch_assoc($results);


			$selectquerylocations = "SELECT location_unique_key FROM locations WHERE parent_location_id = '".$row['id']."'";
			$resultslocations = mysqli_query($con, $selectquerylocations);
			
				if(mysqli_num_rows($resultslocations) > 0){

						while ($row = mysqli_fetch_assoc($resultslocations)) {
							//$rowlocations[] = $row;
							array_push($rowlocations,$row['location_unique_key']);
						}

						$message = "Successful!";
						$status = "true";
					}
					else{

						$message = "This Aisle location does not contain any location!";
						$status = "false";


					}
			}
			else{
				$message = "This Aisle location is not valid!";
				$status = "false";
			}
			$response['data'] = array("status"=>$status,"message"=>$message, "locations"=> $rowlocations);
			return $response;
		}





		function getAllLocationsunderItem($con, $json){
			$item_id = $json->data->{'item_id'};

			$rowlocations = [];
			
			$selectquery = "SELECT location_unique_key FROM inventory_locations WHERE product_id = '".$item_id."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) > 0){

				$message = "Successful!";
				$status = "true";

				while ($row = mysqli_fetch_assoc($results)) {
					array_push($rowlocations,$row['location_unique_key']);
				}

			}
			else{
				$message = "This Item is not present on any location!";
				$status = "false";
			}
			$response['data'] = array("status"=>$status,"message"=>$message, "locations"=> $rowlocations);
			return $response;
		}


		function checkInventoryLocationByItems($con, $json){
			$numberOfUnitIds = $json->data->{'numberOfUnitIds'};
			$location_unique_key = $json->data->{'location_unique_key'};
			$item_id = $json->data->{'item_id'};
			
			$selectquery = "SELECT * FROM inventory_locations WHERE location_unique_key = '".$location_unique_key."' && product_id = '".$item_id."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) == $numberOfUnitIds){
				$message = "Matched";
				$status = "true";
			}else{	
				$message = "Not Matched";
				$status = "false";
			}
			
			$response['data'] = array("status"=>$status,"message"=>$message, "numberOfUnitIds"=> mysqli_num_rows($results));
			return $response;
		}



		function checkInventoryLocationByUnidIDByItems($con, $json){
			$unitid = $json->data->{'unitid'};
			$location_unique_key = $json->data->{'location_unique_key'};
			$item_id = $json->data->{'item_id'};
			
			$selectquery = "SELECT * FROM inventory_locations WHERE location_unique_key = '".$location_unique_key."' and label = '".$unitid."' && product_id = '".$item_id."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) > 0){
				$message = "Matched";
				$status = "true";
				$locationInfo = [];
			}else{	
				$message = "Not Matched";
				$status = "false";

				$selectquery_forResponse = "SELECT * FROM inventory_locations WHERE label = '".$unitid."'";
				$results_forResponse = mysqli_query($con, $selectquery_forResponse);

				$locationInfo = [];
				while ($row = mysqli_fetch_assoc($results_forResponse)) {
					$locationInfo[] = $row;
				}


			}
			
			$response['data'] = array("status"=>$status,"message"=>$message,"location"=>$locationInfo);
			return $response;
		}


		function locationMove($con, $json){
			$location_unique_key_from = $json->data->{'location_unique_key_from'};
			$location_unique_key_to = $json->data->{'location_unique_key_to'};


			$selectquery = "SELECT * FROM inventory_locations WHERE location_unique_key = '".$location_unique_key_from."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) > 0){


				$selectqueryTo = "SELECT * FROM locations WHERE location_unique_key = '".$location_unique_key_to."'";
				$resultsTo = mysqli_query($con, $selectqueryTo);

				if(mysqli_num_rows($resultsTo) > 0){

						$updatequeryTo = "Update inventory_locations set location_unique_key = '".$location_unique_key_to."' where location_unique_key= '".$location_unique_key_from."'";
						$resultsUpdate = mysqli_query($con, $updatequeryTo);

						$message = "Location updated!";
						$status = "true";


				}else{

					$message = "To Location is not valid!";
					$status = "false";
				}



			}else{

				$message = "From Location is not valid or empty!";
				$status = "false";
			}


			$response['data'] = array("status"=>$status,"message"=>$message);
			return $response;
		}


		function UnitIDMove($con, $json){
			$unitid = $json->data->{'unitid'};
			$location_unique_key_to = $json->data->{'location_unique_key_to'};


			$selectquery = "SELECT * FROM inventory_locations WHERE label = '".$unitid."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) > 0){


				$selectqueryTo = "SELECT * FROM locations WHERE location_unique_key = '".$location_unique_key_to."'";
				$resultsTo = mysqli_query($con, $selectqueryTo);

				if(mysqli_num_rows($resultsTo) > 0){

						$updatequeryTo = "Update inventory_locations set location_unique_key = '".$location_unique_key_to."' where label= '".$unitid."'";
						$resultsUpdate = mysqli_query($con, $updatequeryTo);

						$message = "Location updated!";
						$status = "true";


				}else{

					$message = "To Location is not valid!";
					$status = "false";
				}



			}else{

				$message = "From UNITID is not valid or putaway is pending!";
				$status = "false";
			}


			$response['data'] = array("status"=>$status,"message"=>$message);
			return $response;
		}



		function UnitIDAdjust($con, $json){
			$unitid = $json->data->{'unitid'};
			$qty_unitid = $json->data->{'qty_unitid'};


			$selectquery = "SELECT * FROM inventory_locations WHERE label = '".$unitid."'";
			$results = mysqli_query($con, $selectquery);
			
			if(mysqli_num_rows($results) > 0){


				$selectqueryTo = "select SUM(total_quantity) as total_quantity from purchase_receipt_order WHERE label = '".$unitid."'";
				$resultsTo = mysqli_query($con, $selectqueryTo);
				$total_qty = mysqli_fetch_array($resultsTo);

				$total_qty = $total_qty['total_quantity'];
				

		
				if($total_qty == $qty_unitid){

					$difference = 0;

					$message = "Quantity in this UINTID is up-to-date!";
					$status = "true";

				}
				else if($total_qty < $qty_unitid){

					$difference = $qty_unitid - $total_qty; 

				$message = "New Quantity is Updated!";
				$status = "true";


				}
				else if($total_qty > $qty_unitid){

					$difference = $qty_unitid - $total_qty; 

				$message = "New Quantity is Updated!";
				$status = "true";


				}

				
			

				$selectBaseque = "SELECT id FROM `purchase_receipt_order` WHERE label ='".$unitid."' and is_web = 0 ORDER by id asc limit 1";
				$resultsBaseQue = mysqli_query($con, $selectBaseque);
				$baseId = mysqli_fetch_array($resultsBaseQue);

				$baseId = $baseId['id'];

				$updateQtyfirstRaw = "Update purchase_receipt_order set total_quantity = total_quantity+(".$difference.") where id= '".$baseId."'";
				mysqli_query($con, $updateQtyfirstRaw);

				


			}else{

				$message = "UNITID is not valid or putaway is pending!";
				$status = "false";
			}


			$response['data'] = array("status"=>$status,"message"=>$message);
			return $response;
		}

		
		function insertPicking($con, $json){
			$requestdata = $json->data->{'requestdata'};
			foreach($requestdata as $req){
				$product_id = $req->{'product_id'};	
				$picked_quantity_serial = $req->{'picked_quantity_serial'};
				$totalQuantityRecieved = array_sum($picked_quantity_serial);
				$ticket_detail_id = $req->{'ticket_detail_id'};
				$ticket_id = $req->{'ticket_id'};
				$location = $req->{'location'};
				$picked_status = $req->{'picked_status'};
				
				$insertQuery = "INSERT INTO product_picking_order(`ticket_id`,`ticket_detail_id`,`picked_quantity`,`picked_quantity_serial`,`product_id`,`location`,`updated_at`,`user_id`, `status`) VALUES('".$ticket_id."','".$ticket_detail_id."','".$totalQuantityRecieved."','".json_encode($picked_quantity_serial)."','".$product_id."','".$location."', NOW(), 1, '".$picked_status."')";
				
				mysqli_query($con, $insertQuery);
				
				$updateQuery = "UPDATE product_ticket_details SET picking_status = '".$picked_status."' WHERE ticket_detail_id = '".$ticket_detail_id."'";
				mysqli_query($con, $updateQuery);
				
			}
			$response['data'] = array("status"=>"true","message"=>'Order added Successfully');
			return $response;
			
			
		}

?>
