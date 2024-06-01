<?php
    require "../assets/connect_db.php";

    $pdfId = isset($_GET['id']) ? $_GET['id'] : null;

    $sql = "SELECT file_content, file_name FROM it_speks_faili WHERE file_id = ?";
    $stmt = mysqli_prepare($savienojums, $sql);


    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $pdfId);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $fileContent, $fileName);

        mysqli_stmt_fetch($stmt);

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $fileName . '"');
        header('Content-Length: ' . strlen($fileContent));

        echo $fileContent;

        mysqli_stmt_close($stmt);
    }

?>