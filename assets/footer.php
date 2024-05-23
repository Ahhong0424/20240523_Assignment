<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Static Footer</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <style>
        .footer-container {
            background-color: #D9FDFF;
            padding: 20px 0;
        }
        .footer-col h5, .footer-col h7 {
            margin-bottom: 10px;
        }
        .footer-links a {
            display: block;
            color: #000;
            text-decoration: none;
            transition: text-decoration 0.3s;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .payment-icons img {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid footer-container text-start">
        <div class="row">
            <div class="col footer-col">
                <h5>ADDRESS</h5>
                <h7>Jalan 123, Taman 123, Kuala Lumpur</h7>

                <h5>EMAIL</h5>
                <h7>MYPET123@COMPANY.COM</h7>

                <h5>H/P</h5>
                <h7>012-3451236</h7>
            </div>
            <div class="col text-center footer-links">
                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="aboutUs.php">
                    <h6>ABOUT US</h6>
                </a>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="petsInfo.php">
                    <h6>PETS INFO</h6>
                </a>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="community.php">
                    <h6>COMMUNITY</h6>
                </a>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="donation.php">
                    <h6>DONATION</h6>
                </a>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="adopt.php">
                    <h6>ADOPT</h6>
                </a>

                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="news.php">
                    <h6>NEWS</h6>
                </a>
            </div>
            <div class="col text-end">
                <div class="payment-icons">
                    <img src="Image/MasterCard.png" alt="MasterCard">
                    <img src="Image/VisaCard.png" alt="VisaCard">
                </div>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
