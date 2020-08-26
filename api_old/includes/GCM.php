<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GCM
 *
 * @author Mukesh Nandeda
 */
//class GCM {

	
  function send_gcm_notify($devicetoken, $messageData) {
		
		
		
	$GOOGLE_API_KEY="AIzaSyAy0GBzy3veyhT5U4Dk-JwgvKcIJK3YANU";
	$GOOGLE_GCM_URL="https://android.googleapis.com/gcm/send";
	
		
	
		
	$fields= $messageData;
	
	

		
        $headers = array(
            'Authorization: key=' . $GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $GOOGLE_GCM_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
       $result = curl_exec($ch);
	   
        curl_close($ch);
        return  $result;
    }
    
    
   function bulk_send_gcm($messageData) {
		
		
		
	$GOOGLE_API_KEY="AIzaSyAJajTrT0jyO5rRZ2EL_ruN_sZo1k3N6ns";
	$GOOGLE_GCM_URL="https://android.googleapis.com/gcm/send";
		
	
		
	 $data=json_encode($messageData) ;
	

		
        $headers = array(
            'Authorization: key=' . $GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $GOOGLE_GCM_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data );
		
        $result = curl_exec($ch);
        
        $res= json_decode ($result);
       
	/*echo "<pre>";
	print_r($res);
	echo "</pre>";
	*/
	
		
        curl_close($ch);
        return  $result;
    }
	 
	
	
	

//}

?>
