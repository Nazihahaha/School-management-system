<?php
include("database.php");

$sql = "SELECT announcement, Date FROM admin ORDER BY Date DESC";
$result = $conn->query($sql);

$count = 0;

if ($result->num_rows > 4) {
    while ($row = $result->fetch_assoc()) {
        if ($row["announcement"] !== null) {
            echo "<li>{$row["Date"]}  -   {$row['announcement']}</li>";
             $count++;
        }
        if ($count >= 4) {
            break;
        }
    }

} else {
    echo "0 results";
}

$conn->close();
?>
