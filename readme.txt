=== OAuth Single Sign On - SSO (OAuth Client) ===
Contributors: cyberlord92,oauth
Tags: WordPress SSO, oauth 2.0, login, Single Sign-On, sso, multisite sso, Azure, Keycloak, Cognito, Okta sso, azure ad b2c, social login
Requires at least: 3.0.1
Tested up to: 5.8
Requires PHP: 5.4
Stable tag: 6.20.3
License: MIT/Expat
License URI: https://docs.miniorange.com/mit-license

WordPress Login ( SSO ) with Azure AD, Azure B2C, AWS Cognito, Okta, Ping, Clever, WSO2, Onelogin, Keycloak, many OAuth & OpenID Providers [24/7 SUPPORT]

== Description ==

WordPress Single Sign-On ( SSO ) with OAuth & OpenID Connect plugin allows login ( Single Sign On ) with your Azure AD, Azure B2C, WSO2, Office 365, Azure AD, Clever, AWS Cognito, WSO2, Ping, Keycloak, WHMCS, Okta, LinkedIn, Onelogin, Salesforce, Invision Community, Slack, Amazon, Discord, Twitter, Apple, G Suite / Google Apps or other custom OAuth 2.0 & OpenID Connect providers. WordPress SSO ( Login ) plugin supports SSO with many OAuth 2.0 and OpenID Connect ( OIDC ) 1.0 providers.
It also provides unlimited User Authentication with OAuth & OpenID Connect protocol and allows authorized user to login into the WordPress site. Support provided for Single-site & Multisite Network environments.
You can checkout below video tutorial to know how to setup SSO with your OAuth / OpenID Connect providers.

[youtube https://youtu.be/Vff0E0KxM3k]

= WordPress Single Sign-On / SSO ( Login into WordPress ) =

WordPress Single Sign-On ( SSO ) allows users to login into any site / application using the credentials of another app / site.
Example. If you have all your Users / Customers / Members / Employees stored on 1 site ( ex. Microsoft Azure AD, Azure B2C, Gmail, WordPress, AWS Cognito, Keycloak etc. ), let's say site A and you want all of them to register / login into your WordPress site say site B. In this scenario, you can register / login all your users of site A into Site B using the login credentials / account of Site A. This is called Single Sign-On or SSO.

= WordPress Single Sign-On ( SSO ) supported Third-Party Application / OAuth OpenID Provider =
* The other terms are: OAuth Identity Provider, OAuth Server, OpenID Connect Server, OpenID Connect Provider, OIDC Provider, OIDC Server, OAuth Application, OpenID Connect Application, OIDC Application, OpenID Connect Server, OpenID Connect Provider, OpenID Connect Application
* This Third-Party Application can be anything where User Accounts are stored or site / application where you want to store / migrate all the users. It can be your social login app, WordPress site, custom provider or any database.

OAuth and OpenID Connect are token based Single Sign-On ( SSO ) protocols which allows an end user's account information to be used by third party services without exposing the user's password.


= WordPress Single Sign-On ( SSO ) USE-CASES =

* Single Sign On ( SSO ) between WordPress - WordPress ( Login with WordPress ) :
	1. Single Sign On ( SSO ) to a WordPress site ( single / multisite ) using User Credentials stored on Another WordPress site
	2. Single Sign On ( SSO ) to 1 / multiple WordPress sites ( or subsites ) using User Credentials stored on Another WordPress site
* Single Sign On ( SSO ) into WordPress with Any OAuth / OpenID Connect ( OIDC ) application ( Login with Social Login Apps / Custom Providers ) :
	1. Single Sign On ( SSO ) to 1 WordPress site ( single / multisite ) using User Credentials stored on your third party application
	2. Single Sign On ( SSO ) to 1 / multiple WordPress sites ( or subsites ) using User Credentials stored on Another WordPress site
* Single Sign On ( SSO ) into WordPress Using existing User stores ( Active Directory / Database )
* SSO and extended plugin functionality using tokens ( access_token / jwt token / id_token ) such as secure API calls using third party token
* Others: eCommerce Single Sign On ( SSO ) / Login & other third-party integration with SSO features

**Azure SSO**
This WordPress Single Sign on plugin support Microsoft Azure SSO use cases with both OAuth and OpenID Connect protocols. It supports policy-based login redirections such as sign-up policy, sign-in policy, custom policy, etc.
It supports Login with Azure AD, Login with Azure B2C, Login with Office 365, Login with multiple Microsoft applications, SSO with the multi-tenants app ( users registered in different applications from different tenants ) and SSO into multiple WordPress domains / subdomains / subdirectories, role-based access restriction to WordPress pages, Login into WordPress using Microsoft users outside the tenant / application, Integrate Azure SSO with a social account ( facebook, google, etc ) use-cases.
Apart from SSO, it also supports WordPress - Azure integrations / customizations such as token-based calls to specific API / Graph API.
Azure SSO also supports syncing Azure user profile to WordPress profile with the option to customize the profile attribute mapping ( given_name, family_name, username, email, group, custom attributes, etc ) as per need. 

**Cognito SSO**
The SSO plugin supports Login with AWS Cognito, Login with Amazon, Login into WordPress with Cognito, and associated social login accounts. Also supports user profile syncing and role mapping into WordPress, fetching token from AWS Cognito to make the other API calls to extend the existing functionality.
It supports customization for integrating Cognito SDKs like syncing new registrations from Wordpress to Cognito, Login into the site via default wordpress login form instead of redirecting to the Cognito’s login page, connecting Cognito User Pool, login redirections, and many more.

**Discord SSO**
This Single Sign-On plugin allows Login into WordPress using Discord. The other supported use-cases are syncing user profile from Discord to WordPress, Role mapping into WordPress based on Discord roles, Avatar Mapping along with customizations like WordPress to Discord role mapping, managing Guild members, handling subscriptions based access to discord channels from a WordPress site.
It also supports customization for integrating different WordPress and Discord applications.

**Keycloak SSO**
This Single Sign-On plugin supports SSO with Keycloak. Keycloak server authenticates the user for WordPress. On successful authentication. It also provides an identity token and an access token that contains user profile information along with roles. The access token from Keycloak can be used to invoke other remote services on behalf of the user.
WordPress can make the REST invocations on remote services using this access token. 
OAuth / OIDC SSO plugin also allows you to make the authorization decisions based on role-based access control ( RBAC ) on WordPress site using the role mapping feature. You can map different WordPress roles to the Users based on their Keycloak roles and capabilities.

**Ping Federate SSO**
WordPress OAuth / OIDC ( OpenID Connect ) Single Sign-On plugin allows Login into WordPress using ping Federate. The plugin provides authorized access to different Ping REST APIs using the access token / bearer token.

**Clever SSO**
The Wordpress OAuth / OpenID Connect SSO plugin supports login with Clever to allow users ( teachers, students, district admins, etc ) to access their school portal based on their roles and capabilities. It also supports integration with the Learndash to sync the lessons, courses, assignments with the Clever SSO application.

Along with Clever, it also provides support for SSO to other IDPs school and universities use such as ClassLink, Google Classroom, Canvas, and any other application which supports OAuth or OpenID Connect protocol.

The plugin can also support WordPress Single Sign On ( SSO ) with any Identity Provider including SAML, OAuth, OpenID Connect, Active Directory, database using miniOrange IDP allowing your users to login to the WP site via authenticating with their user store.

= FREE VERSION FEATURES =

*	WordPress Single Sign-On ( SSO ) OAuth & OpenId Connect Login supports SSO with any 3rd party OAuth & OpenID Connect server or custom OAuth & OpenID Connect server like AWS Cognito, Azure, Office 365, Google Apps, etc.
*	**WordPress Single Sign-On ( SSO ) Grant Support** - Standard OAuth2 Grant : Authorization Code
*	**Auto Create Users ( User Provisioing )** : After Single Sign On ( SSO ), new user automatically gets created in WordPress
*	**Account Linking** : After user SSO to WordPress, if the user already exists in WordPress, then his profile gets updated or it will create a new WordPress User
*	**Attribute Mapping** : OAuth Login allows you to map your Identity Provider's unique attribute with WordPress Username Attribute.
*	**Login Widget** : Use Widgets to easily integrate the SSO / login on your WordPress site
*	**OpenID Connect & OAuth Provider Support** : WordPress Single Sign On ( OAuth Login ) supports any OpenID Connect & OAuth Provider.
*	**Redirect URL after Login** : WordPress Single Sign On ( OAuth Login ) automatically redirects user after successful login.
*	**Logging** : If you run into issues WordPress Single Sign On ( OAuth Login ) can be helpful to enable debug logging.


= STANDARD VERSION FEATURES =

*	All the FREE Version Features included.
*	**WordPress Single Sign-On ( SSO ) Grant Support** - Standard OAuth2 Grant : Authorization Code
*	**Optionally Auto Register Users** : WordPress Single Sign On ( OAuth Login ) does automatic user registration after login if the user is not already registered with your site
*	**Advanced Attribute Mapping** : WordPress Single Sign On ( OAuth Login ) provides an Attribute Mapping feature to map WordPress user profile attributes like username, firstname, lastname, and email. Manage username & email with data provided.
*	**Basic Role Mapping** : Assign default role to user registering through OAuth Login based on rules you define.
*	**Support for Shortcode** : Use a shortcode to place the OAuth login button anywhere in your Theme or Plugin
*	**Customize Login Buttons / Icons / Text** : Wide range of WordPress Single Sign On ( OAuth Login ) Buttons/Icons and it allows you to customize Text shadow
*	**Custom Redirect URL after Login** : WordPress OAuth Single Sign On ( SSO ) provides auto redirection and this is useful if you wanted to globally protect your whole site
*	**Custom Redirect URL after logout** : WordPress OAuth Single Sign On ( SSO ) allows you to auto redirect Users to custom URL after he logs out from your WordPress site


= PREMIUM VERSION FEATURES =

*	All the STANDARD Version Features
*	**WordPress Single Sign-On ( SSO ) Grant Support** - Standard OAuth2 Grants: Authorization Code, Implicit Grant, Password Grant, Refresh Token Grant (Customization Available).
*	**Custom Attribute Mapping** : PLugin allows to map any custom user attributes received from OAuth / OpenId Connect provider to map to any WordPress user attribute.
*	**Advanced Role Mapping** : Assign roles to users registering through WordPress Single Sign On ( OAuth & OpenId Login ) based on rules you define.
*	**Force Authentication / Protect Complete Site** : Allows user to restrict login ( Single Sign On ) / authorization for particular site.
*	**Multiple Userinfo Endpoints Support** : WordPress Single Sign On ( OAuth Login ) supports multiple Userinfo Endpoints.
*	**App domain specific Registration Restrictions** : WordPress Single Sign On ( OAuth Login ) restricts registration on your site based on the person's email address domain.
*	**JWT Support** : This feature enables usage of JSON Web Token ( JWT ) from the OAuth2 / OpenID Connect server response.
*	**Multisite Support** : WordPress Multisite allows you to create multiple subdomains / subdirectories within a single instance of WordPress. WordPress Single Sign On ( OAuth Login ) has the unique ability to support multiple sites ( multisite ) under one account. You have to configure the OAuth & OpenID Connect Single Sign On ( SSO ) plugin just once for all your sites in the network.

= ENTERPRISE VERSION FEATURES =

*	All the PREMIUM Version Features
*	Multiple OAuth & OpenID Connect Provider Support
*	**WordPress Single Sign-On ( SSO ) Grant Support** - Standard OAuth2 Grants : Authorization Code, Implicit Grant, Password Grant, Refresh Token Grant, Client Credential Grant, Authorization code grant with PKCE flow, Hybrid Grant (Customization Available)
*	**Single Login button for Multiple Apps** : It provides a single login button for multiple providers
*	**Extended OAuth API support** : Extend OAuth / OpenId Connect API support to extend functionality to the existing WordPress OAuth Single Sign-On ( SSO ) plugin.
*	**WP Hooks for Different Events** : Provides support for different hooks for user defined functions.
*	**WordPress Single Sign-On ( SSO ) Login Reports** : WordPress Single Sign On ( OAuth Login ) creates user login and registration reports based on the application used.
*	**Enable / Disable WordPress Default Login** : WordPress Single Sign On ( OAuth Login ) allows you to disable the default WordPress login form.
*	**Multisite Support** : WordPress Multisite allows you to create multiple subdomains / subdirectories within a single instance of WordPress. WordPress Single Sign On ( OAuth Login ) have unique ability to support multiple sites ( multisite ) under one account. You have to configure the OAuth & OpenID Connect Single Sign On ( SSO ) plugin just once for all your sites in the network.

= ALL INCLUSIVE VERSION FEATURES =

*All-in-one WordPress Single Sign-On ( SSO ) plan with the support of add-ons / Third Party Plugin compatibility
*	**Third Party Plugin Compatibility for Single Sign-On ( SSO )**: WooCommerce plugin compatibility with WordPress Single Sign-On ( SSO ) / Login plugin
*	**Add-on Support with SSO Plugin**: SCIM User Provisioning, Page & Post Restriction, BuddyPress Integration, Login Form Add-on, Discord Role Mapping, LearnDash Integration, Media Restriction, Attribute Based Redirection, SSO Session Management, SSO Login Audit, Membership based Login Redirection, Azure Forgot Password / Rest Password Policy Add-on

= No SSL restriction =
*	Login to WordPress ( WordPress SSO ) using Google ( G Suite ) credentials ( G Suite / Google Apps Login ) or any other app without having an SSL or HTTPS enabled site.

= List of popular OAuth and OpenID Connect ( OIDC ) Providers we support for Single Sign-On ( SSO ) =
*	<a href="https://plugins.miniorange.com/office-365-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Office 365 </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/azure-b2c-ad-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Azure B2C </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/azure-ad-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Azure AD </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/google-classroom-single-sign-on-sso" target="_black"> Google Classroom </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/classlink-single-sign-on-wordpress-sso-oauth-openid-connect" target="_black"> Classlink </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/canvas-single-sign-on-wordpress-sso-oauth-openid-connect" target="_black"> Canvas </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/aws-cognito-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> AWS Cognito </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/keycloak-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Keycloak </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/clever-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Clever </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/whmcs-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> WHMCS </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/ping-federate-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Ping Federate ( Ping / Ping Identity )</a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/slack-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Slack </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/discord-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Discord </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/wso2-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> WSO2 </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/salesforce-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Salesforce </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/paypal-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> PayPal </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/google-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> G Suite / Google Apps </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/okta-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Okta </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/onelogin-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> OneLogin </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/yahoo-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Yahoo </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/step-step-guide-to-single-sign-on-into-wordpress-using-openathens-oauth" target="_blank"> OpenAthens </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/linkedin-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> LinkedIn </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/gitlab-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Gitlab </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/gluu-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Gluu Server </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/github-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> GitHub </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/box-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Box </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/identityserver4-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> IdentityServer4 </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/identityserver3-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> IdentityServer3 </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/login-with-apple-app-using-wordpress-oauth-client" target="_blank"> Apple </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/blizzard-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Blizzard / Battle.net </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login ) 
*	<a href="https://plugins.miniorange.com/eve-online-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Eve Online </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/meetup-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Meetup </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/swiss-rx-login-single-sign-on-for-wordpress-using-oauth" target="_blank"> Swiss-RX-Login ( Swiss RX Login )</a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/coil-single-sign-on-sso" target="_blank"> Coil </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/vatsim-single-sign-on-sso" target="_blank"> VATSIM </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/login-with-intuit-using-wordpress-oauth-openid-connect" target="_blank"> Intuit </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/kakao-single-sign-on-wordpress-sso-oauth-openid-connect" target="_blank"> Kakao </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/hubspot-single-sign-on-for-wordpress-using-oauth" target="_blank"> Hubspot </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/twitter-single-sign-on-wordpress-sso-oauth-openid-connect" target="_black"> Twitter </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	<a href="https://plugins.miniorange.com/netiq-single-sign-on-for-wordpress-using-oauth" target="_black"> NetIQ </a> ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Oracle IDCS ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	HR Answerlink / Support center ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	ABSORB LMS ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Zoho ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Wechat ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Weibo ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Shibboleth ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	servicem8 ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
* 	Centrify ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Shibboleth ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Egnyte ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	OpenAM ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Basecamp ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Steam ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Webflow ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Amazon ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	ADFS ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Gigya ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	PhantAuth ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	XING ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Centrify ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Egnyte ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	DID ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Stripe ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Parallel Markets ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Liferay ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Fatsecret ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	iMIS ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	ORY Hydra ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	FusionAuth ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	ID.me ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	MoxiWorks ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Idaptive | CyberArk ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Splitwise ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Infusionsoft ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	JOIN IT ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	MyAcademicID ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	MemberConnex ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Coassemble ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Servicenow ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	IBM APP ID ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	Nimble AMS ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )
*	EPIC ( supports OAuth 2.0 / OpenID Connect SSO for WordPress login )

= List of grant types we support for WordPress Single Sign-On ( SSO ) OAuth / OpenId Connect ( OIDC ) Client =
*	Authorization code grant
*	Implicit grant
*	Resource owner credentials grant (Password Grant)
*	Client credentials grant
*	Refresh token grant
*	Hybrid Grant
*	Authorization code grant with PKCE flow


= Other OAuth and OpenID Connect ( OIDC ) Providers we support for WordPress Single Sign-On ( SSO ) =
*	Other oauth 2.0 and OpenId Connect ( OIDC ) 1.0 servers WordPress Single Sign-On ( SSO ) plugin support includes Office 365, AWS Cognito, Egnyte, Autodesk, Zendesk, Foursquare, Harvest, Mailchimp, Bitrix24, Spotify, Vkontakte, Huddle, Reddit, Strava, Ustream, Yammer, RunKeeper, Instagram, SoundCloud, Pocket, PayPal, Pinterest, Vimeo, Nest, Heroku, DropBox, Buffer, Box, Hubic, Deezer, DeviantArt, Delicious, Dailymotion, Bitly, Mondo, Netatmo, Amazon, FitBit, Clever, Sqaure Connect, Windows, Dash 10, Github, Invision Community, Blizzard, authlete, Keycloak, Procore, Eve Online, Laravel Passport, Nextcloud, Renren, Soundcloud, OpenAM, IdentityServer, ORCID, Diaspora, Timezynk, Idaptive CyberArk, Duo Security, Rippling, Crowd, Janrain, Numina Solutions, Ubuntu Single Sign-On, Apple, Ipsilon, Zoho, Itthinx, Fellowshipone, Miro, Naver, Clever, Coil, Parallel Markets, VATSIM, Liferay, Fatsecret, Intuit, iMIS, ORY Hydra, FusionAuth, Kakao, ID.me, MoxiWorks, ClassLink, Google Classroom, MemberClicks, BankID, CSI, Splitwise, Infusionsoft, Hubspot, Join It, MyAcademicID, MemberConnex, Novi, Coassemble, Servicenow, IBM APP ID, Nimble AMS, iSpring LMS, Neon CRM, EPIC, IPB forum, Wiziq, Sprinklr, Elvanto, FranceConnect, Church Online, Bigcommerce, Sewobe, PracticePanther, SubscribeStar, Eventbrite, Medi-Access, Lichess, CILogon, Simplecast, SURF, MediaWiki, UNA, NetSuite, Oracle IDCS, Globus etc.


== WordPress Single Sign-On ( SSO ) Supported Add-ons ==

We have a variety of add-ons that can be integrated with the OAuth & OpenId Connect Single Sign-On ( SSO ) plugin to improve the OAuth SSO functionality of your WordPress site.

*	**Page Restriction** - This add-on is basically used to protect the pages / posts of your site with OAuth & OpenID Connect compliant IDP ( Server ) login page and also, restrict the access to pages / posts of the site based on the user roles.
*	**BuddyPress Integration** - This add-on maps the attributes fetched from the OAuth & OpenID Connect compliant IdP with BuddyPress attributes.
*	**LearnDash Integrator** - LearnDash Integration will map the Single Sign-On ( SSO ) users to LearnDash groups as per the group attributes sent by your Identity Provider.
*	**Login Form Add-On** - This add-on provides Login form for OAuth2 / OpenID Connect login instead of only a button. It relies on OAuth & OpenID Connect Single Sign-On ( SSO ) plugin to have Password Grant configured. It can be customized using custom CSS and JS.
*	**Discord Role Mapping** - Discord Role Mapping add-on helps you to get roles from your discord server and maps it to WordPress user while Single Sign-On ( SSO ).
*	**Media Restriction** - This add-on restricts unauthorized users from accessing the media files on your WordPress site.
*	**Attribute Based Redirection** - Attribute Based Redirection add-on can be used to restrict and redirect users to different URLs based on OAuth & OpenID Connect attributes.
*	**SSO Session Management** - SSO session management add-on manages the login session time of your users based on their WordPress roles.
*	**SSO Login Audit** - SSO Login Audit captures and tracks all the SSO users and generates reports.
*	**Membership Level based Login Redirection** - This add-on allows redirecting users to custom pages based on users' membership levels after Single Sign-On ( SSO ). Checks for the user's membership level during every login, so any update on the membership level doesn't affect redirection.
*	**Azure Forgot Password / Reset Password Policy Add-on** - This add-on enables the Forgot Password option provided on Azures Login page using the Azure's Password Reset policy while SSO into WordPress. 


= Real Time User Provisioning using SCIM =
Provides user-provisioning ( sync user profiles ) from your IDP ( Okta, Azure, OneLogin etc ) to your WordPress using SCIM standard. You can refer our <a href="https://plugins.miniorange.com/wordpress-user-provisioning/" target="_blank"> WordPress User Provisioning using SCIM </a> plugin.

= REST API Authentication =
Secures the unauthorized access to your WordPress sites/pages using our <a href="https://wordpress.org/plugins/wp-rest-api-authentication/" target="_blank"> WordPress REST API Authentication </a> plugin.

== Installation ==

= From your WordPress dashboard =
1. Visit ` Plugins > Add New `
2. Search for ` oauth `. Find and Install `oauth` plugin by miniOrange
3. Activate the plugin

= From WordPress.org =
1. Download WordPress OAuth Single Sign-On ( OAuth Client ).
2. Unzip and upload the `miniorange-oauth-login` directory to your `/wp-content/plugins/` directory.
3. Activate miniOrange OAuth from your Plugins page.

= Once Activated =
1. Go to ` Settings-> miniOrange OAuth -> Configure OAuth `, and follow the instructions
2. Go to ` Appearance->Widgets ` ,in available widgets you will find ` miniOrange OAuth ` widget, drag it to chosen widget area where you want it to appear.
3. Now visit your site and you will see login with widget.

= For Viewing Corporation, Alliance, Character Name in user profile =
To view Corporation, Alliance and Character Name in edit user profile, copy the following code in the end of your theme's `Theme Functions(functions.php)`. You can find `Theme Functions(functions.php)` in `Appearance->Editor`.
<code>
add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
</code>

== Frequently Asked Questions ==
= I need to customize the plugin or I need support and help? =
Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= How to configure the applications? =
On configure OAuth page, check if your app is already there in default app list, if not then select the custom OAuth 2.0 app or Custom OpenID Connect Provider app based on the protocol supported by your OAuth Server. Then click on How to Configure link to see configuration instructions.


<code>
add_action( 'show_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'mo_oauth_my_show_extra_profile_fields' );
</code>

= This WordPress SSO / Login plugin is not compatible with plugins installed on my site. What can I do? =
Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I need integration of this plugin with my other installed plugins like BuddyPress, Woocommerce, Learndash and other third party plugins? =
We will help you in integrating this plugin with your other installed plugins. This plugin is already compatible with WooCommerce, BuddyPress & Learndash. Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= Can I add multiple SSO options on my WordPress sites? =
Yes, you can add multiple IDPs for Single Sign-on ( SSO ) on your WordPress sites. e.g. Azure AD, G Suite / Google Apps, Office 365, Salesforce, Keycloak and many more.

= I would like to change our license domain. How do we do this? =
Yes, You can now activate the license on your new domain. Write us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> we will help you set up.

= Is it possible to set a different redirect URL after login & logout =
Yes, With standard license you can set different redirect URL to redirect to after login as well as after logout.

= For any other query/problem/request =
Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.


== Screenshots ==

1. List of Apps
2. Login button customization
3. Advanced Feature
4. Troubleshooting
5. Attribute & Role Mapping
6. Login Button / Widget
7. WordPress Dashboard Login

== Changelog ==

= 6.20.3 =
* Security related fix

= 6.20.2 =
* LearnPress conflict fix
* WordFence 2FA conflict fix
* Added Automatic Attr Mapping
* Setup guide & Video guide button on UI
* Licensing plan UI change
* Readme changes

= 6.20.1 =
* Added WP 5.8 Compatibility
* Added support for OAuth 1.0
* UI Changes & fixes
* Readme changes

= 6.20.0 =
* UI Changes & fixes
* Readme changes

= 6.19.8 =
* Minor changes

= 6.19.7 =
* Debug log feature minor fixes
* Discovery flow scope related fixes
* Added default applications for IBM APP ID, Servicenow, Idaptive

= 6.19.6 =
* Added improvements in Debug Log feature
* Added different Language compatibility

= 6.19.5 =
* Added WP 5.7 Compatibility

= 6.19.4 =
* Discovery URL fixes
* Add-ons UI change
* Error log fixes
* Twitter related fixes
* Readme changes

= 6.19.3 =
* Minor Code Fixes

= 6.19.2
* Compatibility with WooCommerce plugin
* UI updates.

= 6.19.1 =
* Minor bug fixes

= 6.19.0 =
* Added Debug log feature
* Added check for state parameter
* Updated add-ons tab UI and Feedback form UI
* Added WP 5.6 Compatibility

= 6.18.1 =
* Minor UI changes

= 6.18.0 =
* Added Twitter support Application
* Added Freja eID Application
* UI updates

= 6.17.3 =
* Clever & Ping configuration fixes
* UI updates

= 6.17.2 =
* Minor fixes

= 6.17.1 =
* Keycloak configuration fixes
* UI Updates

= 6.17.0 =
* Configuration fixes
* UI Updates

= 6.16.3 =
* Compatibility with WordPress 5.5

= 6.16.2 =
* Minor fixes
* Added support for new Apps ( Clever, Auth0 )

= 6.16.1 =
* Minor fixes

= 6.16.0 =
* Automated the plugin OAuth & OIDC configuration
* Added Setup a Call button
* Added UI changes and minor bugfixes

= 6.15.3 =
* Minor fixes

= 6.15.2 =
* Added default apps for WordPress, Zoho, miniOrange Providers
* Updated WHMCS Endpoint

= 6.15.1 =
* Added Copy Callback feature
* Added option to map attributes(manual/automatic)
* Added fixes for Demo Request feature
* Fixed empty UserInfo Endpoint issue
* Added new Apps for Login with Azure - Azure AD, Azure B2C and end to end sso setup guides
* Updated Licensing Plan
* Advertised new features
* Other minor bugfixes and UI changes

= 6.15.0 =
* Updated Licensing plan

= 6.14.5 =
* Attribute mapping fix
* Some UI fixes and bug fixes
* Added new providers
* Added check for failed registration for blocked domains and displayed the message accordingly

= 6.14.4 =
* Dropdown fix
* Added new providers
* Minor compatibility fixes

= 6.14.3 =
* UI Updates

= 6.14.2 =
* Minor Fixes

= 6.14.1 =
* Added nonces and sanitized required parameters
* Updated all the 3rd party libraries
* Added constants
* Added fixes for account setup and attribute Mapping
* Added New Providers ( ORCID, Diaspora, Timezynk )

= 6.14.0 =
* Updated widget logos
* Automated Attribute Mapping 
* Updated Visual Tour 
* Added New Providers ( miniOrange, Identity Server, Nextcloud, Twitch, Wild Apricot, Connect2id )
* Updated Support Query / Contact Us form

= 6.13.0 =
* Fixed the SSO for Default Azure app
* Advertised SSO Setup Video
* Updated plugin licensing
* Added support for new providers ( Centrify, NetIQ, OpenAM, IdentityServer )
* Minor compatibility fixes

= 6.12.12 =
* Added fixes for Widget / Login Button Logo
* Added fixes for common CSS conflicts
* Updated UI
* Added WordPress Theme Compatibility

= 6.12.11 =
* Removed unused libraries

= 6.12.0 =
* Added Login Button on WordPress Dashboard
* Updated Login Button UI
* Added checkboxes to send Client Credentials in Header/Body
* Fixed Attribute Mapping, backslash issue 
* Fixed CSS conflicts
* Automated Request for Demo 

= 6.11.4 =
* Added support for WSO2 & Swiss-Rx-Login ( Swiss RX Login )
* UI updates

= 6.11.3 =
* Added Add-on tab
* Added UI Changes
* Added compability for WordPress version 5.2.2

= 6.11.2 =
* Attribute Mapping fixes
* minor UI Changes

= 6.11.1 =
* Minor bugfixes

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
* Updated Google APIs
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
* Delayed Registration
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
* Added support for OpenID Connect ( OIDC ) Provider
* Added option to disable Authorization Header for Get User Info Endpoint

= 6.4.0 =
* Updated Licensing Plan

= 6.3.0 =
* Bug fixes for 'Vulnerable Link' issue

= 6.1.2 =
* Bug fix for Invalid OTP error

= 6.1.1 =
* CSS customizations

= 6.0.2 =
* Added premium features page.

= 6.0.1 =
* Updated list of OAuth Providers.

= 5.22 =
* Handled self signed SSL sites and slashes.

= 5.21 =
* Bug fixes fetching user resource

= 5.20 =
* Added shortcode option

= 5.12 =
* Added Windows Live app and bug fixes

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