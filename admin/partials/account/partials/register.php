<?php

function register_ui() {
	update_option ( 'new_registration', 'true' );
	$current_user = wp_get_current_user();
	?>
			<!--Register with miniOrange-->
		<form name="f" method="post" action="">
			<input type="hidden" name="option" value="mo_oauth_register_customer" />
			<div class="mo_table_layout">
				<div id="toggle1" class="panel_toggle">
					<h3>Register with miniOrange</h3>
				</div>
				<div id="panel1">
					<!--<p><b>Register with miniOrange</b></p>-->
					<p>Please enter a valid Email ID that you have access to. You will be able to move forward after verifying an OTP that we will be sending to this email.
					</p>
					<table class="mo_settings_table">
						<tr>
							<td><b><font color="#FF0000">*</font>Email:</b></td>
							<td><input class="mo_table_textbox" type="email" name="email"
								required placeholder="person@example.com"
								value="<?php echo get_option('mo_oauth_admin_email');?>" />
							</td>
						</tr>
						<tr class="hidden">
							<td><b><font color="#FF0000">*</font>Website/Company Name:</b></td>
							<td><input class="mo_table_textbox" type="text" name="company"
							required placeholder="Enter website or company name"
							value="<?php echo $_SERVER['SERVER_NAME']; ?>"/></td>
						</tr>
						<tr  class="hidden">
							<td><b>&nbsp;&nbsp;First Name:</b></td>
							<td><input class="mo_openid_table_textbox" type="text" name="fname"
							placeholder="Enter first name" value="<?php echo $current_user->user_firstname;?>" /></td>
						</tr>
						<tr class="hidden">
							<td><b>&nbsp;&nbsp;Last Name:</b></td>
							<td><input class="mo_openid_table_textbox" type="text" name="lname"
							placeholder="Enter last name" value="<?php echo $current_user->user_lastname;?>" /></td>
						</tr>

						<tr  class="hidden">
							<td><b>&nbsp;&nbsp;Phone number :</b></td>
							 <td><input class="mo_table_textbox" type="text" name="phone" pattern="[\+]?([0-9]{1,4})?\s?([0-9]{7,12})?" id="phone" title="Phone with country code eg. +1xxxxxxxxxx" placeholder="Phone with country code eg. +1xxxxxxxxxx" value="<?php echo get_option('mo_oauth_admin_phone');?>" />
							 This is an optional field. We will contact you only if you need support.</td>
							</tr>
						</tr>
						<tr  class="hidden">
							<td></td>
							<td>We will call only if you need support.</td>
						</tr>
						<tr>
							<td><b><font color="#FF0000">*</font>Password:</b></td>
							<td><input class="mo_table_textbox" required type="password"
								name="password" placeholder="Choose your password (Min. length 8)" /></td>
						</tr>
						<tr>
							<td><b><font color="#FF0000">*</font>Confirm Password:</b></td>
							<td><input class="mo_table_textbox" required type="password"
								name="confirmPassword" placeholder="Confirm your password" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><br /><input type="submit" name="submit" value="Save" style="width:100px;"
								class="button button-primary button-large" /></td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<script>
			jQuery("#phone").intlTelInput();
		</script>
		<?php
}