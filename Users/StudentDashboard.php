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
include_once "../Header/studentHeader.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #eeeeee;
        }
      

        .all {
            margin-top: 90px;
        }

        .container {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
            padding: 40px;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(45deg, #E5E1DA, #B3C8CF);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .sidebar:hover {

            transform: scale(1.02);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
            animation: moveBg 10s infinite linear;
        }

        @keyframes moveBg {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .sidebar h3 {
            font-size: 22px;
            margin-bottom: 25px;
            color: white;
        }

        .sidebar ul {
            list-style: none;
            padding: 0; 
        }

        .sidebar ul li {
            padding: 15px;
            margin-bottom: 15px;
            background-color: #ffffff;
            border-radius: 10px;
            color: black;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .sidebar ul li:hover {
            color: black;
            background-color: #F1F0E8;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);

        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .main-content {
            background: #B7C4C6;
            /* Mixed color */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .main-content:hover {
            transform: scale(1.01);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .section {
            margin-bottom: 30px;
            opacity: 0;
            transform: translateX(-100%);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .section.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .section h2 {
            margin-top: 0;
            font-size: 24px;
            color: #2C5C63;
            border-bottom: 2px solid #E5E1DA;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .tasks li,
        .homework li,
        .progress li {


            color: white;

            margin: 15px 0;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .complete {
            background-color: #B3E5FC;
            /* background-color: #f1f1f1; */
            

        }

        .incomplete {
            background-color:  #FFEBCC;

        }



        .tasks li:hover,
        .progress li:hover {

            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .tasks li span,
        .homework li span,
        .progress li span {
            text-align: left;
            padding-left: 30px;
            font-weight: 500;
            color: black;
            word-wrap: break-word;
            /* Ensure text breaks into multiple lines */
            white-space: normal;
            /* Allow text to wrap */
            max-width: 750px;

        }

        /* li {
            display: flex;
            justify-content: space-between;
            align-items: center;
        } */
        .complete, .incomplete {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            z-index: 999;
        }

        .modal {
            height: 400px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            display: none;
            z-index: 1000;
            max-width: 400px;
            width: 90%;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .modal.show {
            display: block;
        }

        .modal-background.show {
            display: block;
        }

        /* Styling for the form */
        .add-form {
            width: 90%;
            max-width: 500px;
            margin: 20px auto;
            padding: 10px;
            border-radius: 8px;

        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-sizing: border-box;
            outline: none;
        }



        textarea {

            resize: vertical;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-sizing: border-box;
            outline: none;
        }

        textarea:focus {
            border-color: #007BFF;
        }

        /* Button styles */
        .modal-buttons {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #3aa856;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #218838;
        }

        .btn-cancel {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }


        /* Animations */
        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateX(-100%);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animated {
            animation: slideIn 0.5s ease-out forwards;
        }



        /* From Uiverse.io by vinodjangid07 */
        .delete-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgb(255, 69, 69);
            border: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
            cursor: pointer;
            transition-duration: .5s;
            overflow: hidden;
            position: relative;
        }

        .svgIcon {
            width: 12px;
            transition-duration: .5s;
        }

        .svgIcon path {
            fill: white;
        }

        .delete-btn:hover {
            width: 140px;
            border-radius: 50px;
            transition-duration: .3s;
            background-color: rgb(255, 69, 69);
            align-items: center;
        }

        .delete-btn:hover .svgIcon {
            width: 50px;
            transition-duration: .3s;
            transform: translateY(60%);
        }

        .delete-btn::before {
            position: absolute;
            top: -20px;
            content: "Delete";
            color: white;
            transition-duration: .3s;
            font-size: 2px;
        }

        .delete-btn:hover::before {
            font-size: 13px;
            opacity: 1;
            transform: translateY(30px);
            transition-duration: .3s;
        }


        .button-add {
            border-radius: 8px;
            margin-left: 40px;
            position: relative;
            width: 150px;
            height: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            border: 1px solid #34974d;
            background-color: #3aa856;
        }

        .button-add,
        .button__icon,
        .button__text {
            transition: all 0.3s;
        }

        .button-add .button__text {
            transform: translateX(30px);
            color: #fff;
            font-weight: 600;
        }

        .button-add .button__icon {
            position: absolute;
            transform: translateX(109px);
            height: 100%;
            width: 39px;
            /* background-color: #34974d; */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .button-add .svg {
            width: 30px;
            stroke: #fff;
        }

        .button-add:hover {
            background: #34974d;
        }

        .button-add:hover .button__text {
            color: transparent;
        }

        .button-add:hover .button__icon {
            width: 148px;
            transform: translateX(0);
        }

        .button-add:active .button__icon {
            background-color: #2e8644;
        }

        .button-add:active {
            border: 1px solid #2e8644;
        }

        .complete-btn {
            font-size: 13px;

            background-color: #818C78;
            color: white;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
            margin-left: 20px;
            border-radius: 10px;
            font-weight: bold;
        }

        .complete-btn:hover {
            background-color: #A7B49E;
        }


        .btns-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .complete {
            color: green;
            font-weight: bold;
            border: none;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
        }

        .complete .sa {
            color: green;
        }

        .complete img {
            height: 30px;
            width: 30px;
            color: green;
        }
        footer {
            width: 100%;
            
            padding: 10px 0;
            position: relative;
            bottom: 0;
        }
        
    </style>
</head>

<body>
    <div class="all">

        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="?page=examroutine">Exam routines</a></li>
                    <li><a href="?page=tasks">Tasks</a></li>
                    <li><a href="?page=homework">Homework</a></li>


                </ul>
            </div>

            <!-- Main Content -->
            <div class="main-content animated">
                <?php
                include("../Connection/dbconnection.php");
                $sql = "SELECT description, task_type, status FROM student_tasks WHERE student_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $studentId);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if there are any tasks
                $tasks = [];
                while ($row = $result->fetch_assoc()) {
                    $tasks[] = $row; // Store all tasks in an array
                }

                // Close the database connection
                $stmt->close();
                $conn->close();

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    switch ($page) {

                        case 'tasks':
                            echo '<div id="tasks" class="section">';
                            echo '<h2>Tasks</h2>';
                            echo '<ul class="tasks">';
                            foreach ($tasks as $task) {
                                if ($task['task_type'] == 'Task') {
                                    // Add a CSS class based on task status
                                    $taskClass = $task['status'] === 'complete' ? 'complete' : 'incomplete';

                                    echo '<li class="' . $taskClass . '">';
                                    echo '<span>' . htmlspecialchars($task['description']) . '</span>';

                                    echo '<div class= "btns-group">';
                                    if ($task['status'] !== 'complete') {


                                        echo '<form action="UpdateStatus.php" method="POST" style="display:inline;">
                                                  <input type="hidden" name="task_type" value="' . htmlspecialchars($task['task_type']) . '">
                                              <input type="hidden" name="description" value="' . htmlspecialchars($task['description']) . '">
                                              <input type="hidden" name="studentId" value="' . htmlspecialchars($studentId) . '">
                                                  <input type="hidden" name="status" value="complete">
                                                  <input type="hidden" name="type" value="?page=tasks">

                                                  <button type="submit" name="mark_complete" class="complete-btn">Complete now</button>
                                
                                              </form>';
                                    } else {
                                        echo '<button type="submit" name="mark_complete" class="complete"> <span class="sa">Completed</span> <img src="icons/tik.png" alt=""></button>';
                                    }


                                    // Form to delete the task
                                    echo '<form action="DeleteData.php" method="POST" style="display:inline;">
                                              <input type="hidden" name="task_type" value="' . htmlspecialchars($task['task_type']) . '">
                                              <input type="hidden" name="description" value="' . htmlspecialchars($task['description']) . '">
                                              <input type="hidden" name="studentId" value="' . htmlspecialchars($studentId) . '">
                                              <input type="hidden" name="type" value="?page=tasks">

        
                                                <button type="submit" name="delete_task" class="delete-btn">
                                                <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                                                </button>
                                          </form>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            }
                            echo '</ul>';
                            echo '<button class="button-add" 
                            type="button" 
                            onclick="openModalF(\'' . htmlspecialchars($studentId) . '\', \'' . htmlspecialchars("Task") . '\', \'' . htmlspecialchars("?page=tasks") . '\')">
                            <span class="button__text">Add now</span>
                            <span class="button__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" fill="none" class="svg">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </span>
                        </button>';
                            echo '</div>';
                            break;




                        case 'homework':
                            echo '<div id="homework" class="section">';
                            echo '<h2>HomeWork</h2>';
                            echo '<ul class="homework">';
                            foreach ($tasks as $task) {
                                if ($task['task_type'] == 'Homework') {
                                    // Add a CSS class based on task status
                                    $taskClass = $task['status'] === 'complete' ? 'complete' : 'incomplete';

                                    echo '<li class="' . $taskClass . '">';
                                    echo '<span>' . htmlspecialchars($task['description']) . '</span>';

                                    echo '<div class= "btns-group">';
                                    if ($task['status'] !== 'complete') {


                                        echo '<form action="UpdateStatus.php" method="POST" style="display:inline;">
                                                  <input type="hidden" name="task_type" value="' . htmlspecialchars($task['task_type']) . '">
                                              <input type="hidden" name="description" value="' . htmlspecialchars($task['description']) . '">
                                              <input type="hidden" name="studentId" value="' . htmlspecialchars($studentId) . '">
                                                  <input type="hidden" name="status" value="complete">
                                                  <input type="hidden" name="type" value="?page=homework">
                                                  <button type="submit" name="mark_complete" class="complete-btn">Complete now</button>
                                              </form>';
                                    } else {
                                        echo '<button type="submit" name="mark_complete" class="complete"> <span class="sa">Completed</span> <img src="icons/tik.png" alt=""></button>';
                                    }


                                    // Form to delete the task
                                    echo '<form action="DeleteData.php" method="POST" style="display:inline;">
                                              <input type="hidden" name="task_type" value="' . htmlspecialchars($task['task_type']) . '">
                                              <input type="hidden" name="description" value="' . htmlspecialchars($task['description']) . '">
                                              <input type="hidden" name="studentId" value="' . htmlspecialchars($studentId) . '">
                                              <input type="hidden" name="type" value="?page=homework">
                                              

        
                                                <button type="submit" name="delete_task" class="delete-btn">
                                                <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                                                </button>
                                          </form>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            }
                            echo '</ul>';
                            echo '<button class="button-add" 
                                        type="button" 
                                        onclick="openModalF(\'' . htmlspecialchars($studentId) . '\', \'' . htmlspecialchars("Homework") . '\', \'' . htmlspecialchars("?page=homework") . '\')">
                                        <span class="button__text">Add now</span>
                                        <span class="button__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" fill="none" class="svg">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </span>
                                    </button>';
                            echo '</div>';
                            break;


                        case 'examroutine':
                         echo '   <iframe src="MyMidFinalRoutine.php" width="950" height="500" style="border: none; overflow: hidden;"></iframe>';
                            break;



                        }
                } else {
                    echo '   <iframe src="MyMidFinalRoutine.php" width="950" height="500" style="border: none; overflow: hidden;"></iframe>';
                    
                }
                ?>

            </div>
        </div>
        <div class="modal-background" id="modalBackground"></div>
        <div id="AddModal" class="modal">
            <h4>Add your tasks,notes,homework</h4>


            <form id="AddForm" action="InsertData.php" method="POST" class="add-form">
                <div class="form-group">
                    
                    <input type="hidden" id="stdId" name="stdId" readonly class="input-field">
                    <input type="hidden" id="pageUrl" name="type1" class="input-field">

                </div>

                <div class="form-group">

                    <label for="topic">Topic</label>
                    <input type="text" id="topic" name="topic" required readonly class="input-field">
                </div>

                <div class="form-group">
                    <label for="comments">Descriptions</label>
                    <textarea id="comments" name="comments" rows="4" class="input-field" required></textarea>
                </div>

                <div class="modal-buttons">
                    <button type="submit" class="btn">Yes, Confirm</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                </div>
            </form>

        </div>

        <script>
            function openModalF(studentId, topic, page) {
                document.getElementById("topic").value = topic;
                document.getElementById("stdId").value = studentId;
                document.getElementById("pageUrl").value = page;

                document.getElementById("modalBackground").classList.add("show");
                document.getElementById("AddModal").classList.add("show");
            }

            function closeModal() {
                document.getElementById("modalBackground").classList.remove("show");
                document.getElementById("AddModal").classList.remove("show");
            }



            const sections = document.querySelectorAll('.section');

            function checkVisibility() {
                sections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
                        section.classList.add('visible');
                    }
                });
            }

            window.addEventListener('scroll', checkVisibility);
            checkVisibility();



            function deleteTask(taskType, description, sid) {
                if (confirm('Are you sure you want to delete this task?')) {

                    var formData = new FormData();
                    formData.append('task_type', taskType);
                    formData.append('description', description);
                    formData.append('student_id', sid);

                    // Create a new AJAX request
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "DeleteData.php", true);

                    // Define what to do when the request completes
                    xhr.onload = function() {
                        if (xhr.status == 200) {
                            // If deletion is successful, remove the task from the list
                            alert("Task deleted successfully.");
                            location.reload(); // Reload the page to update the task list
                        } else {
                            alert("Error deleting task. Please try again.");
                        }
                    };

                    // Send the request with form data
                    xhr.send(formData);
                }
            }
        </script>
    </div>
</body>



</html>
<footer>
<?php include_once "../Header/Footer.php"; ?>
</footer>