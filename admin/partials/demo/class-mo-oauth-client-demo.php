<?php
	
	class Mo_OAuth_Client_Admin_RFD {
	
		public static function requestfordemo() {
			self::demo_request();
		}

		public static function demo_request(){
			$democss = "width: 300px; height:35px;";
		?>
			<div class="mo_demo_layout">
			    <h3> Demo Request Form : </h3>
			    <!-- <div class="mo_table_layout mo_modal-demo"> -->
			    	<form method="post" action="">
					<input type="hidden" name="option" value="mo_oauth_client_demo_request_form" />
			    	<table cellpadding="4" cellspacing="4">
			    		<tr>
							<td><strong>Email : </strong></td>
							<td><input required type="text" style="<?php echo $democss; ?>" name="mo_oauth_client_demo_email" placeholder="Email for demo setup" value="<?php echo get_option("mo_oauth_admin_email"); ?>" /></td>
						</tr>
						<tr>
							<td><strong>Request a demo for : </strong></td>
							<td>
								<select required style="<?php echo $democss; ?>" name="mo_oauth_client_demo_plan" id="mo_oauth_client_demo_plan_id" onclick="moOauthClientAddDescriptionjs()">
									<option disabled selected>------------------ Select ------------------</option>
									<option value="WP OAuth Client Standard Plugin">WP OAuth Client Standard Plugin</option>
									<option value="WP OAuth Client Premium Plugin">WP OAuth Client Premium Plugin</option>
									<option value="WP OAuth Client Enterprise Plugin">WP OAuth Client Enterprise Plugin</option>
									<option value="Not Sure">Not Sure</option>
								</select>
							</td>
					  	</tr>
					  	<tr id="demoDescription" style="display:none;">
						  	<td><strong>Description : </strong></td>
							<td>
							<textarea type="text" name="mo_oauth_client_demo_description" style="resize: vertical; width:350px; height:100px;" rows="4" placeholder="Need assistance? Write us about your requirement and we will suggest the relevant plan for you." value="<?php isset($mo_oauth_client_demo_email); ?>" /></textarea>
							</td>
					  	</tr>
			    	</table>
			    	<p align="center">	
			    		<input type="submit" name="submit" value="Submit Demo Request" class="button button-primary button-large" />
			    	</p>
			    <!-- </div> -->
			</form>
			</div>
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
		<?php
		}
	}