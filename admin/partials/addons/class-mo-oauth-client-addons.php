<?php
  
class Mo_OAuth_Client_Admin_Addons {

  public static function addons() {
      self::addons_page();
  }
    
    public static function addons_page(){
?>

<style>
.outermost-div {
  color: #424242;
  font-family: Open Sans!important;
  font-size: 14px;
  line-height: 1.4;
  letter-spacing: 0.3px;
}

.column_container {
  position: relative;
  box-sizing: border-box;
  margin-top: 30px;
  border-color: 1px solid red;
  z-index: 1000;
}  

.column_container > .column_inner {
  
  box-sizing: border-box;
  padding-left: 15px;
  padding-right: 10px;
  width: 100%;
  margin-right: 1px;
  font-family: Verdana, Arial, Helvetica, sans-serif;
  border-radius: 15px;
} 

.benefits-outer-block{
  padding-left: 1em;
  padding-right: 3em;
  padding-top: 3px;
  width: 80%;
  margin: 0;
  padding-bottom: 1em;
  background:#fff;
  height:230px;
  overflow: hidden;
  box-shadow: 0 5px 10px rgba(0,0,0,.20);
  border-radius: 5px;
}

.benefits-outer-block:hover{
 margin-top: -10px;
 border-top: 5px solid #0063ae;
 transition:  .3s ease-in-out;
 transform: scale(1.02);
}

.benefits-icon {
  font-size: 25px;
  padding-top: 6px;
  padding-right: 8px;
  padding-left: 8px;
  border-radius: 3px;
  padding-bottom: 5px;
  background: #1779ab;
  color: #fff;
}

.mo_2fa_addon_button{
  margin-top: 3px !important;
}

.mo_float-container {
    border: 1px solid #fff;
    padding-bottom: 50px;
   padding-top: 10px;
   padding-left: 1px;
   padding-right: 2px;
   width: 246px;
}

.mo_float-child {
    width: 17%;
    float: left;
    padding: 1px;
    padding-right: 0px;
    padding-left: 0px;
    height: 50px;
}  

.mo_float-child2{

    width: 78%;
    float: left;
    padding-left: 0px;
    padding-top:0px;
    height: 50px;
    font-weight: 700;
}

h5 {
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  text-transform: none;
  letter-spacing: 0.5px;
  color: #585858;
}

a {
  text-decoration: none;
  color: #585858;
}

@media (min-width: 768px) {
  .grid_view {
    width: 33%;
    float: left;
  }
  .row-view {
    width: 100%;
    position: relative;
    display: inline-block;
  }
}

/*Content Animation*/
@keyframes fadeInScale {
  0% {
    transform: scale(0.9);
    opacity: 0;
  }
  
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
</style>
<input type="hidden" value="<?php echo mo_oauth_is_customer_registered();?>" id="mo_customer_registered_addon">

<a  id="mobacktoaccountsetup_addon" style="display:none;" href="<?php echo add_query_arg( array( 'tab' => 'account' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">Back</a>

<form style="display:none;" id="loginform_addon"
              action="<?php echo get_option( 'host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post">
            <input type="email" name="username" value="<?php echo get_option( 'mo_oauth_admin_email' ); ?>"/>
            <input type="text" name="redirectUrl"
                   value="<?php echo "http://plugins.miniorange.com/go/oauth-2fa-buy-now-payment"; ?>"/>
            <input type="text" name="requestOrigin" id="requestOrigin"/>
</form>
<div class="mo_table_layout">
  <b><p style="padding-left: 15px;font-size: 20px;">Check out our add-ons :</p></b>
<div class="outermost-div" style="background-color:#f7f7f7;opacity:0.9;">
  <div class="row-view">
    <div class="grid_view column_container" style="border-radius: 5px;">
      <div class="column_inner" style="border-radius: 5px;">
        <div class="row benefits-outer-block">
        <div class="mo_float-container">
           <div class="mo_float-child" style="margin-left: 0px;padding-left: 0px;"> 
          <img src="<?php echo plugins_url("images/page-restriction.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-weight: 600;font-family: Verdana, Arial, Helvetica, sans-serif;" ><a href="https://developers.miniorange.com/docs/oauth/wordpress/client/page-restriction-addon" target="_blank">Page & Post Restriction</a></p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;">Allows to restrict access to WordPress pages/posts based on user roles and their login status, thereby preventing them from unauthorized access.</p>
      </div>
        </div>
    </div>  
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
           <div class="mo_float-container">
           <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/fsso.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;"><a href="http://plugins.miniorange.com/go/oauth-2fa-plugin-details" target="_blank">Two Factor Authentication</a></p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;"><b>Supported 2FA methods:- </b>Google Authenticator, OTP Over SMS, OTP Over Email, Email Verification, miniOrange methods.<br><b> Additional Features:- </b>Unlimited Users & Multisite support,Website Security features</p>
      </div>
        </div>
    </div>   
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <div class="mo_float-container">
           <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/buddypress-logo.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;"><a href="https://developers.miniorange.com/docs/oauth/wordpress/client/buddypress-integration" target="_blank">BuddyPress Integrator</a></p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">Allows to integrate user information received from OAuth/OpenID Provider with the BuddyPress profile.</p>
        </div>
      </div>
    </div> 
    <div class="row-view"> 
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <div class="mo_float-container">
           <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/login-form.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">Login Form Add-on</p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">Provides Login form for OAuth/OpenID login instead of a only a button. It relies on OAuth/OpenID plugin to have Password Grant configured. It can be customized using custom CSS and JS.</p>
        </div>
      </div>
    </div>
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
         <div class="mo_float-container">
           <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/member-login.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">Membership based Login</p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">Allows to redirect users to custom pages based on users' membership levels. Checks for the user's membership level during every login, so any update on the membership level doesn't affect redirection.</p>
        </div>
      </div>    
    </div>  
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <div class="mo_float-container">
           <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/learndash-icon.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">LearnDash Integration</p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">LearnDash is popular WordPress LMS plugin. If you want to integrate LearnDash with your IDP then you can opt-in for this add-on. This add-on will map the users to LearnDash groups based on the attributes sent by your IDP.</p>
      </div>
    </div>
  </div>
    <div class="row-view">
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
           <div class="mo_float-container">
           <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/report-icon.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">SSO Login Audit</p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">SSO Login Audit captures all the SSO users and will generate the reports.</p>
        </div>
      </div>
    </div>  
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
           <div class="mo_float-container">
           <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/attribute-icon.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2" style="width: px;">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">Attribute Based Redirection</p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">ABR add-on helps you to redirect your users to different pages after they log into your site, based on the attributes sent by your Identity Provider.</p>
        </div>
      </div>    
    </div>  
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <div class="mo_float-container">
          <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/scim-icon.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">SCIM User Provisioning</p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">This plugin allows user provisioning with SCIM standard. System for Cross-domain Identity Management is a standard for automating the exchange of user identity information between identity domains, or IT systems.</p>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row-view">
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <div class="mo_float-container">
          <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/discord.png", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">Discord Role Mapping</p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">Discord Role Mapping add-on helps you to get roles from your discord server and maps it to WordPress user while SSO.</p>
        </div>
      </div>
    </div>
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <div class="mo_float-container">
          <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/session.jpg", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">SSO Session Management
          </p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">SSO session management add-on manages the login session time of your users based on their WordPress roles.</p>
        </div>
      </div>
    </div>
     <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <div class="mo_float-container">
          <div class="mo_float-child"> 
          <img src="<?php echo plugins_url("images/media.jpg", __FILE__) ?>" width="45px" height="48px">
          </div>
          <div class="mo_float-child2">
          <div><strong><p style="font-size: 20px;margin: 1px;padding-left: 7px;line-height: 120%;font-family: Verdana, Arial, Helvetica, sans-serif;">Media Restriction
          </p></strong></div>
          </div>
        </div>
          <p style="text-align: center;font-size: 12px;">miniOrange Media Restriction add-on restrict unauthorized users from accessing the media files on your WordPress site.</p>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

<script type="text/javascript">
   function upgradeform(planType) {
                if(planType === "") {
                  
                    location.href = "https://wordpress.org/plugins/miniorange-login-with-eve-online-google-facebook/";
                    return;
                } else {
                    
                    jQuery('#requestOrigin').val(planType);
                    if(jQuery('#mo_customer_registered_addon').val()==1)
                      {
                        jQuery('#loginform_addon').submit();
                       
                    }
                    else{
                        location.href = jQuery('#mobacktoaccountsetup_addon').attr('href');
                    }
                }

            }
</script>
<?php
    }
}
?>