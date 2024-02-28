<?php
$folderName = $_POST['folderName'];
$target_dir = "member/" . $folderName . "/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

foreach ($_FILES['files']['name'] as $i => $name) {
    if (strlen($_FILES['files']['name'][$i]) > 1) {
        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_dir.$name)) {
            echo "File uploaded successfully!";
        }
    }
}
?>