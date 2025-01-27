<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
            width: 600px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color: #3E5879;
            animation: slideIn 1s ease-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #F5EFE7;
        }

        form {
            width: 100%;
            margin: 0 auto;
            background-color: transparent;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #F5EFE7;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #3E5879;
            border-radius: 5px;
            font-size: 0.9rem;
            background-color: #F5EFE7;
            color: #516B85;
        }

        input:focus {
            outline: none;
            border-color: #3E5879;
            box-shadow: 0 0 5px rgba(62, 88, 121, 0.5);
        }

        button {
            width: 50%;
            padding: 10px;
            background-color:aquamarine;
            color: #333;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #516B85;
            transform: scale(1.05);
        }

        .file-upload {
            display: flex;
            
            gap: 10px;
            align-items: center;
        }

        .image-preview {
            display: block;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            background-color: #F5EFE7;
            border: 1px solid #3E5879;
        }

        p {
            text-align: center;
            font-size: 0.9rem;
            color: #F5EFE7;
        }

        p a {
            color: #F5EFE7;
            text-decoration: none;
            font-weight: 500;
        }

        p a:hover {
            text-decoration: underline;
        }

        @keyframes slideIn {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="RegisterProcess.php" method="POST" enctype="multipart/form-data">
            <h2>Register</h2>

            <div class="form-group">
                <div>
                    <label for="studentId">Student ID</label>
                    <input type="text" name="studentId" id="studentId" placeholder="Enter your Student ID" required>
                </div>
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" required>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div>
                    <label for="dept">Department</label>
                    <input type="text" name="dept" id="dept" placeholder="Enter your department" required>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label for="nickname">Nickname</label>
                    <input type="text" name="nickname" id="nickname" placeholder="Enter your nickname" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="file-upload">
                <label for="picture">Profile picture</label>
                <input type="file" name="picture" id="picture" accept="image/*" onchange="previewImage(event)" required>
                <img id="imagePreview" class="image-preview" alt="Profile Preview">
            </div>

            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a href="LoginForm.php">Log in</a></p>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            const preview = document.getElementById('imagePreview');

            reader.onload = function() {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
