<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <header>
        <h1 style="text-align: center; font-size: 2.5em; margin-bottom: 5px;">Student Feedback Form</h1>
    </header>

    <nav style="text-align: center; margin-bottom: 20px;">
        <a href="index.html">Back to Home</a> |
        <a href="view_data.php">Admin Login (View Data)</a>
    </nav>

    <main>
        <h2>Submit Your Details</h2>
        <p>Please fill out the form below. Your information will be securely stored in our database.</p>
        
        <div class="form-container">
            <form action="process.php" method="POST">
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Feedback / Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                
                <button type="submit" name="submit">Submit Information</button>
            </form>
        </div>
    </main>

</body>
</html>