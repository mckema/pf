<?php
include('session.php');
require_once("dbconn.php");
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
        <!-- END menu nav -->
        <!--<div class="clr"></div>-->
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
        <h3>Edit RPA</h3>
        <p>
        << <a href="publications_home.php">Back</a> to my list of publications<br/>
<?php
		$rpaId = $_REQUEST["rpa_id"];
		// Create connection
		$dbConn = new DBConn();
		// Create connection
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		$sql = "select * from pf_rpa_details where rpa_id = $rpaId";
		//echo $sql;
		$result = $connection->query($sql);
?>
	
	
        <form id="updatePublications" action="admin_update_publications.php" method="post" enctype="multipart/form-data">

	<p>
			<table class="search-table" style="width:700px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			
<?php


		if ($result->num_rows > 0) {  // && $searchTag!="") {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		// file_id, file_name, file_title, file_type, user_id, industry_type, 
        		// search_tags, user_company, creation_date
        		//echo "something " . $row["file_title"]. "again? ";
        		$publishFlag = "publish";
        		$publicationStatus = "Not published";
        		if( $row["active_flag"] == 1 ) {
        			$publishFlag = "unpublish";
        			$publicationStatus = "Activated on " . $row["start_date"];
        		}
        		
        		echo "<tr>
        		<td width='100'>RPA name: </td><td width='600'><input type='text' class='search-text' name='file_title' id='file_title' value='" . $row["rpa_name"]. "'/></td></tr>
        		<tr><td>Asset owner: </td><td>". $row["asset_owner_id"] . "</td></tr>
        		<tr><td>Budget:</td><td>
        			<input type='text' style='width:40px;' class='search-text' name='sell_ccy' id='sell_ccy' value='" . $row["budget_ccy"]. "' />
        			<input type='text' style='width:60px;' class='search-text' name='face_value' id='face_value' value='" . $row["budget_amount"]. "' />
        			</td></tr>
        		<tr><td>Active?</td><td>$publicationStatus</td></tr>
        		<tr><td><strong>Action?</strong></td><td>[ <a href='javascript:submitform();'>save changes</a> ]  
        		&nbsp;&nbsp;&nbsp;&nbsp;
        		</td></tr>";
    		}
		} else {
    		echo "Try refining your search";
		}
		$connection->close();
?>
			
		</table>
		
</p>
		</form>
		
<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("updatePublications");
 	user_form.submit();
}
</script>
<p>		
		<!--If these results were not what you are looking for, please try the following options:
	
<ul>
	
	<li>Contact us for help</li>
	<li>Put a request to publishers for the material you are looking for</li>
</ul>-->
	</p>
            
        </div>
    </div>

    </div>
    <div class="white-section">
	
    <!--<div class="container" style="text-align:center;">
    	<div style="padding:0 150px;">
            <h4 class="large-header">Contact Us</h4>
            <p class="mbottom10">If you have any questions about our research platform, or if you have an enquiry, please contact us using the details below, or by filling out the form on our contact page.</p>
            <a href="contact.php"><span class="button3">Get in touch</span></a>
        </div>
    </div>-->
   
</div>

<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>