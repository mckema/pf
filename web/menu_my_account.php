<?php
include('session.php');
//echo "session_sys_admin: $session_sys_admin";
?>


		<br/>
<?php
	if ($session_sys_admin == 1) {
		echo "<a href='admin_home.php'>[<em>admin tasks</em>]</a> &nbsp;&nbsp; ";
	}
?>
		<a href="admin_edit_my_account.php">[<em>manage my details</em>]</a> &nbsp;&nbsp;
		<a href="publications_home.php">[<em>manage publications</em>]</a> &nbsp;&nbsp;   
		<a href="search.php">Search Materials</a> &nbsp;&nbsp;   
		<a href="my_research_inbox.php">Inbox</a> &nbsp;&nbsp; 
		<a href="my_blotter.php">Blotter</a> &nbsp;&nbsp; 
		<a href="newly_published.php">Newly Published</a> &nbsp;&nbsp; 
		
		<a href="my_funds.php">My Funds</a> &nbsp;&nbsp; 
		<a href="csa_home.php">My CSAs</a> &nbsp;&nbsp; 
		<a href="rpa_home.php">My RPAs</a> &nbsp;&nbsp; 
		<a href="budget_home.php">My Budgets</a>
		<br/><br/>