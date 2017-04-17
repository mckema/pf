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
        <h3>RPA Summary</h3>
        <p>
        << <a href="rpa_home.php">Back</a> to my list of RPAs<br/>
<?php
		$rpaId = $_REQUEST["rpa_id"];
		// Create connection
		$dbConn = new DBConn();
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		$sql = "select a.rpa_id, a.rpa_name, a.asset_owner_id, b.asset_owner_name, a.budget_ccy,
		a.budget_amount, a.start_date, a.end_date, a.creation_date, a.active_flag
		from pf_rpa_details a, pf_asset_owner_details b 
		where a.asset_owner_id = b.asset_owner_id and a.rpa_id = $rpaId";
		$result = $connection->query($sql);
		
		//which funds are linked to this RPA
        $chosenFundsSQL = "SELECT b.ISIN, FORMAT(SUM(b.allocation_amount),2) total, FORMAT(a.fund_limit_amount,2) fund_limit_amount, a.fund_ccy
        	FROM pf_allocation_history b, pf_funds_linked_to_rpa a 
        	where b.rpa_id = $rpaId and b.ISIN = a.ISIN 
        	group by b.ISIN, a.fund_limit_amount, a.fund_ccy ORDER BY SUM(b.allocation_amount) DESC";

    	$resultChosenFunds = $connection->query($chosenFundsSQL);
		
		//what funds have we spent money on within the RPA?
		$sqlMoneySpentOnfunds = "SELECT distinct a.ISIN, b.allocation_amount 
			FROM `pf_funds_linked_to_rpa` a, `pf_allocation_history` b
			where a.rpa_id = $rpaId and a.ISIN = b.ISIN";
		//echo $sqlMoneySpentOnfunds;
		$resultMoneySpentOnfunds = $connection->query($sqlMoneySpentOnfunds);
		$arrIsinInRPA = array();
		if ($resultMoneySpentOnfunds->num_rows > 0) {
    		// output data of each row
    		while($rowMoneySpentOnfunds = $resultMoneySpentOnfunds->fetch_assoc()) {
        		array_push($arrIsinInRPA, $rowMoneySpentOnfunds["ISIN"]);
			}
			$strIsinInRPA = join("','", $arrIsinInRPA);
			$strIsinInRPAForSql = "('" . $strIsinInRPA . "')";
			//echo "ISIN spent: " . $strIsinInRPAForSql;
		}
		//what has been spent so far on the RPA
		//use the list of funds obtained from $resultMoneySpentOnfunds
		$sqlSpent = "SELECT allocation_ccy, FORMAT(SUM(allocation_amount),2) total
			FROM `pf_allocation_history`
			where ISIN in $strIsinInRPAForSql
			GROUP BY allocation_ccy";
		$resultSpent = $connection->query($sqlSpent);
		//take $resultSpent to show what is spent for each fund vs. budget set
		
		//who owns the assets
		/*$newSQL = "select * from pf_asset_owner_details;";
    	$resultAssetOwner = $connection->query($newSQL);*/
?>
	
	
        <form id="updatePublications" action="update_rpa.php" method="post" enctype="multipart/form-data">

	<p>
			<table class="search-table" style="width:700px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			
<?php

		$budgetTotal = 0;
		$budgetRemaining = 0;
		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		$rpaStatus = "Not active";
        		$selectedAssetOwnerId = $row["asset_owner_id"];
        		//echo "AO ID: " . $selectedAssetOwnerId;
        		if( $row["active_flag"] == 1 ) {
        			$rpaStatus = "Active";
        		}
        		
        		echo "<tr>
        			<td width='160'>RPA name: </td><td width='600'>" . $row["rpa_name"]. "</td>
        		</tr>
        		<tr>
        			<td>Asset owner: </td>
        			<td>
        				<input type='hidden' name='asset_owner_hidden' id='asset_owner_hidden' value='". $row["asset_owner_id"] . "'/>";
    				echo $row["asset_owner_name"] . "<input type='hidden' name='rpa_id' id='rpa_id' value='". $row["rpa_id"] . "'/>
        			</td>
        		</tr>
        		<tr>
        			<td>Budget currency:</td><td>";
        				echo $row["budget_ccy"]. "
        			</td>
        		</tr>
        		<tr>
        			<td>Budget set at:</td><td>";
        				$budgetTotal = number_format($row["budget_amount"], 2);
        				//$budgetTotal = $row["budget_amount"];
        				echo $row["budget_ccy"]. " " . $budgetTotal . "
        			</td>
        		</tr>
        		<tr>
        			<td>Budget spent:</td>";
        			//display what has been spent
    				if ($resultSpent->num_rows > 0) {
        				while($rowSpent = $resultSpent->fetch_assoc()) {
        					$budgetSpent = $rowSpent["total"];
        					$budgetSpentStripped = str_replace( ',', '', $budgetSpent );
        					$budgetSpent = $budgetSpentStripped;
        					$budgetSpent = number_format($budgetSpentStripped, 2);
    						echo "<td>" . $rowSpent["allocation_ccy"] . " " . $budgetSpent . "</td>";
    						//echo "<td>nada</td>";
    					}
    				}
    			
    			echo " </tr>
        		<tr>
        			<td>Budget remaining:</td><td>";
        				//$budgetRemaining = $budgetTotal - $budgetSpent;
        				//echo $budgetTotal . " and spent: " . $budgetSpent;
        				$budgetTotalStripped = str_replace( ',', '', $budgetTotal );
        				$budgetSpentStripped = str_replace( ',', '', $budgetSpent );
        				$budgetRemaining = $budgetTotalStripped - $budgetSpentStripped;
        				//$budgetRemaining2DP = number_format((float)$budgetRemaining, 2, '.', '');
        				$budgetRemaining2DP = number_format($budgetRemaining, 2);
        				echo $row["budget_ccy"]. " " . $budgetRemaining2DP;
        				//echo $row["budget_ccy"]. " " . $row["budget_amount"]. ";
        			echo "</td>
        		</tr>
        		<tr>
        			<td>Dates (start-end): </td>
        			<td>
        				" . $row["start_date"] . " to ". $row["end_date"] . "
        			</td>
        		</tr>
        		<tr>
        			<td>Active?</td>
        			<td> ". $rpaStatus . "
        			</td>
        		</tr>
        		<tr>
        			<td>";
  
        				//list the selected funds and their amounts
    					if ($resultChosenFunds->num_rows > 0) {
        					while($rowFunds = $resultChosenFunds->fetch_assoc()) {
    							echo $rowFunds["ISIN"] . "; limit = " . $rowFunds["fund_ccy"] . " " . $rowFunds["fund_limit_amount"] . "
    							; spent: " . $rowFunds["fund_ccy"] . " " . $rowFunds["total"] .  " <br/>";
    						}
    					}
        ?>
        				<a href="edit_rpa_funds.php?rpa_id=<?php echo $rpaId; ?>">Add/edit funds</a>
        			</td>
        		</tr>
        		<tr>
        			<td>Research purchased (TBD):</td>
        			<td>London craft ale [rating: 3/5]</td>
        		</tr>
        <?php
        		echo "<tr>
        			<td><strong>Action?</strong></td><td>[ <a href='edit_rpa.php?rpa_id=" . $rpaId . "'>Edit this RPA</a> ]  
        				&nbsp;&nbsp;&nbsp;&nbsp;
        			</td>
        		</tr>";
    		}
		} 
		else {
    		//new record to be created by user
    		echo "<tr>
        		<td width='100'>RPA name: </td><td width='600'><input type='text' class='search-text' name='rpa_name' id='rpa_name' value=''/></td></tr>
        		<tr><td>Asset owner: </td>
        		<td width='600'><select name='asset_owner_id'>
        			<option value=''>choose...</option>";
        	
    		if ($resultAssetOwner->num_rows > 0) {
    			// output data of each row
    			while($rowAO = $resultAssetOwner->fetch_assoc()) {
    				echo "<option value='". $rowAO["asset_owner_id"] . "'>". $rowAO["asset_owner_name"] . "</option>";
    			}
    		}
        	echo "</select></td></tr>
        		<tr><td>Budget:</td><td>
        			<input type='text' style='width:40px;' class='search-text' name='budget_ccy' id='budget_ccy' value='' placeholder='GBP'/>
        			<input type='text' style='width:100px;' class='search-text' name='budget_amount' id='budget_amount' value='' />
        			</td>
        		</tr>
        		<tr>
        			<td>Dates (start-end): </td><td><input type='text' class='search-text' name='start_date' id='start_date' value=''/> to 
        			<input type='text' class='search-text' name='end_date' id='end_date' value=''/> (yyyy-mm-dd)
        		</td>
        		</tr>
        		<tr>
        			<td>Active?</td>
        			<td>
        				<select name='active_status'>
        					<option value='0'>Not active</option>
        					<option value='1'>Active</option>
        				</select>
        			</td></tr>
        		<tr><td><strong>Action?</strong></td><td>[ <a href='javascript:submitform();'>save changes</a> ]  
        		<input type='text' name='new_record' value='new' />
        		</td></tr>";
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
