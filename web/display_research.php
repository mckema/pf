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
        <h3>View publication</h3>
        <p>
        << <a href="search.php">Back</a> to search<br/>
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
		$sql = "select * from pf_research_files where file_id = $fileId";
		//echo $sql;
		$result = $connection->query($sql);
		//now tell the DB that the user has read this publication
        $readFlag = $_REQUEST["read"];
        if ($readFlag == "yes") {
        	$sqlResearchFileRead = "update pf_research_inbox set read_flag = 1 where file_id= $fileId and user_id = $session_user_id";
        	$resultResearchFileRead = $connection->query($sqlResearchFileRead);
        	if ($result->num_rows > 0) {
        		//row has been updated
        		//echo "ok: $sqlResearchFileRead";
        	}
        	else
        	{
        		//didnt work
        		echo "nope $sqlResearchFileRead";
        	}
        }
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
    			// has this file already been purchased?
    			$purchasedFlag = "";
        		$sqlPurchased = "select file_id, purchased_date from pf_purchase_history where file_id= $fileId and user_id = $session_user_id";
        		
        		// we need to match the firm to the fund too, so need to look up the firm
        		$sqlAllocationDetails = "select file_id, purchased_date from pf_allocation_history where file_id= $fileId and user_id = $session_user_id";
        		//echo $sqlPurchased;
        		$resultFilePurchased = $connection->query($sqlPurchased);
        		if ($resultFilePurchased->num_rows > 0) {
        			while($rowPurchased = $resultFilePurchased->fetch_assoc()) {
        				$purchasedFlag = " (<em>purchased on " .$rowPurchased["purchased_date"] ."</em>)";
        			}
        		}
        		else {
        			//nada
        		}
        		// has this file been bookmarked?
    			$bookmarkedFlag = "";
        		$sqlBookmarked = "select file_id, bookmarks_date from pf_research_bookmarks where file_id= $fileId and user_id = $session_user_id";
        		//echo $sqlBookmarked;
        		$resultFileBookmarked = $connection->query($sqlBookmarked);
        		if ($resultFileBookmarked->num_rows > 0) {
        			while($rowBookmarked = $resultFileBookmarked->fetch_assoc()) {
        				$bookmarkedFlag = " (<em>bookmarked on " .$rowBookmarked["bookmarks_date"] ."</em>)";
        			}
        		}
        		else {
        			//nada
        		}
        		echo "<tr>
        		<td width='100'>Title: </td><td width='600'>" . $row["file_title"]. " " . $purchasedFlag . "" . $bookmarkedFlag . "</td></tr>";
        		if( $purchasedFlag != "" ) {
        			echo "<tr><td>Allocated to: </td><td>TODO, list of funds</td></tr>";
        		}
        		echo "
        		<tr><td>Publisher: </td><td>". $row["user_company"] . "</td></tr>
        		<tr><td>Face value: </td><td>". $row["sell_ccy"] . " ". $row["face_value"] . "</td></tr>
        		<tr><td>Industry: </td><td>" . $row["industry_type"]. "</td></tr>
        		<tr><td>Abstract: </td><td>" . $row["file_abstract"]. "</td>
        		<tr><td>Tags: </td><td>" . $row["search_tags"]. "
        		<input type='hidden' name='file_id' id='file_id' value='" . $row["file_id"]. "' /></td></tr>
        		<tr><td>Creation date: </td><td>" . $row["creation_date"]. "  </td></tr>
        		<tr><td><strong>Action?</strong></td><td> 
        		";
        		//<tr><td>File name: </td><td>". $row["file_name"] . "</td></tr>
    			if ($purchasedFlag != "")
    			{
    				//read the document you have already purchased
    				echo "[ <a href='". $row["file_name"] . "'>read</a> ] ";
    			}
    			else {
    				//purchase this document
    				echo "[ <a href='purchase_research.php?file_id=". $row["file_id"] . "'>purchase</a> ] ";
    				//check for bookmark status on this document
    				if ($bookmarkedFlag == "") {
    					echo "[ <a href='bookmark_research.php?file_id=". $row["file_id"] . "'>bookmark</a> ] ";
    				}
    				else {
    					echo "[ <a href='bookmark_research.php?action=unbookmark&file_id=". $row["file_id"] . "'>un-bookmark</a> ] ";
    				}
    			}
    			echo "</td></tr>";
    			}
		} else {
    		//echo "Try refining your search";
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