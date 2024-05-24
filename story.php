<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'configurations/dbconfig.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'users') {
    header("Location: login.php");
    exit();
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

function uploadFile($file) {
    if (isset($file['name']) && !empty($file['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            return ["status" => 0, "message" => "Sorry, file already exists."];
        }

        // Check file size (limit to 5MB)
        if ($file["size"] > 5000000) {
            return ["status" => 0, "message" => "Sorry, your file is too large."];
        }

        // Allow certain file formats
        $allowedTypes = ["jpg", "png", "jpeg", "gif", "pdf"];
        if (!in_array($fileType, $allowedTypes)) {
            return ["status" => 0, "message" => "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed."];
        }

        // Attempt to move the uploaded file to the server
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return ["status" => 1, "file_path" => $targetFile];
        } else {
            return ["status" => 0, "message" => "Sorry, there was an error uploading your file."];
        }
    } else {
        return ["status" => 0, "message" => "No file uploaded."];
    }
}

function createStory($conn, $lastName, $title, $description, $email, $file_path) {
    $creationTimestamp = date('Y-m-d H:i:s');
    $creationDate = date('Y-m-d');
    $sql = "INSERT INTO community (lastName, title, description, email, file_path, creation_timestamp, creation_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $lastName, $title, $description, $email, $file_path, $creationTimestamp, $creationDate);

    if ($stmt->execute()) {
        return "Story posted successfully!";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deletePet($conn, $id) {
    // Fetch file path associated with the story ID
    $sqlFilePath = "SELECT file_path FROM community WHERE id = ?";
    $stmtFilePath = $conn->prepare($sqlFilePath);
    $stmtFilePath->bind_param("i", $id);
    $stmtFilePath->execute();
    $stmtFilePath->bind_result($filePath);
    $stmtFilePath->fetch();
    $stmtFilePath->close();

    // Delete the record from the database
    $sqlDelete = "DELETE FROM community WHERE id = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $id);
    $stmtDelete->execute();
    $stmtDelete->close();

    // If the file path exists, delete the file from the server
    if ($filePath && file_exists($filePath)) {
        unlink($filePath);
    }

    return "Post deleted successfully!";
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createStory'])) {
        if (isset($_FILES["file"])) {
            $uploadResult = uploadFile($_FILES["file"]);
            if ($uploadResult["status"] == 1) {
                $message = createStory($conn, $_POST['lastName'], $_POST['title'], $_POST['description'], $email, $uploadResult["file_path"]);
            } else {
                $message = $uploadResult["message"];
            }
        } else {
            $message = "No file uploaded.";
        }
    }
}

$sql = "SELECT * FROM community WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$storiesList = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Community Stories Management</title>
    <link rel="stylesheet" href="css/Stylesheet.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <?php include 'assets/header.php'; ?>

    <div class="container">
        <h1>Community Stories Management</h1>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#viewStories">View Stories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#addStory">Add Story</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- View Stories Tab -->
            <div id="viewStories" class="tab-pane fade show active">
                <!-- Stories List -->
                <h2>View Stories</h2>
                <?php
                // Pagination variables
                $recordsPerPage = 10;
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($currentPage - 1) * $recordsPerPage;

                // Fetch stories records with pagination
                $sql = "SELECT * FROM community WHERE email = ? LIMIT $offset, $recordsPerPage";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $storiesList = $result->fetch_all(MYSQLI_ASSOC);

                // Fetch total number of stories records
                $totalRecordsSQL = "SELECT COUNT(*) AS total FROM community WHERE email = ?";
                $stmt = $conn->prepare($totalRecordsSQL);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $totalRecordsResult = $stmt->get_result();
                $totalRecords = $totalRecordsResult->fetch_assoc()['total'];

                // Calculate total number of pages
                $totalPages = ceil($totalRecords / $recordsPerPage);
                ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Email</th>
                            <th>File Path</th>
                            <th>Creation Timestamp</th>
                            <th>Creation Date</th>
                            <th>Action</th> <!-- New column for delete action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($storiesList as $story): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($story['id']); ?></td>
                                <td><?php echo htmlspecialchars($story['lastName']); ?></td>
                                <td><?php echo htmlspecialchars($story['title']); ?></td>
                                <td><?php echo htmlspecialchars($story['description']); ?></td>
                                <td><?php echo htmlspecialchars($story['email']); ?></td>
                                <td>
                                    <?php if ($story['file_path']): ?>
                                        <a href="<?php echo htmlspecialchars($story['file_path']); ?>" target="_blank">View File</a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($story['creation_timestamp']); ?></td>
                                <td><?php echo htmlspecialchars($story['creation_date']); ?></td>
                                <td>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <input type="hidden" name="deleteId" value="<?php echo $story['id']; ?>">
                                        <button type="submit" name="deleteStory" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination links -->
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>



            <!-- Add Story Tab -->
            <div id="addStory" class="tab-pane fade">
                <!-- Add Story Form -->
                <h2>Add Story</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description">Description:</label><br>
                        <textarea id="description" name="description" rows="10" cols="50" required class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <button type="submit" name="createStory" class="btn btn-primary">Post Story</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'assets/footer.php'; ?>

    <!-- Include Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
