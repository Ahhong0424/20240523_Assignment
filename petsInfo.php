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
$sql = "SELECT * FROM petsinfo LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
$petsList = $result->fetch_all(MYSQLI_ASSOC);

// JavaScript for alert message
echo '<script>';
if ($message) {
    echo 'alert("' . $message . '");';
}
echo '</script>';
?>

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
    
    <?php include 'assets/header.php'; ?>

    <div class="container-fluid text-center">
      <h1>Pets Info</h1>
    </div>
    <br>
    <?php foreach ($petsList as $pet): ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card h-100">
              <img src="<?php echo htmlspecialchars($pet['file_path']); ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title"><?php echo htmlspecialchars($pet['pet_title']); ?></h4>
                <h5 class="card-title"><?php echo htmlspecialchars($pet['pet_category']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($pet['pet_description']); ?></p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">Last updated at <?php echo htmlspecialchars($pet['last_maintenance_timestamp']); ?></small>
                <form action="adopt.php?pet_id=<?= $pet['id']; ?>" method="post" style="margin-top: 10px;">
                <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($pet['id']); ?>">
                <button type="submit" class="btn btn-primary">Adopt</button>
              </form>
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