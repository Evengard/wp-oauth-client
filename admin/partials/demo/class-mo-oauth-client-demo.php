<?php
	
	class Mo_OAuth_Client_Admin_RFD {
	
		public static function requestfordemo() {
			self::demo_request();
		}

		public static function demo_request(){
			$democss = "width: 350px; height:35px;";
		?>
			<div class="mo_demo_layout">
			    <h3> <?php _e('Request for Demo','miniorange-login-with-eve-online-google-facebook'); ?>  </h3>
			    <hr>
			    <?php _e('Want to try out the paid features before purchasing the license? Just let us know which plan you\'re interested in and we will setup a demo for you.','miniorange-login-with-eve-online-google-facebook');?>
			    	<form method="post" action="">
					<input type="hidden" name="option" value="mo_oauth_client_demo_request_form" />
					<?php wp_nonce_field('mo_oauth_client_demo_request_form', 'mo_oauth_client_demo_request_field'); ?>
			    	<table class="mo_demo_table_layout" cellpadding="4" cellspacing="4">
			    		<tr>
							<td><strong>Email id <p style="display:inline;color:red;">*</p>: </strong></td>
							<td><input required type="email" style="<?php echo $democss; ?>" name="mo_auto_create_demosite_email" placeholder="We will use this email to setup the demo for you" value="<?php echo esc_html(get_option("mo_oauth_admin_email")); ?>" /></td>
						</tr>
						<tr>
							<td><strong><?php _e('Request a demo for','miniorange-login-with-eve-online-google-facebook'); ?> <p style="display:inline;color:red;">*</p>: </strong></td>
							<td>
								<select required style="<?php echo $democss; ?>" name="mo_auto_create_demosite_demo_plan" id="mo_oauth_client_demo_plan_id">
									<option disabled selected>------------------ Select ------------------</option>
									<option value="miniorange-oauth-client-standard-common@11.6.1">WP <?php echo MO_OAUTH_PLUGIN_NAME; ?> Standard Plugin</option>
									<option value="mo-oauth-client-premium@21.5.3">WP <?php echo MO_OAUTH_PLUGIN_NAME; ?> Premium Plugin</option>
									<option value="miniorange-oauth-client-enterprise@31.5.7">WP <?php echo MO_OAUTH_PLUGIN_NAME; ?> Enterprise Plugin</option>
									<option value="miniorange-oauth-client-allinclusive@48.3.0">WP <?php echo MO_OAUTH_PLUGIN_NAME; ?> All Inclusive Plugin</option>
									<option value="Not Sure">Not Sure</option>
								</select>
							</td>
					  	</tr>
                        <tr>
						  	<td><strong><?php _e('Usecase','miniorange-login-with-eve-online-google-facebook'); ?><p style="display:inline;color:red;">*</p> : </strong></td>
							<td>
							<textarea type="text" minlength="15" name="mo_auto_create_demosite_usecase" style="resize: vertical; width:350px; height:100px;" rows="4" placeholder="<?php _e('Example. Login into wordpress using Cognito, SSO into wordpress with my company credentials, Restrict gmail.com accounts to my wordpress site etc.','miniorange-login-with-eve-online-google-facebook'); ?>" required value=""></textarea>
							</td>
						  </tr> 
						  <tr id="add-on-list">
					        <td colspan="2">
					        <p><strong><?php _e('Select the Add-ons you are interested in (Optional)','miniorange-login-with-eve-online-google-facebook');?> :</strong></p>
					        <p><i><strong>(<?php _e('Note','miniorange-login-with-eve-online-google-facebook');?>: </strong> <?php _e('All-Inclusive plan entitles all the addons in the license cost itself.','miniorange-login-with-eve-online-google-facebook');?> )</i></p>
					        <div style="padding-left:20px;">
					       <?php
						        foreach(Mo_OAuth_Client_Admin_Addons::$all_addons as $key => $value){
						        	if(true === $value['in_allinclusive']){?>
						            <input type="checkbox" style="margin-top:2px;margin-bottom:2px;" name="<?php echo esc_html($value['tag']); ?>" value="true"> <?php echo esc_html($value['title']); ?><br/>
						            <?php
						        	}
						        }
						        ?>
					        </div></td>
        				</tr>	
<!--
					  	<tr id="demoDescription" style="display:none;">
						  	<td><strong>Description : </strong></td>
							<td>
							<textarea type="text" name="mo_oauth_client_demo_description" style="resize: vertical; width:350px; height:100px;" rows="4" placeholder="Need assistance? Write us about your requirement and we will suggest the relevant plan for you." value="<?php isset($mo_oauth_client_demo_email); ?>" /></textarea>
							</td>
					  	</tr>
-->
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="<?php _e('Submit Demo Request','miniorange-login-with-eve-online-google-facebook'); ?>" class="button button-primary button-large" />
                            </td>
                        </tr>
			    	</table>
			    <!-- </div> -->
			</form>
			</div>
<!--
			<script type="text/javascript">
				function moOauthClientAddDescriptionjs() {
					// alert("working");
				var x = document.getElementById("mo_oauth_client_demo_plan_id").selectedIndex;
				var otherOption = document.getElementById("mo_oauth_client_demo_plan_id").options;
				if (otherOption[x].index == 4){
				    demoDescription.style.display = "";
				} else {
				    demoDescription.style.display = "none";
				}
			}
			</script>
-->
		<?php
		}
	}
