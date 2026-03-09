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
    <title>Admin Panel - Vivian Kepha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Cormorant+Garamond:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="hero" style="padding: 36px 32px;">
        <div class="hero-content">
            <h1 style="font-size: 2rem;">Database Records</h1>
        </div>
    </header>

    <nav class="nav-bar">
        <a href="index.html">Back to Home</a>
        <a href="form.php">Submit Feedback</a>
        <?php if ($logged_in): ?>
            <a href="view_data.php?logout=1">Logout</a>
        <?php endif; ?>
    </nav>

    <main>
        <?php if (!$logged_in): ?>
            <section class="section card">
                <div class="login-form">
                    <h3>Admin Login Required</h3>
                    <p>Please enter the password to view database records.</p>
                    <?php if ($error_msg): ?><p class="error-msg"><?php echo $error_msg; ?></p><?php endif; ?>
                    <form action="view_data.php" method="POST">
                        <input type="password" name="password" placeholder="Enter Password" required>
                        <button type="submit" name="login">Login</button>
                    </form>
                </div>
            </section>
            
        <?php else: ?>
            <section class="section card">
                <h2>Submitted Feedback</h2>
                <div class="table-wrap data-table-wrap">
            
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
                </div>
            </section>
        <?php endif; ?>
    </main>

</body>
</html>