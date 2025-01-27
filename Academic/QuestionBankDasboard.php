<?php
session_start();

if (
  isset($_SESSION['studentId']) &&
  isset($_SESSION['studentName']) &&
  !empty($_SESSION['studentName']) &&
  !empty($_SESSION['studentName'])
) {
  $studentId = $_SESSION['studentId'];
  $stname = $_SESSION['studentName'];
  $stemail = $_SESSION['StEmail'];
  $stdept = $_SESSION['StDept'];
  $stpicture = $_SESSION['profilePic'];
} else {
?>
  <script>
    location.assign('../Login_Page/LoginForm.php')
  </script>
<?php
}
include_once "../Header/StudentHeader.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courses Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap");

    body {
      font-family: "Poppins", sans-serif;
      background: #eeeeee;
    }

    .header {
      margin:  0 auto;
      margin-top: 90px;
    
      display: flex;
      align-items: center;
      position: relative;
      padding: 10px 20px;
      background-color: #FFFFFF;
      width: 780px;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      gap: 15px;

    }

    .centered-content {
      position: relative;
      margin: 0 auto;
      text-align: center;
      /* flex-grow: 1; */
      color: black;
      font-weight: bold;
    }

    .banner,
    .subtitle {
      margin: 0;
      font-size: 22px;
    }

    .subtitle {
      font-size: 18px;
    }

    .search-bar-container {
      width: 90%;
      max-width: 600px;
      margin: 5px auto;
      display: flex;
      align-items: center;
      position: relative;
    }

    .search-bar {
      width: 100%;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 10px;
      border: 1px solid #ddd;
      box-sizing: border-box;
      outline: none;
      transition: all 0.3s ease;
    }

    .search-bar:focus {
      border-color: blueviolet;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .search-bar::placeholder {
      color: #aaa;
    }

    .clear-btn {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #aaa;
      font-size: 18px;
      cursor: pointer;
    }

    .clear-btn:hover {
      color: #007BFF;
    }

    .dashboard {
      background-color: #FFFFFF;
      display: grid;
      grid-template-columns: repeat(1, 1fr);
      gap: 15px;
      padding: 20px;
      max-width: 780px;
      margin: 20px auto;
      box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .card {
      color: white;
      border-radius: 10px;
      padding: 20px;
      text-align: left;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      text-decoration: none;
    }

    .card:hover {
      transform: scale(1.01);
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .card-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .course-code {
      font-weight: bold;
      font-size: 16px;
      color: #f5f5f5;
    }

    .button-container {
      margin-top: 20px;
      display: flex;
      gap: 10px;
      justify-content: left;
    }

    .btn {
      padding: 8px 05px;
      font-size: 14px;
      color: white;
      background-color: transparent;
      border: 2px solid  white;
      
    
      border-radius: 10px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .btn:hover {
      border: none;
      transform: scale(1.1); /* Slightly bigger */

      background-color: #2c3e50;
    }
  </style>
</head>

<body>

  <header class="header">
    <div class="centered-content">
      <div class="banner">Course Resources: Previous Questions, Solutions, and Notes</div>
      <div class="subtitle">Please select the course of interest</div>
    </div>
    <div class="search-bar-container">
    <input type="text" id="search-bar" class="search-bar" placeholder="Search by course name, code, or keyword" oninput="filterCourses()">
    <button class="clear-btn" onclick="clearSearch()">x</button>
  </div>
  </header>

  

  <main class="dashboard" id="dashboard"></main>

  <script>
    const courses = [{
        name: 'English – I',
        code: 'ENG 1011'
      },
      {
        name: 'History of the Emergence of Bangladesh',
        code: 'BDS 1201'
      },
      {
        name: 'Introduction to Computer Systems',
        code: 'CSE 1110'
      },
      {
        name: 'Discrete Mathematics',
        code: 'CSE 2213'
      },
      {
        name: 'English – II',
        code: 'ENG 1013'
      },
      {
        name: 'Structured Programming Language',
        code: 'CSE 1111'
      },
      {
        name: 'Structured Programming Language Laboratory',
        code: 'CSE 1112'
      },
      {
        name: 'Fundamental Calculus',
        code: 'MATH 1151'
      },
      {
        name: 'Calculus and Linear Algebra',
        code: 'MATH 2183'
      },
      {
        name: 'Digital Logic Design',
        code: 'CSE 1325'
      },
      {
        name: 'Digital Logic Design Laboratory',
        code: 'CSE 1326'
      },
      {
        name: 'Object Oriented Programming',
        code: 'CSE 1115'
      },
      {
        name: 'Object Oriented Programming Laboratory',
        code: 'CSE 1116'
      },
      {
        name: 'Coordinate Geometry and Vector Analysis',
        code: 'MATH 2201'
      },
      {
        name: 'Physics',
        code: 'PHY 2105'
      },
      {
        name: 'Physics Laboratory',
        code: 'PHY 2106'
      },
      {
        name: 'Advanced Object Oriented Programming laboratory	',
        code: 'CSE 2118'
      },
      {
        name: 'Electrical Circuits',
        code: 'EEE 2113'
      },
      {
        name: 'Probability and Statistics',
        code: 'MATH 2205'
      },
      {
        name: 'Society, Environment and Engineering Ethics',
        code: 'SOC 2101'
      },
      {
        name: 'Data Structure and Algorithms – I',
        code: 'CSE 2215'
      },
      {
        name: 'Data Structure and Algorithms – I Laboratory',
        code: 'CSE 2216'
      },
      {
        name: 'Theory of Computation',
        code: 'CSE 2233'
      },
    ];

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
        form1.action = 'CourseCard.php';
        form1.method = 'GET';
        form1.innerHTML = `
          <input type="hidden" name="courseCode" value="${course.code}">
          <input type="hidden" name="courseName" value="${course.name}">
          <input type="hidden" name="cardColor" value="${colors[index % colors.length]}">
          <button class="btn" type="submit">Access Question</button>
        `;

        const form2 = document.createElement('form');
        form2.action = 'UploadCourseCard.php';
        form2.method = 'GET';
        form2.innerHTML = `
          <input type="hidden" name="courseCode" value="${course.code}">
          <input type="hidden" name="courseName" value="${course.name}">
          <input type="hidden" name="cardColor" value="${colors[index % colors.length]}">
          <button class="btn" type="submit">Contribute recources</button>
        `;


        buttonContainer.appendChild(form1);
        buttonContainer.appendChild(form2);

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
<?php include_once "../Header/Footer.php"; ?>

</html>