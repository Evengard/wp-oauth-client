<?php

function applist_page() {
	?>
	<style>
		.tableborder {
			border-collapse: collapse;
			width: 100%;
			border-color:#eee;
		}

		.tableborder th, .tableborder td {
			text-align: left;
			padding: 8px;
			border-color:#eee;
		}

		.tableborder tr:nth-child(even){background-color: #f2f2f2}
	</style>
	<div class="mo_table_layout">
	<?php

		if(isset($_GET['action']) && $_GET['action']=='delete'){
			if(isset($_GET['app']))
				delete_app($_GET['app']);
		} else if(isset($_GET['action']) && $_GET['action']=='instructions'){
			if(isset($_GET['app']))
				instructions($_GET['app']);
		}

		if(isset($_GET['action']) && $_GET['action']=='add'){
			Mo_OAuth_Client_Admin_Apps::add_app();
		}
		else if(isset($_GET['action']) && $_GET['action']=='update'){
			if(isset($_GET['app']))
				Mo_OAuth_Client_Admin_Apps::update_app($_GET['app']);
		}
		else if(get_option('mo_oauth_apps_list'))
		{
			$appslist = get_option('mo_oauth_apps_list');
			if(sizeof($appslist)>0)
				echo "<br><a href='#'><button disabled style='float:right'>Add Application</button></a>";
			else
				echo "<br><a href='admin.php?page=mo_oauth_settings&action=add'><button style='float:right'>Add Application</button></a>";
			echo "<h3>Applications List</h3>";
			if(is_array($appslist) && sizeof($appslist)>0)
				echo "<p style='color:#a94442;background-color:#f2dede;border-color:#ebccd1;border-radius:5px;padding:12px'>You can only add 1 application with free version. Upgrade to <a href='admin.php?page=mo_oauth_settings&tab=licensing'><b>premium</b></a> to add more.</p>";
			echo "<table class='tableborder'>";
			echo "<tr><th><b>Name</b></th><th>Action</th></tr>";
			foreach($appslist as $key => $app){
				echo "<tr><td>".$key."</td><td><a href='admin.php?page=mo_oauth_settings&action=update&app=".$key."'>Edit Application</a> | <a href='admin.php?page=mo_oauth_settings&action=update&app=".$key."#attribute-mapping'>Attribute Mapping</a> | <a href='admin.php?page=mo_oauth_settings&action=update&app=".$key."#role-mapping'>Role Mapping</a> | <a href='admin.php?page=mo_oauth_settings&action=delete&app=".$key."'>Delete</a> | <a href='admin.php?page=mo_oauth_settings&action=instructions&app=".$key."'>How to Configure?</a></td></tr>";
			}
			echo "</table>";
			echo "<br><br>";

		} else {
			Mo_OAuth_Client_Admin_Apps::add_app();
		 } ?>
		</div>
	<?php
	if(get_option('mo_oauth_eveonline_enable'))
		show_config_old();
}



	function delete_app($appname){
		$appslist = get_option('mo_oauth_apps_list');
		foreach($appslist as $key => $app){
			if($appname == $key){
				unset($appslist[$key]);
				if($appname=="eveonline")
					update_option( 'mo_oauth_eveonline_enable', 0);
			}
		}
		update_option('mo_oauth_apps_list', $appslist);
	}