<?php
session_start();

$host = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASSWORD') ?: "";
$database = getenv('DB_NAME') ?: "oit237_db";

// Hardcoded admin password for the sake of the assignment
$admin_password = "admin";

$logged_in = false;
$error_msg = "";

if (isset($_POST['login'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['logged_in'] = true;
    } else {
        $error_msg = "Incorrect password!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: view_data.php");
    exit();
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $logged_in = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Information (Admin Panel)</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
        }
        .login-form input[type="password"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-form button {
            padding: 10px 20px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <header>
        <h1 style="text-align: center;">Database Records</h1>
    </header>

    <nav style="text-align: center; margin-bottom: 20px;">
        <a href="index.html">Back to Home</a> |
        <a href="form.php">Submit Feedback Form</a>
        <?php if ($logged_in): ?>
            | <a href="view_data.php?logout=1">Logout</a>
        <?php endif; ?>
    </nav>

    <main>
        <?php if (!$logged_in): ?>
            <!-- Login Form to access data -->
            <div class="login-form">
                <h3>Admin Login Required</h3>
                <p>Please enter the password to view database records.</p>
                <p style="color: red;"><?php echo $error_msg; ?></p>
                <form action="view_data.php" method="POST">
                    <input type="password" name="password" placeholder="Enter Password" required>
                    <br>
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
            
        <?php else: ?>
            <!-- Display Data -->
            <h2>Submitted Feedback</h2>
            
            <?php
            // Connect to database
            $conn = new mysqli($host, $username, $password, $database);
            
            if ($conn->connect_error) {
                echo "<p style='color:red;'>Database connection failed: " . $conn->connect_error . "</p>";
            } else {
                $sql = "SELECT id, full_name, email, message, created_at FROM feedback ORDER BY id DESC";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    echo "<table>";
                    echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date Submitted</th></tr></thead>";
                    echo "<tbody>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["full_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p>No records found in the database.</p>";
                }
                $conn->close();
            }
            ?>
        <?php endif; ?>
    </main>

</body>
</html>