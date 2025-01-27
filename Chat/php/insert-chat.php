<?php 
session_start();
if (isset($_SESSION['studentId'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['studentId'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Encryption key (keep this key secure and consistent)
    $encryption_key = "your_secret_key"; // Replace with a secure key
    $ciphering = "AES-128-CTR"; // Cipher method
    $options = 0;
    $encryption_iv = '1234567891011121'; // Initialization vector (16 bytes)

    if (!empty($message)) {
        // Encrypt the message
        $encrypted_message = openssl_encrypt($message, $ciphering, $encryption_key, $options, $encryption_iv);

        // Save encrypted message to the database
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                    VALUES ({$incoming_id}, {$outgoing_id}, '{$encrypted_message}')") or die();
    }
} else {
   
}
?>
