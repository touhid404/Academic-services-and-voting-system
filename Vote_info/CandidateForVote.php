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

include_once "../Header/StudentHeader.php";
include("../Connection/dbconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titleOfVote'])) {
    $titleOfVote = mysqli_real_escape_string($conn, $_POST['titleOfVote']);
} else {
    echo "<div class='error'>Invalid request. Please try again.</div>";
    exit;
}

$sql = "SELECT c.candidateId, c.name, sd.profile_pic
        FROM candidate_data c 
        LEFT JOIN student_data sd ON c.candidateId = sd.studentId
        WHERE c.status = 2 AND c.titleOfVote = '$titleOfVote'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate List</title>
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap");
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #eeeeee;
            color: #333;
        }

        .header {
            margin: 0 auto;
            margin-top: 90px;
            width: 600px;
            padding: 10px 20px;
            background-color: #FFFFFF;
            text-align: center;
            font-weight: bold;
            color: #34495e;
            border-radius: 10px;
        }
        .header h2 {
            font-size: 1.2rem;
        }
      

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            max-width: 1200px;
            margin: auto;
            margin-top: 30px;
        }

        .candidate-card {
            background-color: #ffffff;
            border: 1px solid #dcdde1;
            border-radius: 16px;
            padding: 10px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .candidate-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 20px;
            margin-bottom: 15px;
            border: 2px solid #34495e;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card-name {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #1abc9c;
            color: #ffffff;
            padding: 10px 25px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #16a085;
            transform: scale(1.05);
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
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            display: none;
            z-index: 1000;
            max-width: 400px;
            width: 90%;
        }

        .modal.show {
            display: block;
        }

        .modal-background.show {
            display: block;
        }

        .modal h2 {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .modal p {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .modal-buttons .btn {
            background-color: #3498db;
            padding: 10px 25px;
            font-size: 16px;
            color: #ffffff;
            border-radius: 25px;
        }

        .modal-buttons .btn:hover {
            background-color: #2980b9;
        }

        .btn-cancel {
            background-color: #e74c3c;
            color: #ffffff;
            padding: 10px 35px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
        }

        .no-card {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 400px;
            height: auto;
            background-color: #FFFFFF;
            overflow: hidden;
            border-radius:10px;
            display: flex;
            flex-direction: column;
        }
        .no-card h2{
            font-size: 0.8rem;
            color: #555;
            margin-bottom: 10px;
        }
        .no-card img{
            width: 100%;
            height: 100%;
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
    <header class="header">
        <h2>Vote Topic: <?php echo htmlspecialchars($titleOfVote); ?></h2>
    </header>

    <div class="container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="candidate-card">
                    <?php
                    $profilePicturePath = "../Login_Page/Images/" . htmlspecialchars($row['profile_pic']);
                    $profilePicture = file_exists($profilePicturePath) ? $profilePicturePath : "img/profile.png";
                    ?>
                    <img class="card-img-top" src="<?php echo $profilePicture; ?>" alt="Candidate Image">
                    <h2 class="card-title">Candidate ID: <?php echo htmlspecialchars($row['candidateId']); ?></h2>
                    <p class="card-name">Name: <?php echo htmlspecialchars($row['name']); ?></p>
                    <button class='btn' onclick="openVoteModal('<?php echo $row['candidateId']; ?>', '<?php echo htmlspecialchars($row['name']); ?>')">Vote Now</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-card">
                <h2>No one has applied for this position yet.</h2>
                <img src="img/20943452.jpg" alt="">
            </div>
        <?php endif; ?>
    </div>

    <div class="modal-background" id="modalBackground"></div>
    <div id="voteModal" class="modal">
        <h2>Confirm Your Vote</h2>
        <p>Are you sure you want to vote for <strong id="candidateName"></strong>?</p>
        <form id="voteForm" method="POST">
            <input type="hidden" id="canId" name="candidateId">
            <input type="hidden" id="titleOfVote" name="titleOfVote" value="<?php echo htmlspecialchars($titleOfVote); ?>">
            <div class="modal-buttons">
                <button type="submit" class="btn">Yes, Confirm</button>
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        function openVoteModal(candidateId, candidateName) {
            document.getElementById("canId").value = candidateId;
            document.getElementById("candidateName").textContent = candidateName;
            document.getElementById("modalBackground").classList.add("show");
            document.getElementById("voteModal").classList.add("show");
        }

        function closeModal() {
            document.getElementById("modalBackground").classList.remove("show");
            document.getElementById("voteModal").classList.remove("show");
        }

        
    </script>
</body>
<br>
<br>
<br>
<footer>
<?php include_once "../Header/Footer.php"; ?>
</footer>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['candidateId'], $_POST['titleOfVote'])) {
    $candidateId = mysqli_real_escape_string($conn, $_POST['candidateId']);
    $titleOfVote = mysqli_real_escape_string($conn, $_POST['titleOfVote']);

    $checkVoteQuery = "SELECT * FROM votes WHERE studentId = '$studentId' AND titleOfVote = '$titleOfVote'";
    $checkVoteResult = mysqli_query($conn, $checkVoteQuery);

    if ($checkVoteResult && mysqli_num_rows($checkVoteResult) > 0) {
        echo "<script>alert('You have already voted for this title.');</script>";
    } else {
        $insertQuery = "INSERT INTO votes (studentId, candidateId, titleOfVote) VALUES ('$studentId', '$candidateId', '$titleOfVote')";
        $updateQuery = "UPDATE candidate_data SET voteCount = voteCount + 1 WHERE candidateId = '$candidateId' AND titleOfVote = '$titleOfVote'";

        if (mysqli_query($conn, $insertQuery) && mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Your vote has been successfully recorded.');</script>";
         echo "<script>setTimeout(function() { window.location.href = 'VoteTopics.php'; }, 500);</script>";
        } else {
            echo "<script>alert('Error occurred while recording your vote. Please try again.');</script>";
             echo "<script>setTimeout(function() { window.location.href = 'VoteTopics.php'; }, 500);</script>";
        }
    }
}
?>