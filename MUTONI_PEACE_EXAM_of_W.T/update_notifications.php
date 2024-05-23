<?php
include('db_connection.php');

// Check if Notification ID is set
if(isset($_REQUEST['Notification_ID'])) {
    $notification_id = $_REQUEST['Notification_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM notifications WHERE Notification_ID=?");
    $stmt->bind_param("i", $notification_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $parent_id = $row['Parent_ID'];
        $teacher_id = $row['Teacher_ID'];
        $message = $row['Message'];
        $timestamp = $row['Timestamp'];
        $read_status = $row['Read_Status'];
    } else {
        echo "Notification not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in notifications Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update notifications form -->
    <h2><u>Update Form for Notifications</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="Parent_ID">Parent ID:</label>
        <input type="number" name="Parent_ID" value="<?php echo isset($parent_id) ? $parent_id : ''; ?>">
        <br><br>

        <label for="Teacher_ID">Teacher ID:</label>
        <input type="number" name="Teacher_ID" value="<?php echo isset($teacher_id) ? $teacher_id : ''; ?>">
        <br><br>

        <label for="Message">Message:</label>
        <input type="text" name="Message" value="<?php echo isset($message) ? $message : ''; ?>">
        <br><br>

        <label for="Timestamp">Timestamp:</label>
        <input type="text" name="Timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
        <br><br>

        <label for="Read_Status">Read Status:</label>
        <input type="text" name="Read_Status" value="<?php echo isset($read_status) ? $read_status : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $parent_id = $_POST['Parent_ID'];
    $teacher_id = $_POST['Teacher_ID'];
    $message = $_POST['Message'];
    $timestamp = $_POST['Timestamp'];
    $read_status = $_POST['Read_Status'];
    
    // Update the notification in the database
    $stmt = $connection->prepare("UPDATE notifications SET Parent_ID=?, Teacher_ID=?, Message=?, Timestamp=?, Read_Status=? WHERE Notification_ID=?");
    $stmt->bind_param("iisssi", $parent_id, $teacher_id, $message, $timestamp, $read_status, $notification_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: notifications.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
