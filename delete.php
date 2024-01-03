<?php

$id = $_GET['id'];

include('dbconnect.php');

$query_select_thumbnail = "SELECT thumbnail FROM product WHERE id = '$id'";
$result_select_thumbnail = mysqli_query($conn, $query_select_thumbnail);

if ($row_select_thumbnail = mysqli_fetch_assoc($result_select_thumbnail)) {
    $thumbnail_filename = $row_select_thumbnail['thumbnail'];

    $query_delete = "DELETE FROM product WHERE id = '$id'";

    if (mysqli_query($conn, $query_delete)) {
        $thumbnail_path = "upload/" . $thumbnail_filename;
        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        header("location:home.php");
    } else {
        echo "ERROR, data gagal dihapus" . mysqli_error($conn);
    }
} else {
    echo "ERROR, thumbnail tidak ditemukan";
}

mysqli_close($conn);
?>
