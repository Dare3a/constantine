<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/www/webvol22/qd/77lj6cnq6x6mggt/constantinethegreatbelgrade.com/public_html/contact/PHPMailer/src/Exception.php';
require '/www/webvol22/qd/77lj6cnq6x6mggt/constantinethegreatbelgrade.com/public_html/contact/PHPMailer/src/PHPMailer.php';
require '/www/webvol22/qd/77lj6cnq6x6mggt/constantinethegreatbelgrade.com/public_html/contact/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$your_email ='pgajic@gmail.com';// <<=== update to your email address



session_start();

$errors = '';

$name = '';

$visitor_email = '';

$visitor_naslov = '';

$user_message = '';



if(isset($_POST['submit']))

{

	

	$name = $_POST['name'];

	$visitor_email = $_POST['email'];

	$visitor_naslov = $_POST['naslov'];

	$user_message = $_POST['comments'];

	///------------Do Validations-------------

	if(empty($name)||empty($visitor_email))

	{

		$errors .= "\n Name and email are required. ";	

	}

	if(IsInjected($visitor_email))

	{

		$errors .= "\n Wrong email address!";

	}

	if(empty($_SESSION['6_letters_code'] ) ||

	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)

	{

	//Note: the captcha code is compared case insensitively.

	//if you want case sensitive match, update the check above to

	// strcmp()

		$errors .= "\n You did not enter the correct code!";

	}

	

	if(empty($errors))

	{

		//send the email

		$to = $your_email;

		$subject="New email from your contact form - Constantine The Great, EN";

		$from = $your_email;

		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

		

		$body = "Korisnik  $name je poslao poruku:\n\n".

		"Kontakt osoba: $name\n".

		"Email: $visitor_email \n".

		"Telefon: $visitor_naslov \n".

		"Poruka: \n ".

		"$user_message\n".

		"IP adresa korisnika: $ip\n";	

		

		$headers = "From: $from \r\n";

		$headers .= "Reply-To: $visitor_email \r\n";

		

//		mail($to, $subject, $body,$headers);
        try {
            //Server settings
        //    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mailcluster.loopia.se';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'online@constantinethegreatbelgrade.com';                     //SMTP username
            $mail->Password   = '4onlinEE#14sD';                               //SMTP password
//            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('online@constantinethegreatbelgrade.com', 'Contact form');
//            $mail->addAddress('pgajic@gmail.com', 'constantinethegreatbelgrade.com');     //Add a recipient
            $mail->addAddress('info@hotel-constantine.com', 'constantinethegreatbelgrade.com');     //Add a recipient
            $mail->addReplyTo($visitor_email, $from);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = 'From contact form';

            $mail->send();
//            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }



		

		header('Location: thank-you.html');

	}

}



// Function to validate against any email injection attempts

function IsInjected($str)

{

  $injections = array('(\n+)',

              '(\r+)',

              '(\t+)',

              '(%0A+)',

              '(%0D+)',

              '(%08+)',

              '(%09+)'

              );

  $inject = join('|', $injections);

  $inject = "/$inject/i";

  if(preg_match($inject,$str))

    {

    return true;

  }

  else

    {

    return false;

  }

}

?>

<!DOCTYPE HTML><html lang="en">

   <head>

      <meta charset="UTF-8">

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

      <link rel="icon" type="image/x-icon" href="../img/favicon.ico">

      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

      <meta name="description" content="Hotel Constantine the Great Belgrade - Contact" />

      <meta name="keywords" content="hotel in belgrade contact, contact, hotel belgrade" />

      <title>Contact</title>

      <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

      <link rel="icon" type="image/x-icon" href="../img/favicon.ico">

      <!-- Bootstrap core CSS -->

      <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <!-- Additional CSS Files -->

      <link rel="stylesheet" href="../assets/css/fontawesome.css">

      <link rel="stylesheet" href="../assets/css/templatemo-stand-blog.css">

	  <script src="component/jquery/jquery-3.2.1.min.js"></script>



	

	<script src='https://www.google.com/recaptcha/api.js'></script>	

      <script type="application/ld+json">

         {

         "@context": "https://schema.org",

         "@type": "LocalBusiness",

         "name": "Hotel Constantine The Great",

         "image": "https://constantinethegreatbelgrade.com/img/hotel-constantin-the-great-belgrade.jpg",

         "@id": "",

         "url": "https://constantinethegreatbelgrade.com/",

         "telephone": "+381114012457",

         "address": {

         "@type": "PostalAddress",

         "streetAddress": "27.marta 12",

         "addressLocality": "Beograd",

         "postalCode": "11000",

         "addressCountry": "RS"

         }

         }

      </script>

      <meta property="og:type" content="business.business">

      <meta property="og:title" content="Hotel Constantin The Great">

      <meta property="og:url" content="https://constantinethegreatbelgrade.com/">

      <meta property="og:image" content="https://constantinethegreatbelgrade.com/img/hotel-constantin-the-great-belgrade.jpg">

      <meta property="og:description" content="A 4 star hotel, Constantine the Great opened in November 2014 offering 55 luxury rooms and suites striving to meet requests of both business and leisure guests. ">

      <meta property="business:contact_data:street_address" content="27. marta 12">

      <meta property="business:contact_data:locality" content="Beograd">

      <meta property="business:contact_data:region" content="Srbija">

      <meta property="business:contact_data:postal_code" content="11000">

      <meta property="business:contact_data:country_name" content="Serbia">

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-R55GFMXE16"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'G-R55GFMXE16');</script></head>


   <body>

      <div id="info">

  

      </div>

      <div class="call-mob call">

         <a class="cc-list cc-button" href="tel:+381608898340:" style="text-decoration:none;">

         <img class="img-fluid" src="../img/call1.png" style="max-width:35px;">

         </a>

      </div>

      <div class="call-desk call">

         <a class="cc-list cc-button" href="tel:+381608898340" style="text-decoration:none;">

            <p>  <i class="fa fa-phone" style="margin-right:5px;"></i> +381 60 88 98 340 </p>

         </a>

      </div>

      <div id="call1">

         <a class="cc-list cc-button" href="https://msng.link/o/?381608898340=vi" style="text-decoration:none;" target="_blank">

         <img class="img-fluid" src="../img/viber.png" alt="viber">

         </a>

      </div>

      <div id="call2">

         <a class="cc-list cc-button" href="https://wa.me/381608898340" style="text-decoration:none;" target="_blank">

         <img class="img-fluid" src="../img/whatsapp.png" >

         </a>

      </div>

      <!-- Header -->

      <ul class="nav justify-content-center " style=" padding:1px;text-align:center;" id="topheaderprim">

         <div class="container">

            <li class="nav-item" style="margin-top:1px; margin-right:10px;">

               <div class="container-fluid" id="topheader">

                  <h4>Hotel Constantine the Great, 27. marta 12, 11000 Belgrade, Serbia | <i class="fa fa-phone" aria-hidden="true" style="color:white;margin-left:10px;font-size: 20px;;"></i>

                     <a href="tel:+381114012457" style="color:white; text-decoration:none;"> +381 11 40 12 457</a>   <i class="fa fa-mobile" aria-hidden="true"style="margin-left:10px;font-size: 20px;"></i><a href="tel:+381608898340" style="color:white; text-decoration:none;"> +381 60 88 98 340</a>

                  </h4>

               </div>

            </li>

      </ul>

      </div>

      <header style="background-color: #151e21;">

         <nav class="navbar navbar-expand-lg">

            <div class="container">

               <a class="navbar-brand" href="../"><img src="../img/logo2.png" style="max-width:180px;" alt=""></a>

               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

               <span class="navbar-toggler-icon"></span>

               </button>

               <div class="collapse navbar-collapse" id="navbarResponsive">

                  <ul class="navbar-nav" style="margin-left: 30px;">

                     <li class="nav-item" style="margin-top:-1px;"> 

                        <a class="nav-link" href="../">HOME

                        <span class="sr-only">(current)</span>

                        </a>

                     </li>

                     <li class="nav-item" style="margin-top:-1px;">

                        <a class="nav-link" href="../about-us/">ABOUT US</a>

                     </li>

                     <li class="nav-item">

                        <div class="dropdown" id="glmeni-desktop">

                           <button style="margin-top:-1px;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                           ROOMS & SUITES

                           </button>

                           <div class="dropdown-menu" data-bs-popper="none">

                              <ul class="hideme">

                                 <li class="" style="margin-top:1px;">

                                    <a class="dropdown-item" href="../classic-single-room/">

                                       STANDARD SINGLE ROOM<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom1.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                                 <li class="" style="margin-top:7px;">

                                    <a class="dropdown-item" href="../superior-twin-room/">

                                       DELUXE TWIN ROOM<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom5.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                              </ul>

                              <ul class="hideme">

                                 <li class="">

                                    <a class="dropdown-item" href="../superior-single-room/">

                                       STANDARD DOUBLE ROOM<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom2.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                                 <li class="">

                                    <a class="dropdown-item" href="../family-room/">

                                       FAMILY SUITE<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom6.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                              </ul>

                              <ul class="hideme">

                                 <li class="">

                                    <a class="dropdown-item" href="../classic-double-room/">

                                       SUPERIOR DOUBLE ROOM<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom5.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                                 <li class="">

                                    <a class="dropdown-item" href="../junior-suite/">

                                       JUNIOR SUITE<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom7.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                              </ul>

                              <ul class="hideme">

                                 <li class="">

                                    <a class="dropdown-item" href="../superior-double-room/">

                                       DELUXE DOUBLE ROOM<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom4.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                                 <li class="" style="margin-top:-5px;">

                                    <a class="dropdown-item" href="../all-rooms/">

                                       ALL ROOMS<br>

                                       <div class="item-image">

                                          <img src="../img/menuroom10.png">

                                       </div>

                                       <div class="boxx2"> </div>

                                    </a>

                                 </li>

                              </ul>

                           </div>

                        </div>

                        <div class="dropdown" id="glmeni-mob">

                           <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                           ROOMS & SUITES

                           </button>

                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                              <a class="dropdown-item" href="../classic-single-room/">STANDARD SINGLE ROOM</a>

                              <a class="dropdown-item" href="../superior-single-room/">STANDARD DOUBLE ROOM</a>

                              <a class="dropdown-item" href="../classic-double-room/">SUPERIOR DOUBLE ROOM</a>

                              <a class="dropdown-item" href="../superior-double-room/">DELUXE DOUBLE ROOM</a>

                              <a class="dropdown-item" href="../superior-twin-room/">DELUXE TWIN ROOM</a>

                              <a class="dropdown-item" href="../family-room/">FAMILY SUITE</a>

                              <a class="dropdown-item" href="../junior-suite/">JUNIOR SUITE</a>

                              <a class="dropdown-item" href="../all-rooms/">ALL ROOMS</a>

                           </div>

                        </div>

                     </li>

                     <li class="nav-item gl-meni">

                        <a class="nav-link" href="../restaurant-belgrade/">RESTAURANT</a>

                     </li>

                     <li class="nav-item gl-meni">

                        <a class="nav-link" href="../congress/">CONGRESS</a>

                     </li>

                     <li class="nav-item gl-meni">

                        <a class="nav-link" href="../gallery/">Gallery</a>

                     </li>

                     <li class="nav-item gl-meni">

                        <a class="nav-link" href="../blog/">BLOG</a>

                     </li>

                     <li class="nav-item active" id="gl-meni">

                        <a class="nav-link" href="../contact/">CONTACT</a>

                     </li>

                     <li class="nav-item jezici">

                        <a class="nav-link" href=""><img src="../img/eng.png"></a>

                     </li>

                     <li class="nav-item jezici">

                        <a class="nav-link" href="../rs/"><img src="../img/rs.png"></a>

                     </li>

                  </ul>

               </div>

            </div>

         </nav>

      </header>

      <div class="bckonama  d-flex align-items-center" id="contact">

         <!-- homeparalax -->

         <div class="container" id="jumbo-text">

            <h1 class="f18 belinaslov" style="color:white">Hotel in Belgrade Contact</h1>

            <h3 id="h1" class="f35 belinaslov" style="color:white">Get in touch</h3>

         </div>

      </div>

      <div class="container" style="text-align:center; padding-top:50px; padding-bottom:30px;">

         <img src="../img/smalltext.png" style="margin-bottom:50px;">

         <div class="row">

            <div class="col-md-4"  id="contact-res">

               <h6>ADDRESS</h6>

               <p>

                  27.marta 12,<br>

                  11000 Belgrade, Serbia

               </p>

            </div>

            <div class="col-md-4" id="contact-res">

               <h6>PHONE RESERVATIONS &amp; INFO</h6>

               <p>

                  <a href="tel:+381 11 40 12 457 " style="color:#535353; text-decoration:none;">+381 11 40 12 457 </a>

                  <br>

                  <a href="tel:+381608898340" style="color:#535353; text-decoration:none;">+381 60 88 98 340</a>

               </p>

            </div>

            <div class="col-md-4">

               <h6>EMAIL</h6>

               <a href="mailto:info@hotel-constantine.com">

                  <p>info@hotel-constantine.com</p>

               </a>

            </div>

         </div>

      </div>

      <div style="padding-bottom:20px; padding-top:50px; background-color:#f8f5f0!important;">

         <div class="container mb-5">

            <div class="row">

               <div class="col-md-7 col-xs-12 levikontakt">

                  <a target="_blank" href="https://www.google.com/maps/place/Hotel+Constantine+The+Great/@44.8121431,20.4727552,20.5z/data=!4m16!1m7!3m6!1s0x475a7abb52a293a5:0x76e8319b992a7cd5!2sDvadeset+sedmog+marta+12,+Beograd!3b1!8m2!3d44.8121081!4d20.4728606!3m7!1s0x475a7abb4e8fc085:0xf1cbe419315a77ac!5m2!4m1!1i2!8m2!3d44.812325!4d20.47268"><img class="img-fluid" src="../img/mapa.png"></a>

               </div>

               <div class="col-md-5 ">

                  <div class="row">

                     <div class="col-md-12">

                        <h5 class="gildafont  mt-3 mb-4">Contact us over website</h5>

                     </div>

                  </div>

                  <!-- form -->

     <?php

if(!empty($errors)){

echo "<p class='err'>".nl2br($errors)."</p>";

}

?>

<div class="new-form">

                                            <!-- contact form -->

                                            <div class="contact-form-holder fl-wrap">

                                                <div id="contact-form">

                                                    <div id="message"></div>

<div id="contact-form" class='err'></div>



<form method="POST" name="contact_form" 

action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 

<div class="form-outline">

<label for="name">First and last name<span class="reqired">*</span></label>

 <input class="form-control" name="name" type="text" id="name" onclick="this.select()"  required>

</div>

<div class="form-outline">

<label for="email">Email address<span class="reqired">*</span></label>

<input class="form-control" name="email" type="text" id="email" onclick="this.select()"  required>

</div>

<div class="form-outline">

<label for="naslov">Phone number</label>

<input class="form-control" type="text" name="naslov" id="phone" onclick="this.select()"> 

</div>

<div class="form-outline">

<label for="comments">Text message<span class="reqired">*</span></label>

<textarea class="form-control" type="text" id="comments" onclick="this.select()"  name="comments" required></textarea>

</div>

<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br><br>

<label for='message'style="margin-top: 5px;">Please enter the code from the image here:</label><br>

<input id="6_letters_code" name="6_letters_code" type="text"><br>

<small>Can't read this code? Click  <a href='javascript: refreshCaptcha();'><u>here</u></a> to refresh the image.</small>

</p>

 <button type="submit" id="submit" class="btn newsletterbutton"  name='submit' data-top-bottom="transform: translateY(-50px);" data-bottom-top="transform: translateY(50px);"><span>SEND MESSAGE </span></button>

</form>

    </div>

      </div>

         </div>

<script language="JavaScript">

// Code for validating the form

// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml

// for details

var frmvalidator  = new Validator("contact_form");

//remove the following two lines if you like error message box popups

frmvalidator.EnableOnPageErrorDisplaySingleBox();

frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("name","req","Please fill in the name field"); 

frmvalidator.addValidation("email","req","Please enter your email"); 

frmvalidator.addValidation("naslov","req","Please enter a phone number");

frmvalidator.addValidation("email","email","Please enter your email"); 

</script>

<script language='JavaScript' type='text/javascript'>

function refreshCaptcha()

{

	var img = document.images['captchaimg'];

	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;

}

</script>

                                            <!-- contact form  end-->

				  <!-- // form -->

               </div>

            </div>

         </div>

      </div>

      <div class="blackbck">

         <div class="container blackbck pt-80 pb-40">

            <form class="newsletterform" method="post" action="https://hotel-constantine.us21.list-manage.com/subscribe/post?u=c2a6c439223784e58a9c36683&amp;id=169381d68b&amp;f_id=0042d9e6f0">

            <div class="row text-center">

               <div class="col-md-12">

                  <h6 class="whitetext">NEWSLETTER</h6>

                  <h3 id="h3-4">Sign up for exclusive offers from us</h3>

               </div>

               <div class="col-md-12 text-center newsletterform mt-5 mb-5">

                  <div id="mc_embed_shell">
      <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
  <style type="text/css">
#mc_embed_signup{background:#151e21; false;clear:left; font:14px Helvetica,Arial,sans-serif; width: 280px; color: white !important;
    margin: auto !important;}
        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup" style="margin-top:-45px !important;">
    <form action="https://hotel-constantine.us21.list-manage.com/subscribe/post?u=c2a6c439223784e58a9c36683&amp;id=169381d68b&amp;f_id=0042d9e6f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
        <div id="mc_embed_signup_scroll">
           
            <div class="mc-field-group"><label for="mce-EMAIL">Email Address <span class="asterisk">*</span></label><input type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value="" style="padding:12px;"></div>
        <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display: none;"></div>
            <div class="response" id="mce-success-response" style="display: none;"></div>
        </div><div aria-hidden="true" style="position: absolute; left: -5000px;"><input type="text" name="b_c2a6c439223784e58a9c36683_169381d68b" tabindex="-1" value=""></div><div class="clear"><input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Subscribe" style="margin-top:0px;background-color: #aa8453;"></div>
    </div>
</form>
</div>
<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[4]='PHONE';ftypes[4]='phone';fnames[3]='ADDRESS';ftypes[3]='address';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script></div>


               </div>

            </div>

            <div class="row">

               <div class="col-md-3  whitetext">

                  <div class="footertitlediv">

                     <h5 class="footertitle whitetext">CONTACT</h5>

                  </div>

                  <p class="footerp">

                     LOCATION<br>

                     <a href="https://g.co/kgs/SoXnYC" style="color:white; text-decoration:none;" target="_blank"> 27. marta 12</a>,<br>

                     11000 Belgrade, Serbia

                  </p>

                  <p class="footerp">

                     CONTACT<br>

                     <a class="footerorangelink" href="tel:+381114012457">+381 11 40 12 457</a><br>

                     <a class="footerorangelink" href="tel:+381608898340">+381 60 88 98 340</a><br>

                     <a class="footerlink" href="mailto:info@hotel-constantine.com">info@hotel-constantine.com</a>

                  </p>

               </div>

               <div class="col-md-3">

                  <div class="footertitlediv" id="fo1">

                     <h5 class="footertitle whitetext">ROOMS &amp; SUITES</h5>

                  </div>

                  <ul class="footermenu">

                     <li><a class="nolink" href="../classic-single-room/">Classic single room</a></li>

                     <li><a class="nolink" href="../superior-single-room/">Superior single room</a></li>

                     <li><a class="nolink" href="../classic-double-room/">Classic double room</a></li>

                     <li><a class="nolink" href="../superior-double-room/">Superior double room</a></li>

                     <li><a class="nolink" href="../superior-twin-room/">Superior twin room</a></li>

                     <li><a class="nolink" href="../family-room/">Family room</a></li>

                     <li><a class="nolink" href="../junior-suite/">Junior suite</a></li>

                  </ul>

               </div>

               <div class="col-md-3">

                  <div class="footertitlediv" id="fo2">

                     <h5 class="footertitle whitetext">USEFULL LINKS</h5>

                  </div>

                  <ul class="footermenu">

                     <li><a class="nolink" href="../about-us/">About us</a></li>

                     <li><a class="nolink" href="../restaurant-belgrade/">Restaurant</a></li>

                     <li><a class="nolink" href="../congress/">Congress</a></li>

                     <li><a class="nolink" href="../gallery/">Gallery</a></li>

                     <li><a class="nolink" href="../career/">Career</a></li>

                  </ul>

               </div>

               <div class="col-md-3"> 

                  <img src="../img/luxury.png">

               </div>

            </div>

         </div>

      </div>

      <div id="bottom" class="clearfix style-2">

         <div class="container">

            <div class="row">

               <div class="col-md-12">

                  <div id="bottom-bar-inner" class="clearfix">

                     <div class="bottom-bar-content">

                        <div class="footer-logo">

                           <img src="../img/logo-futer.jpg" style="max-width:300px;" alt="Hotel Constantine the Great">

                        </div>

                        <div class="bottom-bar-socials-mobile">

                           <div class="widget widget_socials style-3">

                              <div class="socials clearfix">

                                 <div class="icon"><a target="_blank" href="https://www.instagram.com/hotelconstantine/"><img src="../img/insta.png"></a></div>

                                 <div class="icon"><a target="_blank" href="https://www.facebook.com/hotelconstantinethegreat"><img src="../img/facebook-app.png"></a></div>

                                 <div class="icon"><a target="_blank" href="https://maps.app.goo.gl/wANe7zJLsz4LYLUw5"><img src="../img/maps.png"></a></div>

                                 <div class="icon"><a target="_blank" href="https://www.linkedin.com/uas/login?session_redirect=%2Fcompany%2F5374906%3Ftrk%3Dtyah%26trkInfo%3DtarId%253A1416324821068%252Ctas%253Ahotel%2520constantine%2520the%2520%252Cidx%253A1-1-1"><img src="../img/linkedin.png"></a></div>

                                 <div class="icon"><a target="_blank" href="https://www.tripadvisor.com/Hotel_Review-g294472-d7225083-Reviews-Hotel_Constantine_the_Great-Belgrade.html"><img src="../img/tripadvisor.png"></a></div>

                              </div>

                           </div>

                           <!-- .widget_socials -->

                        </div>

                        <!-- .footer-logo -->

                     </div>

                     <div class="bottom-bar-socials">

                        <div class="widget widget_socials style-3">

                           <div class="socials clearfix">

                              <div class="icon"><a target="_blank" href="https://www.instagram.com/hotelconstantine/"><img src="../img/insta.png" style="max-width:32px;"></a></div>

                              <div class="icon"><a target="_blank" href="https://www.facebook.com/hotelconstantinethegreat"><img src="../img/facebook-app.png" style="max-width:32px;"></a></div>

                              <div class="icon"><a target="_blank" href="https://maps.app.goo.gl/wANe7zJLsz4LYLUw5"><img src="../img/maps.png" style="max-width:32px;"></a></div>

                              <div class="icon"><a target="_blank" href="https://www.linkedin.com/uas/login?session_redirect=%2Fcompany%2F5374906%3Ftrk%3Dtyah%26trkInfo%3DtarId%253A1416324821068%252Ctas%253Ahotel%2520constantine%2520the%2520%252Cidx%253A1-1-1"><img src="../img/linkedin.png" style="max-width:32px;"></a></div>

                              <div class="icon"><a target="_blank" href="https://www.tripadvisor.com/Hotel_Review-g294472-d7225083-Reviews-Hotel_Constantine_the_Great-Belgrade.html"><img src="../img/tripadvisor.png" style="max-width:32px;"></a></div>

                           </div>

                        </div>

                        <!-- .widget_socials -->

                     </div>

                  </div>

                  <p class="copyright">2023 © constantinethegreatbelgrade.com Sva prava zadržana | Izrada web sajta <a class="cr-link" style="color:#aa8453;" href="https://restop.rs/" target="_blank">restop.rs</a></p>

               </div>

               <!-- .col-md-12 -->

            </div>

            <!-- .row -->

         </div>

         <!-- .container -->

      </div>

      <!-- Bootstrap core JavaScript -->

      <script src="../vendor/jquery/jquery.min.js"></script>

      <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  

   </body>

</html>