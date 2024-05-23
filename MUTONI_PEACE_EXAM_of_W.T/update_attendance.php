<?php
include('db_connection.php');

// Check if Attendance_ID is set
if(isset($_REQUEST['Attendance_ID'])) {
    $attendance_id = $_REQUEST['Attendance_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM attendance WHERE Attendance_ID=?");
    $stmt->bind_param("i", $attendance_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student_id = $row['Student_ID'];
        $teacher_id = $row['Teacher_ID'];
        $date = $row['Date'];
        $status = $row['Status'];
    } else {
        echo "Attendance record not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Attendance Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update attendance form -->
    <h2><u>Update Form for Attendance</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

         <label for="Student_ID">Student ID:</label>
        <input type="number" name="Student_ID" value="<?php echo isset($student_id) ? $student_id : ''; ?>">
        <br><br>

        <label for="Teacher_ID">Teacher ID:</label>
        <input type="number" name="Teacher_ID" value="<?php echo isset($teacher_id) ? $teacher_id : ''; ?>">
        <br><br>

        <label for="Date">Date:</label>
        <input type="text" name="Date" value="<?php echo isset($date) ? $date : ''; ?>">
        <br><br>

        <label for="Status">Status:</label>
        <input type="text" name="Status" value="<?php echo isset($status) ? $status : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $student_id = $_POST['Student_ID'];
    $teacher_id = $_POST['Teacher_ID'];
    $date = $_POST['Date'];
    $status = $_POST['Status'];
    
    // Update the attendance record in the database
    $stmt = $connection->prepare("UPDATE attendance SET Student_ID=?, Teacher_ID=?, Date=?, Status=? WHERE Attendance_ID=?");
    $stmt->bind_param("iissi", $student_id, $teacher_id, $date, $status, $attendance_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: attendance.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
