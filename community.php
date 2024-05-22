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
    <div class="container-fluid">
      <h1 style="text-align: center;">Community</h1>
      <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
                .content {
            width: 100%;
            max-width: 1200px;
            margin-top: 100px;
            margin-bottom: 50px;
        }

        .post {
            background-color: #D9FDFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 20px 100;
            display: flex;
            align-items: flex-start;
        }

        .post img {
            width: 500px;
            height: 500px;
            border-radius: 10px;
            margin-right: 20px;
            object-fit: cover;
        }

        .post-content {
            flex: 1;
        }

        .post-content h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .comments-container {
            width: 30%;
            margin-left: 20px;
            margin-right: auto;
            flex-direction: column;
        }

        .comments-section {
            max-height: 200px;
            overflow-y: auto;
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .comment {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .new-comment {
            display: flex;
            flex-direction: column;
        }

        .new-comment textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .new-comment button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
      </style>
      <div class="post">
        <img src="Image/AdoptCat6.png" alt="Post 1 Image">
        <div class="post-content">
            <h3>My cat
            </h3>
            <p>finally i adopt a cat</p>
            <p style="color: #939393;"><small>Posted by User1 on May 22, 2024</small></p>
        </div>
        <div class="comments-container">
            <div class="comments-section">
                <div class="comment">
                    <p><strong>User2:</strong> Great post! Thanks for sharing.</p>
                </div>
                <div class="comment">
                    <p><strong>User3:</strong> So cute! </p>
                </div>
                <div class="comment">
                    <p><strong>User4:</strong> I love this!</p>
                </div>
            </div>
            <div class="new-comment">
                <textarea rows="3" placeholder="Write a comment..."></textarea>
                <button>Submit</button>
            </div>
        </div>
    </div>
    <div class="post">
        <img src="Image/AdoptDog1.png" alt="Post 2 Image">
        <div class="post-content">
            <h3>Dogiee
            </h3>
            <p>My Dog looks so cute!!</p>
            <p style="color: #939393;"><small>Posted by User2 on May 21, 2024</small></p>
        </div>
        <div class="comments-container">
            <div class="comments-section">
                <div class="comment">
                  <p><strong>User2:</strong> Great post! Thanks for sharing.</p>
                </div>
                <div class="comment">
                    <p><strong>User3:</strong> So cute! </p>
                </div>
                <div class="comment">
                    <p><strong>User4:</strong> I love this!</p>
                </div>
            </div>
            <div class="new-comment">
                <textarea rows="3" placeholder="Write a comment..."></textarea>
                <button>Submit</button>
            </div>
        </div>
    </div>
    <!-- Add more posts as needed -->
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