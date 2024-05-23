<?php
include('db_connection.php');

// Check if Parent ID is set
if(isset($_REQUEST['Parent_ID'])) {
    $parent_id = $_REQUEST['Parent_ID'];
    
    $stmt = $connection->prepare("SELECT * FROM parents WHERE Parent_ID=?");
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
    } else {
        echo "Parent not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Parents Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update parents form -->
    <h2><u>Update Form for Parents</u></h2>
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
    
    // Update the parent in the database
    $stmt = $connection->prepare("UPDATE parents SET Name=?, Email=?, Phone=? WHERE Parent_ID=?");
    $stmt->bind_param("sssi", $name, $email, $phone, $parent_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: parents.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
