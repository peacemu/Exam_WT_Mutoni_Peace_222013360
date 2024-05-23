<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>attachments Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="dimgray">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/parent.teacher-HEADER.jpg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attachments.php">Attachments</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendance.php">Attendance</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./calendar.php">Calendar</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./meetings.php">Meetings</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">feedback</a>
  </li>  <li style="display: inline; margin-right: 10px;"><a href="./notifications.php">Notifications</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./messages.php">Messages</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./parents.php">Parents</a>
  </li>
<li style="display: inline; margin-right: 10px;"><a href="./teachers.php">Teachers</a>
  </li>
   
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
   <h1><u>Attachments Form</u></h1>



<form method="post" onsubmit="return confirmInsert();">

    <label for="Attachment_ID">Attachment_ID:</label>
    <input type="number" id="Attachment_ID" name="Attachment_ID" required><br><br>

    <label for="Message_ID">Message_ID:</label>
    <input type="number" id="Message_ID" name="Message_ID" required><br><br>

    <label for="File_Name">File_Name:</label>
    <input type="text" id="File_Name" name="File_Name" required><br><br>

    <label for="File_Type">File_Type:</label>
    <input type="text" id="File_Type" name="File_Type" required><br><br>

    <label for="File_Path">File_Path:</label>
    <input type="text" id="File_Path" name="File_Path" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>


<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO attachments(Attachment_ID, Message_ID, File_Name, File_Type, File_Path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $Attachment_ID, $Message_ID, $File_Name, $File_Type, $File_Path);

    // Set parameters and execute
    $Attachment_ID = $_POST['Attachment_ID'];
    $Message_ID = $_POST['Message_ID'];
    $File_Name = $_POST['File_Name'];
    $File_Type = $_POST['File_Type'];
    $File_Path = $_POST['File_Path'];

    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Driver Profiles</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Attachments Table</h2></center>
    <table border="3">
        <tr>
            <th>Attachment_ID</th>
            <th>Message_ID</th>
            <th>File_Name</th>
            <th>File_Type</th>
            <th>File_Path</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all attachments
$sql = "SELECT * FROM attachments";
$result = $connection->query($sql);

// Check if there are any attachments
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $Attachment_ID = $row['Attachment_ID']; // Fetch the Attachment_ID
        echo "<tr>
        
            <td>" . $row['Attachment_ID'] . "</td>
            <td>" . $row['Message_ID'] . "</td>
            <td>" . $row['File_Name'] . "</td>
            <td>" . $row['File_Type'] . "</td>
            <td>" . $row['File_Path'] . "</td>

            <td><a style='padding:4px' href='delete_attachments.php?Attachment_ID=$Attachment_ID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_attachments.php?Attachment_ID=$Attachment_ID'>Update</a></td> 
        </tr>";
    }

} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
}
// Close the database connection
$connection->close();
?>
    </table>
</body>

</section>
 
<footer>
  <center> 
   <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:MUTONI PEACE</h2></b>
  </center>
</footer>
  
</body>
</html>

