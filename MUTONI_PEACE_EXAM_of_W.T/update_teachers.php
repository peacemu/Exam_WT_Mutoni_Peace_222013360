<?php
include('db_connection.php');

// Check if Teacher ID is set
if(isset($_REQUEST['Teacher_ID'])) {
    $teacher_id = $_REQUEST['Teacher_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM teachers WHERE Teacher_ID=?");
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $subject = $row['Subject'];
    } else {
        echo "Teacher not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in teachers Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update teachers form -->
    <h2><u>Update Form for Teachers</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo isset($name) ? $name : ''; ?>">
        <br><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>

        <label for="Phone">Phone:</label>
        <input type="text" name="Phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
        <br><br>

        <label for="Subject">Subject:</label>
        <input type="text" name="Subject" value="<?php echo isset($subject) ? $subject : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $subject = $_POST['Subject'];
    
    // Update the teacher in the database
    $stmt = $connection->prepare("UPDATE teachers SET Name=?, Email=?, Phone=?, Subject=? WHERE Teacher_ID=?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $subject, $teacher_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: teachers.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
