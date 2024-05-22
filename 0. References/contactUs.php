<?php session_start();$this_page='ContactUs'; ?>

<!DOCTYPE html>
<html lang="en">
<style>
     #header {
    background-color: #040919;
    } 


    div[role=alert]{
  text-align: center;
  margin: auto;
  width: 40%;
  border: 3px ;
  padding: 10px;
}
 </style>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


  <title>Contact Us|Tarc Badminton Club</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 <!--====link====-->
 <?php include('assets/Includes/link.php');?>
<!--====End link====-->

</head>

<body>
<!--====Header====-->

<?php 
include('assets/Includes/header.php');

?>

<!--====End Header====-->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="section-bg">

      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact Us</h2>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address>77, Lorong Lembah Permai 3, <br>11200 Tanjung Bungah, Pulau Pinang</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+6011-90290903">011-90290903</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:tarcBadminton@example.com">tarcBadminton@example.com</a></p>
            </div>
          </div>

        </div>

        <?php
	if (!empty($_POST)) {
            $name = $_POST['name'];
            $email =$_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $from = $email; 
            
            $error=array();

            // Check if name has been entered
            if (!$_POST['name']) {
              $error['name'] = 'Please enter your name';
            }
            
            // Check if email has been entered and is valid
            if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
              $error['email'] = 'Please enter a valid email address';
            }
            
            //Check if message has been entered
            if (!$_POST['message']) {
              $error['message'] = 'Please enter your message';
            }

            $body = "From: $name\n E-Mail: $email\n Message:\n $message";

            require'forms/phpmailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            $mail->Username='limyong0321@gmail.com';
            $mail->Password='zhi0321qian';
            $mail->setFrom('limyong0321@gmail.com','Tarc Badminton Club');
            $mail->addAddress('tanyg0084@gmail.com');
      
            $mail->Subject='PHP mailer subject';
            $mail->Body=$body;
        
        // If there are no errors, send the email
        if (empty($error)) {
          if (!$mail->Send()) {
            $result='<div class="alert alert-danger" role="alert">
            Sorry there was an error sending your message. Please try again later
          </div>';

          } else {
            $result='<div class="alert alert-success" role="alert">
            Thank You! I will be in touch.
          </div>';
          }
          }
        }
?>
        <div class="form">
          <form action="" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
         
                  <?php 
                  
                  if (!empty($error)) {
                      foreach($error as $value){
                        echo"<li>$value</li>";
                    }
                  }
                  if(!empty($result)){
                    printf('%s',$result);
                  }
                  ?>	

            
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- End Contact Section -->


<?php
include('assets/includes/footer.php');
?>
   


</body>

</html>