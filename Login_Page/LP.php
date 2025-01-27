<?php
// Include database connection
include("../Connection/dbconnection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $studentId = mysqli_real_escape_string($conn, $_POST["studentId"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);

    try {
        // Admin login: Check if the user input has 5 digits and validate with the admin table
        if (strlen($studentId) == 5 && ctype_digit($studentId)) {
            // Prepare query to check admin credentials
            $query = "SELECT * FROM admin_data WHERE adminId = ?";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("s", $studentId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password']; // Hashed password from the admin_data table

                if (password_verify($pass, $hashedPassword)) {
                    session_start();
                    $_SESSION['adminId'] = $studentId;
                    $_SESSION['adminName'] = $row['name'];
                    $_SESSION['adminEmail'] = $row['email'];
                    $_SESSION['adminProfilePic'] = "../Login_Page/Images/" . $row['profile_pic'];

                    // Redirect to Admin Dashboard
                    echo '<script>
                            location.assign("../Admin/AdminDashboard.php");
                        </script>';
                } else {
                    echo '<script>alert("Invalid admin credentials.");</script>';
                    echo '<script>
                            location.assign("LoginForm.php");
                        </script>';
                }
            } else {
                echo '<script>alert("No admin found with this ID.");</script>';
                echo '<script>
                        location.assign("LoginForm.php");
                    </script>';
            }
        }

        // Prepared statement to check student credentials
        else {
            $query = "SELECT * FROM student_data WHERE studentId = ?";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("s", $studentId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password']; // Hashed password from the student_data table

                if (password_verify($pass, $hashedPassword)) {
                    session_start();
                    // Set session variables for student
                    $_SESSION['studentName'] = $row['name'];
                    $_SESSION['studentId'] = $studentId;
                    $_SESSION['StEmail'] = $row['email'];
                    $_SESSION['StDept'] = $row['dept'];
                    $_SESSION['profilePic'] = "../Login_Page/Images/" . $row['profile_pic'];

                    // Update user status to "Active now"
                    $updateQuery = "UPDATE student_data SET status = 'Active now' WHERE studentId = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    if (!$updateStmt) {
                        throw new Exception("Error preparing update statement: " . $conn->error);
                    }
                    $updateStmt->bind_param("s", $studentId);
                    $updateStmt->execute();

                    echo '<script>
                            location.assign("../Users/StudentDashboard.php");
                        </script>';
                } else {
                    echo '<script>alert("Please login with valid info.");</script>';
                    echo '<script>
                            location.assign("LoginForm.php");
                        </script>';
                }
            } else {
                echo '<script>alert("Something went wrong. Try again.");</script>';
                echo '<script>
                    location.assign("LoginForm.php");
                </script>';
            }
        }
    } catch (Exception $e) {
        echo '<script>
        location.assign("LoginForm.php");
    </script>';
    }
}
?>
