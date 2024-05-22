<?php session_start(); $this_page='Event'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Event record|Tarc Badminton Club</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


 
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Tab bar icons -->
  <link href="assets/img/Badminton-icon.png" rel="icon">
  <link href="assets/img/Badminton-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

 
  <style>

#header {
background-color: #040919;
}   


.tbl-cart th {
  background-color: #E0E0E0;
}


.no-records {
	text-align: center;
	clear: both;
	margin: 38px 0px;
}
#btnEmpty {
	background-color: #ffffff;
	border: #d00000 1px solid;
	padding: 5px 10px;
	color: #d00000;
	float: right;
	text-decoration: none;
	border-radius: 3px;
	margin: 10px 0px;
}


.cart-item-image {
  	
    height: 70px;
    width: 160px;
    transition: all ease-in-out 0.3s;
    vertical-align: middle;
    box-sizing: border-box;
    overflow: hidden;
    border-radius: 50%;
    float: left;
    margin: 0 10px 10px 0;
  }


</style>
</head>

<body>

 <!--====Header====-->

<?php include('assets/Includes/header.php');?>

<!--====End Header====-->
  
  <section id="event">
<!--====Side nav====-->

<?php include('assets/Includes/side-nav.php');?>

<!--====End side nav====-->
  
  <section id="schedule" class="section-with-bg">
      <div class="container" data-aos="">
        <div class="section-header">
          <h2>Event records</h2>
          <p>Here is the records of events you joined and tickets you purchased.</p>
        </div>
        <div class="tab-content row justify-content-center" data-aos="" data-aos-delay="">

  <?php // $num1=1; $total; printf(' <input type="number" id="quantity" name="quantity" min="1" max="5">'); // display record from db ?> 



          <!-- Schdule-->

          <div role="tabpanel" class="col-lg-12" >
          <a id="btnEmpty" href="">Event</a>
          <a id="btnEmpty" href="">Tickets</a>
          <a id="btnEmpty" href="">All</a>
          <br><br><br>
          <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
              <th style="text-align:left;">Event Name</th>
              <th style="text-align:left;">Event Code</th>
              <th style="text-align:right;" width="5%">Quantity</th>
              <th style="text-align:right;" width="10%">Unit Price</th>
              <th style="text-align:right;" width="10%">Price</th>
            </tr>	
            <tr>
              <td><img src="assets/img/Event/osaka-international-challenge-2019-logo2.jpg" class="cart-item-image" />YONEX OSAKA INTERNATIONAL CHALLENGE 2021</td>
              <td>Event code</td>
              <td style="text-align:right;">2</td>
              <td  style="text-align:right;">RM2.00</td>
              <td  style="text-align:right;">RM4.00</td>
				    </tr>
            <tr>
              <td><img src="assets/img/Event/osaka-international-challenge-2019-logo2.jpg" class="cart-item-image" style="height: 460; width:640;" />YONEX OSAKA INTERNATIONAL CHALLENGE 2021</td>
              <td>Event code</td>
              <td style="text-align:right;">2</td>
              <td  style="text-align:right;">RM2.00</td>
              <td  style="text-align:right;">RM4.00</td>
          
				    </tr>
        
           
            </tbody>

           
          </table>	
          </div>
          <!-- End Schdule-->
        </div>

      </div>

    </section><!-- End Event Calendar Section -->


<?php
include('assets/includes/footer.php');
?>
</body>
</html>