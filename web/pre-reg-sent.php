<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style-mobile.css" media="only screen and (max-width: 767px)" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<link href="css/owl.carousel.css" type="text/css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css' />

<title>PublishForce | Making research transparent</title>

<meta name="keywords" content="PublishForce, PublishForce Limited, research everywhere" />
<meta name="description" content="PublishForce is coming soon." />
<meta name="robots" content="index, follow" />
<meta name="author" content="PublishForce Limited" />
<meta name="revisit-after" content="7 days" />
<meta name="copyright" content="PublishForce Limited" />
<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>


</head>

<body>

<div id="header-section">
	<div id="header-bar">
		<!-- menu nav -->
		<?php require("menu_empty.php"); ?>
        <!-- END menu nav -->
        <div class="clr"></div>
    </div>

	<div class="container">    	
		<div id="banner-container">
        	<div id="banner-slider">
                <div class="item">
					
					<h2>The new face of global markets research</h2>
					
                    
        <div class="content">
					<p class="holding-page">Thank you for expressing your interest.</p>	
	<?php
		//include phpmailer
		require_once('class.phpmailer.php');
		
		$contact_form = $_REQUEST["page_action"];
		if( $contact_form == "completed" )
		{			
			/*$headers = "From: sales@publishforce.com\r\n" .
     				"X-Mailer: php";
     				
			$to_email = "mark.mckee@publishforce.com";
			$subject = "publishforce.com GO-LIVE registration";
			$message = "Keep me updated on your go-live:\n\n";
			$message .= "Email = \t$_POST[user_email]\n";*/
			
			//SMTP Settings
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = "tls";
			$mail->Host       = "email-smtp.eu-west-1.amazonaws.com";
			$mail->Username   = "AKIAJENIZFNVGAVHA33A";
			$mail->Password   = "AgkPzaHxKFkBb0gevbvgl/GzhHr6rNTYy7d3DY6Z+E3U";
			//
			$mail->SetFrom('sales@publishforce.com', 'Sender Name'); //from (verified email address)
			$mail->Subject = "publishforce.com GO-LIVE registration"; //subject

			//message
			$body = "This is an expression of interest message from  $email_user";
			$body = eregi_replace("[]",'',$body);
			$mail->MsgHTML($body);
			//
			
			//recipient
			$mail->AddAddress("mark.mckee@publishforce.com", "Mark McKee");

			//Success
			if ($mail->Send()) {
    			echo "Message sent!"; die;
			}
		}
			//Error
			if(!$mail->Send()) {
    			echo "Mailer Error: " . $mail->ErrorInfo;
			} 

			/*if(IsSet($contact_form))
			{
				$formset = mail($to_email, $subject, $message, $headers);
				if($formset ==1)
				{
					print("<p class=\"content-text\">Thanks for sending your email. We will never spam you.</p>");
				}
			}
			else
			{
				Print("<p class=\"content-text\">Oh dear. There was a problem submitting your details.<br>Click <a href='javascript:history.go(-1);' class='link'>here</a> go back and try again.</p>");
			}
		}
		else
		{
			Print("<p class=\"content-text\">Whoops! There was a problem submitting your details.<br>Click <a href='javascript:history.go(-1);' class='link'>here</a> go back and try again.</p>");
		}*/
			
	
	?>            			

						</p>
                    
                </div>
            </div>
        </div>
        <!-- CLOSE HEADING DIVS -->
    </div>
</div>
<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>


				