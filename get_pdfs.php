<?php
$folder = $_GET['folder'];
$dir = "member/$folder/";
$files = scandir($dir);
$pdfs = array_filter($files, function($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
});
$data = array('pdfCount' => count($pdfs), 'pdfNames' => array_values($pdfs));
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>