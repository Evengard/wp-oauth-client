<?php

class Mo_OAuth_Hanlder {
	
	function getToken($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url){
		
		$ch = curl_init($tokenendpoint);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Basic '.base64_encode($clientid.":".$clientsecret),
			'Accept: application/json'
		));
		
		curl_setopt( $ch, CURLOPT_POSTFIELDS, 'redirect_uri='.urlencode($redirect_url).'&grant_type='.$grant_type.'&client_id='.$clientid.'&client_secret='.$clientsecret.'&code='.$code);
		$response = curl_exec($ch);
		
		if(curl_error($ch)){
			print_r($response);
			exit( curl_error($ch) );
		}

		if(!is_array(json_decode($response, true))){
			echo "<b>Response : </b><br>";print_r($response);echo "<br><br>";
			exit("Invalid response received getting access_token from url ".$tokenendpoint);
		}

		$content = json_decode($response,true);
		if(isset($content["error_description"])){
			print_r($response);
			exit($content["error_description"]);
		} else if(isset($content["error"])){
			print_r($response);
			exit($content["error"]);
		} 
		
		return $response;
	}

	function getAccessToken($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url){
		$response = $this->getToken ($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url);
		$content = json_decode($response,true);

		if(isset($content["access_token"])) {
			return $content["access_token"];
			exit;
		} else {
			echo 'Invalid response received from OAuth Provider. Contact your administrator for more details.<br><br><b>Response : </b><br>'.$response;
			exit;
		}
	}
	
	function getIdToken($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url){
		$response = $this->getToken ($tokenendpoint, $grant_type, $clientid, $clientsecret, $code, $redirect_url);
		$content = json_decode($response,true);
		if(isset($content["id_token"])) {
			return $content;
			exit;
		} else {
			echo 'Invalid response received from OpenId Provider. Contact your administrator for more details.<br><br><b>Response : </b><br>'.$response;
			exit;
		}
	}

	function getResourceOwnerFromIdToken($id_token){
		$id_array = explode(".", $id_token);
		if(isset($id_array[1])) {
			$id_body = base64_decode($id_array[1]);
			if(is_array(json_decode($id_body, true))){
				return json_decode($id_body,true);
			}
		}
		echo 'Invalid response received.<br><b>Id_token : </b>'.$id_token;
		exit;
	}
	
	function getResourceOwner($resourceownerdetailsurl, $access_token){

		$ch = curl_init($resourceownerdetailsurl);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt( $ch, CURLOPT_POST, false);
		if(get_option('mo_oauth_client_disable_authorization_header') == false)
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer '.$access_token
				));
				
		$content = curl_exec($ch);
		
		if(curl_error($ch)){
			echo "<b>Response : </b><br>";print_r($content);echo "<br><br>";
			exit( curl_error($ch) );
		}
		
		if(!is_array(json_decode($content, true))) {
			echo "<b>Response : </b><br>";print_r($content);echo "<br><br>";
			exit("Invalid response received.");
		}
		
		$content = json_decode($content,true);
		if(isset($content["error_description"])){
			if(is_array($content["error_description"]))
				print_r($content["error_description"]);
			else
				echo $content["error_description"];
			exit;
		} else if(isset($content["error"])){
			if(is_array($content["error"]))
				print_r($content["error"]);
			else
				echo $content["error"];
			exit;
		} 
		
		return $content;
	}
	
	function getResponse($url){
		$ch = curl_init($url);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt( $ch, CURLOPT_POST, false);			
		$content = curl_exec($ch);
		if(curl_error($ch)){
			return false;
		}
		return $content;
	}
	
}

?>