<?php
include('db_connection.php');

// Check if Message_ID is set
if(isset($_REQUEST['Message_ID'])) {
    $message_id = $_REQUEST['Message_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM messages WHERE Message_ID=?");
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sender_id = $row['Sender_ID'];
        $receiver_id = $row['Receiver_ID'];
        $message_content = $row['Message_Content'];
        $timestamp = $row['Timestamp'];
    } else {
        echo "Message not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Messages Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update messages form -->
    <h2><u>Update Form for Messages</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

         <label for="Sender_ID">Sender ID:</label>
        <input type="number" name="Sender_ID" value="<?php echo isset($sender_id) ? $sender_id : ''; ?>">
        <br><br>

        <label for="Receiver_ID">Receiver ID:</label>
        <input type="number" name="Receiver_ID" value="<?php echo isset($receiver_id) ? $receiver_id : ''; ?>">
        <br><br>

        <label for="Message_Content">Message Content:</label>
        <input type="text" name="Message_Content" value="<?php echo isset($message_content) ? $message_content : ''; ?>">
        <br><br>

        <label for="Timestamp">Timestamp:</label>
        <input type="text" name="Timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $sender_id = $_POST['Sender_ID'];
    $receiver_id = $_POST['Receiver_ID'];
    $message_content = $_POST['Message_Content'];
    $timestamp = $_POST['Timestamp'];
    
    // Update the message in the database
    $stmt = $connection->prepare("UPDATE messages SET Sender_ID=?, Receiver_ID=?, Message_Content=?, Timestamp=? WHERE Message_ID=?");
    $stmt->bind_param("iissi", $sender_id, $receiver_id, $message_content, $timestamp, $message_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: messages.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
