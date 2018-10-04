<?php



class Mo_OAuth_Client_Admin_Licesing {
	
	public static function license_page() {
		
		?>

        <div class="mo_oauth_table_layout">

        <span style="float:right;margin-top:5px"><input type="button" name="ok_btn" id="ok_btn" class="button button-primary button-large" value="OK, Got It" onclick="window.location.href='admin.php?page=mo_oauth_settings'" /></span>
        <h2>Licensing Plans</h2>
        <hr>
        <table class="table mo_table-bordered mo_table-striped">

            <thead>
            <tr style="background-color:#0085ba">
                <th width="20%"><br><br><br>
                    <h3><font color="#FFFFFF">Features \ Plans</font></h3></th>
                <th class="text-center" width="10%"><br><br><br></h3><p class="mo_plan-desc"></p><h3><font color="#FFFFFF">FREE</font><b class="tooltip"><span class="tooltiptext"></span></b><br><span>
                </span></h3></th>
                <th class="text-center" width="10%"><h3><font color="#FFFFFF">Standard<br></font></h3><p class="mo_plan-desc"></p><h3><b class="tooltip"><font color="#FFFFFF">$149</font><span class="tooltiptext">Cost applicable for one instance only.</span></b><br><br><span>

                <input type="button" name="upgrade_btn" class="button button-default button-large" value="Upgrade Now"
                       onclick="getupgradelicensesform('wp_oauth_client_standard_plan')"/>


                </span></h3></th>

                <th class="text-center" width="10%"><h3><font color="#FFFFFF">Premium</font></h3><p></p><p class="mo_plan-desc"></p><h3><b class="tooltip"><font color="#FFFFFF">$349</font><span class="tooltiptext">Cost applicable for one instance only.</span></b><br><br><span>
      <input type="button" name="upgrade_btn" class="button button-default button-large" value="Upgrade Now"
                       onclick="getupgradelicensesform('wp_oauth_client_premium_plan')"/>

            </th>
            <th class="text-center" width="10%"><h3><font color="#FFFFFF">Enterprise</font></h3><p></p><p class="mo_plan-desc"></p><h3><b class="tooltip"><font color="#FFFFFF">$449</font><span class="tooltiptext">Cost applicable for one instance only.</span></b><br><br><span>
      <input type="button" name="upgrade_btn" class="button button-default button-large" value="Upgrade Now"
                       onclick="getupgradelicensesform('wp_oauth_client_enterprise_plan')"/>

            </th></tr>
            </thead>
            <tbody class="mo_align-center mo-fa-icon">
            <tr>
                <td>OAuth Provider Support</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>Unlimited</td>
            </tr>
            <tr>
                <td>Auto Create Users</td>
                <td>Upto 10 Users</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
                <td>Unlimited</td>
            </tr>
            <tr>
            <td>Auto fill OAuth servers configuration</td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
            <td>Basic Attribute Mapping (Email, FirstName)</td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Login Widget</td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Advanced Attribute Mapping (Username, FirstName, LastName, Email, Group Name)</td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Login using the link / Shortcode</td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Custom login buttons and CSS</td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Custom Redirect URL after login and logout</td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
             <tr>
                <td>Basic Role Mapping (Support for default role for new users)</td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Advanced Role Mapping</td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Custom Attribute Mapping</td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Force authentication / Protect complete site</td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>OpenId Connect Support (Login using OpenId Connect Server)</td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Multiple Userinfo endpoints support</td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Domain specific registration </td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Multi-site Support</td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Reverse Proxy Support</td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Account Linking </td>
                <td></td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>BuddyPress Attribute Mapping</td>
                <td></td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Dynamic Callback URL</td>
                <td></td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Page Restriction</td>
                <td></td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>WP hooks for different events</td>
                <td></td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
            <tr>
                <td>Login Reports / Analytics</td>
                <td></td>
                <td></td>
                <td></td>
                <td><img style="width:10px;height:10px;" src="<?php echo plugin_dir_url( __FILE__ );?>/img/tick.png"></i></td>
            </tr>
        </table>
        <form style="display:none;" id="loginform" action="<?php echo get_option( 'host_name').'/moas/login'; ?>"
        target="_blank" method="post">
        <input type="email" name="username" value="<?php echo get_option('mo_oauth_admin_email'); ?>" />
        <input type="text" name="redirectUrl" value="<?php echo get_option( 'host_name').'/moas/viewlicensekeys'; ?>" />
        <input type="text" name="requestOrigin" id="requestOrigin1"  />
        </form>
        <form style="display:none;" id="licenseform" action="<?php echo get_option( 'host_name').'/moas/login'; ?>"
        target="_blank" method="post">
        <input type="email" name="username" value="<?php echo get_option('mo_oauth_admin_email'); ?>" />
        <input type="text" name="redirectUrl" value="<?php echo get_option( 'host_name').'/moas/initializepayment'; ?>" />
        <input type="text" name="requestOrigin" id="requestOrigin2"  />
        </form>
        <script>

            function getupgradelicensesform(planType){
                jQuery('#requestOrigin2').val(planType);
                jQuery('#licenseform').submit();
            }
            jQuery('.mo_oauth_content').css("width","100%");
        </script>
        <br>
        <h3>* Steps to upgrade to premium plugin -</h3>
        <p>1. You will be redirected to miniOrange Login Console. Enter your password with which you created an account with us. After that you will be redirected to payment page.</p>
        <p>2. Enter you card details and complete the payment. On successful payment completion, you will see the link to download the premium plugin.</p>
        </div>

    <?php
}
	


}

?>