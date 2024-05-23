<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {

 include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'attachments' => "SELECT File_Name FROM attachments WHERE File_Name LIKE '%$searchTerm%'",
        'attendance' => "SELECT Attendance_ID FROM attendance WHERE Attendance_ID LIKE '%$searchTerm%'",
        'calendar' => "SELECT Event_Name FROM calendar WHERE  Event_Name LIKE '%$searchTerm%'",
        'feedback' => "SELECT Feedback_Content FROM feedback WHERE Feedback_Content LIKE '%$searchTerm%'",
        'meetings' => "SELECT Meeting_ID FROM meetings WHERE Meeting_ID LIKE '%$searchTerm%'",
        'messages' => "SELECT Message_Content FROM messages WHERE Message_Content LIKE '%$searchTerm%'",
        'notifications' => "SELECT Notification_ID FROM notifications WHERE Notification_ID LIKE '%$searchTerm%'",
        'parents' => "SELECT Name FROM parents WHERE Name LIKE '%$searchTerm%'",
        'teachers' => "SELECT Name FROM teachers WHERE Name LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>



