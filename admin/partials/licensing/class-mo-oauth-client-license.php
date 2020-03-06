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
                width: 90%;
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
                font-size: 32px;
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
                <div class="row justify-content-center mx-15">
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">standard</div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>299<sup>*</sup></div>
                                <div class="moc-licensing-plan-usp">(Attribute Mapping + Login <br>Customization)<br></div>
                            </div>
                            <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_standard_plan')">Buy Now</button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;1 OAuth / OpenID Connect provider <br>Support</li>
                                    <li>&#9989;&emsp;Auto Create Users (Unlimited Users)</li>
                                    <li>&#9989;&emsp;Account Linking</li>
                                    <li>&#9989;&emsp;Advanced Attribute Mapping<br>&nbsp;</li>
                                    <li>&#9989;&emsp;Login Widget, Shortcode and Login Link</li>
                                    <li>&#9989;&emsp;Authorization Code Grant&nbsp;<br>&nbsp;<br>&nbsp;<br></li>
                                    <li>&#9989;&emsp;Login Button Customization</li>
                                    <li>&#9989;&emsp;Custom Redirect URL after login and logout</li>
                                    <li>&#9989;&emsp;Basic Role Mapping</li>
                                    <li>&#10060;&emsp;<span class="text-muted">JWT Support</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Protect complete site</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Domain specific registration</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Multi-site Support</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Add-Ons Support( BuddyPress Attribute Mapping, Page Restriction)</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Dynamic Callback URL</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">premium</div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>449<sup>*</sup></div>
                                <div class="moc-licensing-plan-usp">(Role + Group <br>Mapping)</div>
                            </div>
                            <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_premium_plan')">Buy Now</button>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;&emsp;1 OAuth / OpenID Connect provider <br>Support</li>
                                    <li>&#9989;&emsp;Auto Create Users (Unlimited Users)</li>
                                    <li>&#9989;&emsp;Account Linking</li>
                                    <li>&#9989;&emsp;Advanced + Custom Attribute Mapping</li>
                                    <li>&#9989;&emsp;Login Widget, Shortcode and Login Link</li>
                                    <li>&#9989;&emsp;Authorization Code Grant, Password Grant, Implicit Grant, Refresh token Grant<br>&nbsp;<br></li>
                                    <li>&#9989;&emsp;Login Button Customization</li>
                                    <li>&#9989;&emsp;Custom Redirect URL after login and logout</li>
                                    <li>&#9989;&emsp;Advanced Role + Group Mapping</li>
                                    <li>&#9989;&emsp;JWT Support</li>
                                    <li>&#9989;&emsp;Protect complete site</li>
                                    <li>&#9989;&emsp;Domain specific registration</li>
                                    <li>&#9989;&emsp;Multi-site Support*</li>
                                    <li>&#10060;&emsp;<span class="text-muted">Add-Ons Support( BuddyPress Attribute Mapping, Page Restriction)</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">Dynamic Callback URL</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>
                                    <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body moc-lp-highlight">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">enterprise</div>
                                <div class="moc-licensing-plan-price"><sup>$</sup>499<sup>*</sup></div>
                                <div class="moc-licensing-plan-usp">(Page Restriction and other <br>Add-ons)</div>
                            </div>
                            <button class="btn btn-block btn-purple text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_client_enterprise_plan')">Buy Now</button>
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
                                    <li>&#9989;&emsp;Add-Ons Support( BuddyPress Attribute Mapping, Page Restriction)</li>
                                    <li>&#9989;&emsp;Dynamic Callback URL</li>
                                    <li>&#9989;&emsp;WP hooks to read token, login event and extend plugin functionality</li>
                                    <li>&#9989;&emsp;End User Login Reports / Analytics</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 moct-align-center">
                        <div class="moc-licensing-plan card-body">
                            <div class="moc-licensing-plan-header">
                                <div class="moc-licensing-plan-name">OAuth Client + Cloud IDP Package</div>
                                </div>
                            <a class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" href="mailto:info@xecurify.com" target="_blank">Contact Us</a>
                            <br>
                            <div class="moc-licensing-plan-price"><sup>$</sup>299 +<sup>$</sup>0.0019<sup>**</sup></div>
                            <div class="moc-licensing-plan-usp">(miniOrange Cloud IDP(B2C))</div>
                            <div class="moc-licensing-plan-feature-list">
                                <ul>
                                    <li>&#9989;Features provided in selected WP OAuth <br>Client SSO Plan</li>
                                    <li>&#9989;Upto 50k Free User authentications</li>
                                    <li>&#9989;Free SSO Setup with miniOrange Cloud IDP/OAuth Server</li>
                                    <li>&#9989;Free Migration from existing IDP/User Directory</li>
                                </ul>
                                <!--                                        <p><b>Looking for a OAuth Server/User storage? <br><br>We have a B2C Service(Cloud IDP) which can scale to hundreds of millions of consumer identities.</b></br></p>-->
                                <b>Please <a href="https://idp.miniorange.com/b2c-pricing" target="_blank"><u>click here</u></a> to know more about our Identity Provider Services.
                                    <ul>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Licensing Plans End -->
                    <div class="moc-licensing-notice">
                        <span style="color: red;">**</span>OAuth Client + Cloud IDP Package Pricing will be based on plugin plan you select + Cloud IDP pricing per User authentication(first 50,000 authentications would be free).<br><br>
                        <span style="color: red;">*</span>Cost applicable for one instance only. Licenses are perpetual and the Support Plan includes 12 months of maintenance (support and version updates). You can renew maintenance after 12 months at 50% of the current license cost.
                        <p><span style="color: red;">*</span><strong>MultiSite Network Support</strong>
                            There is an additional cost for the number of subsites in Multisite Network.</p>

                        <p>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you purchased is not working as advertised and you've attempted to resolve any issues with our support team, which couldn't get resolved. Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> for any queries regarding the return policy.</p>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Licensing Table -->
        <a  id="mobacktoaccountsetup" style="display:none;" href="<?php echo add_query_arg( array( 'tab' => 'account' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">Back</a>
        <!-- JSForms Controllers -->
        <script>
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