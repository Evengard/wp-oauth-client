<?php

class Mo_OAuth_Client_Admin_Licensing {
    public static function emit_css() {
        ?>
        <style>
            .mo-oauth-licensing-container {
                margin: 0 auto;
                padding: 10px;
            }
            .mo-oauth-licensing-header {
                /* text-align: center; */
            }
            .moct-align-left {
                text-align: left;
            }
            .moct-align-right {
                text-align: right;
            }
            .moct-align-center {
                text-align: center;
            }
            .moc-licensing-notice {
                background: #f2f2f2;
                padding: 1%;
                border-radius: 2%;
                line-height: 1;
                width: 100%;
                margin-top: 5%;
            }
            .moc-licensing-plan-header {
                font-size: 32px;
                font-variant: small-caps;
                border-radius: 1rem 1rem 0px 0px;
            }
            .moc-licensing-plan-header hr {
                margin: 1.5rem 0;
            }
            .moc-licensing-plan-feature-list {
                font-size: 12px;
                padding-top: 10px;
            }
            .moc-licensing-plan-feature-list li {
                text-align: left;
                padding: 10px;
                border: none;
            }
            .moc-licensing-plan-feature-list li:nth-child(even) {
                background-color: #f0f0f0;
            }
            .moc-licensing-plan-usp {
                font-size: 18px;
                font-weight: 500;
                padding-bottom: 10px;
            }
            .moc-licensing-plan-price {
                font-size: 24px;
                font-weight: 400;
            }
            .moc-licensing-plan-name {  
                font-size: 16px;    
                font-weight: 500;   
            }   
            .moc-all-inclusive-licensing-plan-name {    
                font-size: 40px;    
                font-weight: 500;   
            }
            .moc-licensing-plan {
                border-radius: 1rem;
                border: 1px solid #00788E;
                margin: 0.5rem 0;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);
                transition: 0.3s;
            }
            .moc-licensing-plan:hover {
                margin-top: -.25rem;
                margin-bottom: .25rem;
                /* border: 1px solid #17a2b8; */
                border: 1px solid rgb(112, 165, 245);
                box-shadow: 0 16px 32px 0 rgba(112, 165, 245, 0.8);
            }
            .moc-lp-buy-btn {
                border-radius: 5rem;
                letter-spacing: .1rem;
                font-weight: bold;
                padding: 1rem;
                opacity: 0.7;
            }
            .moc-lp-buy-btn:hover {
                opacity: 1;
            }
            .moc-lp-highlight {
                box-shadow: 0 16px 32px 0 #563d7c66;
                border: 1px solid #2B1251;
            }
            .moc-lp-highlight:hover {
                border: 1px solid #563d7c;
                box-shadow: 0 16px 32px 0 #563d7ccc;
            }
            .btn-purple {
                color: #ffffff;
                background: radial-gradient(circle, #563d7c, #452c6b);
                border-color: #563d7c;
            }
            .btn-purple:hover {
                background: radial-gradient(circle, #452c6b, #563d7c);
            }
            .cd-pricing-switcher {
                margin-top: 2em;
                text-align: center;
            }
            .cd-pricing-switcher .fieldset {
                display: inline-block;
                position: relative;
                border-radius: 50em;
                border: 1px solid #17a2b8;
                background-color: #17a2b8;
            }
            .cd-pricing-switcher input[type="radio"] {
                position: absolute;
                opacity: 0;
            }
            .cd-pricing-switcher label {
                position: relative;
                z-index: 1;
                display: inline-block;
                float: left;
                width: 160px;
                height: 40px;
                line-height: 40px;
                cursor: pointer;
                font-size: 1.4rem;
                color: #FFFFFF;
                font-size:18px;
                margin-bottom: 5px;
            }
            .cd-pricing-switcher .cd-switch {
                /* floating background */
                position: absolute;
                top: 2px;
                left: 2px;
                height: 40px;
                width: 160px;
                background-color: black;
                border-radius: 50em;
                -webkit-transition: -webkit-transform 0.5s;
                -moz-transition: -moz-transform 0.5s;
                transition: transform 0.5s;
            }
            .cd-pricing-switcher input[type="radio"]:checked + label + .cd-switch,
            .cd-pricing-switcher input[type="radio"]:checked + label:nth-of-type(n) + .cd-switch {
                /* use label:nth-of-type(n) to fix a bug on safari with multiple adjacent-sibling selectors*/
                -webkit-transform: translateX(155px);
                -moz-transform: translateX(155px);
                -ms-transform: translateX(155px);
                -o-transform: translateX(155px);
                transform: translateX(155px);
            }
            h4 {
                font-size: 13px;
                margin: 1.33em 0px;
                font-weight: 600;
            }
        </style>
        <?php
    }
    public static function show_licensing_page(){
        self::emit_css();
        ?>
        <!-- Important JSForms -->
        <input type="hidden" value="<?php echo mo_oauth_is_customer_registered();?>" id="mo_customer_registered">
        <form style="display:none;" id="loginform"
              action="<?php echo get_option( 'host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post">
            <input type="email" name="username" value="<?php echo get_option( 'mo_oauth_admin_email' ); ?>"/>
            <input type="text" name="redirectUrl"
                   value="<?php echo get_option( 'host_name' ) . '/moas/initializepayment'; ?>"/>
            <input type="text" name="requestOrigin" id="requestOrigin"/>
        </form>
        <form style="display:none;" id="viewlicensekeys"
              action="<?php echo get_option( 'host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post">
            <input type="email" name="username" value="<?php echo get_option( 'mo_oauth_admin_email' ); ?>"/>
            <input type="text" name="redirectUrl"
                   value="<?php echo get_option( 'host_name' ) . '/moas/viewlicensekeys'; ?>"/>
        </form>
        <!-- End Important JSForms -->
        <!-- Licensing Table -->
        <div class="cd-pricing-switcher">
            <p class="fieldset">
                <input type="radio" name="sitetype" value="singlesite" id="singlesite" checked>
                <label for="singlesite"><?php _e('Single Site','miniorange-login-with-eve-online-google-facebook'); ?></label>
                <input type="radio" name="sitetype" value="multisite" id="multisite">
                <label for="multisite"><?php _e('Multisite Network','miniorange-login-with-eve-online-google-facebook'); ?></label>
                <span class="cd-switch"></span>
            </p>
        </div>
    
        <div class="mo-oauth-licensing-container">
        <div class="mo-oauth-licensing-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 moct-align-right">
                        &nbsp;
                    </div>
                    <div class="col-6 moct-align-right">
                        &nbsp;
                    </div>
                </div>
                <div id="single-site-section">
                <div class="row justify-content-center mx-15">
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">Unlimited user creation<br>+<br>Advanced Attribute Mapping</div><div><br></div>
                                <div class="moc-licensing-plan-price"><small>[STANDARD]</small></div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>349<sup>*</sup></div>
                            </div>
                            <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_standard_plan')"><?php _e('Buy Now','miniorange-login-with-eve-online-google-facebook'); ?></button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;1 OAuth / OpenID Connect provider <br>Support</li>
                                    <li>&#9989;&emsp;Auto Create Users (Unlimited Users)</li>
                                    <li>&#9989;&emsp;Account Linking</li>
                                    <li>&#9989;&emsp;Advanced Attribute Mapping</li>
                                    <li>&#9989;&emsp;Login Widget, Shortcode and Login Link</li>
                                    <!-- <li>&#9989;&emsp;Authorization Code Grant&nbsp;<br>&nbsp;<br>&nbsp;<br></li> -->
                                    <li>&#9989;&emsp;Authorization Code Grant&nbsp;<br>&nbsp;<br></li>
                                    <li>&#9989;&emsp;Login Button Customization</li>
                                    <li>&#9989;&emsp;Custom Redirect URL after login and logout</li>
                                    <li>&#9989;&emsp;Basic Role Mapping</li>
                                    <li>&#10060;&emsp;<span class="text-muted">JWT Support</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Protect complete site</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Domain specific registration</span></li>
                                    <!-- <li>&#10060;&emsp;<span class="text-muted">Multi-site Support</span></li>                                     -->
                                    <li>&#10060;&emsp;<span class="text-muted">Hide & Disable WP Login</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Dynamic Callback URL</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Add-Ons Support</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">Protect site with SSO login<br>+<br>Email Domains restriction</div><div><br></div>
                                <div class="moc-licensing-plan-price"><small>[PREMIUM]</small></div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>499<sup>*</sup></div>
                            </div>
                            <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_premium_plan')"><?php _e('Buy Now','miniorange-login-with-eve-online-google-facebook'); ?></button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;1 OAuth / OpenID Connect provider <br>Support</li>
                                    <li>&#9989;&emsp;Auto Create Users (Unlimited Users)</li>
                                    <li>&#9989;&emsp;Account Linking</li>
                                    <li>&#9989;&emsp;Advanced + Custom Attribute Mapping</li>
                                    <li>&#9989;&emsp;Login Widget, Shortcode and Login Link</li>
                                    <li>&#9989;&emsp;Authorization Code Grant, Password Grant, Implicit Grant, Refresh token Grant</li>
                                    <li>&#9989;&emsp;Login Button Customization</li>
                                    <li>&#9989;&emsp;Custom Redirect URL after login and logout</li>
                                    <li>&#9989;&emsp;Advanced Role + Group Mapping</li>
                                    <li>&#9989;&emsp;JWT Support</li>
                                    <li>&#9989;&emsp;Protect complete site</li>
                                    <li>&#9989;&emsp;Domain specific registration</li>
                                    <!-- <li>&#9989;&emsp;Multi-site Support*</li> -->
                                    <li>&#10060;&emsp;<span class="text-muted">Hide & Disable WP Login</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Dynamic Callback URL</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Add-Ons Support</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body moc-lp-highlight">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">Multiple providers support<br>+<br>Dynamic Callback URL<br>+<br>Developer Hooks</div>
                                <div class="moc-licensing-plan-price"><small>[ENTERPRISE]</small></div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>549<sup>*</sup></div>
                            </div>
                            <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_enterprise_plan')"><?php _e('Buy Now','miniorange-login-with-eve-online-google-facebook'); ?></button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;Unlimited OAuth / OpenID Connect <br>provider Support</li>
                                    <li>&#9989;&emsp;Auto Create Users (Unlimited Users)</li>
                                    <li>&#9989;&emsp;Account Linking</li>
                                    <li>&#9989;&emsp;Advanced + Custom Attribute Mapping</li>
                                    <li>&#9989;&emsp;Login Widget, Shortcode and Login Link</li>
                                    <li>&#9989;&emsp;Authorization Code Grant, Password Grant, Client Credentials Grant, Implicit Grant, Refresh token Grant</li>
                                    <li>&#9989;&emsp;Login Button Customization</li>
                                    <li>&#9989;&emsp;Custom Redirect URL after login and logout</li>
                                    <li>&#9989;&emsp;Advanced Role + Group Mapping</li>
                                    <li>&#9989;&emsp;JWT Support</li>
                                    <li>&#9989;&emsp;Protect complete site</li>
                                    <li>&#9989;&emsp;Domain specific registration</li>
                                    <li>&#9989;&emsp;Hide & Disable WP Login</li>
                                    <!-- <li>&#9989;&emsp;Multi-site Support*</li> -->
                                    <li>&#9989;&emsp;Dynamic Callback URL</li>
                                    <li>&#9989;&emsp;WP hooks to read token, login event and extend plugin functionality</li>
                                    <li>&#9989;&emsp;End User Login Reports / Analytics</li>
                                    <li>&#10060;&emsp;<span class="text-muted">Add-Ons Support</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body moc-lp-highlight">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-all-inclusive-licensing-plan-name">All-Inclusive Plan<br></div>
                                <div class="moc-licensing-plan-price"><small><br></small></div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>699<sup>*</sup></div>
                            </div>
                            <button class="btn btn-block btn-purple text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_all_inclusive_single_site_plan')"><?php _e('Buy Now','miniorange-login-with-eve-online-google-facebook'); ?></button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;<b>All Advanced SSO Features</b></li>
                                    <li>&#9989;&emsp;<b>Add-Ons Support for below Add-Ons:</b></li>
                                        <ul style="list-style-position: inside";>
                                            <li type="square">Real Time User Provisioning from IDP to WordPress - SCIM,</li>
                                            <li type="square">Page Restriction,</li>
                                            <li type="square">BuddyPress Attribute Mapping,</li>
                                            <li type="square">Login Form Add-On,</li>
                                            <li type="square">Discord Role Mapping,</li>
                                            <li type="square">LearnDash Attribute Integration Add-On,</li>
                                            <li type="square">Media Restriction Add-On (Premium Plan),</li>
                                            <li type="square">Attribute based Redirection,</li>
                                            <li type="square">SSO Session Management,</li>
                                            <li type="square">Membership Level Based Login Redirection,</li>
                                            <li type="square">SSO Login Audit,</li>
                                            <li type="square">Azure Forgot/Reset Password Policy Add-on,</li>
                                            <li type="square">Regex Role Mapping Add-on</li>
                                            <li><br></li>
                                            <li><br></li>
                                            <li><br></li>
                                            <li><br></li>
                                        </ul><br>
                                    <!-- </li> -->
                                </ul>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div id="multisite-network-section" style="display: none;">
                <div class="row justify-content-center mx-15">
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">Protect site with SSO login<br>+<br>Email Domains restriction</div><div><br></div>
                                <div class="moc-licensing-plan-price"><small>[PREMIUM]</small></div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>499<sup>*</sup></div>
                            </div>
                            <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_multisite_premium_plan')">Buy Now</button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;1 OAuth / OpenID Connect provider <br>Support</li>
                                    <li>&#9989;&emsp;Auto Create Users (Unlimited Users)</li>
                                    <li>&#9989;&emsp;Account Linking</li>
                                    <li>&#9989;&emsp;Advanced + Custom Attribute Mapping</li>
                                    <li>&#9989;&emsp;Login Widget, Shortcode and Login Link</li>
                                    <li>&#9989;&emsp;Authorization Code Grant, Password Grant, Implicit Grant, Refresh token Grant</li>
                                    <li>&#9989;&emsp;Login Button Customization</li>
                                    <li>&#9989;&emsp;Custom Redirect URL after login and logout</li>
                                    <li>&#9989;&emsp;Advanced Role + Group Mapping</li>
                                    <li>&#9989;&emsp;JWT Support</li>
                                    <li>&#9989;&emsp;Protect complete site</li>
                                    <li>&#9989;&emsp;Domain specific registration</li>
                                    <li>&#9989;&emsp;Multi-site Support*</li>
                                    <!-- <li>&#9989;&emsp;Multi-site Support*</li> -->
                                    <li>&#10060;&emsp;<span class="text-muted">Hide & Disable WP Login</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Dynamic Callback URL</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Add-Ons Support</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body moc-lp-highlight">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">Multiple providers support<br>+<br>Dynamic Callback URL<br>+<br>Developer Hooks</div>
                                <div class="moc-licensing-plan-price"><small>[ENTERPRISE]</small></div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>549<sup>*</sup></div>
                            </div>
                            <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_multisite_enterprise_plan')">Buy Now</button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;Unlimited OAuth / OpenID Connect <br>provider Support</li>
                                    <li>&#9989;&emsp;Auto Create Users (Unlimited Users)</li>
                                    <li>&#9989;&emsp;Account Linking</li>
                                    <li>&#9989;&emsp;Advanced + Custom Attribute Mapping</li>
                                    <li>&#9989;&emsp;Login Widget, Shortcode and Login Link</li>
                                    <li>&#9989;&emsp;Authorization Code Grant, Password Grant, Client Credentials Grant, Implicit Grant, Refresh token Grant</li>
                                    <li>&#9989;&emsp;Login Button Customization</li>
                                    <li>&#9989;&emsp;Custom Redirect URL after login and logout</li>
                                    <li>&#9989;&emsp;Advanced Role + Group Mapping</li>
                                    <li>&#9989;&emsp;JWT Support</li>
                                    <li>&#9989;&emsp;Protect complete site</li>
                                    <li>&#9989;&emsp;Domain specific registration</li>
                                    <li>&#9989;&emsp;Multi-site Support*</li>
                                    <li>&#9989;&emsp;Hide & Disable WP Login</li>
                                    <li>&#9989;&emsp;Dynamic Callback URL</li>
                                    <li>&#9989;&emsp;WP hooks to read token, login event and extend plugin functionality</li>
                                    <li>&#9989;&emsp;End User Login Reports / Analytics</li>
                                    <li>&#10060;&emsp;<span class="text-muted">Add-Ons Support</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body moc-lp-highlight">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-all-inclusive-licensing-plan-name">All-Inclusive Plan<br></div>
                                <div class="moc-licensing-plan-price"><small><br></small></div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>699<sup>*</sup></div>
                            </div>
                            <button class="btn btn-block btn-purple text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_all_inclusive_multisite_plan')">Buy Now</button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;<b>All Advanced SSO Features</b></li>
                                    <li>&#9989; <b>Add-Ons Support for below Add-Ons:</b></li>
                                        <ul style="list-style-position: inside";>
                                            <li type="square">Real Time User Provisioning from IDP to WordPress - SCIM,</li>
                                            <li type="square">Page Restriction,</li>
                                            <li type="square">BuddyPress Attribute Mapping,</li>
                                            <li type="square">Login Form Add-On,</li>
                                            <li type="square">Discord Role Mapping,</li>
                                            <li type="square">LearnDash Attribute Integration Add-On,</li>
                                            <li type="square">Media Restriction Add-On (Premium Plan),</li>
                                            <li type="square">Attribute based Redirection,</li>
                                            <li type="square">SSO Session Management,</li>
                                            <li type="square">Membership Level Based Login Redirection,</li>
                                            <li type="square">SSO Login Audit,</li>
                                            <li type="square">Azure Forgot/Reset Password Policy Add-on,</li>
                                            <li type="square">Regex Role Mapping Add-on</li>
                                            <li><br></li>
                                            <li><br></li>
                                            <li><br></li>
                                            <li><br></li>
                                            <li><br></li>
                                        </ul><br>
                                    <!-- </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>    
                    <!-- Licensing Plans End -->
                    <div class="moc-licensing-notice"><b>
                        <span style="color: red;">*</span>Cost applicable for one instance only. Licenses are perpetual and the Support Plan includes 12 months of maintenance (support and version updates). You can renew maintenance after 12 months at 50% of the current license cost.<br><br>

                        <p><span style="color: red;">*</span>We provide deep discounts on bulk license purchases and pre-production environment licenses. As the no. of licenses increases, the discount percentage also increases.</p>
                        <p><span style="color: red;">*</span><strong>MultiSite Network Support</strong><br>
                            There is an additional cost for the number of subsites in Multisite Network. The Multisite licenses are based on the <b>total number of subsites</b> in your WordPress Network.</p></b>

                        <p>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you purchased is not working as advertised and you've attempted to resolve any issues with our support team, which couldn't get resolved. Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> for any queries regarding the return policy.</p>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Licensing Table -->
        <a  id="mobacktoaccountsetup" style="display:none;" href="<?php echo add_query_arg( array( 'tab' => 'account' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">Back</a>
        <!-- JSForms Controllers -->
        <script>
            jQuery("input[name=sitetype]:radio").change(function() {

                if (this.value == 'multisite') {
                    jQuery('#single-site-section').css('display','none');
                    jQuery('#multisite-network-section').css('display','block');

                }
                else {
                    jQuery('#single-site-section').css('display','block');
                    jQuery('#multisite-network-section').css('display','none');

                }
            });   

            function upgradeform(planType) {
                if(planType === "") {
                    location.href = "https://wordpress.org/plugins/miniorange-login-with-eve-online-google-facebook/";
                    return;
                } else {
                    jQuery('#requestOrigin').val(planType);
                    if(jQuery('#mo_customer_registered').val()==1)
                        jQuery('#loginform').submit();
                    else{
                        location.href = jQuery('#mobacktoaccountsetup').attr('href');
                    }
                }

            }

            function getlicensekeys() {
                // if(jQuery('#mo_customer_registered').val()==1)
                jQuery('#viewlicensekeys').submit();
            }
        </script>
        <!-- End JSForms Controllers -->
        <?php
    }
}