=== WordPress OAuth Login ( OAuth Client ) ===
Contributors: cyberlord92,oauth
Tags: OAuth, oauth client, oauth login, SSO OAuth, sso
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 6.6.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

OAuth Login plugin allows login with your google, facebook, twitter, Custom OAuth server, Custom Openid Connect (OIDC) server.

== Description ==

OAuth Login plugin allows login (Single Sign On) with your google, facebook, twitter or other custom OAuth server. OAuth Client plugin works with any OAuth provider that conforms to the OAuth 2.0 and OpenID Connect (OIDC) 1.0 standard.

= FREE VERSION FEATURES =

*	OAuth Login supports login (sso) with any 3rd party OAuth server or custom OAuth server.
*	Attribute Mapping- OAuth Login supports basic Attribute Mapping feature to map WordPress user profile attributes like email and first name. Manage username & email with data provided
*	OAuth Provider Support- OAuth Login supports only one OAuth Provider. (ENTERPRISE : Supports Multiple OAuth Provider)
*	Redirect URL after Login- OAuth Login Automatically Redirects user after successful login. Note: Does not include custom redirect URL
*	Display Options- OAuth Login Provides Display Option for both Login form and Registration form
*	Logging- If you run into issues OAuth Login can be helpful to enable debug logging


= STANDARD VERSION FEATURES =

*	All the Free Version Features
*	Optionally Auto Register Users- OAuth Login does automatic user registration after login if the user is not already registered with your site
*	Attribute Mapping- OAuth Login provides custom Attribute Mapping feature to map WordPress user profile attributes like username, firstname, lastname, email and profile picture. Manage username & email with data provided
*	Login Widget- Use Widgets to easily integrate the login link with your WordPress site
*	Support for Shortcode- Use shortcode to place OAuth login button anywhere in your Theme or Plugin
*	Customize Login Buttons / Icons / Text- Wide range of OAuth login Buttons/Icons and it allows you to customize Text shadow
*	Custom Redirect URL after Login- OAuth Login provides Auto Redirection and this is useful if you wanted to globally  protect your whole site
*	Redirect URL after logout- OAuth Login auto Redirect Users to custom URL after logout in WordPress
*	Basic Role Mapping- Assign default role to user registering through OAuth Login based on rules you define.


= PREMIUM VERSION FEATURES =

*	All the Standard Version Features
*	Advanced Role Mapping- Assign roles to users registering through OAuth Login based on rules you define.
*	OpenID Connect Support- OAuth Login supports login with any 3rd party OpenID Connect server.
*	Multiple Userinfo Endpoints Support- OAuth Login supports multiple Userinfo Endpoints.
*	Account Linking- OAuth Login supports the linking of user accounts from OAuth Providers to Wordpress account.
*	App domain specific Registration Restrictions- OAuth Login restricts registration on your site based on the person's email address domain
*	Multi-site Support- OAuth Login have unique ability to support multiple sites under one account
*	Reverse Proxy Support- OAuth Login support for sites behind a reverse-proxy or on-prem instances with no internet access.
*	Email notifications- You can customize the E-mail templates used for the automatic email notifications related to user registration.
*	Extended OAuth API support- Extend OAuth API support to extend functionality to the existing OAuth client.[ENTERPRISE]
*	BuddyPress Attribute Mapping- OAuth Login allows BuddyPress Attribute Mapping.[ENTERPRISE]
*	Page Restriction according to roles- Limit Access to pages based on user status or roles. This WordPress OAuth Login plugin allows you to restrict access to the content of a page or post to which only certain group of users can access.[ENTERPRISE]
*	Login Reports- OAuth Login creates user login and registration reports based on application used. [ENTERPRISE]


= No SSL restriction =
*	Login to WordPress using Google credentials (Google Apps Login) or any other app without having an SSL or HTTPS enabled site.

= List of popular OAuth Providers we support =
*	Eve Online
*	Slack
*	Discord
*	HR Answerlink / Support center
*	WSO2
*	Wechat
*	Weibo
*	AWS Cognito
*   LinkedIn
*	Azure AD
*	Gitlab
*	Shibboleth
*	Blizzard (Formerly Battle.net)
*	servicem8
*	Meetup

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
*   Resource owner credentials grant
*   Client credentials grant
*   Refresh token grant


= Other OAuth Providers we support =
*	Other OAuth Providers OAuth Login (OAuth client) plugin support includes Foursquare, Harvest, Mailchimp, Bitrix24, Spotify, Vkontakte, Huddle, Reddit, Strava, Ustream, Yammer, RunKeeper, Instagram, SoundCloud, Pocket, PayPal, Pinterest, Vimeo, Nest, Heroku, DropBox, Buffer, Box, Hubic, Deezer, DeviantArt, Delicious, Dailymotion, Bitly, Mondo, Netatmo, Amazon, WHMCS, FitBit, Clever, Sqaure Connect, Windows, Dash 10, Github, Invision Comminuty, Blizzar, authlete, Keycloak etc.


== Installation ==

= From your WordPress dashboard =
1. Visit `Plugins > Add New`
2. Search for `oAuth Login ( OAuth Client )`. Find and Install `oAuth Login ( OAuth Client )`
3. Activate the plugin from your Plugins page

= From WordPress.org =
1. Download oAuth Login ( OAuth Client ).
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
Please email us at info@miniorange.com or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I don't see any applications to configure. I only see Register to miniOrange? =
Our very simple and easy registration lets you register to miniOrange. OAuth login works if you are connected to miniOrange. Once you have registered with a valid email-address and phone number, you will be able to configure applications for OAuth.

= How to configure the applications? =
When you want to configure a particular application, you will see a Save Settings button, and beside that a Help button. Click on the Help button to see configuration instructions.


<code>
add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
</code>


= I need integration of this plugin with my other installed plugins like BuddyPress, etc.? =
We will help you in integrating this plugin with your other installed plugins. Please email us at info@miniorange.com or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I verified the OTP received over my email and entering the same password that I registered with, but I am still getting the error message - "Invalid password." =
Please write to us at info@miniorange.com and we will get back to you very soon.

= For any other query/problem/request =
Please email us at info@miniorange.com or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

== Screenshots ==

1. Add OAuth Applications
2. List of Apps
2. Configure Custom OAuth Application

== Changelog ==

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