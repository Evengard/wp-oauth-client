<?php

class Mo_OAuth_Client_Admin_Support {
	
	public static function support() {
		self::support_page();
		self::setup_call_page();
		self::mo_download_log();
	}
	
	public static function support_page(){
	?>
		<div id="mo_support_layout" class="mo_support_layout">
			<div>
				<h3><?php esc_html_e('Contact Us','miniorange-login-with-eve-online-google-facebook')?></h3>
				<p><?php esc_html_e('Need any help? Couldn\'t find an answer in ','miniorange-login-with-eve-online-google-facebook')?><a href="https://faq.miniorange.com/kb/oauth-openid-connect" target="_blank">FAQ</a>?<br><br><?php esc_html_e('Just give us a call at ','miniorange-login-with-eve-online-google-facebook')?><b>+1 978 658 9387</b><br>
				<?php esc_html_e('or send a query so we can help you.','miniorange-login-with-eve-online-google-facebook')?></p>
				<form method="post" action="">
					<?php wp_nonce_field('mo_oauth_support_form','mo_oauth_support_form_field'); ?>
					<input type="hidden" name="option" value="mo_oauth_contact_us_query_option" />
					<table class="mo_settings_table">
						<tr>
							<td><input type="email" class="mo_table_textbox" required name="mo_oauth_contact_us_email" placeholder="Enter email here"
							value="<?php echo get_option("mo_oauth_admin_email"); ?>"></td>
						</tr>
						<tr>
							<td><input class="mo_table_textbox" style="min-width: 153%;" type="tel" id="contact_us_phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}|[\+]\d{1,4}[\s]" placeholder="Enter phone here" name="mo_oauth_contact_us_phone" value="<?php echo get_option('mo_oauth_client_admin_phone');?>"></td>
						</tr>
						<tr>
							<td><textarea class="mo_table_textbox" onkeypress="mo_oauth_valid_query(this)" placeholder="<?php _e('Enter your query here','miniorange-login-with-eve-online-google-facebook'); ?>" onkeyup="mo_oauth_valid_query(this)" onblur="mo_oauth_valid_query(this)" required name="mo_oauth_contact_us_query" rows="4" style="resize: vertical;"></textarea></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="mo_oauth_send_plugin_config" id="mo_oauth_send_plugin_config" checked>&nbsp;<?php esc_html_e('Send Plugin Configuration','miniorange-login-with-eve-online-google-facebook')?></td>
						</tr>
						<tr>
							<td><small style="color:#666"><?php esc_html_e('We will not be sending your Client IDs or Client Secrets.','miniorange-login-with-eve-online-google-facebook')?></small></td>
						</tr>
					</table>
					<div style="text-align:left;">
						<input type="submit" name="submit" style="margin:15px; width:100px;" class="button button-primary button-large" value="<?php _e('Submit','miniorange-login-with-eve-online-google-facebook'); ?>" />
					</div>
					<p><?php esc_html_e('If you want custom features in the plugin, just drop an email at ','miniorange-login-with-eve-online-google-facebook')?><a href="mailto:oauthsupport@xecurify.com">oauthsupport@xecurify.com</a>.</p>
				</form>
			</div>
		</div>
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/css/intlTelInput.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/js/intlTelInput.min.js"></script>

        <script>
			jQuery("#contact_us_phone").intlTelInput({
				nationalMode: false,
			});
			function mo_oauth_valid_query(f) {
				!(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
						/[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
			}
		</script>
		<br/>
				
	<?php
	}

	public static function mo_download_log() {
		?>	
		<div id="mo_support_layout" class="mo_support_layout">
			<h3>Debug Logs</h3>
			<div class="mo_debug">
				<table class="mo_settings_table2" style="margin-bottom: 5px;">
                <form id="mo_oauth_debug_form" method="post">
					<input type="hidden" name="option" value="mo_oauth_enable_debug">
					<?php wp_nonce_field( 'mo_oauth_enable_debug', 'mo_oauth_enable_debug_nonce' ); ?> 
					<tr>
					<td style="padding-right:1px;"><input type="checkbox" name="mo_oauth_debug_check" <?php if(get_option('mo_debug_enable')){echo 'checked';} ?> >&nbsp;Enable Debug Log</td>
					</tr>
					<tr style="height: 10px;">						
					</tr>
					<tr>	
					<td>
					<input type="submit" name="submit" value="Submit" class="button button-primary button-large" style="width: 100px;">
					</td>
					</tr>
					</form>
                </table>
					<p>The error logs will be cleared automatically on weekly basis.</p>
					<?php if(get_option('mo_debug_enable')){ ?>	
					<form id="mo_oauth_debug_download_form" method="post">
					<input type="hidden" name="option" value="mo_oauth_enable_debug_download">
					<?php wp_nonce_field( 'mo_oauth_enable_debug_download', 'mo_oauth_enable_debug_download_nonce' ); ?>
					<input type="submit" name="submit" value="Download Logs" class="button button-primary button-large" style="width: 120px;">	
					</form>					
			<?php } ?>
					<br>
			</div>
		</div>
		<br>
		<script type='text/javascript'>
    <!--//--><![CDATA[//><!--
            !function(a,b){"use strict";function c(){if(!e){e=!0;var a,c,d,f,g=-1!==navigator.appVersion.indexOf("MSIE 10"),h=!!navigator.userAgent.match(/Trident.*rv:11\./),i=b.querySelectorAll("iframe.wp-embedded-content");for(c=0;c<i.length;c++){if(d=i[c],!d.getAttribute("data-secret"))f=Math.random().toString(36).substr(2,10),d.src+="#?secret="+f,d.setAttribute("data-secret",f);if(g||h)a=d.cloneNode(!0),a.removeAttribute("security"),d.parentNode.replaceChild(a,d)}}}var d=!1,e=!1;if(b.querySelector)if(a.addEventListener)d=!0;if(a.wp=a.wp||{},!a.wp.receiveEmbedMessage)if(a.wp.receiveEmbedMessage=function(c){var d=c.data;if(d)if(d.secret||d.message||d.value)if(!/[^a-zA-Z0-9]/.test(d.secret)){var e,f,g,h,i,j=b.querySelectorAll('iframe[data-secret="'+d.secret+'"]'),k=b.querySelectorAll('blockquote[data-secret="'+d.secret+'"]');for(e=0;e<k.length;e++)k[e].style.display="none";for(e=0;e<j.length;e++)if(f=j[e],c.source===f.contentWindow){if(f.removeAttribute("style"),"height"===d.message){if(g=parseInt(d.value,10),g>1e3)g=1e3;else if(~~g<200)g=200;f.height=g}if("link"===d.message)if(h=b.createElement("a"),i=b.createElement("a"),h.href=f.getAttribute("src"),i.href=d.value,i.host===h.host)if(b.activeElement===f)a.top.location.href=d.value}else;}},d)a.addEventListener("message",a.wp.receiveEmbedMessage,!1),b.addEventListener("DOMContentLoaded",c,!1),a.addEventListener("load",c,!1)}(window,document);
		</script><iframe sandbox="allow-scripts" security="restricted" src="https://wordpress.org/plugins/wp-rest-api-authentication/embed/" width="100%" title="&#8220;WordPress REST API Authentication &#8211;&#8221; &#8212; Plugin Directory" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" class="wp-embedded-content"></iframe>
	<?php 


	}

	public static function setup_call_page() {
	?>
		<div id="mo_setup_call_layout" class="mo_support_layout" >
			<h3><?php esc_html_e('Setup a Call / Screen-share session','miniorange-login-with-eve-online-google-facebook')?></h3>
			<form method="post" action="">
				<?php wp_nonce_field('mo_oauth_setup_call_form','mo_oauth_setup_call_form_field'); ?>
				<input type="hidden" name="option" value="mo_oauth_setup_call_option"/>
				<table class="mo_settings_table" cellpadding="2" cellspacing="2">
					<tr>
						<td><strong><font color="#FF0000">*</font><?php esc_html_e('Email:','miniorange-login-with-eve-online-google-facebook')?></td></strong></td>
						<td><input class="mo_callsetup_table_textbox" type="email" placeholder="user@example.com" name="mo_oauth_setup_call_email" value="<?php echo get_option("mo_oauth_admin_email"); ?>" required></td>
					</tr>
					<tr>
						<td><strong><font color="#FF0000">*</font><?php esc_html_e('Issue:','miniorange-login-with-eve-online-google-facebook')?></td></strong></td>
						<td><select id="issue_dropdown" class="mo_callsetup_table_textbox" name="mo_oauth_setup_call_issue" required>
							<option disabled selected>--------Select Issue type--------</option>
							<option id="sso_setup_issue">SSO Setup Issue</option>
							<option>Custom requirement</option>
							<option id="other_issue">Other</option>
						</select></td>
					</tr>
					<tr id="setup_guide_link" style="display: none;">
						<td colspan="2"><?php esc_html_e('Have you checked the setup guide ','miniorange-login-with-eve-online-google-facebook')?><a href="https://plugins.miniorange.com/wordpress-single-sign-on-sso-with-oauth-openid-connect" target="_blank">here</a>?</td>
					</tr>
					<tr>
						<td><strong><font id="required_mark" color="#FF0000" style="display: none;">*</font></td></strong></td>
						<td><textarea id="issue_description" class="mo_callsetup_table_textbox" name="mo_oauth_setup_call_desc" minlength="15" placeholder="Any queries like oecnajdnacdmv jvndf avdd won't be answered" rows="4"></textarea></td>
					</tr>
					<tr>
						<td><strong><font color="#FF0000">*</font><?php esc_html_e('Date:','miniorange-login-with-eve-online-google-facebook')?></td></strong></td>
						<td><input class="mo_callsetup_table_textbox" name="mo_oauth_setup_call_date" type="text" id="calldate" required></td>
					</tr>
					<tr>
						<td><strong><font color="#FF0000">*</font><?php esc_html_e('Time(Local):','miniorange-login-with-eve-online-google-facebook')?></td></strong></td>
						<td><input class="mo_callsetup_table_textbox" name="mo_oauth_setup_call_time" type="time" id="mo_oauth_setup_call_time" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="<?php _e('Submit','miniorange-login-with-eve-online-google-facebook') ?>" class="button button-primary button-large"></td>
					</tr>
				</table>
				<p><?php esc_html_e('We are available from 3:30 to 18:30 UTC','miniorange-login-with-eve-online-google-facebook')?></p>
				<input type="hidden" name="mo_oauth_time_diff" id="mo_oauth_time_diff">
			</form>
		</div>
		<br>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
			jQuery('#calldate').datepicker({
				dateFormat: 'd MM, yy',
				beforeShowDay: $.datepicker.noWeekends,
				minDate: 1,
			});
			jQuery('#issue_dropdown').change(function() {
				if(document.getElementById("sso_setup_issue").selected) {
					document.getElementById("setup_guide_link").style.display = "table-row";
				}
				else {
					document.getElementById("setup_guide_link").style.display = "none";	
				}
				if(document.getElementById("other_issue").selected) {
					document.getElementById("required_mark").style.display = "inline";
					document.getElementById("issue_description").required = true;
				}
				else {
					document.getElementById("required_mark").style.display = "none";
					document.getElementById("issue_description").required = false;	
				}
			});
			var d = new Date();
	  		var n = d.getTimezoneOffset();
	  		document.getElementById("mo_oauth_time_diff").value = n;
		</script>
	<?php	
	}
}