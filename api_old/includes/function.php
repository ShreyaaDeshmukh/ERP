<?php

	function barberRegister($con,$json)
	{
		$getData = mysqli_query($con,"SELECT id FROM barberUsers where email = '".$json->barberRegister->{'email'}."' and userType='barber'");
		if(mysqli_num_rows($getData) > 0)
		{
			$response['registerData'] = array("message"=>'alreadyExist');
		}
		else
		{
			$query = mysqli_query($con,"INSERT INTO barberUsers (storeLocation,email,businessName,phoneNumber,password,lat,lng)VALUES ( '".$json->barberRegister->{'storeLocation'}."', '".$json->barberRegister->{'email'}."', '".$json->barberRegister->{'businessName'}."', '".$json->barberRegister->{'phoneNumber'}."', '".$json->barberRegister->{'password'}."', '".$json->barberRegister->{'lat'}."', '".$json->barberRegister->{'lng'}."' )");
			if($query)
			{
				$response['registerData'] = array("message"=>'true',"userId"=>mysqli_insert_id($con));	
			}
			else{
				$response['registerData'] = array("message"=>'false');	
			}
			
		}
		return $response;
	}


	function barberLogin($con,$json)
	{
		$getData = mysqli_query($con,"SELECT id ,storeLocation,email,businessName,phoneNumber,image FROM barberUsers where email = '".$json->barberLogin->{'email'}."' and password = '".$json->barberLogin->{'password'}."' and userType='barber'");
		if(mysqli_num_rows($getData) > 0)
		{
			while($row = mysqli_fetch_array($getData))
			{
				$response['userDetail'] = array("message"=>"successfully","userId"=>$row['id'],"email"=>$row['email'],"storeLocation"=>$row['storeLocation'],"phoneNumber"=>$row['phoneNumber'],"businessName"=>$row['businessName'],"Image"=>$row['image']);
			}		
		}
		else
		{
			$response['userDetail'] = array("message"=>"wrongCredentials");			
		}
		return $response;
	}

	function barberGetProfile($con,$json)
	{
		$getData = mysqli_query($con,"SELECT id,storeLocation,email,businessName,phoneNumber,image,username FROM barberUsers where id = '".$json->barberGetProfile->{'userId'}."' ");
		if(mysqli_num_rows($getData) > 0)
		{
			while($row = mysqli_fetch_array($getData))
			{
				$response['profileDetail'] = array("message"=>"profileLoaded","userId"=>$row['id'],"email"=>$row['email'],"storeLocation"=>$row['storeLocation'],"phoneNumber"=>$row['phoneNumber'],"businessName"=>$row['businessName'],"Image"=>$row['image'],"username"=>$row['username']);
			}		
		}
		else
		{
			$response['profileDetail'] = array("message"=>"profileNotLoaded");			
		}
		return $response;
	}

	function barberUpdateProfile($con,$json)
	{
		$getData = mysqli_query($con,"SELECT email FROM barberUsers where email = '".$json->barberUpdateProfile->{'email'}."' and userType = 'barber' and id != '".$json->barberUpdateProfile->{'userId'}."' ");
		if(mysqli_num_rows($getData) > 0)
		{
			$response['updateProfile'] = array("message"=>'false',"imagename"=>'NoImage');
		}
		else
		{	
			$filename = 'NoImage';
			mysqli_query($con, "UPDATE barberUsers set username = '".$json->barberUpdateProfile->{'username'}."', email='".$json->barberUpdateProfile->{'email'}."', phoneNumber =  '".$json->barberUpdateProfile->{'phoneNumber'}."', storeLocation =  '".$json->barberUpdateProfile->{'storeLocation'}."' where id = '".$json->barberUpdateProfile->{'userId'}."' ");
			// $filename = 'noImage';
			if($json->barberUpdateProfile->{'image'} != '' && $json->barberUpdateProfile->{'image'} != null && $json->barberUpdateProfile->{'image'} != undefined)
			{	
				define('UPLOAD_DIR', 'uploads/barberProfile/');
				$data = base64_decode($json->barberUpdateProfile->{'image'});
				// $filename = $json->barberUpdateProfile->{'userId'}.'.jpg';
				$filename = $json->barberUpdateProfile->{'userId'}."_".date("Ymdhis").'.jpg';
				$file = UPLOAD_DIR . $json->barberUpdateProfile->{'userId'}.'_'.date("Ymdhis").'.jpg';
				$success = file_put_contents($file, $data);
				mysqli_query($con, "UPDATE barberUsers set image = '".$filename."' where id = '".$json->barberUpdateProfile->{'userId'}."' ");
			}	
			$response['updateProfile'] = array("message"=>'true',"imagename"=>$filename);			
		}
		return $response;
	}

	function barberAddService($con,$json)
	{		
		$query = mysqli_query($con, "INSERT INTO barberServices (barberUser,name,price,speciality,create_at)VALUES ( '".$json->barberAddService->{'userId'}."','".$json->barberAddService->{'name'}."','".$json->barberAddService->{'price'}."','".$json->barberAddService->{'speciality'}."',Now())");
		if($query)
		{ 
			$lastId = mysqli_insert_id($con);
			if($json->barberAddService->{'image'} != '' && $json->barberAddService->{'image'} != null && $json->barberAddService->{'image'} != undefined)
			{
				define('UPLOAD_DIR', 'uploads/services/');
				$data = base64_decode($json->barberAddService->{'image'});
				$filename = $lastId."_".date("Ymdhis").'.jpg';
				$file = UPLOAD_DIR . $lastId.'_'.date("Ymdhis").'.jpg';
				$success = file_put_contents($file, $data);
				mysqli_query($con, "UPDATE barberServices set image = '".$filename."' where id = '".$lastId."' ");
			}

			$response['addService'] = array("message"=>'true');				
		}
		else{
			$response['addService'] = array("message"=>'false');			
		}
		return $response;
	}

	function barberServices($con,$json)
	{		
		$query = mysqli_query($con, "SELECT id as serviceId, name,price,speciality,create_at,image from barberServices where barberUser = '".$json->barberServices->{'userId'}."' order by id desc");
		if(mysqli_num_rows($query) > 0)
		{
			$values;
			while($row = mysqli_fetch_array($query,true))
			{
				$values[] = $row; 
			}	
			$response['barberServices'] = $values;
			$response['status'] = array("message"=>'true');
		}
		else
		{
			$response['barberServices'] = array("message"=>'false');	
			$response['status'] = array("message"=>'false');		
		}

		return $response;
	}

	function customerRegister($con,$json)
	{
		$getData = mysqli_query($con,"SELECT id FROM barberUsers where email = '".$json->customerRegister->{'email'}."' and userType='customer'");
		if(mysqli_num_rows($getData) > 0)
		{
			$response['customerData'] = array("message"=>'alreadyExist');
		}
		else
		{
			$query = mysqli_query($con,"INSERT INTO barberUsers (username,email,password,userType)VALUES ('".$json->customerRegister->{'username'}."', '".$json->customerRegister->{'email'}."', '".$json->customerRegister->{'password'}."', 'customer')");
			if($query)
			{
				$response['customerData'] = array("message"=>'true',"userId"=>mysqli_insert_id($con));	
			}
			else
			{
				$response['customerData'] = array("message"=>'false');	
			}
			
		}
		return $response;
	}

	function customerLogin($con,$json)
	{	
		if($json->customerLogin->{'signupType'} == 'fbsocial'){
			$getData = mysqli_query($con,"SELECT id FROM barberUsers where socialId = '".$json->customerLogin->{'socialId'}."' and signupType= '".$json->customerLogin->{'signupType'}."'");
			if(mysqli_num_rows($getData) > 0)
			{
				while($row = mysqli_fetch_array($getData))
				{
					$response['userDetail'] = array("message"=>"true","userId"=>$row['id']);
				}		
			}
			else
			{
				$query = mysqli_query($con,"INSERT INTO barberUsers (username,socialId,userType,signupType)VALUES ('".$json->customerLogin->{'username'}."', '".$json->customerLogin->{'socialId'}."','customer','".$json->customerLogin->{'signupType'}."')");
				if($query)
				{
					$response['userDetail'] = array("message"=>'true',"userId"=>mysqli_insert_id($con));	
				}
				else
				{
					$response['userDetail'] = array("message"=>'false');	
				}
			}
		}
		elseif($json->customerLogin->{'signupType'} == 'gmailsocial')
		{
			$getData = mysqli_query($con,"SELECT id FROM barberUsers where socialId = '".$json->customerLogin->{'socialId'}."' and signupType= '".$json->customerLogin->{'signupType'}."'");
			if(mysqli_num_rows($getData) > 0)
			{
				while($row = mysqli_fetch_array($getData))
				{
					$response['userDetail'] = array("message"=>"true","userId"=>$row['id']);
				}		
			}
			else
			{
				$query = mysqli_query($con,"INSERT INTO barberUsers (username,socialId,email,userType,signupType)VALUES ('".$json->customerLogin->{'username'}."', '".$json->customerLogin->{'socialId'}."','".$json->customerLogin->{'email'}."','customer','".$json->customerLogin->{'signupType'}."')");
				if($query)
				{
					$response['userDetail'] = array("message"=>'true',"userId"=>mysqli_insert_id($con));	
				}
				else
				{
					$response['userDetail'] = array("message"=>'false');	
				}
			}
		}
		else
		{
			$getData = mysqli_query($con,"SELECT id,email,image,username FROM barberUsers where email = '".$json->customerLogin->{'email'}."' and password = '".$json->customerLogin->{'password'}."' and userType='customer' and signupType = 'manual'");
			if(mysqli_num_rows($getData) > 0)
			{
				while($row = mysqli_fetch_array($getData))
				{
					$response['userDetail'] = array("message"=>"successfully","userId"=>$row['id'],"email"=>$row['email'],"image"=>$row['image'],"username"=>$row['username']);
				}		
			}
			else
			{
				$response['userDetail'] = array("message"=>"wrongCredentials");			
			}
		}
		return $response;
	}

	function customerGetProfile($con,$json)
	{
		$getData = mysqli_query($con,"SELECT id,email,image,username FROM barberUsers where id = '".$json->customerGetProfile->{'userId'}."' ");
		if(mysqli_num_rows($getData) > 0)
		{
			while($row = mysqli_fetch_array($getData))
			{
				$response['profileDetail'] = array("message"=>"profileLoaded","userId"=>$row['id'],"email"=>$row['email'],"Image"=>$row['image'],"username"=>$row['username']);
			}		
		}
		else
		{
			$response['profileDetail'] = array("message"=>"profileNotLoaded");			
		}
		return $response;
	}

	function customerUpdateProfile($con,$json)
	{
		$getData = mysqli_query($con,"SELECT email FROM barberUsers where email = '".$json->customerUpdateProfile->{'email'}."' and userType = 'customer' and id != '".$json->customerUpdateProfile->{'userId'}."' ");

		if(mysqli_num_rows($getData) > 0)
		{
			$response['updateProfile'] = array("message"=>'EmailAlreadyExist');
		}
		else
		{
			$filename = 'NoImage';	
			mysqli_query($con, "UPDATE barberUsers set username = '".$json->customerUpdateProfile->{'username'}."', email='".$json->customerUpdateProfile->{'email'}."' where id = '".$json->customerUpdateProfile->{'userId'}."' ");

			if($json->customerUpdateProfile->{'image'} != '' && $json->customerUpdateProfile->{'image'} != null && $json->customerUpdateProfile->{'image'} != undefined)
			{
				define('UPLOAD_DIR', 'uploads/barberProfile/');
				$data = base64_decode($json->customerUpdateProfile->{'image'});
				$filename = $json->customerUpdateProfile->{'userId'}."_".date("Ymdhis").'.jpg';
				$file = UPLOAD_DIR . $json->customerUpdateProfile->{'userId'}.'_'.date("Ymdhis").'.jpg';
				$success = file_put_contents($file, $data);
				mysqli_query($con, "UPDATE barberUsers set image = '".$filename."' where id = '".$json->customerUpdateProfile->{'userId'}."' ");
			}
			$response['updateProfile'] = array("message"=>'true',"imagename"=>$filename);			
		}
		return $response;
	}

	function barberServicesdelete($con,$json)
	{
		$query = mysqli_query($con, "DELETE from barberServices where id = '".$json->barberServicesdelete->{'serviceId'}."' ");	
		if($query)
		{
			$response['updateProfile'] = array("message"=>'true');				
		}
		else
		{
			$response['updateProfile'] = array("message"=>'false');
		}
		return $response;
	}

	function barberSearch($con,$json)
	{		
		$query = mysqli_query($con, "SELECT id as barberId,username,storeLocation,email,businessName,phoneNumber,image,lat,lng from barberUsers where userType='barber' order by id desc");
		if(mysqli_num_rows($query) > 0)
		{
			while($row = mysqli_fetch_array($query,true))
			{	
				$query1 = mysqli_query($con, "select GROUP_CONCAT(name) as specl from barberServices where barberUser='".$row['barberId']."' and speciality='1' order by id desc");

				while($row1 = mysqli_fetch_array($query1,true))
				{	
					if($row1['specl'] != null)
					{
						$speciality=$row1['specl'];				
					}
					else
					{
						$speciality="No Any";					
					}
				}
				$colArray = array(
				    "barberId" => $row['barberId'],
				    "username" => $row['username'],
				    "storeLocation" => $row['storeLocation'],
				    "email" => $row['email'],
				    "phoneNumber" => $row['phoneNumber'],
				    "image" => $row['image'],
				    "businessName" => $row['businessName'],
				    "lat" => $row['lat'],
				    "lng" => $row['lng'],
				    "spl" => $speciality
				);
			  	$values[] = $colArray;
			}	
			$response['barberSearchList'] = $values;
			$response['status'] = array("message"=>'true');
		}
		else
		{
			$response['status'] = array("message"=>'false');			
		}

		return $response;
	}


?>