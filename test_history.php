<?php
require_once 'env.php';
$directory = "assets/uploads/comics/dan_da_dan/chap_1/";
$baseURL = BASE_URL.'../';

$userInput = isset($_GET['history_page']) ? intval($_GET['history_page']) : 0;

if (is_dir($directory)) {
    $files = scandir($directory);

    $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
    $imageFiles = array_filter($files, function ($file) use ($directory, $validExtensions) {
        $filePath = $directory . $file;
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        return !in_array($file, [".", ".."]) && in_array(strtolower($fileExtension), $validExtensions);
    });

    $imageFiles = array_values($imageFiles);
    if ($userInput >= count($imageFiles)) {
        $userInput = 0;
    }
    for ($i = $userInput; $i < count($imageFiles); $i++) {
        $file = $imageFiles[$i];
        $filePath = $directory . $file;
        echo '<img src="'  . $filePath . '" alt="' . htmlspecialchars($file) . '" loading="lazy">';
    }
    for ($i = 0; $i < $userInput; $i++) {
        $file = $imageFiles[$i];
        $filePath = $directory . $file;
        echo '<img src="'  . $filePath . '" alt="' . htmlspecialchars($file) . '" loading="lazy">';
    }
} else {
    echo "Thư mục không tồn tại.";
}
?>