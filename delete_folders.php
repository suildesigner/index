<?php
$folderNames = $_POST['folderNames'];
foreach ($folderNames as $folderName) {
    $target_dir = "member/" . $folderName;
    if (is_dir($target_dir)) {
        $objects = scandir($target_dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (!is_dir($target_dir."/".$object))
                    unlink($target_dir."/".$object);
            }
        }
        rmdir($target_dir);
    }
}
echo "Folders deleted successfully!";
?>