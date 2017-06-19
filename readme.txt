=== oAuth Login ( OAuth Client ) ===
Contributors: miniOrange
Tags: oauth, oauth client, oauth login, login with google, login with facebook, login with twitter, login with windows
Requires at least: 3.0.1
Tested up to: 4.7
Stable tag: 5.21
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

OAuth Login plugin allows login with your google, facebook, twitter or other custom OAuth server.

== Description ==

OAuth Login plugin allows login with your google, facebook, twitter or other custom OAuth server. OAuth Client plugin works with any OAuth provider that conforms to the OAuth 2.0 standard.

= Features =
*	Login to your Wordpress site using any OAuth server account like facebook, google, twitter, windows live.
*	Supports login with any 3rd party OAuth server or custom OAuth server.
*	Easily integrate plugin with your Wordpress website using widgets. Just drop it in a desirable place in your website.
*	Automatic user registration after login if the user is not already registered with your site.

= No SSL restriction =
*	Login to wordpress using google credentials or any other app without having an SSL or HTTPS enabled site.


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
3. Now visit your site and you will see login with widget.

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

== Upgrade Notice ==
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

= 1.0.3 =
* Bug fix

= 1.0.2 =
* Updated version

= 1.0.1 =
* Updated version

= 1.0 =
First version of plugin.