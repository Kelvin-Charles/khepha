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
    <title>Processing Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1 style="text-align: center;">Submission Result</h1>
    </header>
    
    <nav style="text-align: center; margin-bottom: 20px;">
        <a href="index.html">Back to Home</a> |
        <a href="form.php">Submit Another Feedback</a> |
        <a href="view_data.php">View Data</a>
    </nav>
    
    <main style="text-align: center;">
        <h2 style="color: <?php echo $status_color; ?>;"><?php echo $status_msg; ?></h2>
    </main>
</body>
</html>