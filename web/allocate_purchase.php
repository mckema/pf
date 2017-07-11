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
<script type="text/javascript" src="js/data-scripts.js"></script>
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
        <h3>Step 2: Allocate research to your funds</h3>
        <p>
        
<script language="javascript">
// Return an array of the selected opion values
// select is an HTML select element
/*function getSelectValues(select) {
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
    }
  }
  //selected_funds.value = result;
  return result;
}*/
</script>
<?php
		$fileId = $_REQUEST["file_id"];
		$rpaId = $_REQUEST["rpa_id"];
		$budgetCcy = $_POST["budget_ccy"];
?>     
<form id="allocatePublications" name="allocatePublications" action="review_purchase.php?rpa_id=<?php $rpaId;?>" method="post">
<table style="width:800px;">
	<tr>
		<td>
<?php
		$dbConn = new DBConn();
		// Create connection
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		echo "<< <a href='display_research.php?file_id=$fileId'>Back</a> to summary<br/>";
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		//base this upon the RPA chosen...
		$sqlFunds = "select a.ISIN, a.Issuer_name, a.Security_Description
			from `pf_funds` a, `pf_funds_linked_to_rpa` b
			where b.rpa_id = $rpaId and b.ISIN = a.ISIN";
		$resultFunds = $connection->query($sqlFunds);
		//echo $sqlFunds;
		$sqlBudget = "select budget_ccy from `pf_rpa_details` where rpa_id = $rpaId";
		//echo $sqlBudget;
		$resultBudget = $connection->query($sqlBudget);
		echo "<strong>Funds I manage:</strong><br/>";
		if ($resultBudget->num_rows > 0) {
			while($rowBudgetCcy = $resultBudget->fetch_assoc()) {
				echo "<input type='hidden' name='budget_ccy' value='". $rowBudgetCcy["budget_ccy"] . "' />";
			}
		}
		
		echo "<input type='hidden' name='rpa_id' value='". $rpaId . "' />";
		if ($resultFunds->num_rows > 0) {
        	echo "<select id='myselect' name='myselect' multiple style='height:220px;width:500px;overflow-y: auto;'>";
        	while($rowFunds = $resultFunds->fetch_assoc()) {
        		
          		echo" <option value='" . $rowFunds["ISIN"]. "'>" . $rowFunds["Issuer_name"]. ": " . $rowFunds["ISIN"]. ": "  . $rowFunds["Security_Description"]. "</option>";
        		//echo "<strong>ISIN</strong>: " . $rowFunds["ISIN"]. " &nbsp;&nbsp;<strong>Name</strong>: "  . $rowFunds["Security_Description"]. " [ <a href='#'>add this fund</a> ]<br/>";
        	}
        	echo "</select>";
        }
        $connection->close();
?>
		</td>
&nbsp;<!--<button onclick="javsacript:grab_data(myselect);">select funds &gt;&gt;</button>
<a href="javascript:grab_data(myselect);">select funds &gt;&gt;</a>-->
		<td>
			
			<a id="myLink" href="#" onclick="grab_data(myselect, userselectedfunds, hiddenselectedfunds);return false;">add&nbsp;&gt;&gt;</a><br/><br/>
			<a id="clearData" href="#" onclick="clear_data(userselectedfunds, userselectedfunds2, hiddenselectedfunds);return false;">&lt;&lt;&nbsp;remove</a>
			&nbsp;
		</td>
		<td>
			<br/><strong>Funds I have selected:</strong><br/>
  			<select name="userselectedfunds[]" id="userselectedfunds" multiple style="height:220px;width:500px;overflow-y: auto;">
			</select>
			<input type="hidden" name="file_id" value="<?php echo "$fileId";?>" />
			<input type="hidden" name="hiddenselectedfunds" id="hiddenselectedfunds" value="" />
		</td>
	</tr>
</table>
<!--<select name="userselectedfunds2[]" id="userselectedfunds2" multiple style="height:220px;width:500px;overflow-y: auto;">
			</select>-->
<a id="nextPage" href="#" onclick="submitform();return false;">next steps</a>
</form>
<!--<a href="review_purchase.php">next step</a>-->

<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("allocatePublications");
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