<?php
include('db_connection.php');

// Check if Feedback_ID is set
if(isset($_REQUEST['Feedback_ID'])) {
    $feedback_id = $_REQUEST['Feedback_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE Feedback_ID=?");
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sender_id = $row['Sender_ID'];
        $receiver_id = $row['Receiver_ID'];
        $content = $row['Feedback_Content'];
        $timestamp = $row['Timestamp'];
    } else {
        echo "Feedback not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Feedback Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update feedback form -->
    <h2><u>Update Form for Feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

         <label for="Sender_ID">Sender ID:</label>
        <input type="number" name="Sender_ID" value="<?php echo isset($sender_id) ? $sender_id : ''; ?>">
        <br><br>

        <label for="Receiver_ID">Receiver ID:</label>
        <input type="number" name="Receiver_ID" value="<?php echo isset($receiver_id) ? $receiver_id : ''; ?>">
        <br><br>

        <label for="Feedback_Content">Feedback Content:</label>
        <textarea name="Feedback_Content"><?php echo isset($content) ? $content : ''; ?></textarea>
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
    $content = $_POST['Feedback_Content'];
    $timestamp = $_POST['Timestamp'];
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET Sender_ID=?, Receiver_ID=?, Feedback_Content=?, Timestamp=? WHERE Feedback_ID=?");
    $stmt->bind_param("iissi", $sender_id, $receiver_id, $content, $timestamp, $feedback_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
