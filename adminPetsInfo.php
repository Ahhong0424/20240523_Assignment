<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'configurations/dbconfig.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

function uploadFile($file, $updateMode = false, $currentFilePath = null) {
    if (isset($file['name']) && !empty($file['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // If in update mode and the file path has changed
        if ($updateMode && $targetFile !== $currentFilePath && file_exists($targetFile)) {
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


function createPet($conn, $pet_category, $pet_name, $pet_title, $pet_description, $file_path) {
    $creationTimestamp = date('Y-m-d H:i:s');
    $creationDate = date('Y-m-d');
    $sql = "INSERT INTO petsinfo (pet_category, pet_name, pet_title, pet_description, file_path, creation_timestamp, creation_date, last_maintenance_timestamp, last_maintenance_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $pet_category, $pet_name, $pet_title, $pet_description, $file_path, $creationTimestamp, $creationDate, $creationTimestamp, $creationDate);

    if ($stmt->execute()) {
        return "Pet information created successfully!";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

function updatePet($conn, $id, $pet_category, $pet_name, $pet_title, $pet_description, $file_path = null) {
    $lastMaintenanceTimestamp = date('Y-m-d H:i:s');
    $lastMaintenanceDate = date('Y-m-d');
    
    if ($file_path) {
        $sql = "UPDATE petsinfo SET pet_category = ?, pet_name = ?, pet_title = ?, pet_description = ?, file_path = ?, last_maintenance_timestamp = ?, last_maintenance_date = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $pet_category, $pet_name, $pet_title, $pet_description, $file_path, $lastMaintenanceTimestamp, $lastMaintenanceDate, $id);
    } else {
        $sql = "UPDATE petsinfo SET pet_category = ?, pet_name = ?, pet_title = ?, pet_description = ?, last_maintenance_timestamp = ?, last_maintenance_date = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $pet_category, $pet_name, $pet_title, $pet_description, $lastMaintenanceTimestamp, $lastMaintenanceDate, $id);
    }

    if ($stmt->execute()) {
        return "Pet information updated successfully!";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deletePet($conn, $id) {
    // Fetch file path associated with the pet ID
    $sqlFilePath = "SELECT image_path FROM petsinfo WHERE id = ?";
    $stmtFilePath = $conn->prepare($sqlFilePath);
    $stmtFilePath->bind_param("i", $id);
    $stmtFilePath->execute();
    $stmtFilePath->bind_result($filePath);
    $stmtFilePath->fetch();
    $stmtFilePath->close();

    // Delete the record from the database
    $sqlDelete = "DELETE FROM petsinfo WHERE id = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $id);
    $stmtDelete->execute();
    $stmtDelete->close();

    // If the file path exists, delete the file from the server
    if ($filePath && file_exists($filePath)) {
        unlink($filePath);
    }

    return "Pet information deleted successfully!";
}


$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createPet'])) {
        if (isset($_FILES["file"])) {
            $uploadResult = uploadFile($_FILES["file"]);
            if ($uploadResult["status"] == 1) {
                $message = createPet($conn, $_POST['pet_category'], $_POST['pet_name'], $_POST['pet_title'], $_POST['pet_description'], $uploadResult["file_path"]);
            } else {
                $message = $uploadResult["message"];
            }
        } else {
            $message = "No file uploaded.";
        }
    } elseif (isset($_POST['updatePet'])) {
        if (!empty($_FILES["file"]["name"])) {
            $uploadResult = uploadFile($_FILES["file"]);
            if ($uploadResult["status"] == 1) {
                $message = updatePet($conn, $_POST['id'], $_POST['pet_category'], $_POST['pet_name'], $_POST['pet_title'], $_POST['pet_description'], $uploadResult["file_path"]);
            } else {
                $message = $uploadResult["message"];
            }
        } else {
            $message = updatePet($conn, $_POST['id'], $_POST['pet_category'], $_POST['pet_name'], $_POST['pet_title'], $_POST['pet_description']);
        }
    } elseif (isset($_POST['deletePet'])) {
        $message = deletePet($conn, $_POST['id']);
    }
}

// Pagination logic
$results_per_page = 10;

$sql = "SELECT COUNT(*) AS count FROM petsinfo";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$number_of_results = $row['count'];

$number_of_pages = ceil($number_of_results / $results_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$this_page_first_result = ($page - 1) * $results_per_page;

$sql = "SELECT * FROM petsinfo LIMIT $this_page_first_result, $results_per_page";
$result = $conn->query($sql);
$petsList = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Pets Information Management</title>
    <link rel="stylesheet" href="css/Stylesheet.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <?php include 'assets/adminHeader.php'; ?>

    <div class="container">
        <h1>Admin Pets Information Management</h1>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#viewPets">View Pets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#addPet">Add Pet</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#updatePet">Update Pet</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- View Pets Tab -->
            <div id="viewPets" class="tab-pane fade show active">
                <!-- Pets List -->
                <h2>View Pets</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pet Category</th>
                            <th>Pet Name</th>
                            <th>Pet Title</th>
                            <th>Pet Description</th>
                            <th>File Path</th>
                            <th>Creation Timestamp</th>
                            <th>Creation Date</th>
                            <th>Last Maintenance Timestamp</th>
                            <th>Last Maintenance Date</th>
                            <th>Action</th> <!-- New column for action buttons -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($petsList as $pet): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pet['id']); ?></td>
                                <!-- Include other fields accordingly -->
                                <td><?php echo htmlspecialchars($pet['pet_category']); ?></td>
                                <td><?php echo htmlspecialchars($pet['pet_name']); ?></td>
                                <td><?php echo htmlspecialchars($pet['pet_title']); ?></td>
                                <td><?php echo htmlspecialchars($pet['pet_description']); ?></td>
                                <td>
                                    <?php if ($pet['file_path']): ?>
                                        <a href="<?php echo htmlspecialchars($pet['file_path']); ?>" target="_blank">View File</a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($pet['creation_timestamp']); ?></td>
                                <td><?php echo htmlspecialchars($pet['creation_date']); ?></td>
                                <td><?php echo htmlspecialchars($pet['last_maintenance_timestamp']); ?></td>
                                <td><?php echo htmlspecialchars($pet['last_maintenance_date']); ?></td>
                                <td>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <input type="hidden" name="id" value="<?php echo $pet['id']; ?>">
                                        <button type="submit" name="deletePet" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
    
                <!-- Pagination Links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php for ($page = 1; $page <= $number_of_pages; $page++): ?>
                            <li class="page-item <?php echo ($page == $currentPage) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>


            <!-- Add Pet Tab -->
            <div id="addPet" class="tab-pane fade">
                <!-- Add Pet Form -->
                <h2>Add Pet</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label for="pet_category">Pet Category:</label>
                        <select id="pet_category" name="pet_category">
                            <option value="cat">Cat</option>
                            <option value="dog">Dog</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pet_name">Pet Name:</label>
                        <input type="text" id="pet_name" name="pet_name">
                    </div>

                    <div class="mb-3">
                        <label for="pet_title">Pet Title:</label>
                        <input type="text" id="pet_title" name="pet_title">
                    </div>

                    <div class="mb-3">
                        <label for="pet_description">Pet Description:</label><br>
                        <textarea id="pet_description" name="pet_description" rows="10" cols="50"></textarea>
                    </div>
    
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
    
                    <button type="submit" name="createPet" class="btn btn-primary">Create Pet</button>
                </form>

            </div>

            <!-- Update Pet Tab -->
            <div id="updatePet" class="tab-pane fade">
                <!-- Update Pet Form -->
                <h2>Update Pet</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                        <label for="id">ID：</label>
                        <input type="number" id="id" name="id" required >
                    </div>
                
                    <div class="mb-3">
                        <label for="pet_category">Pet Category:</label>
                        <select id="pet_category" name="pet_category">
                            <option value="cat">Cat</option>
                            <option value="dog">Dog</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pet_name">Pet Name:</label>
                        <input type="text" id="pet_name" name="pet_name">
                    </div>

                    <div class="mb-3">
                        <label for="pet_title">Pet Title:</label>
                        <input type="text" id="pet_title" name="pet_title">
                    </div>

                    <div class="mb-3">
                        <label for="pet_description">Pet Description:</label><br>
                        <textarea id="pet_description" name="pet_description" rows="10" cols="50"></textarea>
                    </div>
    
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" name="updatePet" class="btn btn-primary">Update Pet</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
