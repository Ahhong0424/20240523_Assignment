<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Tarcu Badminton Club</title>

    
    <!-- Tab bar icons -->
    <link href="assets/img/Badminton-icon.png" rel="icon">
    <link href="assets/img/Badminton-icon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="assets/css/payment-form.css">
</head>
<body>
        <!-- Payment form-->
        <section id="payment">
        <h1 class="mb-4 pb-0"><span>TAR UC Badminton Club</span> </h1>
<div class="card rounded-0 border-0 card2" id="paypage">
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="">
                <div class="card card0 rounded-0">
                    <div class="row"></div>
                        <div class="p-0 box">
                            <div class="card rounded-0 border-0 card2" id="paypage">
                            <form action="successpage.php">
                                <div class="form-card">
                                <h2 id="heading2" class="text-danger">Payment Method</h2>                        
                                                    <div class="radio-group row">
                                                        <div class="row">
                                                            <div class="col-2 col-md-4">    
                                                                <input type="radio" class="radio" id="" name="pay-method" value="credit"  style="vertical-align: middle" />
                                                            </div>
                                                            <div class="col-2 col-md-8">  
                                                                <label for="pay-method"><img src="assets/img/payment/creditcard.jpg" width="200px" height="60px"></label>
                                                            </div>
                                                            </div> 
                                                    </div>
                                                    <div class="radio-group row">
                                                        <div class="row"  style="vertical-align: middle">
                                                            <div class="col-2 col-md-4 "> 
                                                                <input type="radio" class="radio" id="" name="pay-method" value="paypal"  />
                                                                </div>
                                                            <div class="col-2 col-md-8">   
                                                                <label for="pay-method"><img src="assets/img/payment/paypal.jpg" width="200px" height="60px"></label>
                                                            </div>
                                                            </div>
                                                    </div>
                                                    <label class="pay">Name on Card</label> <input type="text" name="holdername" placeholder="Your name">
                                                    <div class="row">
                                                        <div class="col-8 col-md-6"> <label class="pay">Card Number</label> <input type="text" name="cardno" id="cr_no" placeholder="0000-0000-0000-0000" minlength="19" maxlength="19"> </div>
                                                        <div class="col-4 col-md-6"> <label class="pay">CVV</label> <input type="password" name="cvcpwd" placeholder="&#9679;&#9679;&#9679;" class="placeicon" minlength="3" maxlength="3"> </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"> <label class="pay">Expiration Date</label> </div>
                                                        <div class="col-md-12"> <input type="text" name="exp" id="exp" placeholder="MM/YY eg.(05/21)" minlength="5" maxlength="5"> </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12"> <label class="pay">Billing Email</label> </div>
                                                        <div class="col-md-12"> <input type="email" name="email" id="email" placeholder="abc123@gmail.com"> </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-7"> <input type="submit" value="MAKE A PAYMENT" class="btn btn-info placeicon" > </div>

                                                    </div>
                                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
                
</section>
  <!-- Payment form-->
</body>
</html>