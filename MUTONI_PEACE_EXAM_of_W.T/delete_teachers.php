<?php
include('db_connection.php');

// Check if Teacher ID is set
if(isset($_REQUEST['teacher_id'])) {
    $teacher_id = $_REQUEST['teacher_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM teachers WHERE Teacher_ID=?");
    $stmt->bind_param("i", $teacher_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Teacher ID is not set.";
}

$connection->close();
?>
