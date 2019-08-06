<?php
	
class Mo_OAuth_Client_Admin_Addons {
    
    public static function addons() {
        self::addons_page();
	}
    
    public static function addons_page(){
?>

<style>
    *,
*:after,
*:before {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.clearfix:before,
.clearfix:after {
	content: " ";
	display: table;
}

.clearfix:after {
	clear: both;
}

body {
	font-family: sans-serif;
	background: #f6f9fa;
}

/*Fun begins*/
.tab_container {
	width: 98%;
	margin: 0 auto;
	padding-top: 20px;
	position: relative;
}

.tab-input, .tab-section {
  clear: both;
  padding-top: 10px;
  display: none;
}

.tab-label {
  font-weight: 700;
  font-size: 14px;
  display: block;
  float: left;
  width: 25%;
  padding: 1.5em;
  color: #757575;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  background: #f0f0f0;
}

#tab1:checked ~ #content1,
#tab2:checked ~ #content2,
#tab3:checked ~ #content3,
#tab4:checked ~ #content4,
#tab5:checked ~ #content5 {
  display: block;
  padding: 20px;
  background: #fff;
  color: #999;
  border-bottom: 2px solid #f0f0f0;
}

.tab_container .tab-content p,
.tab_container .tab-content h3 {
    font-size: 17px;
  -webkit-animation: fadeInScale 0.7s ease-in-out;
  -moz-animation: fadeInScale 0.7s ease-in-out;
  animation: fadeInScale 0.7s ease-in-out;
}
.tab_container .tab-content h3  {
  text-align: center;
    font-size: 28px;
}

.tab_container [id^="tab"]:checked + label {
  background: #fff;
  box-shadow: inset 0 3px #0CE;
}

.tab_container [id^="tab"]:checked + label .fa {
  color: #0CE;
}

.tab-label .fa {
  font-size: 1.3em;
  margin: 0 0.4em 0 0;
}

/*Media query*/
@media only screen and (max-width: 930px) {
  .tab-label span {
    font-size: 14px;
  }
  .tab-label .fa {
    font-size: 14px;
  }
}

@media only screen and (max-width: 768px) {
  .tab-label span {
    display: none;
  }

  .tab-label .fa {
    font-size: 16px;
  }

  .tab_container {
    width: 98%;
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


<div class="tab_container">
			<input class="tab-input" id="tab1" type="radio" name="tabs" style="display:none" checked>
			<label class="tab-label" for="tab1"><i class="fa fa-code"></i><span>Page Restriction</span></label>

			<input class="tab-input" id="tab2" type="radio" style="display:none" name="tabs">
			<label class="tab-label" for="tab2"><i class="fa fa-pencil-square-o"></i><span>Buddypress Integrator</span></label>

			<input class="tab-input" id="tab3" type="radio" style="display:none" name="tabs">
			<label class="tab-label" for="tab3"><i class="fa fa-bar-chart-o"></i><span>Login Form Add-on</span></label>

			<input class="tab-input" id="tab4" type="radio" style="display:none" name="tabs">
			<label class="tab-label" for="tab4"><i class="fa fa-folder-open-o"></i><span>SCIM User Provisioning</span></label>

			<section id="content1" class="tab-section tab-content">
				<h3>Page Restriction</h3>
                       
        <ul style="list-style-type:square">
          <li><p  style="color:black">Page restriction over users is based on their roles and whether they are logged in or not. It allows you to restrict access to your WordPress pages/posts based on user roles and prevent it from unauthorize access. </p></li>
          <li><p  style="color:black">Also, allows admin to use login page other than wp-login.php.</p></li>
        </ul>
                
        <p><b>Before Login:</b> Site Admin can mark the pages/posts to be private. If the user tries to access these private marked pages/posts without being logged in then user will be redirected to OAuth Provider login page. User can access these pages/post only after authenticated from OAuth Provider. The pages/post that are not marked private can be accesses by the user without logging into the site. </p>
                
        <p><b>After Login:</b> The site admin can decide the content to be visible/accessed by the user based on their roles in the site. Site Admin can mark the pages/posts to be accesses by certain roles of the site. So, once the user is logged into the site, the user can access a particular page or post if the site admin has given the access capability to that role.</p>
                 
			</section>

			<section id="content2" class="tab-section tab-content">
				<h3>Buddypress Integrator</h3>
		    <p>This add-on allows you to integrate your User Information sent from OAuth / OpenID Provider with your BuddyPress profile.</p>
                
        <p>By default, attribute mapping is done with the attributes that are stored in the WordPress default <b>`user_meta`</b> table. This add-on allows you to map your BuddyPress User attributes with your OAuth Server User attributes. If you are using the <b>BuddyPress plugin</b> and looking for a solution where you can map the user attributes fetched from the OAuth Provider to the BuddyPress then you can opt-in for this add-on.</p>
                
			</section>

			<section id="content3" class="tab-section tab-content">
				<h3>Login Form Add-on</h3>
        <p>This add-on adds an additional functionality of using the login form instead of the login button.</p>
        <p>This login form is easily customizable using custom Cascaded Style Sheets as well as custom JavaScript. The add-on relies on the plugin to have *Password Grant* enabled and configured.</p>
                
			</section>

			<section id="content4" class="tab-section tab-content">
				<h3>SCIM User Provisioning</h3>
		      <p>This add-on synchronises Users stored in your provider(ex. Onelogin) with WordPress Users using SCIM standard.</p>
                
          <p>This User Provisioning add-on provides following operations using SCIM protocol. <br><b>Create</b>: It will create user using First Name, Last Name, Email and Username.<br><b>Update</b>: It will update user's field like First Name, Last Name.<br><b>Delete</b>: Once delete a user from OAuth Provider, it would delete a user from WordPress User list as well. </p>
        
			</section>

		</div>


<?php
    }
}