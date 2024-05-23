<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Notifications Page</title>
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
<h1><u>Notifications Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">

    <label for="Notification_ID">Notification ID:</label>
    <input type="number" id="Notification_ID" name="Notification_ID" required><br><br>

    <label for="Parent_ID">Parent ID:</label>
    <input type="number" id="Parent_ID" name="Parent_ID" required><br><br>

    <label for="Teacher_ID">Teacher ID:</label>
    <input type="number" id="Teacher_ID" name="Teacher_ID" required><br><br>

    <label for="Message">Message:</label>
    <input type="text" id="Message" name="Message" required><br><br>

    <label for="Timestamp">Timestamp:</label>
    <input type="datetime-local" id="Timestamp" name="Timestamp" required><br><br>

    <label for="Read_Status">Read Status:</label>
    <input type="text" id="Read_Status" name="Read_Status" required><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO notifications(Notification_ID, Parent_ID, Teacher_ID, Message, Timestamp, Read_Status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisss", $Notification_ID, $Parent_ID, $Teacher_ID, $Message, $Timestamp, $Read_Status);
    // Set parameters and execute
    $Notification_ID = $_POST['Notification_ID'];
    $Parent_ID = $_POST['Parent_ID'];
    $Teacher_ID = $_POST['Teacher_ID'];
    $Message = $_POST['Message'];
    $Timestamp = $_POST['Timestamp'];
    $Read_Status = $_POST['Read_Status'];
    
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
    <title>Notifications Table</title>
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
    <center><h2>Notifications Table</h2></center>
    <table border="3">
        <tr>
            <th>Notification ID</th>
            <th>Parent ID</th>
            <th>Teacher ID</th>
            <th>Message</th>
            <th>Timestamp</th>
            <th>Read Status</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('db_connection.php');

        // Prepare SQL query to retrieve all notifications
        $sql = "SELECT * FROM notifications";
        $result = $connection->query($sql);

        // Check if there are any notifications
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $Notification_ID = $row['Notification_ID']; // Fetch the Notification_ID
                echo "<tr>
                    <td>" . $row['Notification_ID'] . "</td>
                    <td>" . $row['Parent_ID'] . "</td>
                    <td>" . $row['Teacher_ID'] . "</td>
                    <td>" . $row['Message'] . "</td>
                    <td>" . $row['Timestamp'] . "</td>
                    <td>" . $row['Read_Status'] . "</td>
                    <td><a style='padding:4px' href='delete_notifications.php?Notification_ID=$Notification_ID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_notifications.php?Notification_ID=$Notification_ID'>Update</a></td> 
                </tr>";
            }

        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
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


