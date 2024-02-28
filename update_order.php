<?php
$servername = "localhost";
$username = "gongc00";
$password = "gongleems!4016";
$dbname = "gongc00";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$folder_name = $_POST['folder_name'];
$order_number = $_POST['order_number'];

$sql = "INSERT INTO FolderOrder (folder_name, order_number) VALUES ('$folder_name', '$order_number') ON DUPLICATE KEY UPDATE order_number = '$order_number'";


if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>