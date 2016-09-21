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
		<?php require("menu_my_account.php"); ?>
        <!-- END menu for my account -->
    </div>
    <div class="white-section">
        <div class="container">
        
        <h3>Add your research content here:</h3>
        <p>
<?php
$fileTitle = $_POST['file-title'];
$fileAbstract = $_POST['file-abstract'];
$fileSector = $_POST['file-sector'];
$fileKeywords = $_POST['file-keywords'];
$filePublisher = $_POST['file-publisher'];
$fileFaceValue = $_POST['file-face-value'];
$fileCcy = $_POST['file-ccy'];

// Establishing DB connection to persist file upload details, tags, author, etc.
$servername = "127.0.0.1";
$username = "publishforce";
$password = "publishforce";
$dbname = "publishforce";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$userName = $_SESSION['login_user'];
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    //$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is ok" . $check["mime"] . ".";
        $uploadOk = 1;
        // Write details to the database on the file...
        $sql = "INSERT INTO `pf_research_files`(`user_id`, `file_name`, `file_type`, `file_title`, `file_abstract`, `industry_type`, `search_tags`, `user_company`, `face_value`, `sell_ccy`, `creation_date`) 
			VALUES ('$userName','$target_file','$fileType', '$fileTitle', '$fileAbstract', '$fileSector','$fileKeywords','$filePublisher', $fileFaceValue, '$fileCcy', NOW())";
        
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} 
		else {
			if ($connection->query($sql) === TRUE) {
    			//echo "inserted successfully";
			}
			else {
    			echo "Error inserting record: " . $connection->error;
			}
			$connection->close();
		}
        
    } 
    else {
        echo "File is not valid.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}*/
// Allow certain file formats
/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo " <a href='$target_file'>Link</a>";
        if (!$connection->connect_error) {
        	//echo "closing DB connection";
        	$connection->close();
        }
        
    } else {
        echo "Sorry, there was an error uploading your file.";
        //TO DO don;t upload the file if you have seen it already exists
    }
}


?>
		</p>
		
	<p>
		Please note you will still need to publish this research for clients to see it
	</p>
            
        </div>
    </div>

    </div>
    <div class="white-section">
	
    <div class="container" style="text-align:center;">
    	<div style="padding:0 15px;">
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
