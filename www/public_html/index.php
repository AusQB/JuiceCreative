<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {

	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$company = trim($_POST['company']);
	$message = trim($_POST['message']);
	
	// require a name from user
	if($name === '') {
		$nameError =  'Name is required'; 
		$hasError = true;
	}
	
	// need valid email
	if($email === '')  {
		$emailError = 'Email address is required';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $email)) {
		$emailError = 'Email address is invalid';
		$hasError = true;
	}
		
	// we need at least some content
	if($message === '') {
		$commentError = 'A message is required';
		$hasError = true;
	} else if(function_exists('stripslashes')) {
		$message = stripslashes($message);
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$emailTo = 'scott@juicecreative.com.au';
		$subject = 'Juice Creative Contact Form';
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name\n\nEmail: $email";
		if($phone !== '') $body .= "\n\nPhone: $phone";
		if($company !== '') $body .= "\n\nCompany: $company";
		$body .= "\n\nMessage: $message";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Juice Creative</title>
	<meta name='keywords' content='marketing,advertising,campaign,strategy,media,print,production,consulting,perth,australia' />
	<meta name='description' content='Marketing and Ad Campaign creation at its finest. Juice Creative will squeeze the best out of any budget.' />

    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png" />

    <link href='http://fonts.googleapis.com/css?family=Pacifico|Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/foundation.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />

    <script src="/assets/js/vendor/modernizr.js"></script>

</head>
<body>

<header>
    <div class="row">
        <div class="large-12 columns" style="text-align:center;">
            <a id="logo" href="/">
                <img data-interchange="[/assets/img/logo_reversed_230x154.png, (default)], [/assets/img/logo_reversed_460x308.png, (medium)]" alt="" />
            </a>
        </div>
        <!-- <div class="small-8 columns">
            <nav>
                <ul id="menu">
                    <li {if segment_1 == 'about'}class="active"{/if}><a href="/about">About</a></li>
                    <li {if segment_1 == 'products'}class="active"{/if}><a href="/products">Products</a></li>
                    <li {if segment_1 == 'contact'}class="active"{/if}><a href="/contact">Contact</a></li>
                </ul>
            </nav>
        </div> -->
    </div>
</header>

<div id="contents">
    <div class="row">
	    <div class="large-12 columns" style="text-align:center;">
	        <h1>Juice Creative. Get fresh!</h1>
	        <p style="font-size:1.1rem;font-weight:500;">Marketing and Ad Campaign creation at its finest. Juice Creative will squeeze the best out of any budget.</p>
	    </div>
	</div>

	<div class="row">
	    <div class="large-12 columns">
	        <ul id="services">
	            <li>
	                <i class="fa fa-briefcase"></i>
	                <span>Campaign Creation</span>
	            </li>
	            <li>
	                <i class="fa fa-bullseye"></i>
	                <span>Marketing Strategy</span>
	            </li>
	            <li>
	                <i class="fa fa-money"></i>
	                <span>Media Buying</span>
	            </li>
	            <li>
	                <i class="fa fa-print"></i>
	                <span>Print and Production</span>
	            </li>
	            <li>
	                <i class="fa fa-user-secret"></i>
	                <span>Consulting</span>
	            </li>
	            <li>
	                <i class="fa fa-desktop"></i>
	                <span>Web Development</span>
	            </li>
	        </ul>
	    </div>
	</div>

	<div class="row">
	    <div class="large-12 columns">

	        <h2>Let's have a chat <i class="fa fa-coffee"></i></h2>

	        <form action="contact.php" accept-charset="utf-8" id="contact-form" method="post">
		        <div class="row">
		            <div class="medium-6 columns">
		                <div class="row">
		                    <div class="large-12 columns">
		                    	<label data-label="name">Name</label>
		                    	<input type="text" name="name" class="required-field" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" id="cf-name" maxlength="150" placeholder="Name (required)" required>
		                    	<? if($nameError != '') : ?>  
						            <span class="error"><?= $nameError ?></span>   
						        <? endif; ?>  
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="large-12 columns">
		                    	<label data-label="email address">Email</label>
		                    	<input type="email" name="email" class="required-field email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" id="cf-email" maxlength="150" placeholder="Email (required)" required>
		                   		<? if($emailError != '') : ?>  
						            <span class="error"><?= $emailError ?></span>   
						        <? endif; ?>  
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="large-12 columns">
		                    	<label data-label="phone number">Phone</label>
		                    	<input type="tel" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>" id="cf-phone" maxlength="16" placeholder="Phone">
		                    	<? if($phoneError != '') : ?>  
						            <span class="error"><?= $phoneError ?></span>   
						        <? endif; ?>  
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="large-12 columns">
		                    	<label data-label="company">Company</label>
		                    	<input type="text" name="company" value="<?php if(isset($_POST['company'])) echo $_POST['company']; ?>" id="cf-company" maxlength="150" placeholder="Company">
		                    	<? if($companyError != '') : ?>  
						            <span class="error"><?= $companyError ?></span>   
						        <? endif; ?> 
		                    </div>
		                </div>
		            </div>
		            <div class="medium-6 columns">
		                <div class="row">
		                    <div class="large-12 columns">
		                    	<label data-label="message">Message</label>
		                    	<textarea name="message" class="required-field" cols="50" rows="6" id="cf-message" placeholder="Message" required><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
		                    	<? if($messageError != '') : ?>  
						            <span class="error"><?= $messageError ?></span>   
						        <? endif; ?>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="large-12 columns clearfix">
		                        <button class="right" type="submit" name="submit">Submit</button>
		                    	<input type="hidden" name="submitted" id="submitted" value="true">
		                    </div>
		                </div>
		            </div>
		        </div>
	        </form>

	        <div id="contact-sent" style="display:none;">
	            <p style="font-size:1.1rem;font-weight:500;"><i class="fa fa-check-circle" style="color:#95D725;"></i> Form submitted successfully</h2>
	            <p>Thanks for enquiring, we'll be in touch as soon as possible.</h3>
	        </div>

	    </div>
	</div>
</div>

<footer>
    <div class="row">
        <div class="medium-4 columns">
            <p id="copyright"><i class="fa fa-copyright"></i> Juice Creative <?= date('Y') ?></p>
        </div>
        <div class="medium-4 columns">
            <!-- <ul id="social-icons">
                <li class="social-facebook"><a href="http://arsenal-mania.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li class="social-twitter"><a href="http://www.arsenalvision.co.uk/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li class="social-google"><a href="http://www.arsenalaustralia.com.au/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            </ul> -->
        </div>
        <div class="medium-4 columns">
            <div class="clearfix">
                <!-- <a id="rgg-logo" class="right" href="http://rggwebdesigns.com" target="_blank"><img style="max-width:125px;" src="{assets}/img/rgg_logo_lanscape.png" /></a> -->
            </div>
        </div>
    </div>
</footer>

<script src="/assets/js/vendor/jquery.js"></script>
<script src="/assets/js/foundation.min.js"></script>
<script>$(document).foundation();</script>
<script>
$(document).ready(function() {
	$('#contact-form').submit(function(e) {
		e.preventDefault();
		$('#contact-form .error').remove();
		var hasError = false;
		$(this).find('button[type=submit]').html('<i class="fa fa-circle-o-notch fa-spin"></i> Sending...');
		$('.required-field').each(function() {
			if($.trim($(this).val()) == '') {
				var labelText = $(this).prev('label').data('label');
				$(this).parent().append('<span class="error">Your forgot to enter your '+labelText+'.</span>');
				$(this).addClass('inputError');
				hasError = true;
			} else if($(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test($.trim($(this).val()))) {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">You\'ve entered an invalid email address</span>');
					$(this).addClass('inputError');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			var url = $(this).attr('action'),
			data = $(this).serialize();
			$.post(url, data, function() {
				$('#contact-form').fadeOut(400, function() {
					$('#contact-sent').fadeIn(400);
				});
			});
		}
	});
});
</script>

</body>
</html>