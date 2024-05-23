<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php
include 'configurations/dbconfig.php';

$message = '';

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Function to upload a file
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

// Function to create a news record
function createNews($conn, $topic, $description, $file_path) {
    $creationTimestamp = date('Y-m-d H:i:s');
    $creationDate = date('Y-m-d');
    $sql = "INSERT INTO news (topic, description, creation_timestamp, creation_date, last_maintenance_timestamp, last_maintenance_date, file_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $topic, $description, $creationTimestamp, $creationDate, $creationTimestamp, $creationDate, $file_path);

    if ($stmt->execute()) {
        return "News created successfully!";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to update a news record
function updateNews($conn, $id, $topic, $description, $file_path = null) {
    $lastMaintenanceTimestamp = date('Y-m-d H:i:s');
    $lastMaintenanceDate = date('Y-m-d');
    
    if ($file_path) {
        $sql = "UPDATE news SET topic = ?, description = ?, last_maintenance_timestamp = ?, last_maintenance_date = ?, file_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $topic, $description, $lastMaintenanceTimestamp, $lastMaintenanceDate, $file_path, $id);
    } else {
        $sql = "UPDATE news SET topic = ?, description = ?, last_maintenance_timestamp = ?, last_maintenance_date = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $topic, $description, $lastMaintenanceTimestamp, $lastMaintenanceDate, $id);
    }

    if ($stmt->execute()) {
        return "News updated successfully!";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to delete a news record
function deleteNews($conn, $id) {
    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return "News deleted successfully!";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createNews'])) {
        if (isset($_FILES["file"])) {
            $uploadResult = uploadFile($_FILES["file"]);
            if ($uploadResult["status"] == 1) {
                $message = createNews($conn, $_POST['topic'], $_POST['description'], $uploadResult["file_path"]);
            } else {
                $message = $uploadResult["message"];
            }
        } else {
            $message = "No file uploaded.";
        }
    } elseif (isset($_POST['updateNews'])) {
        if (!empty($_FILES["file"]["name"])) {
            $uploadResult = uploadFile($_FILES["file"]);
            if ($uploadResult["status"] == 1) {
                $message = updateNews($conn, $_POST['id'], $_POST['topic'], $_POST['description'], $uploadResult["file_path"]);
            } else {
                $message = $uploadResult["message"];
            }
        } else {
            $message = updateNews($conn, $_POST['id'], $_POST['topic'], $_POST['description']);
        }
    } elseif (isset($_POST['deleteNews'])) {
        $message = deleteNews($conn, $_POST['id']);
    }
}

// Fetch all news records
$sql = "SELECT * FROM news";
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
    <title>Admin News Management</title>
    <link rel="stylesheet" href="css/Stylesheet.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
    <?php include 'assets/adminHeader.php'; ?>

    <div class="container">
        <h1>Admin News Management</h1>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewNews">View News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#addNews">Add News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#updateNews">Update News</a>
            </li>
            
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Add News Tab -->
            <div id="addNews" class="tab-pane fade show active">
                <!-- Add News Form -->
                <h2>Add News</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="topic" class="form-label">Topic</label>
                        <input type="text" class="form-control" id="topic" name="topic" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" name="createNews" class="btn btn-primary">Create News</button>
                </form>
            </div>


           <!-- Update News Tab -->
        <div id="updateNews" class="tab-pane fade">
            <!-- Update News Form -->
            <h2><?php echo isset($isEdit) ? 'Edit News' : 'Update News'; ?></h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" class="form-control" id="id" name="id" required value="<?php echo isset($editId) ? $editId : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="topic" class="form-label">Topic</label>
                    <input type="text" class="form-control" id="topic" name="topic" required value="<?php echo isset($editTopic) ? $editTopic : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo isset($editDescription) ? $editDescription : ''; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="file" name="file">
                    <?php if (isset($editFilePath)): ?>
                        <p>Current File: <a href="<?php echo htmlspecialchars($editFilePath); ?>" target="_blank"><?php echo htmlspecialchars(basename($editFilePath)); ?></a></p>
                    <?php endif; ?>
                </div>
                <button type="submit" name="updateNews" class="btn btn-primary">Update News</button>
            </form>
        </div>


            <!-- View News Tab -->
            <div id="viewNews" class="tab-pane fade">
                <!-- News List -->
                <h2>View News</h2>
                <!-- Your View News Content Here -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Topic</th>
                            <th>Description</th>
                            <th>Creation Timestamp</th>
                            <th>Creation Date</th>
                            <th>Last Maintenance Timestamp</th>
                            <th>Last Maintenance Date</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($newsList as $news): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($news['id']); ?></td>
                                <td><?php echo htmlspecialchars($news['topic']); ?></td>
                                <td><?php echo htmlspecialchars($news['description']); ?></td>
                                <td><?php echo htmlspecialchars($news['creation_timestamp']); ?></td>
                                <td><?php echo htmlspecialchars($news['creation_date']); ?></td>
                                <td><?php echo htmlspecialchars($news['last_maintenance_timestamp']); ?></td>
                                <td><?php echo htmlspecialchars($news['last_maintenance_date']); ?></td>
                                <td>
                                    <?php if ($news['file_path']): ?>
                                        <a href="<?php echo htmlspecialchars($news['file_path']); ?>" target="_blank">View File</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
                                        <button type="submit" name="deleteNews" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
