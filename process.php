<?php
// Database configuration
$host = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "root"; 
$password = getenv('DB_PASSWORD') ?: ""; 
$database = getenv('DB_NAME') ?: "oit237_db";

// Connect to database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Sanitize input data
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // SQL query to insert data
    $sql = "INSERT INTO feedback (full_name, email, message) VALUES ('$full_name', '$email', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        $status_msg = "Success: Information has been stored successfully!";
        $status_color = "green";
    } else {
        $status_msg = "Error: " . $sql . "<br>" . $conn->error;
        $status_color = "red";
    }
} else {
    header("Location: form.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Result - Vivian Khepha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Cormorant+Garamond:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="hero" style="padding: 36px 32px;">
        <div class="hero-content">
            <h1 style="font-size: 2rem;">Submission Result</h1>
        </div>
    </header>
    
    <nav class="nav-bar">
        <a href="index.html">Back to Home</a>
        <a href="form.php">Submit Another</a>
        <a href="view_data.php">View Data</a>
    </nav>
    
    <main>
        <section class="section card" style="text-align: center;">
            <h2 style="color: <?php echo $status_color; ?>; border: none; margin: 0;"><?php echo $status_msg; ?></h2>
        </section>
    </main>
</body>
</html>