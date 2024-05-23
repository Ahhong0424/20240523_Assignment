<?php
session_start();
include 'configurations/dbconfig.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Function to register a new user
    function register($conn, $firstName, $lastName, $email, $password, $confirm_password) {
        if ($password !== $confirm_password) {
            return "Passwords do not match!";
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user'; // Default role

        // SQL query to insert user data
        $sql = "INSERT INTO users (firstName, lastName, email, password, role) VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $password_hash, $role);

        if ($stmt->execute()) {
            return "Registration successful!";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Function to login a user
    function login($conn, $email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($password == $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_last_name'] = $user['lastName'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];
                if ($user['role'] == 'admin') {
                    header("Location: adminIndex.php");
                    exit;
                } else {
                    header("Location: index.php");
                    exit;
                }
            } else {
                return "Incorrect password!";
            }
        } else {
            return "No user found with that email address!";
        }
    }

    // Function to reset password
    function reset_password($conn, $email, $new_password, $confirm_new_password) {
        if ($new_password !== $confirm_new_password) {
            return "Passwords do not match!";
        }

        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE email = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $password_hash, $email);

        if ($stmt->execute()) {
            return "Password reset successful!";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Check which form was submitted
    if (isset($_POST['register'])) {
        $message = register($conn, $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    } elseif (isset($_POST['login'])) {
        $message = login($conn, $_POST['email'], $_POST['password']);
    } elseif (isset($_POST['reset_password'])) {
        $message = reset_password($conn, $_POST['email'], $_POST['new_password'], $_POST['confirm_new_password']);
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Authentication</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div>
            <div class="tabs" onclick="showTab('login-tab')">Login</div>
            <div class="tabs" onclick="showTab('signup-tab')">Sign Up</div>
            <div class="tabs" onclick="showTab('reset-tab')">Reset Password</div>
        </div>

        <div id="login-tab" class="tab-content active">
            <h2>Login</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <div id="signup-tab" class="tab-content">
            <h2>Sign Up</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="firstName" placeholder="First Name" required><br>
                <input type="text" name="lastName" placeholder="Last Name" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>

        <div id="reset-tab" class="tab-content">
            <h2>Reset Password</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="new_password" placeholder="New Password" required><br>
                <input type="password" name="confirm_new_password" placeholder="Confirm New Password" required><br>
                <button type="submit" name="reset_password">Reset Password</button>
            </form>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tabs
            var tabs = document.getElementsByClassName('tab-content');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }

            // Remove active class from tab buttons
            var tabButtons = document.getElementsByClassName('tabs');
            for (var i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove('active');
            }

            // Show the clicked tab
            document.getElementById(tabId).classList.add('active');

            // Add active class to clicked tab button
            event.currentTarget.classList.add('active');
        }

        // Set default tab
        document.addEventListener('DOMContentLoaded', function() {
            showTab('login-tab');
        });
    </script>

    <script>
        // Function to show message
        function showMessage(message) {
            alert(message);
        }

        // Check if form is submitted and show message
        <?php if (isset($message)) { ?>
            showMessage("<?php echo $message; ?>");
        <?php } ?>
    </script>
</body>
</html>
