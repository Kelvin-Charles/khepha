<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form - Vivian Kepha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Cormorant+Garamond:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="hero" style="padding: 36px 32px;">
        <div class="hero-content">
            <h1 style="font-size: 2.2rem;">Student Feedback Form</h1>
        </div>
    </header>

    <nav class="nav-bar">
        <a href="index.html">Back to Home</a>
        <a href="view_data.php">Admin Login (View Data)</a>
    </nav>

    <main>
        <section class="section card">
            <h2>Submit Your Details</h2>
            <p>Please fill out the form below. Your information will be securely stored in our database.</p>
            
            <div class="form-container">
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" required placeholder="Your full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required placeholder="you@example.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Feedback / Message</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Share your feedback..."></textarea>
                    </div>
                    
                    <button type="submit" name="submit">Submit Information</button>
                </form>
            </div>
        </section>
    </main>

</body>
</html>