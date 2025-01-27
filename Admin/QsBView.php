<?php
session_start();
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentId'])
) {
    $studentId = $_SESSION['studentId'];
    $stname = $_SESSION['studentName'];
} else {
?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
}

include_once "../Header/AdminHeader.php";

include("../Connection/dbconnection.php");
// Fetch courses from the database
$query = "SELECT * FROM course_table ORDER BY id ASC"; // Assuming 'course' is the name of the table
$result = mysqli_query($conn, $query);
$courses = [];

while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = [
        'name' => $row['course_name'], // Assuming the column for the course name is 'courseName'
        'code' => $row['CourseCode'], // Assuming the column for the course code is 'courseCode'
    ];
}

// Convert courses array to JSON format for use in JavaScript
$coursesJson = json_encode($courses);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courses Dashboard</title>
  <link rel="stylesheet" href="../Css/QsD.css">
 
</head>

<body>

  <header class="header">
    <div class="centered-content">
      <div class="banner">Course Resources: Previous Questions, Solutions, and Notes</div>
      <div class="subtitle">Please select the course of interest</div>
    </div>
    <div class="search-bar-container">
      <input type="text" id="search-bar" class="search-bar" placeholder="Search by course name, code, or keyword" oninput="filterCourses()">
      <button class="clear-btn" onclick="clearSearch()">x</button>
    </div>
  </header>

  <main class="dashboard" id="dashboard"></main>

  <script>
    // Parse the courses JSON data into a JavaScript object
    const courses = <?php echo $coursesJson; ?>;

    const colors = [
      '#7AB2B2', '#4D869C', '#7AB2D3', '#4A628A', '#9fa8da', '#90caf9', '#9fa8da', '#90caf9', '#b39ddb', '#80cbc4', '#81c784',
      '#c5e1a5', '#ffcc80', '#ffe082', '#f8bbd0', '#f48fb1',
      '#a5d6a7', '#c8e6c9', '#d1c4e9', '#b3e5fc', '#ffeb3b',
      '#ffc107', '#ff9800', '#ff5722', '#81c784', '#f44336',
      '#ce93d8', '#9575cd', '#b2dfdb', '#90a4ae', '#e1bee7',
      '#ff4081', '#64b5f6', '#a2dff7', '#f3e5f5', '#e1f5fe'
    ];

    function capitalizeSentences(text) {
      return text.replace(/(?:^|\.\s*)([a-z])/g, (match, p1) => p1.toUpperCase());
    }

    function getCourseInitials(courseName) {
      return courseName.split(' ').map(word => word.charAt(0).toLowerCase()).join('');
    }

    function generateCards(filteredCourses = courses) {
      const dashboard = document.getElementById('dashboard');
      dashboard.innerHTML = '';

      filteredCourses.forEach((course, index) => {
        const cardContainer = document.createElement('div');
        cardContainer.classList.add('card');
        cardContainer.style.backgroundColor = colors[index % colors.length];
        cardContainer.style.transition = 'all 0.3s ease';

        cardContainer.addEventListener('mouseover', () => {
          cardContainer.style.backgroundColor = shadeColor(colors[index % colors.length], -10);
        });
        cardContainer.addEventListener('mouseout', () => {
          cardContainer.style.backgroundColor = colors[index % colors.length];
        });

        const cardTitle = document.createElement('div');
        cardTitle.classList.add('card-title');
        cardTitle.textContent = capitalizeSentences(course.name);

        const courseCode = document.createElement('div');
        courseCode.classList.add('course-code');
        courseCode.textContent = `Course Code: ${course.code}`;

        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('button-container');

        const form1 = document.createElement('form');
        form1.action = 'cc.php';
        form1.method = 'GET';
        form1.innerHTML = `
          <input type="hidden" name="courseCode" value="${course.code}">
          <input type="hidden" name="courseName" value="${course.name}">
          <input type="hidden" name="cardColor" value="${colors[index % colors.length]}">
          <button class="btn" type="submit">Access Question</button>
        `;

        buttonContainer.appendChild(form1);

        cardContainer.appendChild(cardTitle);
        cardContainer.appendChild(courseCode);
        cardContainer.appendChild(buttonContainer);

        dashboard.appendChild(cardContainer);
      });
    }

    function shadeColor(color, percent) {
      const num = parseInt(color.slice(1), 16);
      const amt = Math.round(2.55 * percent);
      const R = (num >> 16) + amt;
      const G = ((num >> 8) & 0x00FF) + amt;
      const B = (num & 0x0000FF) + amt;
      return `#${(0x1000000 + (R < 255 ? (R < 1 ? 0 : R) : 255) * 0x10000 + 
                      (G < 255 ? (G < 1 ? 0 : G) : 255) * 0x100 + 
                      (B < 255 ? (B < 1 ? 0 : B) : 255)).toString(16).slice(1)}`;
    }

    function filterCourses() {
      const searchQuery = document.getElementById('search-bar').value.toLowerCase();
      const filteredCourses = courses.filter(course =>
        course.name.toLowerCase().includes(searchQuery) ||
        course.code.toLowerCase().includes(searchQuery) ||
        getCourseInitials(course.name).includes(searchQuery)
      );
      generateCards(filteredCourses);
    }

    function clearSearch() {
      document.getElementById('search-bar').value = '';
      generateCards();
    }

    generateCards();
  </script>

</body>

</html>
