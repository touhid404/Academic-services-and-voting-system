<?php

include("../Connection/dbconnection.php");

if (isset($_GET['titleOfVote']) && !empty($_GET['titleOfVote'])) {
    $titleOfVote = mysqli_real_escape_string($conn, $_GET['titleOfVote']);

    // Fetch the current state of the 'Approve' column for the given titleOfVote
    $query = "SELECT Approve FROM vote_details WHERE titleOfVote = '$titleOfVote'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentState = $row['Approve'];

        // Determine the new state based on the current state
        $newState = ($currentState === 'yes') ? 'no' : 'yes';

        // Update the 'Approve' column with the new state
        $updateQuery = "UPDATE vote_details SET Approve = '$newState' WHERE titleOfVote = '$titleOfVote'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>
                    alert('Vote state has been toggled to \"$newState\" successfully!');
                    location.assign('VoteInfo.php');
                </script>";
        } else {
            echo "<script>
                    alert('Failed to toggle the vote state. Please try again.');
                    location.assign('VoteInfo.php');
                </script>";
        }
    } else {
        echo "<script>
                alert('Invalid vote title or vote not found!');
                location.assign('VoteInfo.php');
            </script>";
    }
} else {
    echo "<script>
            alert('Invalid vote title!');
            location.assign('VoteInfo.php');
        </script>";
}
