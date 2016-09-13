<?php
$session_expiry_msg = $_REQUEST["my_session"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link href="css/owl.carousel.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />

<title>PublishForce | Making research transparent</title>

<meta name="keywords" content="PublishForce, PublishForce Limited, research everywhere" />
<meta name="description" content="PublishForce is coming soon." />
<meta name="robots" content="index, follow" />
<meta name="author" content="PublishForce Limited" />
<meta name="revisit-after" content="7 days" />
<meta name="copyright" content="PublishForce Limited" />
<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">

<script type="text/javascript" src="js/mobile-nav.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>


</head>

<body>
<div id="header-section">
	<div id="header-bar">
		<!-- menu nav -->
        <div class="clr"></div>
        
		<div style="text-align:center;color:#ff0000;">
		<?php require("menu_teaser.php"); ?>
        <!-- END menu nav -->
        <?php
        if( $session_expiry_msg == "expired" )
		{
				Print("Please login again");
              
		}
        ?>
        </div>
    </div>
	<div class="container">
		<div id="banner-container">
        	<div id="banner-slider">
               <div class="item">
					<h2>Turning research upside down</h2>
                    <p>Find a simple, efficient, independent means of selling your research publications in a transparent manner that gives you access to a large group of customers and regulatory compliance.
                    </p>
                    <br />
                    
                </div>
                <div class="item">
					<h2>What is PublishForce?</h2>
                    <p>We serve as an independent marketplace for wide-ranging research provided by leaders in all the major fields of research. You don't need to mix in fancy circles to access independent, intelligent information.
                    </p>
                    <br />
                    
                </div>
            </div>
            <span id="left_banner_arrow">&nbsp;</span>
            <span id="right_banner_arrow">&nbsp;</span>
        </div>
        
        <!-- CLOSE HEADING DIVS -->
    </div>
	
</div>

<!-- CLOSE HEADING DIVS -->



<div class="grey-section" style="padding:4px 0;">
	<div class="container">
    	<h3><br/>Research Distribution is changing </h3>
    		<p>
    			MiFID II will transform the relationship between producers and consumers of investment research. 
    			New legislation is involved, affecting everything from unbundling of research to the methods of payment and budget allocation, with profound implications for the research business. 
    		</p>
    		<p>
    			<ul>
                	<li>PublishForce delivers a workflow solution covering the research distribution and analysis life-cycle in a regulatory compliant way, minimising risk and dramatically improving efficiency</li>
					<li>MiFID compliant solution to billing and funding via the Research Payment Account, with an option to manage through a Commission Sharing Agreement</li>
					<li>Straightforward workflow that recognises and allocates the value of Research that you purchase </li>
                </ul>
            </p>
	</div>
</div>

<div id="main-section">
	<div class="container">
            	<h1><span class="headerunderline">Who we are</span></h1>
                <p>
                	MiFID is set to drive a train through the middle of Research provision in both the equity and OTC markets. While the market is wrestling with how to reconfigure workflows and relationships, PublishForce has been established with the specific goal of providing a MiFID compliant set of workflows through one single access. We help you fit the appropriate workflow modules into your existing infrastructure, ensuring your firm succeeds in building the solution that matches your business needs to a controlled budget.  
				</p>
				<p>
					We recognise that it can be complicated to choose which company will help work with you to arrive at the best outcome. So we emphasise the opportunity to use PublishForce at this early stage, when you can pull in a substantial proportion of our energy, development time and experience - to your best advantage. We focus on building a long term client relationship rather looking for a customer sale. The investment that will be made by your company and the wider industry at this time is significant and must create a demonstrable benefit. We will ensure that outcome. 

				</p>
				<p>
				Selecting PublishForce as your partner will provide your firm with a secure solution to the MiFID-driven research unbundling headache. Risk is controlled, research value is recognised and the finance department can manage the funding workflow from Research Payment Account through to direct payment or Commission Sharing Agreements. 
				</p>
				
                <br />
				&nbsp;</p>
				
				
							<script language="JavaScript">
									function checkVals()
									{
										var email = document.getElementById("user_email");
										if( email.value.length == 0 || email == 'enter your email' )
										{
											alert("Don't be shy! Fill in your email...");
											return false;
										}
										else
										{
											sendForm();
											return true;
										}	
									}
									
									function sendForm()
									{
										document.loginForm.submit();
									}
							</script>
	<h2>Why not stay in touch with our go-live?</h2>
        <p>
        <form id="loginForm" name="loginForm" method="POST" action="mail_sent.php">
        	<input type="text" placeholder="enter your email" class="user-text" name="user_email" id="user_email" style="width: 180px;" />&nbsp;&nbsp;
        	<input type="hidden" name="send">
        	<input type="button" class="search-button" name="Submit" value="notify me!" onClick="javascript:checkVals();"> 
        </form>
									
        </p>


        </div>

</div>




<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>