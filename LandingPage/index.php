<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Dashboard</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f6f9;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            color: #34495e;
        }

        .header p {
            font-size: 16px;
            color: #7f8c8d;
        }

        .nav-links {
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-links a {
            margin: 0 15px;
            text-decoration: none;
            color: #3498db;
            font-size: 16px;
        }

        .nav-links a:hover {
            color: #2980b9;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 10px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #7f8c8d;
            line-height: 1.6;
        }

        .card .student-info {
            margin-top: 15px;
            font-size: 12px;
            color: #95a5a6;
        }

        .actions {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            background-color: #3498db;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* New feature cards */
        .feature-card-container {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .feature-card h3 {
            font-size: 22px;
            color: #34495e;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 14px;
            color: #7f8c8d;
            line-height: 1.6;
        }

        .feature-btn {
            background-color: #3498db;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .feature-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Feedback Dashboard</h1>
        <p>Explore feedback from students and improve your university experience.</p>
    </div>

    <!-- Navigation Links -->
    <div class="nav-links">
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    </div>

    <!-- Feature Cards -->
    <div class="feature-card-container">
        <div class="feature-card">
            <h3>Store Previous Questions</h3>
            <p>Access previous exam questions to help you prepare better. A dedicated portal to find and review past questions will be available soon.</p>
            <a href="previous_questions.php" class="feature-btn">Explore Previous Questions</a>
        </div>

        <div class="feature-card">
            <h3>Contribute Feedback</h3>
            <p>Help us improve by submitting your feedback about university services and campus life. Your opinion matters!</p>
            <a href="FeedbackForm.php" class="feature-btn">Submit Feedback</a>
        </div>

        <div class="feature-card">
            <h3>Vote for Club President</h3>
            <p>Participate in the democratic process of electing your next club president. Vote for your favorite candidate and make a difference.</p>
            <a href="club_vote.php" class="feature-btn">Vote Now</a>
        </div>
    </div>

    <!-- Card Section (Dynamic Content from Database) -->
    <div class="card-container">
        <?php
        // Assuming you're using PHP and MySQL to fetch data from the database
        // Replace with your database connection details
        $conn = new mysqli('localhost', 'root', '', 'MyProject');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT topic, studentId, description FROM feedbacks";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>Topic: " . $row['topic'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<div class='student-info'>Submitted by: " . $row['studentId'] . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No feedback available.</p>";
        }

        $conn->close();
        ?>
    </div>

  
</body>

</html>
