<?php

 function customization_ui(){
	
	$cclass = $cscript = '';	?>
	
	<?php echo '<div class="mo_oauth_premium_option_text"><span style="color:red;">*</span>This is a standard feature. 
	<a href="admin.php?page=mo_oauth_settings&tab=licensing">Click Here</a> to see our full list of Standard Features.</div>'; $cclass = 'mo_oauth_premium_option'; $cscript = '<script>jQuery( document ).ready(function() { jQuery(".mo_oauth_premium_option :input").prop("disabled", true);}); </script>';?>
	
	<div id="mo_oauth_customiztion" class="mo_table_layout mo_oauth_app_customization <?php echo $cclass; ?>">
	<form id="form-common" name="form-common" method="post" action="admin.php?page=mo_oauth_settings&tab=customization">
		<input type="hidden"/>
		<h2>Customize Icons</h2>
		<table class="mo_settings_table">
			<tr>
				<td><strong>Icon Width:
				</strong></td>
				<td><input type="text"> e.g. 200px or 100%</td>
			</tr>
			<tr>
				<td><strong>Icon Height:</strong></td>
				<td><input  type="text"> e.g. 50px or auto</td>
			</tr>
			<tr>
				<td><strong>Icon Margins:</strong></td>
				<td><input  type="text"> e.g. 2px 0px or auto</td>
			</tr>
			<tr>
				<td><strong>Custom CSS:</strong></td>
				<td><textarea type="text" style="resize: vertical; width:400px; height:180px;  margin:5% auto;" rows="6" ></textarea><br/><b>Example CSS:</b> 
<pre>.oauthloginbutton{
	background: #7272dc;
	height:40px;
	padding:8px;
	text-align:center;
	color:#fff;
}</pre>
			</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save settings"
					class="button button-primary button-large" /></td>
			</tr>
		</table>
	</form>
	</div>
	<?php echo $cscript; ?>
		
	<?php
}
