<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <style>
      
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap");
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F5EFE7;
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 800px;
            height: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-color: #3E5879;
            animation: slideIn 1s ease-out;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #516B85, #3E5879);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #F5EFE7;
            text-align: center;
        }

        .left-panel h1 {
            color: white;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .left-panel p {
            font-size: 1rem;
            line-height: 1.6;
        }

        .left-panel img {
            width: 250px;
            height: 250px;
            max-width: 100%;
    
        }

        .right-panel {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: white;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            color:#333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color:#333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #3E5879;
            border-radius: 5px;
            font-size: 1rem;
          
            color:black;
        }

        input:focus {
            outline: none;
            border-color: #3E5879;
            
        }

        button {
            width: 50%;
            padding: 12px;
            background-color:  #2c3e50;
            color: #F5EFE7;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #516B85;
            transform: scale(1.05);
        }

        p {
            text-align: center;
            font-size: 0.9rem;
            color: black;
        }

        p a {
            color:black;
            text-decoration: none;
            font-weight: 500;
        }

        p a:hover {
            text-decoration: underline;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="left-panel fade-in">
            <h1>Welcome Back!</h1>
            <p>Enter your credentials to access your account and explore our features.</p>
            <img  class="lpimg" src="lpimage.svg" alt="Illustration">
        </div>
        <div class="right-panel">
            <form action="LoginProcess.php" method="POST">
                <h1>Login</h1>
                <label for="studentId">Student ID</label>
                <input type="text" name="studentId" id="studentId" placeholder="Enter Student ID or username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>

                <button type="submit" name="submit">Login</button>

                <p>Don't have an account? <a href="Registar.php">Register now</a></p>
                <p>Forgot your password? <a href="Forgot.php">Reset it</a></p>
            </form>
        </div>
    </div>

</body>

</html>
