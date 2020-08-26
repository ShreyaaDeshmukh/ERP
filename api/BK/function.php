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
	
	
// 	function connection($dbname){
// 		$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);
// 			if (mysqli_connect_errno())
// 			{
// 				echo "Failed to connect to MySQL: " . mysqli_connect_error();die();
// 			}

// 		}


	 function login($con, $json){ 

		$username = $json->data->{'username'};

		$password = $json->data->{'password'};

		if($username!='' && $password!=''){

			$getData = mysqli_query($con,"SELECT * FROM mobile_user_details where email = '".$username."' AND password = '".md5("gef".$password)."'");

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
		// print_r($stateId);

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

	function getItemByPoRoId($conn, $json){
	// $dbname= $json->data->{'nameSet'};

	// if($dbname !=''){
	// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
	// }else{
	// 	$dbname = "wholesale_v3";
	// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
	// }
	
	$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
	$po = $json->data->{'po'};

		if($po!=""){

		$query = "SELECT purchase_id FROM product_purchase WHERE purchase_id = '".$po."'";

			$results = mysqli_query($con, $query);
			mysqli_num_rows($results);
			if(mysqli_num_rows($results)>0){

				//fetching purchaser id producs

				#$query2 = "SELECT product_id FROM product_purchase_details WHERE purchase_id = '".$po."'";

				 $query2 = "SELECT a.product_id, pi.product_name,a.purchase_detail_id,pi.product_details,ci.customer_name, si.supplier_name FROM product_purchase_details as a, product_purchase as b, product_information as pi, supplier_information as si, customer_information as ci WHERE b.purchase_id = a.purchase_id AND b.supplier_id = si.supplier_id AND b.customer_id = ci.customer_id AND pi.product_id = a.product_id AND a.purchase_id = '".$po."'";
				//  return $query2; die;

				$results2 = mysqli_query($con, $query2);

				$productids = [];

				while ($row = mysqli_fetch_assoc($results2)) {

					$productids[] = $row;

				}

				$response['datat'] = array("status"=>'true', "mydata"=>$productids, "order_type"=>"purchase");
				// return $productids;
				// die;

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
	
	
	
	
	function getItemPoList($con, $json){
		$customer_name = $json->data->{'customer_name'};
		// return $customer_name;
		
		$product_sss = $json->data->{'product_sss'};
		$vendor_search = $json->data->{'vendor_search'};
		$str = '';
		if($customer_name !=""){
			if($str == ''){
				$str = " customer_id = (select customer_id from customer_information where customer_name ='".$customer_name."')";
			}else{
				$str .= " and customer_id = (select customer_id from customer_information where customer_name ='".$customer_name."')";
			}
		}else if($product_sss !=''){
			if($str ==''){
				$str = " supplier_id = (select supplier_id from product_information where product_id='".$product_sss."')";
			
			}else{
				
				$str .= " and supplier_id = (select supplier_id from product_information where product_id='".$product_sss."')";
			}
		}else if($vendor_search !=''){
			if($str ==''){
				$str = " supplier_id = '".$vendor_search."'";
			}else{
				$str .= " and supplier_id = '".$vendor_search."'";
			}
		}else{
			return false;
		}
			
			$query2 = "SELECT purchase_id FROM product_purchase WHERE ".$str;
			// echo $query2;
			// die();

			$results2 = mysqli_query($con, $query2);
			$productids = array();
			while ($row = mysqli_fetch_assoc($results2)) {
				// $productids[] = $row;
				array_push($productids,$row['purchase_id']);
			}

			$response['data'] = array("status"=>'true', "data"=>$productids, "order_type"=>"purchase");
		
		// 	$response['data'] = array("status"=>"false","message"=>'Request parameter Required');

		

		return $response;

	}
	
	

	



	/*Function: getItemDetail 

	* Create By: Rizwan

	* Create Date: 22 November 2018

	* @Params: Item id

	* @Output: Item Array

	*/



	function getItemDetail($con, $json){
		// $dbname= $json->data->{'nameSet'};
		// if($dbname !=''){
		// 		$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
		// 	}else{
		// 		$dbname = "wholesale_v3";
		// 		$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
		// 	}		
		$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
		$product_id = $json->data->{'product_id'};
		$po = $json->data->{'po'};
		$order_type = $json->data->{'order_type'};
		$purchase_detail_id = $json->data->{'purchase_detail_id'};
		if($product_id!="" && $po!=""){
			if($order_type=="purchase"){
			 $query = "SELECT a.product_id,a.product_details, a.supplier_id, a.category_id, a.product_name, a.cartoon_quantity, a.pallet_quantity, a.innercart_quantity, a.lot_flag, a.expiry_flag, a.serial_flag, b.quantity, b.rate, b.total_amount, a.image, b.unit, ifnull((select SUM(total_quantity) from purchase_receipt_order where purchase_id = '".$po."'),'0') as total_quantity_received,a.unit_values,(SELECT ifnull(sum(total_quantity),0) FROM `purchase_receipt_order` where purchase_id = '".$po."'  and is_web<>1) as receivedqty,(SELECT sum(quantity)  FROM `product_purchase_details` where purchase_id = '".$po."'  and product_id=".$product_id.") as poqty   FROM product_information as a, product_purchase_details as b WHERE a.product_id = b.product_id AND a.product_id = ".$product_id."  AND b.purchase_id = '".$po."' AND a.status = 1 AND b.purchase_detail_id = '".$purchase_detail_id."'";
			}else if($order_type=="receipt"){
				$query = "SELECT a.product_id, a.supplier_id, a.category_id, a.product_name, a.cartoon_quantity, a.pallet_quantity, a.innercart_quantity, a.lot_flag, a.expiry_flag, a.serial_flag, b.quantity, b.rate, b.total_amount, a.image, b.unit, b.unit,  ifnull((select SUM(total_quantity) from purchase_receipt_order where purchase_id = '".$po."'),'0') as total_quantity_received,a.unit_values FROM product_information as a, product_receipt_details as b WHERE a.product_id = b.product_id AND a.product_id = ".$product_id."  AND b.receipt_id = '".$po."' AND a.status = 1 AND b.receipt_detail_id = '".$purchase_detail_id."'";
			}

			$results = mysqli_query($con, $query);

			$productinfo = [];

			if(mysqli_num_rows($results)>0){

				while ($row = mysqli_fetch_assoc($results)) {

					$productinfo[] = $row;

				}

				$querySelect = "SELECT SUM(total_quantity) as totalQuantityReceivedYet FROM purchase_receipt_order WHERE product_id = ".$product_id." AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' and is_web = 0";
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
		// $con = connection($json->data->{'nameSet'});
		// $dbname= $json->data->{'nameSet'};
		// if($dbname !=''){
		// 		$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
		// 	}else{
		// 		$dbname = "wholesale_v3";
		// 		$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
		// 	}	
		$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
		$product_id = $json->data->{'product_id'};
		$po = $json->data->{'po'};
		$cartoon_quantity = $json->data->{'cartoon_quantity'};
		$pallet_quantity = $json->data->{'pallet_quantity'};
		$innercart_quantity = $json->data->{'innercart_quantity'};
		$itemquantity = $json->data->{'itemquantity'};
		$order_type = $json->data->{'order_type'};
		$total_quantity = $json->data->{'total_quantity'};
		$datateimett = $json->data->{'timestamp_gropby'};
		$lot = $json->data->{'lot'};

		$serial_number = $json->data->{'serial_number'};
		$expiry_date = $json->data->{'expiry_date'};
		$sell_date = $json->data->{'sell_date'};
		$unit_values = $json->data->{'unit_values'};
		$purchase_detail_id = $json->data->{'purchase_detail_id'};
		$user_id = $json->data->{'user_id'};
												 

		$totalQuantityReceived = 0;
		$queryArr = [];
		$labell = 0;
		foreach($itemquantity as $qty){
			/*if($qty->per=="CARTON"){
				$totalQuantityReceived +=  $qty->qty * $cartoon_quantity;	
			}else if($qty->per=="PALLET"){
				$totalQuantityReceived +=  $qty->qty * $pallet_quantity;
			}else{
				$totalQuantityReceived += $qty->qty;
			}*/
			$labell = $qty->label;
			if($order_type=='purchase'){
				 $query = "SELECT * FROM purchase_receipt_order WHERE unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND is_deleted = 0 AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND serial_number='' AND is_web=1";
				$results = mysqli_query($con, $query);
				$dataQuantity = mysqli_fetch_array($results);
				#echo sizeof($dataQuantity);die;
				if(sizeof($dataQuantity)>0 && $dataQuantity['quantity']==$qty->qty){
					  $updatequery = "UPDATE purchase_receipt_order SET user_id = ".$user_id.", serial_number = '".$serial_number."', expiry_date = '".$expiry_date."', sell_date = '".$sell_date."' WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND quantity = '".$qty->qty."'";
					 mysqli_query($con, $updatequery);
					
				}else{
					# $updatequery = "UPDATE purchase_receipt_order SET is_deleted = 1 WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->	per3."' AND quantity = '".$qty->qty."'";
					
					$updateQuery = "DELETE FROM `purchase_receipt_order` WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."'";
					 mysqli_query($con, $updatequery);	
		
					$insertQuery = "INSERT INTO purchase_receipt_order(`purchase_id`, `type`, `unit`, `per`, `per2`, `per3`, `quantity`, `label`, `product_id`, `total_quantity`, `serial_number`, `expiry_date`, `purchase_detail_id`, `sell_date`, `user_id`,`lot`,datagrp) VALUES('".$po."', 1, '".$qty->unit."', '".$qty->per."', '".$qty->per2."', '".$qty->per3."', ".$qty->qty.", '".$qty->label."', ".$product_id.", ".$total_quantity.", '".$serial_number."', '".$expiry_date."', '".$purchase_detail_id."', '".$sell_date."', '".$user_id."', '".$lot."', '".$datateimett."')";
					 
				}				
			}else if($order_type=='receipt'){
			 	$insertQuery = "INSERT INTO purchase_receipt_order(`receipt_id`, `type`, `unit`, `per`, `per2`, `per3`, `quantity`, `label`, `product_id`, `total_quantity`, `serial_number`, `expiry_date`, `purchase_detail_id`, `sell_date`,`lot`,datagrp) VALUES('".$po."', 2, '".$qty->unit."', '".$qty->per."', '".$qty->per2."', '".$qty->per3."', ".$qty->qty.", '".$qty->label."', ".$product_id.", ".$total_quantity.", '".$serial_number."', '".$expiry_date."', '".$purchase_detail_id."', '".$sell_date."', '".$user_id."', '".$datateimett."')";	
			}
			// echo($insertQuery);
			// die();
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

		 $querySelect = "SELECT SUM(total_quantity) as totalQuantityReceivedYet FROM purchase_receipt_order WHERE product_id = ".$product_id." AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND is_web = 0";
		$results = mysqli_query($con, $querySelect);
		$dataQuantity = mysqli_fetch_array($results);
		if($dataQuantity['totalQuantityReceivedYet']!="null" && $dataQuantity['totalQuantityReceivedYet']!=null){
			$ttlRcvd = $dataQuantity['totalQuantityReceivedYet'];
		}else{
			$ttlRcvd = 0;
		}
		mysqli_close($con);
		$response['data'] = array("status"=>"true","message"=>'Order Successfully', "totalQuantity"=>$ttlRcvd, "label"=>$labell);
		return $response;	
	}


	function updateOrderInfo($con, $json){
		$dbname= $json->data->{'nameSet'};
		if($dbname !=''){
				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			}else{
				$dbname = "wholesale_v3";
				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			}
			
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
		// $dbname= $json->data->{'nameSet'};
		// if($dbname !=''){
		// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	

		// }else{
		// 	$dbname = "wholesale_v3";
		// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	

		// }
	$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
		
		$label = $json->data->{'label'};
	    $r_id = $json->data->{'r_id'};
		$queryproduct_id = "SELECT * FROM purchase_receipt_order WHERE label = '".$label."' and is_web=0 and r_id=".$r_id." limit 1";
// 		echo $queryproduct_id;die;
		$resultproduct_id = mysqli_query($con, $queryproduct_id);
		
		$resultproduct_id = mysqli_fetch_array($resultproduct_id);

		/* print_r($resultproduct_id);die; */
		$product_id = $resultproduct_id['product_id'];
		
		// print_r($product_id);die;
		
		

		// $query = "SELECT product_name,product_details,total_quantity as quantity,location_unique_key FROM inventory_locations JOIN product_information ON inventory_locations.product_id = product_information.product_id  JOIN purchase_receipt_order ON inventory_locations.product_id = purchase_receipt_order.product_id  WHERE inventory_locations.product_id = '".$product_id."' GROUP BY location_unique_key"; // comment by tapan 17-05-2019
		
		
		
		$query = "SELECT *,(select product_name from product_information where product_id='".$product_id."') as product_name,(select product_details from product_information where product_id='".$product_id."') as product_details,(select total_quantity from purchase_receipt_order where label = '".$label."' and product_id = '".$product_id."' limit 0,1) as quantity,location_unique_key FROM inventory_locations WHERE inventory_locations.product_id = '".$product_id."' GROUP By location_unique_key";
		
		
		
		//  print_r($query);die;
		
		
		$result = mysqli_query($con, $query);
		$locationInfo = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$locationInfo[] = $row;
		}
		
		if(sizeof($locationInfo) < 1){
			$query = "select a.product_name,a.product_details,b.total_quantity as quantity,'' as location_unique_key from product_information as a, purchase_receipt_order as b where b.label = '".$label."' and a.product_id =b.product_id  and a.product_id ='".$product_id."'";
			$result = mysqli_query($con, $query);
			$locationInfo = [];
			
			while ($row = mysqli_fetch_assoc($result)) {
				$locationInfo[] = $row;
			}
			// print_r($locationInfo);die;
		}
		$response['data'] = array("status"=>"true","locations"=>$locationInfo);
		return $response;		
	}
	
	function updatePutAwayLocation($con, $json){
		// $dbname= $json->data->{'nameSet'};
		 $con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");	
		// if($dbname !=''){
		// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	

		// }else{
		// 	$dbname = "wholesale_v3";
		// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
		// }
		
		$label = $json->data->{'label'};
		$location_unique_key = $json->data->{'location_unique_key'};
		$user_id = $json->data->{'user_id'};
		
		
		 $selectQuery = "SELECT * FROM purchase_receipt_order WHERE label = '".$label."' and is_web=0 ";
		$results = mysqli_query($con, $selectQuery);
	 
		$result = mysqli_fetch_array($results);
		$r_id = $result['r_id'];
		$productId = $result['product_id'];
		if(mysqli_num_rows($results) > 0){


		$selectQuery = "SELECT * FROM locations WHERE location_unique_key = '".$location_unique_key."'";
		$results = mysqli_query($con, $selectQuery);
// print_r(mysqli_num_rows($results));die;
		if(mysqli_num_rows($results) > 0){
						
							$selectquery = "SELECT * FROM inventory_locations WHERE label = '".$label."'";
							$results = mysqli_query($con, $selectquery);
							$dataQuantity = mysqli_fetch_array($results);
							// print_r("rinky");
							// print_r(mysqli_num_rows($results));die;
							// if(sizeof($dataQuantity)>0){
								
							if(mysqli_num_rows($results) >0){
								$insertQuery = "UPDATE inventory_locations SET location_unique_key = '".$location_unique_key."', updated_at = NOW(), updated_by = '".$user_id."', product_id = '".$result['product_id']."' WHERE label = '".$label."'";
							
							
							}else{	
								$insertQuery = "INSERT INTO inventory_locations(`label`, `location_unique_key`, `created_at`, `updated_at`, `created_by`, `updated_by`, `product_id`,r_id) VALUES('".$label."','".$location_unique_key."',NOW(),NOW(),'".$user_id."','".$user_id."','".$productId."',".$r_id.")";
							}
							// echo "tayyab";  
							// print_r($insertQuery);exit;
							mysqli_query($con, $insertQuery);

							$status = "true";
							$msg = "Location Updated!";

					}
					else{
						$status = "false";
						$msg = "This Location is not valid!";
					}
	}
	else{

		$status = "false";
		$msg = "This UNITID is not valid!";

	}
		
		$response['data'] = array("status"=>$status,"message"=>$msg);
		return $response;
	}

		function getTiketDetails($con, $json){
			$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
			// print_r($con);die;
			// $dbname= $json->data->{'nameSet'};
			// if($dbname !=''){
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }else{
			// 	$dbname = "wholesale_v3";
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }
			// $con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			
			$pt = $json->data->{'pt'};
			$r_id = $json->data->{'r_id'};
			if($pt!=''){
				#echo $query = "SELECT product_ticket_details.*, product_information.product_name, product_picking_order.picked_quantity FROM product_ticket_details JOIN product_information ON product_information.product_id = product_ticket_details.product_id LEFT JOIN product_picking_order ON product_ticket_details.ticket_detail_id = product_picking_order.ticket_detail_id WHERE product_ticket_details.ticket_id= '".$pt."' AND product_ticket_details.picking_status!='picked'";
				 /* $query = "SELECT product_ticket_details.*, product_information.product_name, SUM(product_picking_order.picked_quantity) as picked_quantity FROM product_ticket_details JOIN product_information ON product_information.product_id = product_ticket_details.product_id LEFT JOIN product_picking_order ON product_ticket_details.ticket_detail_id = product_picking_order.ticket_detail_id WHERE product_ticket_details.ticket_id= '".$pt."' GROUP BY product_ticket_details.ticket_detail_id";
				 $query = "SELECT product_ticket_details.*, product_information.product_name, SUM(product_picking_order.picked_quantity) as picked_quantity FROM product_ticket_details JOIN product_information ON product_information.product_id = product_ticket_details.product_id LEFT JOIN product_picking_order ON product_ticket_details.ticket_detail_id = product_picking_order.ticket_detail_id WHERE product_ticket_details.ticket_id= '".$pt."' GROUP BY product_ticket_details.ticket_detail_id"; */
				 
				 
				 
				 /* $query = "SELECT product_ticket_details.id, product_ticket_details.ticket_detail_id, product_ticket_details.ticket_id, product_ticket_details.product_id, product_ticket_details.quantity, product_ticket_details.each_quantity,  product_ticket_details.unit, product_ticket_details.location, product_ticket_details.rate, product_ticket_details.total_amount, product_ticket_details.status, product_ticket_details.picking_status, product_ticket_details.picking_details, product_ticket_details.created_at, product_ticket_details.is_deleted,sum(product_ticket_details.total_quantity) as total_quantity, product_information.product_name, SUM(product_picking_order.picked_quantity) as picked_quantity from product_information,product_ticket_details left join product_picking_order on product_picking_order.product_id=product_ticket_details.product_id and product_picking_order.ticket_id=product_ticket_details.ticket_id where product_ticket_details.product_id = product_information.product_id  and product_ticket_details.ticket_id= '".$pt."'  and total_quantity > ifnull(picked_quantity,0) GROUP by product_ticket_details.product_id, product_picking_order.product_id"; */
			
				$query = "call STR_epr_qtysum('".$pt."','".$r_id."')";
				$result = mysqli_query($con, $query);
				// print_r(mysqli_fetch_assoc($result));die;
				$ticketInfo = [];
				$totalPickedTickets = 0;
				
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['picking_status']== "picked"){
						$totalPickedTickets++;
					}else{
					$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
						 $query = "select ifnull(SUM(product_picking_order.picked_quantity),0) as picked_quantity FROM product_picking_order  WHERE ticket_detail_id = '".$row['ticket_detail_id']."'";
						 
						// $con = mysqli_connect("localhost","root","","wholesale_latest");
						 
						$results = mysqli_query($con, $query);
						
						$dataQuantity = mysqli_fetch_assoc($results);
						
						// if($dataQuantity)
						#print_r($dataQuantity);die;
						if($dataQuantity['picked_quantity'] == $row['quantity']){
							$updateeQuery = "UPDATE product_ticket_details SET picking_status = 'picked' WHERE ticket_detail_id = '".$row['ticket_detail_id']."'";
							$result = mysqli_query($con, $updateeQuery);
						}else{
							$ticketInfo[] = $row;
						}
					}
					
				}
				$rowcount=mysqli_num_rows($result);
								
				if($rowcount==$totalPickedTickets){
					$response['data'] = array("status"=>"false","msg"=>"This ticket is closed");
				}
				else{
					if(sizeof($ticketInfo)>0){
						$response['data'] = array("status"=>"true","locations"=>$ticketInfo);
					}else{
						$response['data'] = array("status"=>"false","msg"=>"No ticket found.");
					}
				}
			}else{
				$response['data'] = array("status"=>"false","message"=>'Request Parameter missing');
			}
			return $response;
		}
		
		function validatePicking($con, $json){
// 			$dbname= $json->data->{'nameSet'};
// 			if($dbname !=''){
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}else{
// 				$dbname = "wholesale_v3";
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}	
			
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
$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
			// $dbname= $json->data->{'nameSet'};
			// if($dbname !=''){
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }else{
			// 	$dbname = "wholesale_v3";
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }
			
			$product_id = $json->data->{'product_id'};
			$label = $json->data->{'label'};
			$location = $json->data->{'location'};
			
			$locationArr = explode("###", $location);
			if($product_id!="" && $label!=""){
				
				   
				    $query = "SELECT *,(purchase_receipt_order.total_quantity-purchase_receipt_order.quantity) as totalQty,purchase_receipt_order.id as pidset FROM purchase_receipt_order JOIN inventory_locations ON inventory_locations.label = purchase_receipt_order.label WHERE purchase_receipt_order.is_deleted = 0  AND purchase_receipt_order.product_id = '".$product_id."' AND inventory_locations.location_unique_key = '".$locationArr[0]."' and inventory_locations.label = '".$label."'  and purchase_receipt_order.unit <> '' AND purchase_receipt_order.is_web = 0 HAVING purchase_receipt_order.total_quantity  > 0 ORDER BY purchase_receipt_order.expiry_date ASC";
				 
				 
				  
				 
				  $labelQuery = "select * from (SELECT sum(purchase_receipt_order.total_quantity) as total_quantity, purchase_receipt_order.label, purchase_receipt_order.expiry_date,  inventory_locations.location_unique_key, product_information.product_name, product_information.product_details FROM purchase_receipt_order JOIN inventory_locations ON purchase_receipt_order.product_id = inventory_locations.product_id AND purchase_receipt_order.label = inventory_locations.label JOIN product_information ON purchase_receipt_order.product_id = product_information.product_id WHERE purchase_receipt_order.total_quantity != '' and inventory_locations.location_unique_key = '".$locationArr[0]."' AND purchase_receipt_order.product_id = '".$product_id."'  GROUP BY purchase_receipt_order.label HAVING total_quantity > 0 order by purchase_receipt_order.expiry_date asc) as a where a.expiry_date <> '' limit 0,1";
				  
				  
				   $labelResult = mysqli_query($con, $labelQuery);
					$labelInfo = [];
					while ($row = mysqli_fetch_assoc($labelResult)) {
						$labelInfo[] = $row;
					}
					
					if(sizeOf($labelInfo)>0){
						
					}else{
						$labelQuery = "SELECT sum(purchase_receipt_order.total_quantity) as total_quantity, purchase_receipt_order.label, purchase_receipt_order.expiry_date,  inventory_locations.location_unique_key, product_information.product_name, product_information.product_details FROM purchase_receipt_order JOIN inventory_locations ON purchase_receipt_order.product_id = inventory_locations.product_id AND purchase_receipt_order.label = inventory_locations.label JOIN product_information ON purchase_receipt_order.product_id = product_information.product_id WHERE purchase_receipt_order.total_quantity != '' and inventory_locations.location_unique_key =  '".$locationArr[0]."' AND purchase_receipt_order.product_id = '".$product_id."' GROUP BY purchase_receipt_order.label HAVING total_quantity > 0 order by purchase_receipt_order.expiry_date asc limit 0,1";
						$labelResult = mysqli_query($con, $labelQuery);
						$labelInfo = [];
						while ($row = mysqli_fetch_assoc($labelResult)) {
							$labelInfo[] = $row;
						}
					}
				   
				
				 
				 
				  
				$result = mysqli_query($con, $query);
				$purchaseInfo = [];
				while ($row = mysqli_fetch_assoc($result)) {
					$purchaseInfo[] = $row;
				}
				
				if(!empty($purchaseInfo)){
					
					
					
				/* if($purchaseInfo[0]['label']==$label){ */
				if($purchaseInfo[0]['label']==$label){
					$msg = '';
					
				}else{
					 $msg = "You must use this ".$purchaseInfo[0]['label']." Unit Id as it will expire earlier. Please go to location - ".$purchaseInfo[0]['location_unique_key']. ".\n Do you want to change unitID so click on cancel?";
				}
					$unit = $purchaseInfo[0]['unit'];
					$pidset = $purchaseInfo[0]['pidset'];
					/* $totalQtyEach = $purchaseInfo[0]['totalQty']; */ // comment on 23-05-2019
					$totalQtyEach = $purchaseInfo[0]['total_quantity'];
					
					$str = substr($unit, 0, strpos($unit, "###"));
					$str1 = substr($unit, 0, strpos($unit, "###"));
					$b = strpos($unit, "###");
					
					$strLast = substr($unit, $b);
					
					$querysum = "SELECT sum(purchase_receipt_order.total_quantity) as total_quantity, purchase_receipt_order.label, purchase_receipt_order.expiry_date, purchase_receipt_order.sell_date, purchase_receipt_order.lot, purchase_receipt_order.serial_number, inventory_locations.location_unique_key, product_information.product_name, product_information.product_details FROM purchase_receipt_order JOIN inventory_locations ON purchase_receipt_order.product_id = inventory_locations.product_id and purchase_receipt_order.label = inventory_locations.label JOIN product_information ON purchase_receipt_order.product_id = product_information.product_id WHERE purchase_receipt_order.total_quantity != '' AND purchase_receipt_order.product_id = '".$product_id."' and purchase_receipt_order.label = '".$label."'	GROUP BY purchase_receipt_order.label";
					
					
					
					 
					$result = mysqli_query($con, $querysum);
					$qtyInfo = [];
					while ($row = mysqli_fetch_assoc($result)) {
						$qtyInfo[] = $row;
					}
					if(!empty($qtyInfo)){
				
						if($qtyInfo[0]['total_quantity']=='' || $qtyInfo[0]['total_quantity']=='null'){
							$totalQtyEach = 0;
						}else{
							$totalQtyEach = $qtyInfo[0]['total_quantity'];
						}
					}  
					
					if($labelInfo[0]['label']==$label){
						$msg = '';
					}else{
						if(sizeof($labelInfo)>0){
							$msg = "You must use this ".$labelInfo[0]['label']." Unit Id as it will expire earlier. Please go to location - ".$labelInfo[0]['location_unique_key']. ".\n Do you want to change unitID so click on cancel?";
						}else{
							$msg ='';
						}
						
					}
					
					$response['data'] = array("status"=>"true","each"=>$totalQtyEach,"purchasereceiptorder"=>$pidset,"strLast"=>$strLast,"unitQty"=>$str1,"msg"=>$msg);
				/* }else{
					$response['data'] = array("status"=>"false","data"=>$purchaseInfo[0], "msg"=>"You must use this ".$purchaseInfo[0]['label']." Unit Id as it will expire earlier. Please go to location - ".$purchaseInfo[0]['location_unique_key'], "flag" => 1);
				} */
				}else{
					
					
				  /* $labelQuery ="SELECT sum(purchase_receipt_order.total_quantity) as total_quantity, purchase_receipt_order.label, purchase_receipt_order.expiry_date, inventory_locations.location_unique_key, product_information.product_name, product_information.product_details FROM purchase_receipt_order JOIN inventory_locations ON purchase_receipt_order.product_id = inventory_locations.product_id AND purchase_receipt_order.label = inventory_locations.label JOIN product_information ON purchase_receipt_order.product_id = product_information.product_id WHERE purchase_receipt_order.total_quantity != '' and inventory_locations.location_unique_key = '".$locationArr[0]."' AND purchase_receipt_order.product_id = '".$product_id."' GROUP BY purchase_receipt_order.label HAVING total_quantity > 0 order by purchase_receipt_order.expiry_date asc limit 0,1";
				   */
				   
				  
				    $labelQuery = "select * from (SELECT sum(purchase_receipt_order.total_quantity) as total_quantity, purchase_receipt_order.label, purchase_receipt_order.expiry_date,  inventory_locations.location_unique_key, product_information.product_name, product_information.product_details FROM purchase_receipt_order JOIN inventory_locations ON purchase_receipt_order.product_id = inventory_locations.product_id AND purchase_receipt_order.label = inventory_locations.label JOIN product_information ON purchase_receipt_order.product_id = product_information.product_id WHERE purchase_receipt_order.total_quantity != '' and inventory_locations.location_unique_key = '".$locationArr[0]."' AND purchase_receipt_order.product_id = '".$product_id."'  GROUP BY purchase_receipt_order.label HAVING total_quantity > 0 order by purchase_receipt_order.expiry_date asc) as a where a.expiry_date <> '' limit 0,1";
				  
				  
				   $labelResult = mysqli_query($con, $labelQuery);
					$labelInfo = [];
					while ($row = mysqli_fetch_assoc($labelResult)) {
						$labelInfo[] = $row;
					}
					
					if(sizeOf($labelInfo)>0){
						
					}else{
						$labelQuery = "SELECT sum(purchase_receipt_order.total_quantity) as total_quantity, purchase_receipt_order.label, purchase_receipt_order.expiry_date,  inventory_locations.location_unique_key, product_information.product_name, product_information.product_details FROM purchase_receipt_order JOIN inventory_locations ON purchase_receipt_order.product_id = inventory_locations.product_id AND purchase_receipt_order.label = inventory_locations.label JOIN product_information ON purchase_receipt_order.product_id = product_information.product_id WHERE purchase_receipt_order.total_quantity != '' and inventory_locations.location_unique_key =  '".$locationArr[0]."' AND purchase_receipt_order.product_id = '".$product_id."' GROUP BY purchase_receipt_order.label HAVING total_quantity > 0 order by purchase_receipt_order.expiry_date asc limit 0,1";
						$labelResult = mysqli_query($con, $labelQuery);
						$labelInfo = [];
						while ($row = mysqli_fetch_assoc($labelResult)) {
							$labelInfo[] = $row;
						}
					}
					
					if($labelInfo[0]['label']==$label){
						$msg = '';
					}else{
						if(sizeof($labelInfo)>0){
							$msg = "Please pick this ".$labelInfo[0]['label']." Unit Id.";
						}else{
							$msg ='Something is wrong';
						}
						
					}
					
					
					$response['data'] = array("status"=>"false","msg"=>$msg);
				}
			}else{
				$response['data'] = array("status"=>"false","msg"=>'Request Parameter missing');
			}
			return $response;
		}

		
		function getNextLabelAsPerPriority($con, $json){
// 			$dbname= $json->data->{'nameSet'};
// 			if($dbname !=''){
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}else{
// 				$dbname = "wholesale_v3";
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}
			
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
// 			$dbname= $json->data->{'nameSet'};
// 			if($dbname !=''){
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}else{
// 				$dbname = "wholesale_v3";
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}	
		
			$numberOfUnitIds = $json->data->{'numberOfUnitIds'};
			$location_unique_key = $json->data->{'location_unique_key'};

			$checkLocation = "SELECT * FROM locations WHERE location_unique_key = '".$location_unique_key."'";
			$resultsLocation = mysqli_query($con, $checkLocation);
			if(mysqli_num_rows($resultsLocation) > 0 ){

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
					
			}
			else{
					$response['data'] = array("status"=>"invalid","message"=>"This Location is not valid", "numberOfUnitIds"=> "0");
			}
			return $response;
		}


		function checkInventoryLocationByUnidID($con, $json){
// 			$dbname= $json->data->{'nameSet'};
// 			if($dbname !=''){
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}else{
// 				$dbname = "wholesale_v3";
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}	
		
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
// 			$dbname= $json->data->{'nameSet'};
// 			if($dbname !=''){
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}else{
// 				$dbname = "wholesale_v3";
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}	
		
			$unitid = $json->data->{'unitid'};
			$qtyofeaches = $json->data->{'qtyofeaches'};
			
			$checkLocation = "SELECT * FROM inventory_locations WHERE label = '".$unitid."'";
			$resultsLocation = mysqli_query($con, $checkLocation);
			if(mysqli_num_rows($resultsLocation) > 0 ){


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

			}else{
				
				$response['data'] = array("status"=>"invalid","message"=>"This UNITID is not valid", "qtyofeaches"=> "0");
			}
			return $response;
		}
		
		
		
		function updatePickingQty($con, $json){
			$dbname= $json->data->{'nameSet'};
			$purchasereceiptorderID= $json->data->{'purchasereceiptorderID'};
			$qtyString= $json->data->{'qtyString'};
			if($dbname !=''){
				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			}else{
				$dbname = "wholesale_v3";
				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			}
			
			$query = "update purchase_receipt_order set unit='".$qtyString."' where id='".$purchasereceiptorderID."'";
			$result = mysqli_query($con, $query);
		}
		
		
		function insertPicking($con, $json){
		$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");	
			// $dbname= $json->data->{'nameSet'};

			// if($dbname !=''){
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }else{
			// 	$dbname = "wholesale_v3";
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }		
		
			$requestdata = $json->data->{'requestdata'};
			// print_r($requestdata);die;
			foreach($requestdata as $req){
				$product_id = $req->{'product_id'};	
				$picked_quantity_serial = $req->{'picked_quantity_serial'};
				 $totalQuantityRecieved = array_sum($picked_quantity_serial);
				 
				 $sitearr = (count($picked_quantity_serial)-1);
				 $totalQuantityRecieved = $picked_quantity_serial[$sitearr];
				 
				 
				$ticket_detail_id = $req->{'ticket_detail_id'};
				
				$ticket_id = $req->{'ticket_id'};
				$location = $req->{'location'};
				$picked_status = $req->{'picked_status'};
				$user_id = $req->{'user_id'};
				$labnum = $req->{'labnum'};

				$r_id = $req->{'r_id'};
				
				$selectQuery = "SELECT ifnull(SUM(product_picking_order.picked_quantity),0) as picked_quantity FROM product_picking_order WHERE ticket_id = '".$ticket_id."' AND ticket_detail_id = '".$ticket_detail_id."' and product_id = '".$product_id."'";
				$results = mysqli_query($con, $selectQuery);
				$row = mysqli_fetch_assoc($results);
				 $pickedItemNumber = $row['picked_quantity'];
				 $totalQuantityReceived;
				 $latestPickedItemNumber = (int)$pickedItemNumber + (int)$totalQuantityRecieved;
				$selectQuery2 = "SELECT sum(quantity) as quantity FROM product_ticket_details WHERE ticket_id = '".$ticket_id."' and product_id = '".$product_id."'";
				$results2 = mysqli_query($con, $selectQuery2);
				$row2 = mysqli_fetch_assoc($results2);
				
				if($latestPickedItemNumber > $row2['quantity']){
					$response['data'] = array("status"=>"false","message"=>'Picking Quantity already matched.', "statusss"=>"finalize");
					return $response;
				}
#die;	
				
				//inserting into inventory table
				 $selectQueryForInventory = "SELECT inventory_locations.*, purchase_receipt_order.* FROM `inventory_locations` LEFT JOIN purchase_receipt_order ON inventory_locations.label = purchase_receipt_order.label WHERE inventory_locations.`location_unique_key` = '".$location."' AND inventory_locations.`product_id` = '".$product_id."'";
				$results = mysqli_query($con, $selectQueryForInventory);
				$row = mysqli_fetch_assoc($results);
				
				
				$insertQuery = "INSERT INTO product_picking_order(`ticket_id`,`ticket_detail_id`,`picked_quantity`,`picked_quantity_serial`,`product_id`,`location`,`updated_at`,`user_id`, `status`, `label`,`r_id`) VALUES('".$ticket_id."','".$ticket_detail_id."','".$totalQuantityRecieved."','".json_encode($picked_quantity_serial)."','".$product_id."','".$location."', NOW(), 1, '".$picked_status."', '".$labnum."',".$r_id.")";
				
				mysqli_query($con, $insertQuery);
				
				$updateQuery = "UPDATE product_ticket_details SET picking_status = '".$picked_status."' WHERE ticket_detail_id = '".$ticket_detail_id."' and product_id ='".$product_id."'";
				mysqli_query($con, $updateQuery);
				
				 $insertQueryinventory = "INSERT purchase_receipt_order(`label`, `purchase_id`, `purchase_detail_id`, `unit`, `type`, `total_quantity`, `user_id`, `product_id`,`r_id`) VALUES('".$labnum."', '".$row['purchase_id']."', '".$row['purchase_detail_id']."', '".$row['unit']."', 3, '"."-".$totalQuantityRecieved."', '".$user_id."', '".$product_id."',".$r_id.")";
				
				mysqli_query($con, $insertQueryinventory);
				
				
				
			}
			
			$selectQuery = "SELECT ifnull(SUM(product_picking_order.picked_quantity),0) as picked_quantity FROM product_picking_order WHERE ticket_id = '".$ticket_id."'  and product_id = '".$product_id."'";
				$results = mysqli_query($con, $selectQuery);
				$row = mysqli_fetch_assoc($results);
				 $pickedItemNumber = $row['picked_quantity'];
				 
			if($pickedItemNumber == $row2['quantity']){
				$qty = "1";
			}else{
				$qty = "0";
			}
			
			$response['data'] = array("status"=>"true","message"=>'Order added Successfully',"qty"=>$qty,"latestPickedItemNumber"=>$pickedItemNumber,"QTY"=>$row2['quantity']);
			return $response;
			
			
		}
		
		function checkUnitId($con, $json){
// 			$dbname= $json->data->{'nameSet'};
// 			if($dbname !=''){
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}else{
// 				$dbname = "wholesale_v3";
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}	
		
			$unitd = $json->data->{'unitd'};
			if($unitd!=""){
				//$query = "SELECT * FROM inventory_locations WHERE label = '".$unitd."'";
				$query = "SELECT inventory_locations.*, SUM(purchase_receipt_order.total_quantity) as totalquantity FROM `inventory_locations` JOIN purchase_receipt_order ON inventory_locations.label = purchase_receipt_order.label WHERE inventory_locations.`label` = '".$unitd."'";
				$results = mysqli_query($con, $query);
				$row = mysqli_fetch_assoc($results);
				if(!empty($row)){
					$response['data'] = array("status"=>"true","data"=>$row);
				}else{
					$response['data'] = array("status"=>"false","message"=>'No data found.');
				}
			}else{
				$response['data'] = array("status"=>"false","message"=>'Unit Id is blank');
			}
			
			return $response;
		}
		
		function pickCheckoutItem($con, $json){
			$dbname= $json->data->{'nameSet'};
			if($dbname !=''){
				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			}else{
				$dbname = "wholesale_v3";
				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			}		
		
			$unitid = $json->data->{'unitid'};	
			$picking = $json->data->{'picking'};
			$user_id = $json->data->{'user_id'};
			
			$query = "SELECT inventory_locations.*, SUM(purchase_receipt_order.total_quantity) as totalquantity, purchase_receipt_order.purchase_id, purchase_receipt_order.purchase_detail_id, purchase_receipt_order.unit, inventory_locations.product_id  FROM `inventory_locations` JOIN purchase_receipt_order ON inventory_locations.label = purchase_receipt_order.label WHERE inventory_locations.`label` = '".$unitid."'";
			$results = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($results);
			
			 $insertQueryinventory = "INSERT purchase_receipt_order(`label`, `purchase_id`, `purchase_detail_id`, `unit`, `type`, `total_quantity`, `user_id`, `product_id`) VALUES('".$unitid."', '".$row['purchase_id']."', '".$row['purchase_detail_id']."', '".$row['unit']."', 3, '"."-".$picking."', '".$user_id."', '".$row['product_id']."')";
			
			$update = mysqli_query($con, $insertQueryinventory);
			
			 $insertCheckoutInventory = "INSERT INTO checkout_inventory(`label`, `picking`, `product_id`, `user_id`) VALUES('".$unitid."', '".$picking."', '".$row['product_id']."', '".$user_id."')";
			
			$update1 = mysqli_query($con, $insertCheckoutInventory);
			#if(mysqli_affected_rows($update)>0 && mysqli_affected_rows($update1)>0){
				$response['data'] = array("status"=>"true","message"=>'Inserted Successfully');
			#}else{
			#	$response['data'] = array("status"=>"false","message"=>'Not inserted');
			#}
			
			return $response;
		}
		
		function forgetpassword($con, $json){
// 			$dbname= $json->data->{'nameSet'};
// 			if($dbname !=''){
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}else{
// 				$dbname = "wholesale_v3";
// 				$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
// 			}		
		
			$email = $json->data->{'username'};
			$query = "SELECT * FROM user_login WHERE username = '".$email."' AND status = 1";
			$results = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($results);
			if(!empty($row) && sizeof($row)>0){
			
			
			//setting new password
			$password = rand(1000,10000);
			$newpassword = md5("gef".$password);
			$query = "UPDATE user_login SET password = '".$newpassword."' WHERE id=".$row['id']." AND username= '".$email."'";
			
			mysqli_query($con, $query);
			
			
			$mail = new PHPMailer(true);

			  try{

			// $mail->SMTPDebug = 1                              // Enable verbose debug output



			//$mail->isSMTP();                                      // Set mailer to use SMTP

			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers

			$mail->SMTPAuth = true;                               // Enable SMTP authentication

			$mail->Username = 'mindcrewtest1001@gmail.com';                 // SMTP username

			$mail->Password = 'mahi1990**';                     // SMTP password

			$mail->Port = 465;        

			$mail->SMTPSecure = 'ssl';

			$mail->SMTPAuth = true;                            // TCP port to connect to



			$mail->setFrom('admin@wm-simplified.com', 'WM-Simplified');

			// $mail->addReplyTo($json->data->{'email'}, 'First Last');

			// $mail->From = $json->data->{'email'};

			$mail->isHTML(true);

			$mail->addAddress($email); 

			$mail->Subject = 'WM-Simplified New Password.';

			$mail->Body    = '<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Password Reset</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type="text/css">
         /**
         * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
         */
         @media screen {
         @font-face {
         font-family: "Source Sans Pro";
         font-style: normal;
         font-weight: 400;
         src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format("woff");
         }
         @font-face {
         font-family: "Source Sans Pro";
         font-style: normal;
         font-weight: 700;
         src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format("woff");
         }
         }
         /**
         * Avoid browser level font resizing.
         * 1. Windows Mobile
         * 2. iOS / OSX
         */
         body,
         table,
         td,
         a {
         -ms-text-size-adjust: 100%; /* 1 */
         -webkit-text-size-adjust: 100%; /* 2 */
         }
         /**
         * Remove extra space added to tables and cells in Outlook.
         */
         table,
         td {
         mso-table-rspace: 0pt;
         mso-table-lspace: 0pt;
         }
         /**
         * Better fluid images in Internet Explorer.
         */
         img {
         -ms-interpolation-mode: bicubic;
         }
         /**
         * Remove blue links for iOS devices.
         */
         a[x-apple-data-detectors] {
         font-family: inherit !important;
         font-size: inherit !important;
         font-weight: inherit !important;
         line-height: inherit !important;
         color: inherit !important;
         text-decoration: none !important;
         }
         /**
         * Fix centering issues in Android 4.4.
         */
         div[style*="margin: 16px 0;"] {
         margin: 0 !important;
         }
         body {
         width: 100% !important;
         height: 100% !important;
         padding: 0 !important;
         margin: 0 !important;
         }
         /**
         * Collapse table borders to avoid space between cells.
         */
         table {
         border-collapse: collapse !important;
         }
         a {
         color: #1a82e2;
         }
         img {
         height: auto;
         line-height: 100%;
         text-decoration: none;
         border: 0;
         outline: none;
         }
      </style>
   </head>
   <body style="background-color: #fff;">
      <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
         A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
      </div>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
         <tr>
            <td align="center" bgcolor="#fff">
               <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <tr>
                     <td align="center" valign="top" style="padding: 36px 24px;">
                        <a href="https://sendgrid.com" target="_blank" style="display: inline-block;">
                        <img src="http://wholesale.plumkit.com/my-assets/image/logo/ce7168f07924880099439a9cb3605b98.jpg" alt="Logo" border="0" width="100" style="display: block; width: 100px; max-width: 100px; min-width: 100px;">
                        </a>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td align="center" bgcolor="#fff">
               <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <tr>
                     <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                        <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">WM Simplified New Password</h1>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td align="center" bgcolor="#fff">
               <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                  <tr>
                     <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <p style="margin: 0;">Hello '.$email.'</p>
                        <p style="margin: 0;">Your New Password is <b>'.$password.'</b></p>
                        <p style="margin: 0;"></p>
                     </td>
                  </tr>
                  <tr>
                     <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                        <p style="margin: 0;">Thanks,<br> WM-Simplified</p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>';



			if($mail->send()) {

			  $response['data'] = array("status"=>'true', "msg"=>"Mail sent successfully");

			} else {

			  $response['data'] = array("status"=>'false', "msg"=>"Mail not sent");

			}

			

		  }catch(phpmailerException $e){

			$response['data'] = array("status"=>'false', "msg"=>"Mail not sent");

			

		  }
		   #echo 'Mailer Error: ' . $mail->ErrorInfo;
			#	print_r($response);
			#	die;
			}else{
				$response['data'] = array("status"=>"false","message"=>'User not found.');
			}
			return $response;
		}
		
		// function checkUserLicensing($con, $json){
		// 	$dbname= $json->data->{'nameSet'};
		// 	if($dbname == ''){
		// 		$dbname = "wholesale_v3";
		// 	}
		// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);		
		
		// 	$query = "SELECT * FROM user_licensing WHERE id = 1";
		// 	$results = mysqli_query($con, $query);
		// 	$dataQuantity = mysqli_fetch_array($results);
		// 	$date1 = date('Y-m-d');
		// 	$date2 = $dataQuantity['license_last_date'];
		// 	$difference = datedifference($date1, $date2);
		// 	if($difference>0){
		// 		$response['data'] = array("status"=>'true');
		// 	}else{
		// 		$response['data'] = array("status"=>'false');
		// 	}
		// 	//$response['data'] = array("status"=>'true', "data"=>$licenseData);
		// 	return $response;

		// }
		
		function datedifference($date1, $date2){
			$date1 = new DateTime($date1);
			$date2 = new DateTime($date2);
			$interval = $date1->diff($date2);
			return $interval->days;
			
		}
	
		function multipleAddress($con,$json){
			//$con = connection($json->data->{'nameSet'});
			// $dbname= $json->data->{'nameSet'};
			// if($dbname !=''){
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }else{
			// 	$dbname = "wholesale_v3";
			// 	$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// }		
		$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
			$customer_id = $json->data->{'customer_id'};
			$query =  'select * from tbl_customer_address where customer_id="'.$customer_id.'"';
			// echo $query;die;
			$result = mysqli_query($con, $query);
			$locationInfo = [];
			while ($row = mysqli_fetch_assoc($result)) {
				$locationInfo[] = $row;
			}
			$response['data'] = array("status"=>"true","address"=>$locationInfo);
			return $response;
		}
		
		
		
		
		
		
		function updateItemPO_loop($con, $json){
			// $con = connection($json->data->{'nameSet'});
			// $dbname= $json->data->{'nameSet'};
			// if($dbname !=''){
			// 		$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// 	}else{
			// 		$dbname = "wholesale_v3";
			// 		$con = mysqli_connect("localhost","mindcrew","Mindcrew01",$dbname);	
			// 	}	
	   //  	$con = mysqli_connect("localhost", "mindcrew","Mindcrew01","wholesale_latest");
			$product_id = $json->data->{'product_id'};
			$po = $json->data->{'po'};
			$cartoon_quantity = $json->data->{'cartoon_quantity'};
			// echo $cartoon_quantity;die;
			$pallet_quantity = $json->data->{'pallet_quantity'};
			$innercart_quantity = $json->data->{'innercart_quantity'};
			$itemquantity = $json->data->{'itemquantity'};
			$order_type = $json->data->{'order_type'};
			$total_quantity = $json->data->{'total_quantity'};
			$datateimett = $json->data->{'timestamp_gropby'};
			$lot = $json->data->{'lot'};
	
			$serial_number = $json->data->{'serial_number'};
			$expiry_date = $json->data->{'expiry_date'};
			$sell_date = $json->data->{'sell_date'};
			$unit_values = $json->data->{'unit_values'};
			$purchase_detail_id = $json->data->{'purchase_detail_id'};
			$user_id = $json->data->{'user_id'};
			$qtyyy = $json->data->{'qtyyy'};
			$unit = $json->data->{'unit'};
													 
	
			$select="select * from product_purchase where purchase_id = '".$po."'";
			$res=mysqli_query($con,$select);
			$r=mysqli_fetch_assoc($res);
			$r_id= $r['r_id'];
			
// 			echo $r_id; die;
			$qtyyy = (int)($qtyyy);
// 			echo $qtyyy;die;
			
			for($i = 0; $i < $qtyyy; $i++){
				$queryArr = [];
				$totalQuantityReceived = 0;
			
			$labell = 0;
			
				list($msec, $sec) = explode(' ', microtime());
	
				$label = $time_milli = $sec.substr($msec, 2, 3);
				// echo $label;die;
	
				$itemquantityArray = [];
				$itemquantityArray = array(array("qty"=>1,"per"=>"","per2"=>"","per3"=>"","label"=>$label,"unit"=>$unit));
			
				$convertedObj = ToObject($itemquantityArray); 
				
			foreach($convertedObj as $qty){
				/*if($qty->per=="CARTON"){
					$totalQuantityReceived +=  $qty->qty * $cartoon_quantity;	
				}else if($qty->per=="PALLET"){
					$totalQuantityReceived +=  $qty->qty * $pallet_quantity;
				}else{
					$totalQuantityReceived += $qty->qty;
				}*/
				$labell = $qty->label;
				// echo 	$labell; die;
				// echo $order_type;die;
				if($order_type=='purchase'){
					 $query = "SELECT * FROM purchase_receipt_order WHERE unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND is_deleted = 0 AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND serial_number=''";
					
					 $results = mysqli_query($con, $query);
					$dataQuantity = mysqli_fetch_array($results);
					// echo sizeof($dataQuantity);
					if(sizeof($dataQuantity)>0 && $dataQuantity['quantity']==$qty->qty){
						  $updatequery = "UPDATE purchase_receipt_order SET user_id = ".$user_id.", serial_number = '".$serial_number."', expiry_date = '".$expiry_date."', sell_date = '".$sell_date."' WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."' AND quantity = '".$qty->qty."'";
						 mysqli_query($con, $updatequery);
						 echo 1;
						 die;
						
					}else{
						# $updatequery = "UPDATE purchase_receipt_order SET is_deleted = 1 WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->	per3."' AND quantity = '".$qty->qty."'";
						
						$updateQuery = "DELETE FROM `purchase_receipt_order` WHERE purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND unit = '".$qty->unit."' AND per = '".$qty->per."' AND per2 = '".$qty->per2."' AND per3 = '".$qty->per3."'";
						 mysqli_query($con, $updatequery);
				// 		 print_r($updateQuery);
						 	
			
						$query = "INSERT INTO purchase_receipt_order(`r_id`,`purchase_id`, `type`, `unit`, `per`, `per2`, `per3`, `quantity`, `label`, `product_id`, `total_quantity`, `serial_number`, `expiry_date`, `purchase_detail_id`, `sell_date`, `user_id`,`lot`,datagrp) VALUES('.$r_id.','".$po."', 1, '".$qty->unit."', '".$qty->per."', '".$qty->per2."', '".$qty->per3."', ".$qty->qty.", '".$qty->label."', ".$product_id.", ".$total_quantity.", '".$serial_number."', '".$expiry_date."', '".$purchase_detail_id."', '".$sell_date."', '".$user_id."', '".$lot."', '".$datateimett."')";
						echo 2;
						echo $query;die;
					}				
				}else if($order_type=='receipt'){
					$query = "INSERT INTO purchase_receipt_order(`r_id`,`receipt_id`, `type`, `unit`, `per`, `per2`, `per3`, `quantity`, `label`, `product_id`, `total_quantity`, `serial_number`, `expiry_date`, `purchase_detail_id`, `sell_date`,`lot`,datagrp) VALUES('.$r_id.','".$po."', 2, '".$qty->unit."', '".$qty->per."', '".$qty->per2."', '".$qty->per3."', ".$qty->qty.", '".$qty->label."', ".$product_id.", ".$total_quantity.", '".$serial_number."', '".$expiry_date."', '".$purchase_detail_id."', '".$sell_date."', '".$user_id."', '".$datateimett."')";	
					 echo 3;
					 die;	
					}
				// 
				//
				$queryArr[] = $query;
				// print_r($queryArr);
				// die();
			}
			
			
			
			
			#print_r($queryArr);die;
			if($total_quantity<=0){
				$response['data'] = array("status"=>"false","message"=>'No product quantity found.');
				return $response;
			}
			
			
			//  print_r($queryArr); die; 
			foreach($queryArr as $qrr){
				#echo $qrr.'<br>';
				mysqli_query($con, $qrr);
			}
			$query = "UPDATE product_information SET cartoon_quantity = '".$cartoon_quantity."', pallet_quantity = '".$pallet_quantity."', innercart_quantity = '".$innercart_quantity."',unit_values='".$unit_values."' WHERE product_id = ".$product_id."";
			mysqli_query($con, $query);
			
			}
			
			
			
			
			
			/*if($order_type=='purchase'){
				$updateQuery = "UPDATE product_purchase_details SET quantity_receipt = ".$totalQuantityReceived." WHERE purchase_id = ".$po." AND product_id=".$product_id."";
			}else if($order_type=='receipt'){
				$updateQuery = "UPDATE product_receipt_details SET quantity_receipt = ".$totalQuantityReceived." WHERE receipt_id = ".$po." AND product_id=".$product_id."";
			}
			mysqli_query($con, $updateQuery);	*/
	
			 $querySelect = "SELECT SUM(total_quantity) as totalQuantityReceivedYet FROM purchase_receipt_order WHERE product_id = ".$product_id." AND purchase_id = '".$po."' AND purchase_detail_id = '".$purchase_detail_id."' AND is_web = 0";
			$results = mysqli_query($con, $querySelect);
			$dataQuantity = mysqli_fetch_array($results);
			if($dataQuantity['totalQuantityReceivedYet']!="null" && $dataQuantity['totalQuantityReceivedYet']!=null){
				$ttlRcvd = $dataQuantity['totalQuantityReceivedYet'];
			}else{
				$ttlRcvd = 0;
			}
			
			 $queryLabelshow = "SELECT label FROM `purchase_receipt_order` WHERE purchase_id= '".$po."' ORDER by id desc limit ". $qtyyy;
			 
			$queryLabelshowResult = mysqli_query($con, $queryLabelshow);
			$dataqueryLabelshowResultArray = [];
			while ($row = mysqli_fetch_assoc($queryLabelshowResult)) {
				$dataqueryLabelshowResultArray[] = $row;
			}
			
			// / $dataqueryLabelshowResult = mysqli_fetch_array($queryLabelshowResult); /
			mysqli_close($con);
			$response['data'] = array("status"=>"true","message"=>'Order Successfully', "totalQuantity"=>$ttlRcvd, "label"=>$labell,"printLabel"=>$dataqueryLabelshowResultArray);
			return $response;	
		}
	

	function ToObject($Array) { 
      
    // Create new stdClass object 
    $object = new stdClass(); 
      
    // Use loop to convert array into 
    // stdClass object 
    foreach ($Array as $key => $value) { 
        if (is_array($value)) { 
            $value = ToObject($value); 
        } 
        $object->$key = $value; 
    } 
    return $object; 
} 
		
		
?>
