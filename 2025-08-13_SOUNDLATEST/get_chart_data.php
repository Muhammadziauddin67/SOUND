<?php
include('dbconnection.php');

$query = "SELECT genre, COUNT(*) as total FROM songs_data GROUP BY genre";
$result = $con->query($query);

$chartData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chartData[] = $row;
    }
}

echo json_encode($chartData);

$con->close();
?>
