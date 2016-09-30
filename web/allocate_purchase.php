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
        <h3>Step 2: Allocate research to your funds</h3>
        <p>
        
<script language="javascript">
// Return an array of the selected opion values
// select is an HTML select element
function getSelectValues(select) {
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
    }
  }
  selected_funds.value = result;
  return result;
}
function grab_data(val) {
	//pass data from the main list of fund to what you want to allocate
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
    		targetField.options[targetCount] = new Option(opt.text, opt.value, i);
    		targetCount++;
    	}
  	}
  	return result;
}

function clear_data(val) {
	//remove some or all of the items you have selected
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
    		targetField.options[i] = new Option('', '', i-targetCount);
    		targetCount++;
    	}
  	}
  	return result;
}
</script>
<?php
		$fileId = $_REQUEST["file_id"];
?>     
<form id="purchasePublications" action="review_purchase.php?file_id=<?php echo $fileId;?>" method="post" enctype="multipart/form-data">
<table style="width:800px;">
	<tr>
		<td>
<?php
		$servername = "127.0.0.1";
		$username = "publishforce";
		$password = "publishforce";
		$dbname = "publishforce";
		echo "<< <a href='display_research.php?file_id=$fileId'>Back</a> to summary<br/>";
		// Create connection
		$connection = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
        //display the funds you will be allocating to:
        /*$sqlFunds = "select fd.firm_name as firm_name, f.fund_name as fund_name, f.fund_amount as fund_amount, 
        	f.fund_ccy as fund_ccy from pf_firm_details fd, pf_funds f
			where fd.firm_id = f.firm_id
			and fd.firm_id = 1";*/
		$sqlFunds = "select * from pf_funds where Security_Status = 'Tradeable'";
		$resultFunds = $connection->query($sqlFunds);
		echo "<strong>Funds I manage:</strong><br/>";
		if ($resultFunds->num_rows > 0) {
        	echo "<select id='myselect' multiple style='height:220px;width:500px;overflow-y: auto;'>";
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
			
			<a id="myLink" href="#" onclick="grab_data(myselect);return false;">add&nbsp;&gt;&gt;</a><br/><br/>
			<a id="clearData" href="#" onclick="clear_data(copy_to);return false;">&lt;&lt;&nbsp;remove</a>
			&nbsp;
		</td>
		<td>
			<br/><strong>Funds I have selected:</strong><br/>
  			<select name ="a[]" id="copy_to" multiple style='height:220px;width:500px;overflow-y: auto;'>
		
			</select>
			<input type="hidden" name="file_id" value="<?php echo "$fileId";?>" />
		</td>
	</tr>
</table>
</form>
<!--<a href="review_purchase.php">next step</a>-->
<a id="nextPage" href="review_purchase.php?file_id=<?php echo $fileId;?>" onclick="submitform();return false;">next step</a>

<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("purchasePublications");
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