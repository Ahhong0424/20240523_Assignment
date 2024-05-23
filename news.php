<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'configurations/dbconfig.php';

// Initialize $message
$message = '';

// Pagination logic
$limit = 10; // Number of news items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch total number of news records
$sqlTotal = "SELECT COUNT(*) AS total FROM news";
$resultTotal = $conn->query($sqlTotal);
$totalRecords = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);

// Fetch news records for the current page
$sql = "SELECT * FROM news LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
$newsList = $result->fetch_all(MYSQLI_ASSOC);

// JavaScript for alert message
echo '<script>';
if ($message) {
    echo 'alert("' . $message . '");';
}
echo '</script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <link rel="stylesheet" href="css/Stylesheet.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            width: 70%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <div class="container-fluid">
        
        <?php include 'assets/header.php'; ?>

        <br>
        <div class="container-fluid">
            <h1 style="text-align: center;">Adopt</h1>
        </div>
        <br>
        <style>
            .card {
                width: 70%;
                margin: 0 auto;
            }
        </style>
        <?php foreach ($newsList as $news): ?>
            
            <div class="card mb-3" style="background-color: #1985B6; padding: 20px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo htmlspecialchars($news['file_path']); ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title" style="color: white;"><?php echo htmlspecialchars($news['topic']); ?></h2>
                            <p class="card-text"style="color: white;"><?php echo htmlspecialchars($news['description']); ?></p>
                            <p class="card-text"><small class="text-body-secondary">Last updated at <?php echo htmlspecialchars($news['last_maintenance_timestamp']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <!-- Pagination controls -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <?php include 'assets/footer.php'; ?>

    </div>
</body>
</html>