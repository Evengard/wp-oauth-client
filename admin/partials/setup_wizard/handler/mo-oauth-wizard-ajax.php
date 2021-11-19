<?php 

class Mo_Oauth_Wizard_Ajax{
	function __construct(){

		add_action( 'admin_init'  , array( $this, 'mo_oauth_wizard_ajax' ) );
	}

	function mo_oauth_wizard_ajax(){
		add_action( 'wp_ajax_mo_outh_ajax', array($this,'mo_oauth_ajax') );
	}

	function mo_oauth_ajax(){
		$this->verify_nonce();
		switch(sanitize_text_field($_POST['mo_oauth_option']))
			{				
				case 'save_draft':
					$this->save_draft();	break;
				case 'save_app':
					$this->save_app();	break;	
				case 'query_submit':
					$this->query_submit();	break;	
				case 'test_result':
					$this->test_result(); break;	
				case 'test_finish':
					$this->test_finish();break;			
			} 
	}

	/**
	 * Save application data on next, back, save draft, close events 
	 * @return setup wizard app json object
	 */
	function save_draft(){
		$app = array();
		foreach ($_POST as $key => $value) {
			$key = sanitize_text_field($key);
			if('mo_oauth_nonce' != $key && 'action' != $key && 'mo_oauth_option' != $key){
				if(is_array($value)){
					$value = $this->sanitize_array($value);
					$value = json_encode($value);
				}
				if(filter_var($value, FILTER_VALIDATE_URL))
					$app[$key] = esc_url_raw($value);
				else	
					$app[$key] = sanitize_text_field($value);
			}
		}

		if(empty($app['mo_oauth_appId']))
			wp_send_json('No application selected');


		$defaultapps =  file_get_contents(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR .'/apps/partials/defaultapps.json');
		$defaultappsjson =json_decode($defaultapps);
        $appname = $app['mo_oauth_appId'];
		if(isset($app['mo_oauth_input'])){
	        foreach($defaultappsjson as $appId => $application) {
	        	if($appId == $appname){
	        		$discovery_endpoint = $application->discovery;
			        break;
	        	}
	        }
     	}

		if(isset($app['mo_oauth_input']) && !empty($app['mo_oauth_input']) && !is_null($app['mo_oauth_input'])){

        	$inputs = explode(" ", $app['mo_oauth_input']);
        	foreach ($inputs as $key => $value) {
        		$tag = strtolower(trim($value));
        		if('domain' == $tag){
        			$app[$value] = stripslashes(rtrim($app['mo_oauth_'.$value],"/"));
        		}
        		if('realm' == $tag)
        			$discovery_endpoint = str_replace('realmname', $app['mo_oauth_'.$value], $discovery_endpoint);
        		else
        			$discovery_endpoint = str_replace($tag, $app['mo_oauth_'.$value], $discovery_endpoint);
        	}	
        	$provider_se = null;
        	if('4' == $app['mo_oauth_step']){ 
		        if((filter_var($discovery_endpoint, FILTER_VALIDATE_URL))){
		            update_option('mo_oc_valid_discovery_ep', true);        
	                $arrContextOptions=array( 
	            		"ssl"=>array(
	            			"verify_peer"=>false,
	            			"verify_peer_name"=>false,
	            		),
	            	);  
	            	$content=@file_get_contents($discovery_endpoint,false, stream_context_create($arrContextOptions));
	                $provider_se = array();
	                $scope = array();
	                if($content){
	                    $provider_se=json_decode($content);    
	                    foreach ($provider_se->scopes_supported as $key => $value) {
	                     $scope[$key] = sanitize_text_field($value);          	
	                    }  
	                    $scope_list = array();
	                    foreach ($scope as $key => $value) {
	                    	array_push($scope_list,  array('name' => $value,'value'=> $value ));
	                    }
	                    $app['mo_oauth_scopes_list'] = json_encode($scope_list);  
	                    $scope = $this->mo_oauth_get_scopes($scope);
	                    $app['mo_oauth_scopes'] = json_encode($scope);
	                    $app['mo_oauth_discovery_validation'] = 'valid';
			            update_option('message', 'Your settings are saved successfully.');
			            update_option('mo_discovery_validation', 'valid');
			            add_option('mo_existing_app_flow', true);
	            	}else{
	                    $app['mo_oauth_scopes'] = "";
	                    $app['mo_oauth_discovery_validation'] = 'invalid';
	                    update_option('mo_discovery_validation', 'invalid');
	            	}
	        	}else{ 
	        			$app['mo_oauth_discovery_validation'] = 'invalid';      	
	                    update_option('mo_discovery_validation', 'invalid');
	        	}
	        }else{
	        	 $app['mo_oauth_discovery_validation'] = 'neutral';
	        }
	    }


	    if(1 != $app['mo_oauth_step']){
			update_option('mo_oauth_setup_wizard_app', json_encode($app));
			wp_send_json($app);
	    }
		else{
			delete_option('mo_oauth_setup_wizard_app');
			delete_option('mo_oauth_apps_list');
			wp_send_json("");
		}
	}
	/**
	 * Calls on finish of summary and dumps wizard app in original applist 
	 * @return setup wizard saved application json object
	 */
	function save_app(){
		$app = array();
		foreach ($_POST as $key => $value) {
			if('mo_oauth_nonce' != $key && 'action' != $key && 'mo_oauth_option' != $key){
				if(is_array($_POST[$key]))
					$value = json_encode($value);
				if(filter_var($value, FILTER_VALIDATE_URL))
					$app[$key] = esc_url_raw($value);
				else
					$app[$key] = sanitize_text_field($value);
			}
		}

        $newapp = array();
		$defaultapps =  file_get_contents(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR .'/apps/partials/defaultapps.json');
		$defaultappsjson =json_decode($defaultapps);
        $appname = $app['mo_oauth_appId'];
         foreach($defaultappsjson as $appId => $application) {
         	if($appId == $appname){
				$newapp['ssoprotocol'] = $application->type;
        		$newapp['apptype'] = $application->type;
		        if('oauth1' == $appname || 'twitter' == $appname){
		        	$newapp['requesturl'] = isset($application->requesturl) ? $application->requesturl : "";
		        }

				if(isset($app['mo_oauth_input'])){
		        	$discovery_endpoint = $application->discovery;
		        }
		        break;
         	}
         }
		$newapp['clientid'] = $app['mo_oauth_client_id'];
		$newapp['clientsecret'] = $app['mo_oauth_client_secret'];
		$newapp['redirecturi'] = site_url();
        $newapp['send_headers'] = "1";
        $newapp['send_body'] = "0";
        $newapp['send_state']= 1;
        $newapp['show_on_login_page'] = 1;
        $newapp['appId']=$app['mo_oauth_appId'];

        $scope = "";
        $scopes= json_decode($app['mo_oauth_scopes']);
        foreach ($scopes as $key => $value) {
        	$scope.=" ".$value;
        }
        $newapp['scope'] = trim($scope);


        if(isset($app['mo_oauth_input'])){
        	$inputs = explode(" ", $app['mo_oauth_input']);
        	foreach ($inputs as $key => $value) {
        		$tag = strtolower(trim($value));
        		if('domain' == $tag){
        			$app[$value] = stripslashes(rtrim($app['mo_oauth_'.$value],"/"));
        		}
        		$newapp[$tag] = $app['mo_oauth_'.$value];
        		if('realm' == $tag)
        			$discovery_endpoint = str_replace('realmname', $newapp[$tag], $discovery_endpoint);
        		else
        			$discovery_endpoint = str_replace($tag, $newapp[$tag], $discovery_endpoint);
        	}	
        	$provider_se = null;

	        if((filter_var($discovery_endpoint, FILTER_VALIDATE_URL))){
	            update_option('mo_oc_valid_discovery_ep', true);
                            
                $arrContextOptions=array( 
            		"ssl"=>array(
            			"verify_peer"=>false,
            			"verify_peer_name"=>false,
            		),
            	);  
            	$content=@file_get_contents($discovery_endpoint,false, stream_context_create($arrContextOptions));
                $provider_se = array();
                if($content){
                    $provider_se=json_decode($content);
                    $newapp['authorizeurl'] = isset($provider_se->authorization_endpoint) ? stripslashes($provider_se->authorization_endpoint) : "";
                    $newapp['accesstokenurl'] = isset($provider_se->token_endpoint) ? stripslashes($provider_se->token_endpoint ) : "";
                    $newapp['resourceownerdetailsurl'] = isset($provider_se->userinfo_endpoint) ? stripslashes($provider_se->userinfo_endpoint) : "";
                    $newapp['discovery'] = $discovery_endpoint;                    
		            update_option('message', 'Your settings are saved successfully.');
		            update_option('mo_discovery_validation', 'valid');
		            add_option('mo_existing_app_flow', true);
            	}else{
                    $newapp['authorizeurl'] = "";
                    $newapp['accesstokenurl'] = "";
                    $newapp['resourceownerdetailsurl'] = "";                    
		            update_option( 'message', '<strong>Error: </strong> Incorrect Domain/Tenant/Policy/Realm. Please configure with correct values and try again.' );
		            update_option( 'mo_discovery_validation', 'invalid');
            	}

        	}
        }else{
        	$newapp['authorizeurl'] = isset($app['mo_oauth_authorize']) ? ($app['mo_oauth_authorize']) : "";
            $newapp['accesstokenurl'] = isset($app['mo_oauth_token']) ? $app['mo_oauth_token'] : "";
            $newapp['resourceownerdetailsurl'] = isset($app['mo_oauth_userinfo']) ? $app['mo_oauth_userinfo'] : "";
        }


        if ('wso2' === $appname) {
            update_option('mo_oauth_client_custom_token_endpoint_no_csecret', true);
        }

        update_option('mo_oc_valid_discovery_ep', true);
        $appslist = array();
        $appslist[$app['mo_oauth_app_name']] = $newapp;
		update_option('mo_oauth_apps_list', $appslist);

		$wizard_app = json_decode(get_option('mo_oauth_setup_wizard_app'));
		$wizard_app->mo_oauth_debug = $app['mo_oauth_debug'];
		if('true' === $app['mo_oauth_debug'] ){
			if(!get_option('mo_oauth_debug'))
				update_option('mo_oauth_debug','mo_oauth_debug'.uniqid());

		$mo_oauth_log_file = dirname(dirname(dirname(dirname(dirname(__FILE__))))).DIRECTORY_SEPARATOR .get_option('mo_oauth_debug').'.log';		
			$mo_debug_file=fopen($mo_oauth_log_file,"w");
			chmod($mo_oauth_log_file,0644);
			update_option( 'mo_debug_check',1 );
			MO_Oauth_Debug::mo_oauth_log('');
			update_option( 'mo_debug_check',0 );
			update_option('mo_debug_enable',1);
		}
		else
			update_option('mo_debug_enable',0);

		update_option('mo_oauth_setup_wizard_app',json_encode($wizard_app));

		delete_option("mo_oauth_attr_name_list");
		wp_send_json($wizard_app);
	}

/**
 * submit setup wizard support query
 */
	function query_submit(){
		$email = sanitize_email($_POST['mo_oauth_email']);
		$query = sanitize_text_field($_POST['mo_oauth_query']);
		if(empty($email))
			wp_send_json('Invalid email address.');
		if(empty($query))
			wp_send_json('Please add your query.');


		$customer = new Mo_OAuth_Client_Customer();
		$submited = $customer->submit_contact_us( $email, "", $query, false );
		if(true === $submited)
			wp_send_json('Thanks for getting in touch! We shall get back to you shortly.');
		else
			wp_send_json('Your query could not be submitted. Please fill up all the required fields and try again.');
	}
/**
 * @param  [array] scopes [scopes fetched from discovery endpoint]
 * @return [array] new_scopes [return 3 defaults scopes (openid,email,profile or first three scopes)]
 */
	function mo_oauth_get_scopes($scopes){
     	$pri_scopes = ['openid','email','profile'];
        $new_scopes = [];
	    foreach( $pri_scopes as $key => $value ){
	        if(in_array($pri_scopes[$key], $scopes) ){
	            $new_scopes[$key] = $pri_scopes[$key];
	        }
	    }
    	$new_scope_len = sizeof($new_scopes);
	    if(3 > $new_scope_len){
	        for ( $i = 2; $i >= $new_scope_len; $i--) {
	            for ( $j = sizeof($scopes) - 1; $j >= 0; $j--) {
	                if(!in_array($scopes[$j], $new_scopes)){
	                    $new_scopes[$i] = $scopes[$j];
	                    $break;
	                }
	            }
	        }
	    }
	    return $new_scopes;

}

function sanitize_array( $array ) {

	foreach ($array as $key => $value) {	
		if( !is_array($value) ){
			$array[$key] = sanitize_text_field( $value );
		}
			
		else{
			$array[$key] = $this->sanitize_array($value);
		}
	
	}

	return $array;

}
/**
 * calls during the SSO test is running to get test progress status 
 * @return [array]  success (attribute list) |fail (failure reason) | wait (test logs)
 */
function test_result(){	
	$result = array();
	if(get_option("mo_oauth_attr_name_list")){
		array_push($result, 'success');
		array_push($result, get_option("mo_oauth_attr_name_list"));
		array_push($result,array_values( get_option('mo_oauth_apps_list') )[0]['username_attr']);
	}else{
		$mo_oauth_log_file = dirname(dirname(dirname(dirname(dirname(__FILE__))))).DIRECTORY_SEPARATOR .get_option('mo_oauth_debug').'.log';
		if(file_exists($mo_oauth_log_file))
			$file=file_get_contents($mo_oauth_log_file);
		else
			$file = '';
		if(false != strpos($file, 'ERROR')){
			array_push($result, 'fail');
		}else{
			array_push($result, 'wait');
		}
       	$file = explode(PHP_EOL,$file);
       foreach ($file as $key => $value) {
          array_push($result, explode("=>",$value));
          
       }
	}
	wp_send_json($result);
}
/**
 * calls when click on finish button of test screen
 */
function test_finish(){
		delete_option('mo_oauth_setup_wizard_app');	
}

function verify_nonce(){
	if(!isset($_POST['mo_oauth_nonce']) || !wp_verify_nonce($_POST['mo_oauth_nonce'],'mo-oauth-setup-wizard-nonce'))
		wp_send_json('error');	
}

}new Mo_Oauth_Wizard_Ajax;
?>