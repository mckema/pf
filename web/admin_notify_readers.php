<?php
include('session.php');
require_once("DBConn.php");
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
        <h3>Tell clients about this publication</h3>
        <p>
        << <a href="publications_home.php">Back</a> to my list of publications<br/>
<?php
		$fileId = $_REQUEST["file_id"];
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
		//TO DO, design table to store who has already gotten this
		$sql = "select * from pf_email_publication_notification where file_id = $fileId";
		//echo $sql;
		$result = $connection->query($sql);
?>
	
		<!-- TO DO, which form to send this to -->
        <form id="updatePublications" action="admin_update_publications.php" method="post" enctype="multipart/form-data">

	<p>
			<table class="search-table" style="width:700px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			
<?php


		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		$notificationStatus = "Not notified";
        		if( $row["active_flag"] == 1 ) {
        			$notificationStatus = "Notified to " . $row["email_group_id"];
        		}
        		
        		echo "<tr>
        		<td width='200'>Title: </td><td width='600'>" . $row["file_title"]. "</td></tr>
        		
        		<tr><td>You have already published this to: </td><td>". $notificationStatus . "</td></tr>
        		
        		<tr><td>File name: </td><td>". $row["file_name"] . "</td></tr>
        		<tr><td>Publisher: </td><td><input type='text' class='search-text' name='user_company' id='user_company' value='". $row["user_company"] . "'/></td></tr>
        		<tr><td>Industry: </td><td><input type='text' class='search-text' name='industry_type' id='industry_type' value='" . $row["industry_type"]. "' /></td></tr>
        		<tr><td>Abstract: </td><td><textarea name='file_abstract' id='file_abstract' cols='4'>" . $row["file_abstract"]. "</textarea></td></tr>
        		<tr><td>Tags: </td><td><input type='text' style='width:400px;' class='search-text' name='search_tags' id='search_tags' value='" . $row["search_tags"]. "' />
        		<input type='hidden' name='file_id' id='file_id' value='" . $row["file_id"]. "' /></td></tr>
        		<tr><td>Standard price:</td><td>
        			<input type='text' style='width:40px;' class='search-text' name='sell_ccy' id='sell_ccy' value='" . $row["sell_ccy"]. "' />
        			<input type='text' style='width:60px;' class='search-text' name='face_value' id='face_value' value='" . $row["face_value"]. "' />
        			</td></tr>
        		<tr><td>Author name: </td><td><input type='text' class='search-text' name='file_author' id='file_author' value='". $row["file_author"] . "'/></td></tr>
        		<tr><td>Author email: </td><td><input type='text' class='search-text' name='file_author_email' id='file_author_email' value='". $row["file_author_email"] . "'/></td></tr>
        		<tr><td>Creation date: </td><td>" . $row["creation_date"]. "  </td></tr>
        		<tr><td>Publication status: </td><td>$publicationStatus</td></tr>
        		<tr><td><strong>Action?</strong></td><td>[ <a href='javascript:submitform();'>save changes</a> ]  
        		&nbsp;&nbsp;&nbsp;&nbsp;
        		[ <a href='admin_publish_publications.php?file_id=" . $row["file_id"]. "&action=$publishFlag'>$publishFlag now</a> ]
        		
        		 
        		&nbsp;&nbsp;&nbsp;&nbsp;
        		[ <a href='admin_notify_readers.php?file_id=" . $row["file_id"]. "&action=notify'>notify clients</a> ]
        		
        		<br/><em>(please save any changes before you publish)</em>
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

	</p>
            
        </div>
    </div>

    </div>
    <div class="white-section">
   
</div>

<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>