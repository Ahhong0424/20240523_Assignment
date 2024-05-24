<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Static Header</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <style>
        .navbar {
            background-color: #D9FDFF;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
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
                        <a class="nav-link active" aria-current="page" href="story.php">Post</a>
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
                    <?php if(isset($_SESSION['user_last_name'])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="profile.php">Welcome, <?php echo htmlspecialchars($_SESSION['user_last_name']); ?>!</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">Login/Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
