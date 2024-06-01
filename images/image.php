<?php
    require "../assets/connect_db.php";

    $imageId = isset($_GET['id']) ? $_GET['id'] : null;

    $sql = "SELECT file_content, file_type FROM it_speks_faili WHERE file_id = ?";
    $stmt = mysqli_prepare($savienojums, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $imageId);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $imageContent, $imageType);

        mysqli_stmt_fetch($stmt);

        header('Content-Type: ' . $imageType);

        echo $imageContent;

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement.";
    }

    mysqli_close($savienojums);
?>