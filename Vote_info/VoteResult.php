<?php
session_start();

include("../Connection/dbconnection.php");

if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentId'])
) {
    $studentId = $_SESSION['studentId'];
} else {
?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
    exit;
}
include_once "../Header/StudentHeader.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titleOfVote'])) {
    $titleOfVote = mysqli_real_escape_string($conn, $_POST['titleOfVote']);
} else {
    echo "<div style=\"text-align: center; padding: 20px; margin-top:90px; color: #333;\">
    <h1 style=\"font-size: 24px; color: #555;\">No votes have been recorded for this topic</h1>
    <p style=\"font-size: 16px; color: #777;\">Something went wrong..</p>
    <img src=\"img/20943452.jpg\" alt=\"No Data\" style=\"max-width: 400px; height: auto;\">
</div>";
    exit;
}
$sql = "SELECT candidateId, name,voteCount
        FROM candidate_data
        WHERE status = 2 AND titleOfVote = '$titleOfVote' 
        ORDER BY voteCount DESC, name ASC";

$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    echo "<div style=\"text-align: center; padding: 20px; margin-top:90px; color: #333;\">
    <h1 style=\"font-size: 24px; color: #555;\">No votes have been recorded for this topic</h1>
    <p style=\"font-size: 16px; color: #777;\">Please check back later for updated results.</p>
    <img src=\"img/20943452.jpg\" alt=\"No Data\" style=\"max-width: 400px; height: auto;\">
</div>";

    exit;
}


$candidates = [];
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}

$winners = array_slice($candidates, 0, 3);
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Results</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #eeeeee;
        }

        .results-container {
            margin: auto;
            margin-top: 90px;
            padding: 20px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 90%;
            max-width: 800px;
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sp {
            font-size: 18px;
            color:  #2c3e50;
        }

        .cards-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            flex-wrap: wrap;
        }

        .card {
            background: linear-gradient(145deg, #f0f0f0, #ffffff);
            border-radius: 10px;
            box-shadow: 8px 8px 20px #d9d9d9, -8px -8px 20px #ffffff;
            padding: 20px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 10px 10px 25px #bfbfbf, -10px -10px 25px #ffffff;
        }

        .card h2 {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
            font-size: 1.2em;
        }

        .card.winner {
            border: 3px solid #2ecc71;
        }

        .card.runner-up {
            border: 3px solid #f1c40f;
        }

        .card.third-place {
            border: 3px solid #3498db;
        }

        .btn-show-all {
            margin: 20px 0;
            padding: 10px 20px;
            font-size: 16px;
            background-color:  #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            box-shadow: 5px 5px 10px #1c5c85, -5px -5px 10px #3aa3ff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-show-all:hover {
            background: linear-gradient(145deg, #2980b9, #3498db);
        }

        .all-candidates-table {
            display: none;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background: #f2f2f2;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .no-data h1 {
            font-size: 24px;
            color: #555;
        }

        .no-data p {
            font-size: 16px;
            color: #777;
        }

        .no-data img {
            max-width: 400;
            height: auto;
            margin-top: 20px;
        }
        footer {
            width: 100%;
            
            padding: 10px 0;
            position: relative;
            bottom: 0;
        }
    </style>
    <script>
        function toggleCandidates() {
            const table = document.querySelector('.all-candidates-table');
            table.style.display = table.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>

<body>
    <div class="results-container">
        <h1><span class="sp">Vote Results for Topic:</span> <?php echo htmlspecialchars($titleOfVote); ?></h1>

        <?php if (!empty($winners)) : ?>
            <div class="cards-container">
                <?php foreach ($winners as $index => $candidate) : ?>
                    <div class="card <?php echo $index === 0 ? 'winner' : ($index === 1 ? 'runner-up' : 'third-place'); ?>">
                        <h2><?php echo htmlspecialchars($candidate['name']); ?></h2>
                        <p>Votes: <?php echo htmlspecialchars($candidate['voteCount']); ?></p>
                        <p>Rank: <?php echo $index + 1; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="btn-show-all" onclick="toggleCandidates()">Show All Candidates</button>

            <?php if (count($candidates) > 3) : ?>
                <div class="all-candidates-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Candidate Name</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($candidates as $index => $candidate) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($candidate['name']); ?></td>
                                    <td><?php echo htmlspecialchars($candidate['voteCount']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php else : ?>

            <div class="no-data">
                <h1>No votes have been recorded for this topic</h1>
                <p>Please check back later for updated results.</p>
                <img src="img/20943452.jpg" alt="">
            </div>

        <?php endif; ?>
    </div>
</body>
<footer>
<?php include_once "../Header/Footer.php"; ?>
</footer>

</html>