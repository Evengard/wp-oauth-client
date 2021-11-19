<?php
/**
 * setup wizard step 2 - show callback URL
 */
function mo_oauth_client_setup_callback(){
	echo '	<!-- content main --> 
	        <h4>Setting up a Relying Party<span class="mo-oauth-setup-guide"></span></h4>
	        <p>
	        	Copy below callback URL (Redirect URI) and configure it in your OAuth Provider
	        </p>
	        <div class="field-group">
	            <label>Callback URL</label> 
	            <input title="Copy this Redirect URI and provide to your provider"
				 type="text" class="mo-normal-text" id="callbackurl" name="url" value="'.esc_url_raw(site_url()).'" readonly="true"> 
	           <div class="tooltip" style="display: inline;"><span class="tooltiptext" id="moTooltip">Copy to clipboard</span><i class="fa fa-clipboard fa-border" style="font-size:20px; align-items: center;vertical-align: middle;" aria-hidden="true" onclick="copyUrl()" onmouseout="outFunc()"></i></div>
	            <div class="description">
	                <p>
	                    "Redirect URI" to be provided to your administrator
	                </p>                
	            </div>
	        </div>';?>
	        <script type="text/javascript">
			function outFunc() {
					var tooltip = document.getElementById("moTooltip");
					tooltip.innerHTML = "Copy to clipboard";
			}

			function copyUrl() {
    			var copyText = document.getElementById("callbackurl");
				outFunc();
				copyText.select();
				copyText.setSelectionRange(0, 99999); 
				document.execCommand("copy");
				var tooltip = document.getElementById("moTooltip");
				tooltip.innerHTML = "Copied";

			}
		</script>
<?php
}

?>