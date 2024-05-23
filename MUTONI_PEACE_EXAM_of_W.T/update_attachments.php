<?php
include('db_connection.php');

// Check if Attachment_ID is set
if(isset($_REQUEST['Attachment_ID'])) {
    $attachment_id = $_REQUEST['Attachment_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM attachments WHERE Attachment_ID=?");
    $stmt->bind_param("i", $attachment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $message_id = $row['Message_ID'];
        $file_name = $row['File_Name'];
        $file_type = $row['File_Type'];
        $file_path = $row['File_Path'];
    } else {
        echo "Attachment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Attachments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update attachments form -->
    <h2><u>Update Form for Attachments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

         <label for="Message_ID">Message ID:</label>
        <input type="number" name="Message_ID" value="<?php echo isset($message_id) ? $message_id : ''; ?>">
        <br><br>

        <label for="File_Name">File Name:</label>
        <input type="text" name="File_Name" value="<?php echo isset($file_name) ? $file_name : ''; ?>">
        <br><br>

        <label for="File_Type">File Type:</label>
        <input type="text" name="File_Type" value="<?php echo isset($file_type) ? $file_type : ''; ?>">
        <br><br>

        <label for="File_Path">File Path:</label>
        <input type="text" name="File_Path" value="<?php echo isset($file_path) ? $file_path : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $message_id = $_POST['Message_ID'];
    $file_name = $_POST['File_Name'];
    $file_type = $_POST['File_Type'];
    $file_path = $_POST['File_Path'];
    
    // Update the attachment in the database
    $stmt = $connection->prepare("UPDATE attachments SET Message_ID=?, File_Name=?, File_Type=?, File_Path=? WHERE Attachment_ID=?");
    $stmt->bind_param("isssi", $message_id, $file_name, $file_type, $file_path, $attachment_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: attachments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
