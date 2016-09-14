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
        <!-- END menu nav -->
        <!--<div class="clr"></div>-->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->
	<div style="text-align:center;">

		<!-- menu for my account -->
		<?php require("menu_admin.php"); ?>
        <!-- END menu for my account -->
    </div>

    <div class="white-section">
        <div class="container">
        <h3>Edit publication</h3>
        <p>
        << <a href="admin_publications_list.php">Back</a> to list of publications<br/>
<?php
		$fileId = $_REQUEST["file_id"];
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
		$sql = "select * from pf_research_files where file_id = $fileId";
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
        		
        		echo "<tr>
        		<td width='100'>Title: </td><td width='600'><input type='text' class='search-text' name='file_title' id='file_title' value='" . $row["file_title"]. "'/></td></tr>
        		<tr><td>File name: </td><td><input type='text' class='search-text' name='file_name' id='file_name' value='". $row["file_name"] . "'/></td></tr>
        		<tr><td>Publisher: </td><td><input type='text' class='search-text' name='user_company' id='user_company' value='". $row["user_company"] . "'/></td></tr>
        		<tr><td>Industry: </td><td><input type='text' class='search-text' name='industry_type' id='industry_type' value='" . $row["industry_type"]. "' /></td></tr>
        		<tr><td>Abstract: </td><td><input type='text' class='search-text' name='file_abstract' id='file_abstract' value='" . $row["file_abstract"]. "' /></td></tr>
        		<tr><td>Tags: </td><td><input type='text' class='search-text' name='search_tags' id='search_tags' value='" . $row["search_tags"]. "' />
        		<input type='hidden' name='file_id' id='file_id' value='" . $row["file_id"]. "' /></td></tr>
        		<tr><td>Creation date: </td><td>" . $row["creation_date"]. "  </td></tr>
        		<tr><td><strong>Action?</strong></td><td>[ <a href='javascript:submitform();'>update</a> ]  
        		&nbsp;&nbsp;&nbsp;&nbsp;
        		[ <a href='admin_delete_publications.php?file_id=" . $row["file_id"]. "'>delete</a> ]
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