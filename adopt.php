<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'configurations/dbconfig.php';

$message = '';

if (!isset($_POST['pet_id']) || empty($_POST['pet_id'])) {
    header("Location: petsInfo.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    if (empty($_POST['full_name']) || empty($_POST['home_address']) || empty($_POST['postcode']) || empty($_POST['state']) || empty($_POST['phone_number'])) {
        $message = 'Error: Please fill in all required fields.';
    } else {
        // Process form submission
        $pet_id = $_POST['pet_id'];
        $full_name = $_POST['full_name'];
        $home_address = $_POST['home_address'];
        $postcode = $_POST['postcode'];
        $state = $_POST['state'];
        $phone_number = $_POST['phone_number'];
        $submission_date = date('Y-m-d');

        if ($pet_name) {
            // Insert into petsAdoption
            $sql = "INSERT INTO petsAdoption (pet_name, full_name, home_address, postcode, state, phone_number, submission_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $pet_name, $full_name, $home_address, $postcode, $state, $phone_number, $submission_date);

            if ($stmt->execute()) {
                $message = 'Adoption request submitted successfully.';
            } else {
                $message = 'Error: ' . $conn->error;
            }

            $stmt->close();
        } else {
            $message = 'Error: Pet not found.';
        }
    }
    $conn->close();
}

echo '<script>';
if ($message) {
    echo 'alert("' . $message . '");';
}
echo '</script>';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vets for Pets Animal Clinic (VPAC) is a well-established, full service, small animal and exotic veterinary clinic providing comprehensive preventive, medical, surgical and dental care. We provide a broad spectrum of diagnostic procedures through in-house testing and the use of external laboratories. We also work closely with local practices when special diagnostic procedures are required. The facility includes a well-stocked pharmacy, in-house surgery suite, in-house x-ray capabilities, a closely supervised hospitalization area, and indoor boarding kennels with outdoor walking areas. We understand that your pets are a part of your family. Thus, we treat each patient with the same love and gentle handling that we would expect for our own ‘kids’.">
    <meta name="keywords" content="animal clinic, pets clinic, veterinary, vets for pets animal clinic, vpac, VPAC">
    <meta name="author" content="Desmond Lin Wai Kin">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carattere&display=swap" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="container-fluid">
        
        <?php include 'assets/header.php'; ?>

        <div class="container-fluid text-center">
            <h1>Adopt a Pet</h1>
        </div>
        <br>
        <div class="container">
            <form action="adopt.php" method="POST" class="row g-3 needs-validation" novalidate>
                <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($_GET['pet_id']); ?>" />
                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                    <div class="invalid-feedback">
                        Please provide your full name.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="home_address" class="form-label">Home Address</label>
                    <textarea class="form-control" id="home_address" name="home_address" rows="3" required></textarea>
                    <div class="invalid-feedback">
                        Please provide your home address.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" required>
                    <div class="invalid-feedback">
                        Please provide your postcode.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                    <div class="invalid-feedback">
                        Please provide your state.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                    <div class="invalid-feedback">
                        Please provide your phone number.
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit Adoption Request</button>
                </div>
            </form>
        </div>
        <br>
        <?php include 'assets/footer.php'; ?>    
    </div>
</body>

</html>
