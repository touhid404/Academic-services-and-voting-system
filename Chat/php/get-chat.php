<?php
session_start();
if (isset($_SESSION['studentId'])) {
    include_once "config.php";

    $outgoing_id = $_SESSION['studentId']; // User's unique ID
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // Friend's unique ID

    $output = "";
    $ciphering = "AES-128-CTR"; // Cipher method
    $encryption_key = "your_secret_key"; // Replace with your secure key
    $options = 0;
    $encryption_iv = '1234567891011121';

    // Fetching messages between the two users
    $sql = "SELECT * FROM messages 
            LEFT JOIN student_data ON student_data.studentId = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
            ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {

            // Decrypt messages retrieved from the database
            $decrypted_message = openssl_decrypt($row['msg'], $ciphering, $encryption_key, $options, $encryption_iv);

            // Check if the message is outgoing or incoming
            if ($row['outgoing_msg_id'] == $outgoing_id) {

                // Outgoing message structure
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . htmlspecialchars($decrypted_message, ENT_QUOTES, 'UTF-8') . '</p>
                                </div>
                            </div>';
            } else {
                // Incoming message structure
                $output .= '<div class="chat incoming">
                                <div class="details">
                                    <p>' . htmlspecialchars($decrypted_message, ENT_QUOTES, 'UTF-8') . '</p>
                                </div>
                            </div>';
            }
        }
    } else {
        // No messages fallback
        $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
    }

    echo $output;
} else {
    echo "Session expired. Please log in again.";
}
