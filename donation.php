<?php
echo '
<!DOCTYPE html <html>

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
    content="Vets for Pets Animal Clinic (VPAC) is a well-established, full service, small animal and exotic veterinary clinic providing comprehensive preventive, medical, surgical and dental care.
    We provide a broad spectrum of diagnostic procedures through in-house testing and the use of external laboratories. We also work closely with local practices when special diagnostic procedures are required. The facility includes a well-stocked pharmacy, in-house surgery suite, in-house x-ray capabilities, a closely supervised hospitalization area, and indoor boarding kennels with outdoor walking areas.
    We understand that your pets are a part of your family. Thus, we treat each patient with the same love and gentle handling that we would expect for our own ‘kids’. ">
  <meta name="keywords" content="animal clinic, pets clinic, veterinary, vets for pets animal clinic, vpac, VPAC">
  <meta name="author" content="Desmond Lin Wai Kin">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/Style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Carattere&display=swap" rel="stylesheet">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg" style="background-color: #D9FDFF;">
      <div class="container-fluid">
        <img src="Image/WebLogo.png" alt="">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="aboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="petsInfo.php">Pets Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="community.php">Community</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="donation.php">Donation</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="adopt.php">Adopt</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="news.php">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
            </li>
            
          </ul>

        </div>
      </div>

    </nav>

    <br>
    <div class="container-fluid text-center">
      <h1>Donation</h1>
    </div>
    <br>
    <div class="container-fluid" style="padding: 100px; background-color:#D9FDFF;">
      <div class="container-fluid" style="padding:50px ; border-radius: 10px; background-color: #1985B6;">
        <form class="row g-3">
          <div class="col-md-6">
            <label for="inputFristName4" class="form-label">First Name</label>
            <input type="text" class="form-control" id="inputFristName4">
          </div>
          <div class="col-md-6">
            <label for="inputLastName4" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="inputLastName4">
          </div>
          <div class="col-12">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputemail" placeholder="Type Your Email Here....">
          </div>
          <div class="col-12">
            <label for="inputPhoneNumber" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="inputPhone Number"
              placeholder="Type Your Phone Number Here....">
          </div>
          <div class="col-12">
            <label for="Textarea" class="form-label">Message to us</label>
            <textarea class="form-control" id="Textarea" rows="5" placeholder="Type Your Message Here...."></textarea>
          </div>
          <div class="col-12">
            <h5 style="font-size: 32px; color: white;">Qr Payment</h5>
          </div>
          <div class="col-12 text-center" style="max-width: 100%; max-height: 100%;">
            <img src="Image/QrPayment.png" alt="">
          </div>
          <div>
            Line
          </div>
          <div class="col-12">
            <h5 style="font-size: 32px; color: white;">Card Payment</h5>
          </div>
          <div class="col-12">
            <label for="inputCardHolderName" class="form-label">Card Holder Name</label>
            <input type="text" class="form-control" id="inputcardnumbername" placeholder="Card Holder Name....">
          </div>
          <div class="col-12">
            <label for="inputCardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="inputcardnumber" placeholder="Card Number....">
          </div>
          <div class="col-md-6">
            <label for="inputExpiry" class="form-label">Expiry</label>
            <input type="text" class="form-control" id="inputExpiry">
          </div>
          <div class="col-md-6">
            <label for="inputSecurityNumber" class="form-label">Security Number</label>
            <input type="text" class="form-control" id="inputSecurityNumber">
          </div>
          <div class="col-12">
            <label for="inputAmount" class="form-label">Ringgit Malaysia (RM)</label>
            <input type="amount" class="form-control" id="inputamount" placeholder="RM">
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Sign in</button>
          </div>
        </form>

      </div>

    </div>

    <br>
    <br>
    <div class="container-fluid text-start" style="background-color: #D9FDFF;">
      <div class="row">
        <div class="col">
          <h5>ADDRESS</h5>
          <h7>Jalan 123,Taman 123,Kuala Lumpur</h7>

          <h5>EMAIL</h5>
          <h7>MYPET123@COMPANY.COM</h7>

          <h5>H/P</h5>
          <h7>012-3451236</h7>

        </div>
        <div class="col text-center">
          <a class="Link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="#">
            <h6>ABOUT US</h6>
          </a>

          <a class="Link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="#">
            <h6>PETS INFO</h6>
          </a>

          <a class="Link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="#">
            <h6>COMMUNITY</h6>
          </a>

          <a class="Link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="#">
            <h6>DONATION</h6>
          </a>

          <a class="Link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="#">
            <h6>ADOPT</h6>
          </a>

          <a class="Link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href="#">
            <h6>NEWS</h6>
          </a>
        </div>
        <div class="col text-end">
          <img src="Image/MasterCard.png" alt="">
          <img src="Image/VisaCard.png" alt="">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</body>
';
?>