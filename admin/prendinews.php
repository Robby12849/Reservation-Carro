<?php
include '../conn/connessione.php';

$sql = "SELECT titolo, notizia, data_di_riferimento FROM notizia";
$result = $conn->query($sql);

$newsItems = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $newsItems[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($newsItems);
?>
