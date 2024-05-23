<?php
session_start();

// Check if the user is logged in with the 'users' role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'users') {
    // Redirect to login.php if not logged in with the 'users' role
    header("Location: login.php");
    exit();
}

// Include database configuration
include 'configurations/dbconfig.php';

// Define variables and initialize with empty values
$full_name = $phone_number = $userMessage = '';
$file_path = null;
$responseMessage = ''; // This variable will store the feedback message for the user

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseMessage = createDonation($conn, $_POST, $_SESSION);
}

// Close database connection
$conn->close();

// Function to handle file upload
function uploadFile($file) {
    if (isset($file['name']) && !empty($file['name'])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

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

// Function to insert donation records into the database
function createDonation($conn, $postData, $sessionData) {
    $file_path = null;
    $userMessage = trim($postData['message']); // This is the message from the form

    // Validate input
    $full_name = trim($postData['full_name']);
    $phone_number = trim($postData['phone_number']);
    $email = isset($sessionData['email']) ? $sessionData['email'] : '';

    // File upload handling
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadFile($_FILES['file_upload']);
        if ($uploadResult['status'] === 1) {
            $file_path = $uploadResult['file_path'];
        } else {
            return $uploadResult['message']; // Feedback if file upload fails
        }
    }

    // Prepare and bind the SQL statement
    $sql = "INSERT INTO donation (Full_name, email, phone_number, message, file_path) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $full_name, $email, $phone_number, $userMessage, $file_path);

    // Execute the statement
    if ($stmt->execute()) {
        return 'Donation submitted successfully.';
    } else {
        return 'Error: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation</title>
    <link rel="stylesheet" href="css/Stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            width: 50%;
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
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" id="donationForm">
                <div class="container-fluid">
                    <h1 style="text-align: center;">Donation</h1>
                </div>

                <!-- Display the response message here -->
                <?php if (!empty($responseMessage)) echo "<p>$responseMessage</p>"; ?>

                <label for="full_name">Full Name:</label><br>
                <input type="text" id="full_name" name="full_name" required value="<?php echo htmlspecialchars($full_name); ?>"><br><br>

                <label for="phone_number">Phone Number:</label><br>
                <input type="tel" id="phone_number" name="phone_number" required value="<?php echo htmlspecialchars($phone_number); ?>"><br><br>

                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="4" required><?php echo htmlspecialchars($userMessage); ?></textarea><br><br>

                <label for="file_upload">File Upload:</label><br>
                <input type="file" id="file_upload" name="file_upload"><br><br>

                <button type="submit" name="createDonation" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <br>

        <?php include 'assets/footer.php'; ?>
    </div>
</body>
</html>