<?php
include('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link href="css/owl.carousel.css" type="text/css" rel="stylesheet" />

<title>PublishForce | Making research transparent</title>

<meta name="keywords" content="PublishForce, PublishForce Limited, research everywhere" />
<meta name="description" content="PublishForce is coming soon." />
<meta name="robots" content="index, follow" />
<meta name="author" content="PublishForce Limited" />
<meta name="revisit-after" content="7 days" />
<meta name="copyright" content="PublishForce Limited" />

<script type="text/javascript" src="js/mobile-nav.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>

<div id="header-section">
	<div id="header-bar">
		<!-- menu nav -->
		<?php require("menu_logged-in.php"); ?>
    </div>
</div>
<!-- CLOSE HEADING DIVS -->
	<div style="text-align:center;">

		<!-- menu for my account -->
		<?php require("menu_my_account.php"); ?>
        <!-- END menu for my account -->
    </div>

    <div class="white-section">
        <div class="container">
        <h3>My research inbox</h3>
        <p>
        	Research I have yet to read:
        <!--<form id="searchForm" method="POST" action="search_results.php?action=completed">
        	<input type="text" name="search_text" id="search_text" style="width: 100;" />
        	<a href='javascript:document.getElementById("searchForm").submit();'><span class="button1">search</span></a>
        	
        </form>-->
<?php
		//echo "session_user_id: $session_user_id";
		$searchTag = $_POST['search_text'];
		$servername = "127.0.0.1";
		$username = "publishforce";
		$password = "publishforce";
		$dbname = "publishforce";

		// Create connection
		$connection = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		
		//$sql = "select * from pf_research_files";
		$sql = "select b.file_id as fid, b.file_name as fn, b.file_title as ft, b.industry_type as it, b.user_company as uc, b.creation_date as cd 
		from pf_research_inbox a, pf_research_files b 
		where a.user_id = $session_user_id and a.file_id = b.file_id and a.read_flag = 0";
		$result = $connection->query($sql);
?>
	<p>
		<table class="search-table">
			<tr>
				<th>Title</th>
				<th>Industry/sector</th>
				<th>Publisher</th>
				<th>Issue date</th>
			</tr>
			
<?php


		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "<tr><td><a href='display_research.php?read=yes&file_id=" . $row["fid"]. "'</a>" . $row["ft"]. "</td><td>" . $row["it"] . "</td><td>" . $row["uc"]. "</td><td>" . $row["cd"]. "</td></tr>";
        		
    		}
		} else {
    		echo "Try refining your search";
		}
		//mysql_close($connection); // Closing Connection
		$connection->close();
?>
			
			
		</table>
</p>
<p>		
		If these results were not what you are looking for, please try the following options:
	
<ul>
	
	<li>Contact us for help</li>
	<li>Put a request to publishers for the material you are looking for</li>
</ul>
	</p>
            
        </div>
    </div>

    </div>
    <div class="white-section">
	
    <div class="container" style="text-align:center;">
    	<div style="padding:0 150px;">
            <h4 class="large-header">Contact Us</h4>
            <p class="mbottom10">If you have any questions about our research platform, or if you have an enquiry, please contact us using the details below, or by filling out the form on our contact page.</p>
            <a href="contact.php"><span class="button3">Get in touch</span></a>
        </div>
    </div>
   
</div>

<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>