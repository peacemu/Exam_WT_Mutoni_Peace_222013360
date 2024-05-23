<?php
include('db_connection.php');

// Check if Event_ID is set
if(isset($_REQUEST['Event_ID'])) {
    $event_id = $_REQUEST['Event_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM calendar WHERE Event_ID=?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $event_name = $row['Event_Name'];
        $description = $row['Description'];
        $start_date = $row['Start_Date'];
        $end_date = $row['End_Date'];
        $parent_id = $row['Parent_ID'];
        $teacher_id = $row['Teacher_ID'];
    } else {
        echo "Event not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Calendar Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update calendar event form -->
    <h2><u>Update Form for Calendar Event</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="Event_Name">Event Name:</label>
        <input type="text" name="Event_Name" value="<?php echo isset($event_name) ? $event_name : ''; ?>">
        <br><br>

        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($description) ? $description : ''; ?>">
        <br><br>

        <label for="Start_Date">Start Date:</label>
        <input type="text" name="Start_Date" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
        <br><br>

        <label for="End_Date">End Date:</label>
        <input type="text" name="End_Date" value="<?php echo isset($end_date) ? $end_date : ''; ?>">
        <br><br>

        <label for="Parent_ID">Parent ID:</label>
        <input type="number" name="Parent_ID" value="<?php echo isset($parent_id) ? $parent_id : ''; ?>">
        <br><br>

        <label for="Teacher_ID">Teacher ID:</label>
        <input type="number" name="Teacher_ID" value="<?php echo isset($teacher_id) ? $teacher_id : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $event_name = $_POST['Event_Name'];
    $description = $_POST['Description'];
    $start_date = $_POST['Start_Date'];
    $end_date = $_POST['End_Date'];
    $parent_id = $_POST['Parent_ID'];
    $teacher_id = $_POST['Teacher_ID'];
    
    // Update the calendar event in the database
    $stmt = $connection->prepare("UPDATE calendar SET Event_Name=?, Description=?, Start_Date=?, End_Date=?, Parent_ID=?, Teacher_ID=? WHERE Event_ID=?");
    $stmt->bind_param("sssiiii", $event_name, $description, $start_date, $end_date, $parent_id, $teacher_id, $event_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: calendar.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
