<?php
include('db_connection.php');

// Check if Meeting ID is set
if(isset($_REQUEST['Meeting_ID'])) {
    $meeting_id = $_REQUEST['Meeting_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM meetings WHERE Meeting_ID=?");
    $stmt->bind_param("i", $meeting_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $parent_id = $row['Parent_ID'];
        $teacher_id = $row['Teacher_ID'];
        $date_time = $row['Date_Time'];
        $agenda = $row['Agenda'];
    } else {
        echo "Meeting not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in meetings Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update meetings form -->
    <h2><u>Update Form for Meetings</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="Parent_ID">Parent ID:</label>
        <input type="number" name="Parent_ID" value="<?php echo isset($parent_id) ? $parent_id : ''; ?>">
        <br><br>

        <label for="Teacher_ID">Teacher ID:</label>
        <input type="number" name="Teacher_ID" value="<?php echo isset($teacher_id) ? $teacher_id : ''; ?>">
        <br><br>

        <label for="Date_Time">Date Time:</label>
        <input type="datetime-local" name="Date_Time" value="<?php echo isset($date_time) ? date('Y-m-d\TH:i', strtotime($date_time)) : ''; ?>">
        <br><br>

        <label for="Agenda">Agenda:</label>
        <input type="text" name="Agenda" value="<?php echo isset($agenda) ? $agenda : ''; ?>">
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
    $date_time = $_POST['Date_Time'];
    $agenda = $_POST['Agenda'];
    
    // Update the meeting in the database
    $stmt = $connection->prepare("UPDATE meetings SET Parent_ID=?, Teacher_ID=?, Date_Time=?, Agenda=? WHERE Meeting_ID=?");
    $stmt->bind_param("iisss", $parent_id, $teacher_id, $date_time, $agenda, $meeting_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: meetings.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
