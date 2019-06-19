=== OAuth Single Sign On - SSO (OAuth client) ===
Contributors: cyberlord92,oauth
Tags: oauth, oauth client, single sign on, sso, wordpress single sign on
Requires at least: 3.0.1
Tested up to: 5.2.1
Stable tag: 6.11.0
License: GPLv2 or later
License URI: http://miniorange.com/usecases/miniOrange_User_Agreement.pdf

OAuth Login plugin allows Single Sign-On with Azure AD, AWS Cognito, Invision Community, slack, discord custom OAuth 2.0 and OpenID Connect (OIDC) servers.

== Description ==

This plugin allows login (Single Sign On) with your Azure AD, AWS Cognito, Invision Community, slack, discord or other custom OAuth 2.0 providers. OAuth Client plugin works with any Identity provider that conforms to the OAuth 2.0 and OpenID Connect (OIDC) 1.0 standard.

= FREE VERSION FEATURES =

*	OAuth Login supports single sign-on / SSO with any 3rd party OAuth /OpenID Connect server or custom OAuth /OpenID Connect server.
*   Auto Create Users : After SSO, new user automatically gets created in WordPress
*	Account Linking : After user SSO to WordPress, if user already exists in WordPress, then his profile gets updated
*	Attribute Mapping : OAuth Login supports basic Attribute Mapping feature to map WordPress user profile attributes like email and first name. Manage username & email with data provided
*	Login Widget : Use Widgets to easily integrate the login link with your WordPress site
*	OAuth / OpenID Connect Provider Support : OAuth Login supports only one OAuth / OpenID Connect Provider. 
*	Redirect URL after Login : OAuth Login Automatically Redirects user after successful login. 
*	Logging :  If you run into issues OAuth Login can be helpful to enable debug logging


= STANDARD VERSION FEATURES =

*	All the FREE Version Features included.
*	Optionally Auto Register Users : OAuth Login does automatic user registration after login if the user is not already registered with your site
*	Attribute Mapping : OAuth Login provides custom Attribute Mapping feature to map WordPress user profile attributes like username, firstname, lastname, email and profile picture. Manage username & email with data provided
*	Support for Shortcode : Use shortcode to place OAuth login button anywhere in your Theme or Plugin
*	Customize Login Buttons / Icons / Text : Wide range of OAuth login Buttons/Icons and it allows you to customize Text shadow
*	Custom Redirect URL after Login : OAuth Login provides Auto Redirection and this is useful if you wanted to globally  protect your whole site
*	Redirect URL after logout : OAuth Login auto Redirect Users to custom URL after logout in WordPress
*	Basic Role Mapping :  Assign default role to user registering through OAuth Login based on rules you define.


= PREMIUM VERSION FEATURES =

*	All the STANDARD Version Features
*	Advanced Role Mapping : Assign roles to users registering through OAuth Login based on rules you define.
*	Force Authentication / Protect Complete Site : Allows user to restrict login / authorization for particular site
*	Multiple Userinfo Endpoints Support : OAuth Login supports multiple Userinfo Endpoints.
*	App domain specific Registration Restrictions : OAuth Login restricts registration on your site based on the person's email address domain
*	Multi-site Support : OAuth Login have unique ability to support multiple sites under one account

= ENTERPRISE VERSION FEATURES =

*	All the PREMIUM Version Features
*	Multiple OAuth / OpenID Connect Provider Support
*	Single Login button for Multiple Apps : It provides single login button for multiple providers
*	Extended OAuth API support : Extend OAuth API support to extend functionality to the existing OAuth client.
*	BuddyPress Attribute Mapping : OAuth Login allows BuddyPress Attribute Mapping.
*	Page Restriction according to roles : Limit Access to pages based on user status or roles. This WordPress OAuth Login plugin allows you to restrict access to the content of a page or post to which only certain group of users can access.
*	WP Hooks for Different Events : Provides support for different hooks for user defined functions
*	Login Reports : OAuth Login creates user login and registration reports based on application used. 


= No SSL restriction =
*	Login to WordPress using Google credentials (Google Apps Login) or any other app without having an SSL or HTTPS enabled site.

= List of popular OAuth Providers we support =
*	Azure AD
*	AWS Cognito
*   WHMCS
*   Ping Federate
*	Slack
*	Discord
*	HR Answerlink / Support center
*	WSO2
*	Wechat
*	Weibo
*   LinkedIn
*	Gitlab
*	Shibboleth
*	Blizzard (Formerly Battle.net)
*	servicem8
*	Meetup
*	Eve Online
*	Gluu Server

= List of popular OpenID Connect (OIDC) Providers we support =
*	Amazon
*	Salesforce
*	PayPal
*	Google
*	AWS Cognito
*	Okta
*	OneLogin
*	Yahoo
*	ADFS
*	Gigya

= List of grant types we support =
*   Authorization code grant
*   Implicit grant
*   Resource owner credentials grant (Password Grant)
*   Client credentials grant
*   Refresh token grant


= Other OAuth Providers we support =
*	Other oauth 2.0 providers oauth single sign-on plugin support includes Autodesk, Zendesk, Foursquare, Harvest, Mailchimp, Bitrix24, Spotify, Vkontakte, Huddle, Reddit, Strava, Ustream, Yammer, RunKeeper, Instagram, SoundCloud, Pocket, PayPal, Pinterest, Vimeo, Nest, Heroku, DropBox, Buffer, Box, Hubic, Deezer, DeviantArt, Delicious, Dailymotion, Bitly, Mondo, Netatmo, Amazon, FitBit, Clever, Sqaure Connect, Windows, Dash 10, Github, Invision Community, Blizzar, authlete, Keycloak etc.


== Installation ==

= From your WordPress dashboard =
1. Visit `Plugins > Add New`
2. Search for `oauth`. Find and Install `oauth` plugin by miniOrange
3. Activate the plugin

= From WordPress.org =
1. Download WordPress OAuth Login (OAuth Client).
2. Unzip and upload the `miniorange-oauth-login` directory to your `/wp-content/plugins/` directory.
3. Activate miniOrange OAuth from your Plugins page.

= Once Activated =
1. Go to `Settings-> miniOrange OAuth -> Configure OAuth`, and follow the instructions
2. Go to `Appearance->Widgets` ,in available widgets you will find `miniOrange OAuth` widget, drag it to chosen widget area where you want it to appear.
3. Now visit your site and y-ou will see login with widget.

= For Viewing Corporation, Alliance, Character Name in user profile =
To view Corporation, Alliance and Character Name in edit user profile, copy the following code in the end of your theme's `Theme Functions(functions.php)`. You can find `Theme Functions(functions.php)` in `Appearance->Editor`.
<code>
add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
</code>

== Frequently Asked Questions ==
= I need to customize the plugin or I need support and help? =
Please email us at info@xecurify.com or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I don't see any applications to configure. I only see Register to miniOrange? =
Our very simple and easy registration lets you register to miniOrange. OAuth login works if you are connected to miniOrange. Once you have registered with a valid email-address and phone number, you will be able to configure applications for OAuth.

= How to configure the applications? =
When you want to configure a particular application, you will see a Save Settings button, and beside that a Help button. Click on the Help button to see configuration instructions.


<code>
add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
</code>


= I need integration of this plugin with my other installed plugins like BuddyPress, etc.? =
We will help you in integrating this plugin with your other installed plugins. Please email us at info@xecurify.com or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I verified the OTP received over my email and entering the same password that I registered with, but I am still getting the error message - "Invalid password." =
Please write to us at info@xecurify.com and we will get back to you very soon.

=  I would like to change our license to support the Diffrent Domain. How do we do this? =
Yes, You can now activate the license on your new domain. Write us at info@miniOrange.com we will help you set up.
			
= Is it possible to set a different redirect URL after login & logout =
Yes, With standard license you can set different redirect URL to redirect to after login as well as after logout.

= For any other query/problem/request =
Please email us at info@xecurify.com or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= REST API Authentication =
Secures the unauthorized access to your WordPress sites/pages using our <a href="https://wordpress.org/plugins/wp-rest-api-authentication/" target="_blank">WordPress REST API Authentication</a> plugin.

== Screenshots ==

1. Add oauth applications
2. List of Apps
2. Configure custom oauth application

== Changelog ==

= 6.11.0 =
* Bug fixes and Minor UI changes

= 6.10.6 =
* Added Compatibility for Wordpress version 5.2.1
* Updated API of support query
* Updated Regisatrtion form
* Added Request for Demo form
* Added Forum link
* Advertised New Features - 
* Updated Licensing Plan

= 6.10.5 =
* Added compatibility for WordPress version 5.2

= 6.10.4 =
* Added Authorization Headers 

= 6.10.3 =
* Added support for Meetup, Autodesk and Zendesk
* Updated Feedback form

= 6.10.2 =
* Added email validation on login
* Tested WP 5.1 compatibility

= 6.10.1 =
* Added WHMCS in default applist

= 6.10.0 =
* Upadted Google APIs
* Fixed cURL issues

= 6.9.17 =
* Updated Licesning Plan

= 6.9.16 =
* Added Uninstall fixes

= 6.9.15 =
* Updated Licesning plan

= 6.9.14 =
* Added CSS fixes

= 6.9.1 =
* UI changes

= 6.9.0 =
* Delayed Registartion
* Updated Password Validation

= 6.8.1 =
* Added Bug Fixes

= 6.8.0 =
* Added Visual Tour
* Updated UI
* Added Setup Guides Links

= 6.7.0 =
* Compatibility with WordPress 5.1 

= 6.6.5 =
* Added FAQ Tab

= 6.6.2 =
* Added Bug Fixes

= 6.6.1 =
* Added Bug Fixes

= 6.6.0 =
* Updated UI
* Added Auto Create User feature

= 6.5.0 =
* Added support for OpenID Connect (OIDC) Provider
* Added option to disable Authorization Header for Get User Info Endpoint

= 6.4.0 =
* Updated Licensing Plan

= 6.3.0 =
* Bug fixes for 'Vulnerable Link' issue

= 6.1.2 =
Bug fix for Invalid OTP error

= 6.1.1 =
CSS customizations

= 6.0.2 =
Added premium features page.

= 6.0.1 =
Updated list of OAuth Providers.

= 5.22 =
Handled self signed SSL sites and slashes.

= 5.21 =
Bug fixes fetching user resource

= 5.20 =
Added shortcode option

= 5.12 =
Added Windows Live app and bug fixes

= 5.10 =
* Changed callback url

= 5.9 =
* Added UI customizations.

= 5.8 =
* Bug fix for warnings showing up.

= 5.3 =
* Compatibility with WordPress 4.7.3
 
= 2.4 =
* Registration Fixes 

= 2.3 =
* Eve Online Changes
* Compatibility with WordPress 4.5.1

= 2.2 =
* Bug fixes
* Compatibility with WordPress 4.5

= 2.1 =
* Bug fixes

= 2.0 =
* Email after first login.
* Redirection after login - same page or custom.
* Shortcode
* Added option for alllowed faction.
* Denied access for character, alliance, corp, faction.

= 1.8 =
* Sets last_name as EVE Online Character Name when user logs in for the first time

= 1.7 =
* Bug fixes for some users facing problem after sign in

= 1.6 =
* Bug fixes.

= 1.5 =
* Fixed bug where user was not redirecting to EVE Online in some php versions.

= 1.4 =
* Bug fixes

= 1.3 =
* Bug fixes

= 1.2 =
* Bug fixes

= 1.1 =
* Added email ID verification during registration.

= 1.0.5 =
* Added Login with Facebook

= 1.0.4 =
* Updates user's profile picture with his EVE Online charcater image.
* Submit your query (Contact Us) from within the plugin.

= 1.0.3 =
* Bug fix

= 1.0.2 =
* Resolved EVE Online login flow bug in some cases

= 1.0.1 =
* Resolved some bug fixes.

= 1.0 =
* First version with supported applications as EVE Online and Google.