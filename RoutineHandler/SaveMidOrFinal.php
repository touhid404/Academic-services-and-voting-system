<?php
// Define file path
$file = 'example.txt';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input text
    $text = $_POST['textM'];

    // Check if the file exists, if not create it
    if (!file_exists($file)) {
        // Create the file
        touch($file);
    }

    // Write the text to the file
    file_put_contents($file, $text);
    
    // Redirect to another page after submission
    header("Location: UploadMidFinnalRoutine.php");
    exit();
}
?>
