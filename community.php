<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vets for Pets Animal Clinic (VPAC) is a well-established, full service, small animal and exotic veterinary clinic providing comprehensive preventive, medical, surgical and dental care. We provide a broad spectrum of diagnostic procedures through in-house testing and the use of external laboratories. We also work closely with local practices when special diagnostic procedures are required. The facility includes a well-stocked pharmacy, in-house surgery suite, in-house x-ray capabilities, a closely supervised hospitalization area, and indoor boarding kennels with outdoor walking areas. We understand that your pets are a part of your family. Thus, we treat each patient with the same love and gentle handling that we would expect for our own ‘kids’. ">
    <meta name="keywords" content="animal clinic, pets clinic, veterinary, vets for pets animal clinic, vpac, VPAC">
    <meta name="author" content="Desmond Lin Wai Kin">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carattere&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'assets/header.php'; ?>
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

        <div class="content">
            <?php
            include 'configurations/dbconfig.php';
            $results_per_page = 5;

            $sql = "SELECT * FROM community";
            $result = mysqli_query($conn, $sql);
            $number_of_results = mysqli_num_rows($result);

            $number_of_pages = ceil($number_of_results / $results_per_page);

            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $this_page_first_result = ($page - 1) * $results_per_page;

            $sql = "SELECT * FROM community LIMIT $this_page_first_result, $results_per_page";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='post'>";
                echo "<img src='" . $row['file_path'] . "' alt='Post Image'>";
                echo "<div class='post-content'>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p style='color: #939393;'><small>Posted by " . $row['lastName'] . " on " . $row['creation_date'] . "</small></p>";
                echo "</div>";
            }
            ?>
        </div>
        
            <?php
            for ($page = 1; $page <= $number_of_pages; $page++) {
                echo '<a href="community.php?page=' . $page . '">' . $page . '</a> ';
            }
            ?>
    </div>
    <br>
    <br>
    <?php include 'assets/footer.php'; ?>
</body>
</html>
