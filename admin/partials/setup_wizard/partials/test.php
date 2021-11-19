<?php 
/**
 * setup wizard step 6 - show sso test progress
 */
function mo_oauth_setup_wizard_test(){
	echo '<h4>SSO Test<span class="mo-oauth-setup-guide"></span></h4>';

	echo 	'<center>
				<div class="mo-oauth-test-in-progress">
					<img class="mo-oauth-loader"src="'.plugins_url( '/images/loader.gif', dirname(__FILE__ )).'"/>
					<h5>Test is in progress. Please wait!!</h5>
				</div>
				<div class="mo-oauth-test-in-failed" hidden>
					<h5 class="mo-oauth-test-fail-msg">Test Failed!!</h5>
				</div>
			</center>
				<div class="mo-oauth-result-test">
				</div>
			<center>
				<div class="mo-oauth-test-successed" hidden>
					<h5 class="mo-oauth-test-success-msg">Congratulations!! Test completed successfully.</h5>
					<p class="mo-oauth-test-prefered-attr"></p>
					<table>
						<tbody class="mo-oauth-test-attr-table">
							<tr><th>Attribute Name</th><th> Attribute Value</th></tr>
						</tbody>
					</table>
				</div>
			</center>';			
	echo 	'<script type="text/javascript">
				function mo_oauth_get_test_result(){
					var data = {
						"action": "mo_outh_ajax",
        				"mo_oauth_option": "test_result",
        				"mo_oauth_nonce" : jQuery("#nonce").val(),
					}
					jQuery.post(mo_oauth_ajax_object.ajax_url, data, function(response){
						jQuery(".mo-oauth-test-in-progress").hide();
						jQuery(".mo-oauth-test-in-failed").hide();
						jQuery(".mo-oauth-test-successed").hide();
						jQuery(".mo-oauth-result-test").empty();
						if("wait" == response[0]){
							jQuery(".mo-oauth-test-in-progress").show();
							mo_oauth_get_test_log(response);
						}
						if("fail" == response[0]){
							jQuery(".mo-oauth-test-in-failed").show();
							clearInterval(mo_oauth_trace_test_progress);
							mo_oauth_get_test_log(response);
						}
						if("success" == response[0]){
							jQuery(".mo-oauth-test-successed").show();
							mo_oauth_get_success_div(response[1],response[2]);
							clearInterval(mo_oauth_trace_test_progress);
						}
					});
				}

				function mo_oauth_get_attr(attr_list){
					jQuery.each(attr_list, function (key, data) {
					   if("object" == typeof data ){
					   		mo_oauth_get_attr(data);	
					   }else{
					   	jQuery(".mo-oauth-test-attr-table").append("<tr><td>"+key+"</td><td>"+data+"</td></tr>");
					   }
					})
				}
				function mo_oauth_get_success_div(attr_list,username_attr){						
					jQuery(".mo-oauth-test-attr-table").find("tr:gt(0)").remove();
					jQuery(".mo-oauth-test-prefered-attr").empty();
					if(undefined != username_attr && "" != username_attr && null != username_attr){
						jQuery(".mo-oauth-test-prefered-attr").append("<b>"+username_attr+"</b> has been mapped to username attribute.&nbsp;<a href=\'"+window.location.pathname+"?page=mo_oauth_settings&tab=attributemapping\'>Click here</a> to change it.");
					}
					else{
						jQuery(".mo-oauth-test-prefered-attr").append("<a href=\'"+window.location.pathname+"?page=mo_oauth_settings&tab=attributemapping\'>Click here</a> for attribute mapping configuration.");
					}
					mo_oauth_get_attr(attr_list);
				}
				function mo_oauth_get_test_log(logs){
					var length = logs.length -1;
					mo_oauth_test_ajax_count++;
					if(2 >= length && 10 < mo_oauth_test_ajax_count){
						jQuery(".mo-oauth-test-in-progress").hide();
					    jQuery("#mo-btn-test-finish").tooltip({ items: "#mo-btn-test-finish", content: "ERROR: Test time exceed. Please check configuration once. " , offset: [45, 170], delay: 4000});
				        jQuery("#mo-btn-test-finish").tooltip("open");
				        setTimeout(function() {jQuery(".ui-tooltip").fadeOut("slow");}, 5000);
						jQuery(".mo-oauth-test-in-failed").show();
						clearInterval(mo_oauth_trace_test_progress);
					}
					var display_log_arr = {"Authorization Request Sent":0,"Token Request Sent":0,"Token Response Received":0,"Authorization Response Received":0,"Resource Owner Response":0};
					for(var i=1; i<length;i++){
						for(var key in display_log_arr){										
							var icon_class = "mo-oauth-test-right-tick";
							var info_class = "mo-oauth-test-success-info";
							if(undefined !== logs[i][1] && (-1 !== logs[i][1].indexOf("ERROR") || -1 !== logs[i][1].indexOf("error") )){							
									var icon_class = "mo-oauth-test-cross-tick";
									var info_class = "mo-oauth-test-error-info";
								}
							if(-1 !== logs[i][0].indexOf(key) && 0 === display_log_arr[key]){
								display_log_arr[key] = 1;
								jQuery(".mo-oauth-result-test").append("<div class="+icon_class+"><label>"+key+"</label></div>");
								if(undefined !== logs[i][1])
									jQuery(".mo-oauth-result-test").append("<div class="+info_class+">"+logs[i][1]+"</div>");
								jQuery(".mo-oauth-result-test").append("<div class=mo-oauth-log></div>");
								break;
							}
						}
							
					}
				}
			</script>';
}
?>