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
    <title>Vote on Topics</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap");

        /* Body and global styles */
        body {
            font-family: "Poppins", sans-serif;
            padding: 0;
            background: #eeeeee;
        }

        .header {
            margin: 10px auto;
            margin-top: 90px;
            color: black;
            padding: 10px 5px;
            text-align: center;
            background-color: #FFFFFF;
            width: 830px;
            border-radius: 10px;
        }

        .header h1 {
            font-size: 1.5rem;
        }


        .container {
            background-color: #FFFFFF;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 16px;
            max-width: 800px;
            margin: 0px auto;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px 20px;
        }

        .post {
            position: relative;
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: left;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .post .content {
            display: flex;
            gap: 8px;
            margin-bottom: 10px;
        }

        .post .content .title {
            max-width: 300px;
            font-size: 13px;
            margin-top: 20px;
            margin-left: 25px;
            font-weight: bold;
        }

        .post .content .description {
            text-align: justify;
            font-size: 12px;
            margin-left: 25px;

        }

        .title span {
            color: #2c3e50;
            font-weight: bold;
        }

        .description{
            font-size: 12px;
            font-weight: normal;
            padding-right:8px;
        }

        .description span {
            color: #2c3e50;
            font-weight: bold;
        }




        .post .end-date {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #707070;
            font-size: 0.7em;
            background-color: #fff;
            padding: 5px 8px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post .vote-options {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
        }

        .post .vote-options form {
            display: inline-block;
        }

        .post .vote-options button {
            padding: 8px 10px;
            font-size: 13px;
            color: white;
            background-color: transparent;
            border: 1.5px solid white;


            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .post .vote-options button:hover {
            border: none;
            transform: scale(1.1);
            /* Slightly bigger */

            background-color: #2c3e50;
        }

        .post .vote-options button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        .voting-complete {
            margin:10px;
            font-size: 0.6em;
            width: fit-content;
            margin-left: 25px;
            padding: 5px;
            background: linear-gradient(to right, orange, purple);
            color: white;
            border-radius: 10px;
        }

        .voteImage {
            width: 210px;
            height: 170px;
            /* object-fit: cover; */
            border-radius: 10px;
        }
        .po{
            font-size: 10px;
        }
        .search-container {
        position: relative;
        width: 90%;
        max-width: 600px;
        margin: 0 auto;
    }
    .search-container input {
        width: 90%;
        padding: 12px 40px 12px 20px;
        font-size: 1rem;
        border: 1px solid #4A628A;
        border-radius: 15px;
        outline: none;
        background-color: #FFFFFF;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .search-container input:focus {
        border-color: #7AB2D3;
        box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
    }
    .search-container button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        cursor: pointer;
        font-size: 1.2rem;
        color: #4A628A;
    }
    </style>
</head>
<header>
    <div class="header">
        <h1>Express your feelings by voting for your freedom</h1>
        <div class="search-container">
    <input type="text" id="searchBar" placeholder="Search by title or keywords..." onkeyup="searchPosts()">
    <button onclick="clearSearch()">&times;</button>
</div>
        
    </div>
</header>

<body>

    <div class="container">



        <?php
        include("../Connection/dbconnection.php");
        $sql = "SELECT titleOfVote, description, end_date, image_path FROM vote_details
                WHERE Approve = 'yes' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        while ($info = mysqli_fetch_array($result)) {
            $end_date = new DateTime($info['end_date']);
            // $formatted_end_date = $end_date->format('F j, Y h:i A');
            $formatted_end_date = $end_date->format('M j, Y h:i A');

            date_default_timezone_set('Asia/Dhaka');
            $current_date = new DateTime();
            $is_past = $current_date > $end_date;



            if ($info['image_path'] == "") {
                $PathofImage  = "img/default.jpg";
            } else if ($info['image_path'] != "") {

                $PathofImage = "../Admin/VoteImages/" . $info['image_path'];
            } else {
                $PathofImage  = "img/default.jpg";
            }


            echo '
            <div class="post" data-vote-title="' . htmlspecialchars($info['titleOfVote']) . '">
                <div class="content">
                     <img class="voteImage" src="' . htmlspecialchars($PathofImage) . '" alt="Vote Image">
                    <div class="deatils">
                    <p class="title"> <span class="po" >Position: </span> ' . htmlspecialchars($info['titleOfVote']) . '</p>
                    <p class="description">  <span class="po">Description: </span> ' . htmlspecialchars($info['description']) . '</p>
                </div>
                </div>
                <div class="end-date">Deadline: ' . htmlspecialchars($formatted_end_date) . '</div>';

            if ($is_past) {
                echo '<div class="voting-complete">Voting session complete</div>';
            }

            echo '
                <div class="vote-options">
                    <form action="CandidateForVote.php" method="POST">
                        <input type="hidden" name="titleOfVote" value="' . htmlspecialchars($info['titleOfVote']) . '">
                        <button type="submit" ' . ($is_past ? 'disabled' : '') . '>Vote now</button>
                    </form>
                    <form action="ApplyAsCandidate.php" method="POST">
                        <input type="hidden" name="titleOfVote" value="' . htmlspecialchars($info['titleOfVote']) . '">
                        <button type="submit" ' . ($is_past ? 'disabled' : '') . '>Apply as a Candidate</button>
                    </form>
                    <form action="VoteResult.php" method="POST">
                        <input type="hidden" name="titleOfVote" value="' . htmlspecialchars($info['titleOfVote']) . '">
                        <button type="submit" ' . (!$is_past ? 'disabled' : '') . ' title="Voting session not complete yet">Result</button>
                    </form>
                </div>
            </div>';
        }
    } else {
        echo '<h4 style="text-align:center;" >No vote topics available.</h4>';
    }
        ?>
        
    </div>

    <script>
        // Define the color palette
        const colors = [
            '#7AB2B2', '#4D869C', '#7AB2D3', '#4A628A', '#9fa8da', '#90caf9', '#9fa8da', '#90caf9', '#b39ddb', '#80cbc4', '#81c784',
            '#c5e1a5', '#ffcc80', '#ffe082', '#f8bbd0', '#f48fb1',
            '#a5d6a7', '#c8e6c9', '#d1c4e9', '#b3e5fc', '#ffeb3b',
            '#ffc107', '#ff9800', '#ff5722', '#81c784', '#f44336',
            '#ce93d8', '#9575cd', '#b2dfdb', '#90a4ae', '#e1bee7',
            '#ff4081', '#64b5f6', '#a2dff7', '#f3e5f5', '#e1f5fe'

        ];

        // Function to consistently assign a color based on a unique identifier
        const getColorById = (id) => {
            const index = id % colors.length; // Ensure the index is within the array bounds
            return colors[index];
        };

        // Assign a consistent color to each post based on its unique identifier
        document.querySelectorAll('.post').forEach((post, index) => {
            const uniqueId = post.getAttribute('data-id') || index; // Use 'data-id' if available, fallback to index
            const color = getColorById(uniqueId);
            post.style.backgroundColor = color;
        });
    
        function searchPosts() {
        let input = document.getElementById('searchBar').value.toLowerCase();
        let posts = document.querySelectorAll('.post');

        posts.forEach(post => {
            let title = post.querySelector('.title').textContent.toLowerCase();
            let description = post.querySelector('.description').textContent.toLowerCase();

            if (title.includes(input) || description.includes(input)) {
                post.style.display = '';
            } else {
                post.style.display = 'none';
            }
        });
    }

    function clearSearch() {
        document.getElementById('searchBar').value = '';
        searchPosts();
    }
    </script>
</body>
<?php include_once "../Header/Footer.php"; ?>
</html>