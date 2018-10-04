<?php

function mo_oauth_client_show_default_apps() { ?>

	<input type="text" id="mo_oauth_client_default_apps_input" onkeyup="mo_oauth_client_default_apps_input_filter()" placeholder="Select application" title="Type in a Application Name">

	<ul id="mo_oauth_client_default_apps">
		
		<?php
			$defaultapps =  file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR .'defaultapps.json');
			$defaultappsjson =json_decode($defaultapps);
			
			foreach($defaultappsjson as $appId => $application) {
				echo '<li data-appid="'.$appId.'"><a href="#"><img class="mo_oauth_client_default_app_icon" src="'. plugins_url( '../images/'.$application->image, __FILE__ ).'"><br>'.$application->label.'</a></li>';
			}
		?>

	</ul>

	<script>
		
		jQuery("#mo_oauth_client_default_apps li").click(function(){
			var appId = jQuery(this).data("appid");
			<?php if (mo_oauth_is_customer_registered()) { ?>
				window.location.href += "&appId="+appId;
			<?php } else { ?>
				window.location.href = "admin.php?page=mo_oauth_settings&tab=register";
			<?php } ?>
		});
		
	</script>

<?php } 


function mo_oauth_client_get_app($currentAppId) {
	$defaultapps =  file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR .'defaultapps.json');
	$defaultappsjson =json_decode($defaultapps);
	
	foreach($defaultappsjson as $appId => $application) {
		if($appId == $currentAppId)
			return $application;
	}
	return false;
}






?>