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
<?php
	$listOfIsinsChosen = $_POST["hiddenselectedfunds"];
?>
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
        <h3>Step 3: Review your funds</h3>
        <p>
        
<script language="javascript">

function grab_data(val) {
	var result = [];
	
	var a = document.getElementById(val.id).value;
	var options = val && val.options;
	var opt;
	var targetCount = 0;
	var targetField = document.getElementById("copy_to");
	for (var i=0, iLen=options.length; i<iLen; i++) {
		
    	opt = options[i];
    	if (opt.selected) {
    		result.push(opt.value || opt.text);
    		targetField.options[targetCount] = new Option(opt.text, i);
    		targetCount++;
    	}
  	}
  	return result;
}
</script>        

<?php
		$fileId = $_POST["file_id"];
		$rpaId = $_POST["rpa_id"];
		$budgetCcy = $_POST["budget_ccy"];
		//echo "RPA ID: " . $rpaId;
		//echo "budgetCcy: " . $budgetCcy;
		$fundsToReview = array();
		$fundsToReview2 = array();
		if (isset($_POST['hiddenselectedfunds'])) {
			//this crap to be removed as superseded by $listOfIsinsChosen
			foreach ($_POST['hiddenselectedfunds'] as $selectedOption) {
    			array_push($fundsToReview,$selectedOption);
    		}
    	}
    	
    	print_r($selectedOption);
    	$amountsChosen = array();
    	
  		if (isset($_POST['funds'])) { 
  			//echo "what is up?";
  			//$fundsToReview2 = $_POST['funds'];
  			foreach ($_POST['funds'] as $selectedFunds) {
    			array_push($fundsToReview2, $selectedFunds);
    		}
    	}
    	$ISINids2 = join("', '", $fundsToReview2);
    	//echo "ISINids2: " . $ISINids2;
		if (isset($_POST['submit'])) {  
			$allocationAmounts = $_POST['alloc-amount'];  
		}
		//$fileId = $_REQUEST['file_id'];
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
		echo "<< <a href='edit_rpa_funds.php?rpa_id=$rpaId'>Back</a> to amend fund choices<br/>";
		
		/* Now we display the amounts allocated to the funds for review purposes
			We have 2 arrays to match up, hence using this $myPosition to cheat so we 
			cycle through the funds to review starting at position 0 
			and finally, create the insert statements for each allocation */
		$myPosition = -1;
		//TBD, get the CCY from previous page
		$ccy = $_POST["budget_ccy"];
		//echo "CCY is? " . $ccy;
		foreach ($allocationAmounts as $reviewAmounts ) {
  			$myPosition ++;
  			echo $ccy . " " . $reviewAmounts . " research cost is allocated to fund " . $fundsToReview2[$myPosition] . "<br/>";
  			
  			//TO DO - the insert statement...
  			//rpa_id, ISIN, user_id, fund_limit_amount, fund_ccy, active_flag, creation_date
  			//$fundAllocationSQL = "insert into pf_funds_linked_to_rpa (`firm_id`, `file_id`, `ISIN`, `allocation_amount`, `allocation_ccy`, `creation_date`, `active_flag`) 
  			//	values ($session_user_firm_id, $fileId, '$fundsToReview2[$myPosition]', $reviewAmounts, '$ccy', NOW(), 1);";
  			$fundAllocationSQL = "insert into pf_funds_linked_to_rpa (`rpa_id`, `ISIN`, `user_id`, `fund_limit_amount`, `fund_ccy`, `creation_date`, `active_flag`) 
  				values ($rpaId, '$fundsToReview2[$myPosition]', $session_user_id, $reviewAmounts, '$ccy', NOW(), 1);";
  			//echo "fundAllocationSQL: " . $fundAllocationSQL;
  			if ($connection->query($fundAllocationSQL) === TRUE) {
    			//echo "inserted successfully";
			}
			else {
    			echo "Error inserting record: " . $connection->error;
			}
		}
        //display the funds you will be allocating to:
        $ISINids = join("', '", $fundsToReview);
        //$ISINids2 = join("', '", $fundsToReview2);
        
		$sqlFunds = "select * from pf_funds where Security_Status = 'Tradeable' and ISIN IN ($listOfIsinsChosen)";
		//echo "sql: " . $sqlFunds;
		$resultFunds = $connection->query($sqlFunds);
?>
<form method="post">
<?php
		$displayNumberOfFunds = $myPosition + 1;
		if (isset($_POST['submit'])) {
			echo "<strong>I confirm I am selecting these amounts in my RPA to the above 
			" . $displayNumberOfFunds . " funds:</strong><br/>";
			echo "<a href='view_rpa.php?rpa_id=". $rpaId ."'>confirm choices</a>";
		}
		else {
			echo "<strong>Enter the amounts you would like to allocate to each fund:</strong><br/>";
		}
		if ($resultFunds->num_rows > 0) {
			while($rowFunds = $resultFunds->fetch_assoc()) {
        		echo $ccy . " <input type='text' autocomplete='off' class='search-text' name='alloc-amount[]' style='width: 60px;' value='' />&nbsp;". $rowFunds["ISIN"]. ", " . $rowFunds["Issuer_name"]. ", "  . $rowFunds["Security_Description"]. "
        		<input type='hidden' name='funds[]' value='". $rowFunds["ISIN"] ."' /> <br/>";
        		
        	}
        }
        $connection->close();
        if (!isset($_POST['submit'])) {
			echo "<input name='submit' type='submit' value=' Proceed with allocation &gt;&gt;' />
			<input type='hidden' name='budget_ccy' value='". $ccy ."' />";
		}
?>
<input type="hidden" name="rpa_id" value="<?php echo "$rpaId";?>" />

</form>

<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("reviewAllocations");
 	user_form.submit();
}
</script>	

	<p>		
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