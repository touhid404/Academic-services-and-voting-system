<?php
    // Section for connected people (always visible)
    $output .= '<div class="connected-people" style="display: flex; overflow-x: auto; padding: 15px 10px; gap: 15px; border-bottom: none; align-items: center; justify-content: flex-start;">
                    <style>
                        /* Hide the scrollbar */
                        .connected-people::-webkit-scrollbar {
                            display: none; /* Hides the scrollbar */
                        }
                        .connected-people {
                            -ms-overflow-style: none;  /* For Internet Explorer */
                            scrollbar-width: none;   
                            border-bottom: none  /* For Firefox */
                        }
                    </style>';
    mysqli_data_seek($query, 0); // Reset query pointer
    while ($row = mysqli_fetch_assoc($query)) {
        // Check user online status
        $offline = ($row['status'] == "Offline now") ? "offline" : "online";
        $status_color = ($offline == "offline") ? "" : "green";
        

        $output .= '<a href="chat.php?user_id='. $row['studentId'] .'" class="connected-profile" style="flex-shrink: 0; text-align: center; text-decoration: none; position: relative; display: flex; flex-direction: column; align-items: center; gap: 5px; margin-bottom: 0;">
                        <img src="../Login_Page/Images/'. $row['profile_pic'] .'" alt="" class="profile-pic" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                        <span style="font-size: 14px; font-weight: normal; color: #333; line-height: 1.2;">'. $row['name'] .'</span>
                         <div class="status-dot" style="width: 3px; height: 8px; border-radius: 70%; background-color: '. $status_color .'; position: absolute; bottom: 5px; right: 10px; border: none;"></div>
                    </a>';
    }
    $output .= '</div>';  // End connected people section

    // Section for conversations (with smooth scrolling animation)
    $output .= '<div class="conversation-section" style="min-height: 200px;">';  // Add a wrapper for conversations
    mysqli_data_seek($query, 0); // Reset query pointer again
    $has_conversations = false;  // Track if there are any conversations

    while ($row = mysqli_fetch_assoc($query)) {
        // Check if the logged-in user has chatted with this user
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['studentId']} 
                OR outgoing_msg_id = {$row['studentId']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);

        // Skip users with no conversations
        if (mysqli_num_rows($query2) == 0) {
            continue;
        }
         

        // Decrypt the message
        $has_conversations = true; // Set to true if a conversation exists
        $ciphering = "AES-128-CTR"; // Cipher method
        $encryption_key = "your_secret_key"; // Replace with your secure key
        $options = 0;
        $encryption_iv = '1234567891011121';
        $result = openssl_decrypt($row2['msg'], $ciphering, $encryption_key, $options, $encryption_iv);
        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

        // Determine if the message is from the logged-in user
        $you = "";
        if (isset($row2['outgoing_msg_id'])) {
            $you = ($outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
           
        }

        // Check user online status for conversation
        $offline = ($row['status'] == "Offline now") ? "offline" : "online";
        $status_color = ($offline == "offline") ? "" : "green";

        // Display conversation with active status
        $output .= '<a href="chat.php?user_id='. $row['studentId'] .'">
                        <div class="content" style="display: flex; align-items: center; padding: 12px 10px; gap: 10px; border-bottom: none; scroll-behavior: smooth;">
                            <img src="../Login_Page/Images/'. $row['profile_pic'] .'" alt="" class="profile-pic" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div class="details" style="flex-grow: 1;">
                                <span style="font-size: 16px; font-weight: normal; color: #333;">'. $row['name'].'</span>
                                <p style="font-size: 14px; color: #666; line-height: 1.2;">'. $you . $msg .'</p>
                            </div>
                        </div>
                        <!-- Status Dot showing active/inactive status -->
                        <div class="status-dot" style="width: 3px; height: 8px; border-radius: 70%; background-color: '. $status_color .'; margin-left: auto; border: none;"></div>
                    </a>';
    }

    // If no conversations, display the "Start Conversation" message
    if (!$has_conversations) {
        $output .= '<div class="no-conversations" style="display: flex; justify-content: center; align-items: center; height: 100%; font-size: 16px; color: #888;">
                        
                        <p style="Margin-top:20px;">No conversations yet. Satrt a conversation</p>
                    </div>';
    }

    $output .= '</div>';  // Close the conversation section
?>

