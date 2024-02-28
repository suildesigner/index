<?php
header('Content-Type: application/json');

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

$sql = "SELECT folder_name FROM FolderOrder ORDER BY order_number ASC";
$result = $conn->query($sql);

$folder_order = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $folder_order[] = $row["folder_name"];
  }
}
$conn->close();

$dir = 'member/';
$folders = array_values(array_diff(scandir($dir), array('..', '.')));
$folders = array_map(function($folder) use ($dir) {
    return ['folder' => $folder, 'time' => filemtime($dir . $folder)];
}, $folders);

usort($folders, function($a, $b) use ($folder_order) {
    $index_a = array_search($a['folder'], $folder_order);
    $index_b = array_search($b['folder'], $folder_order);
    if ($index_a === false && $index_b === false) { // both items are not in the order list - sort alphabetically
        return strcmp($a['folder'], $b['folder']);
    }
    if ($index_a === false) { // first item is not in the order list - put it at the end
        return 1;
    }
    if ($index_b === false) { // second item is not in the order list - put it at the end
        return -1;
    }
    return $index_a - $index_b; // both items are in the order list - sort according to the order
});

$folders = array_map(function($folder) {
    return $folder['folder'];
}, $folders);

$data = array('folderCount' => count($folders), 'folderNames' => $folders);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>