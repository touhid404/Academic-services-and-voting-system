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
$sql = "SELECT 
            vd.titleOfVote,
            vd.description,
            vd.end_date,
            vd.deadline,
            vd.Approve,
            cd.candidateId,
            cd.name AS participantName,
            cd.voteCount,
            cd.status,
            v.studentId
        FROM 
            vote_details vd
        LEFT JOIN 
            candidate_data cd 
        ON 
            vd.titleOfVote = cd.titleOfVote
        LEFT JOIN 
            votes v 
        ON 
            cd.candidateId = v.candidateId

         GROUP BY 
            vd.titleOfVote, cd.candidateId
        ORDER BY vd.titleOfVote, cd.candidateId";

// Initialize an array to store grouped data
$data = [];
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['titleOfVote'];
        if (!isset($data[$title])) {
            $data[$title] = [
                'details' => [
                    'description' => $row['description'],
                    'end_date' => $row['end_date'],
                    'deadline' => $row['deadline'],
                    'approve' => $row['Approve']
                ],
                'candidates' => []
            ];
        }
        if (!empty($row['candidateId'])) {
            $data[$title]['candidates'][] = [
                'candidateId' => $row['candidateId'],
                'participantName' => $row['participantName'],
                'voteCount' => $row['voteCount'],
                'status' => $row['status'],
                'studentId' => $row['studentId']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grouped Table</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        .header {
            margin-top: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            text-align: center;
        }

        .banner {
            font-size: 25px;
            font-weight: bold;
            padding: 5px;
        }

        .contain {
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            background: white;
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .left-div {
            flex: 1;
            min-width: 300px;
            margin-right: 20px;
        }

        .right-div {
            flex: 2;
            min-width: 300px;
        }

        .title-details h2 {
            margin: 0 0 10px;
            color: #2c3e50;
        }

        .title-details p {
            margin: 8px 0;
            font-size: 14px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #2c3e50;
            color: white;
        }

        thead th {
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
        }

        tbody td {
            padding: 10px;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-btns .btn {
            background-color: red;
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }

        .btn-deactivate {
            background-color: orange;
        }

        .btn-deactivate:hover {
            opacity: 0.9;
        }

        .us{
            padding: 5px;
            background-color: #2c3e50;
            border-radius: 5px;
            text-decoration: none;
            color: white;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-div,
            .right-div {
                margin-right: 0;
            }

            table {
                font-size: 12px;
            }
        }
    </style>

</head>

<body>
    <header class="header">
        <div class="banner">Administrator Panel: Vote Details Overview</div>
    </header>

    <div class="contain">
        <?php if (empty($data)): ?>
            <p>No votes or candidates are available.</p>
        <?php else: ?>
            <?php foreach ($data as $title => $info): ?>
                <div class="container">

                    <div class="left-div">
                        <div class="title-details">
                            <h2>Title of Vote: <?= $title ?></h2>
                            <p><strong>Description:</strong> <?= $info['details']['description'] ?></p>
                            <p><strong>End Date:</strong> <?= (new DateTime($info['details']['end_date']))->format('F j, Y h:i A') ?></p>
                            <p><strong>Deadline:</strong> <?= (new DateTime($info['details']['deadline']))->format('F j, Y h:i A') ?></p>
                            <p><strong>Approve:</strong> <?= $info['details']['approve'] == 'yes' ? 'Yes' : 'No' ?></p>

                            <a   class="us" href="deactivateVote.php?titleOfVote=<?= $title ?>" class="btn btn-deactivate">Update status</a>

                        </div>
                    </div>

                    <div class="right-div">
                        <?php if (empty($info['candidates'])): ?>
                            <div class="no-candidates">
                                No candidates available for this vote.
                            </div>
                        <?php else: ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Candidate ID</th>
                                        <th>Participant Name</th>
                                        <th>Vote Count</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($info['candidates'] as $candidate): ?>
                                        <tr>
                                            <td><?= $candidate['candidateId'] ?></td>
                                            <td><?= $candidate['participantName'] ?></td>
                                            <td><?= $candidate['voteCount'] ?></td>
                                            <td>
                                                <?php
                                                $status = $candidate['status'];
                                                if ($status == 0) {
                                                    echo "Pending";
                                                } elseif ($status == 1) {
                                                    echo "Rejected";
                                                } elseif ($status == 2) {
                                                    echo "Approved";
                                                }
                                                ?>
                                            </td>
                                            <td class="action-btns">
                                                <?php
                                                $candidateId = $candidate['candidateId'];
                                                $titleOfVote = $title;
                                                if ($status == 0) {
                                                    echo '<a href="changeSt.php?candidate=' . $candidateId . '&titleOfVote=' . $titleOfVote . '&status=2" class="btn btn-success">Approve</a>';
                                                    echo '<a href="changeSt.php?candidate=' . $candidateId . '&titleOfVote=' . $titleOfVote . '&status=1" class="btn btn-danger">Reject</a>';
                                                } elseif ($status == 1) {
                                                    echo '<a href="changeSt.php?candidate=' . $candidateId . '&titleOfVote=' . $titleOfVote . '&status=2" class="btn btn-success">Approve</a>';
                                                } elseif ($status == 2) {
                                                    echo '<a href="changeSt.php?candidate=' . $candidateId . '&titleOfVote=' . $titleOfVote . '&status=1" class="btn btn-danger">Reject</a>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>