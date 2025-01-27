<?php

include("../Connection/dbconnection.php");

try {
    if (!$conn) {
        throw new Exception("Database connection not established.");
    }

    // Check if required parameters are set
    if (isset($_GET['candidate'], $_GET['status'], $_GET['titleOfVote'])) {
        // Sanitize and validate input
        $status = intval($_GET['status']); // Assuming `status` is an integer
        $pID = intval($_GET['candidate']); // Assuming `participantId` is an integer
        $titleOfV = $conn->real_escape_string($_GET['titleOfVote']); // Assuming `titleOfVote` is a string

        // Prepare the SQL query
        $sql = "UPDATE candidate_data SET status = ? WHERE candidateId = ? AND titleOfVote = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error in preparing statement: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("iis", $status, $pID, $titleOfV);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect with success message
            header("Location: VoteInfo.php?msg=success");
        } else {
            // Redirect with error message
            header("Location: launch_vote.php?msg=error");
        }

        // Close the statement
        $stmt->close();
    } else {
        throw new Exception("Invalid or missing parameters.");
    }
} catch (Exception $e) {
    // Display error message
    echo "Error: " . $e->getMessage();
}
?>
