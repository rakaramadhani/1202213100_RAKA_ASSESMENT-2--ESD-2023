<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('dbconnect.php');

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

    if (isset($_FILES['thumbnail'])) {
        $thumbnail_name = $_FILES['thumbnail']['name'];
        $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_size = $_FILES['thumbnail']['size'];
        $thumbnail_error = $_FILES['thumbnail']['error'];

        $thumbnail_destination = "upload/" . $thumbnail_name;

        move_uploaded_file($thumbnail_tmp, $thumbnail_destination);


        $query = "INSERT INTO product (nama, harga, deskripsi, stock, thumbnail) VALUES ('$nama', '$harga', '$deskripsi','$stock', '$thumbnail_destination')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Produk berhasil ditambahkan";
        } else {
            echo "Gagal menambahkan produk";
        }
    } else {
        echo "No thumbnail uploaded.";
    }


    mysqli_close($conn);


    header("Location: home.php");
    exit(); 
}
?>
