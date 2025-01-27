<?php
// Include database connection
include("../Connection/dbconnection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $studentId = mysqli_real_escape_string($conn, $_POST["studentId"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);

    try {
        if (!is_numeric($studentId)) {
            // Admin login check when `studentId` is not numeric
            $adminQuery = "SELECT * FROM admins WHERE username = ?";
            $adminStmt = $conn->prepare($adminQuery);
            if (!$adminStmt) {
                throw new Exception("Error preparing admin statement: " . $conn->error);
            }
            $adminStmt->bind_param("s", $studentId);
            $adminStmt->execute();
            $adminResult = $adminStmt->get_result();

            if ($adminResult->num_rows > 0) {
                $adminRow = $adminResult->fetch_assoc();
                $hashedAdminPassword = $adminRow['password']; // Hashed admin password from the `admins` table

                if (password_verify($pass, $hashedAdminPassword)) {
                    session_start();
                    // Set session variables for admin
                    $_SESSION['studentId'] = $adminRow['username'];
                    $_SESSION['studentName'] = $adminRow['username'];
                    $_SESSION['profilePic'] = "./../Login_Page/Images/" . $row['profile_pic'];

                    echo '<script>
                            location.assign("../Admin/AdminDashboard.php");
                        </script>';
                    exit;
                } else {
                    echo '<script>alert("Invalid admin credentials.");</script>';
                    echo '<script>
                            location.assign("LoginForm.php");
                        </script>';
                    exit;
                }
            }
        }

        // Student login check when `studentId` is numeric
        $query = "SELECT * FROM student_data WHERE studentId = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Error preparing student statement: " . $conn->error);
        }
        $stmt->bind_param("s", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password']; // Hashed password from the `student_data` table

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
                exit;
            } else {
                echo '<script>alert("Invalid student credentials.");</script>';
                echo '<script>
                        location.assign("LoginForm.php");
                    </script>';
                exit;
            }
        } else {
            echo '<script>alert("No user found with the provided credentials.");</script>';
            echo '<script>
                    location.assign("LoginForm.php");
                </script>';
            exit;
        }
    } catch (Exception $e) {
        echo '<script>alert("Something went wrong: ' . $e->getMessage() . '");</script>';
        echo '<script>
                location.assign("LoginForm.php");
            </script>';
        exit;
    }
}
?>
