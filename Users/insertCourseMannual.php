<?php
// Database connection settings
$host = 'localhost'; // Replace with your database host
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'MyProject'; // Replace with your database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Array of courses
$courses = [
    ['name' => 'English – I', 'code' => 'ENG 1011'],
    ['name' => 'History of the Emergence of Bangladesh', 'code' => 'BDS 1201'],
    ['name' => 'Introduction to Computer Systems', 'code' => 'CSE 1110'],
    ['name' => 'Discrete Mathematics', 'code' => 'CSE 2213'],
    ['name' => 'English – II', 'code' => 'ENG 1013'],
    ['name' => 'Structured Programming Language', 'code' => 'CSE 1111'],
    ['name' => 'Structured Programming Language Laboratory', 'code' => 'CSE 1112'],
    ['name' => 'Fundamental Calculus', 'code' => 'MATH 1151'],
    ['name' => 'Calculus and Linear Algebra', 'code' => 'MATH 2183'],
    ['name' => 'Digital Logic Design', 'code' => 'CSE 1325'],
    ['name' => 'Digital Logic Design Laboratory', 'code' => 'CSE 1326'],
    ['name' => 'Object Oriented Programming', 'code' => 'CSE 1115'],
    ['name' => 'Object Oriented Programming Laboratory', 'code' => 'CSE 1116'],
    ['name' => 'Coordinate Geometry and Vector Analysis', 'code' => 'MATH 2201'],
    ['name' => 'Physics', 'code' => 'PHY 2105'],
    ['name' => 'Physics Laboratory', 'code' => 'PHY 2106'],
    ['name' => 'Advanced Object Oriented Programming laboratory', 'code' => 'CSE 2118'],
    ['name' => 'Electrical Circuits', 'code' => 'EEE 2113'],
    ['name' => 'Probability and Statistics', 'code' => 'MATH 2205'],
    ['name' => 'Society, Environment and Engineering Ethics', 'code' => 'SOC 2101'],
    ['name' => 'Data Structure and Algorithms – I', 'code' => 'CSE 2215'],
    ['name' => 'Data Structure and Algorithms – I Laboratory', 'code' => 'CSE 2216'],
    ['name' => 'Theory of Computation', 'code' => 'CSE 2233']
];

// Insert courses into the database
foreach ($courses as $course) {
    $name = $conn->real_escape_string($course['name']);
    $code = $conn->real_escape_string($course['code']);

    $sql = "INSERT INTO course_table (CourseCode ,course_name) VALUES ('$code', '$name')";

    if ($conn->query($sql) === TRUE) {
        echo "Course '$name' inserted successfully.<br>";
    } else {
        echo "Error inserting course '$name': " . $conn->error . "<br>";
    }
}

// Close the database connection
$conn->close();
?>
