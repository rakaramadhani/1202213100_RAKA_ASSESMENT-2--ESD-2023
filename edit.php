<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Edit Product Form</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>

<?php

include('dbconnect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the form
	$id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];


    $query_select_thumbnail = "SELECT thumbnail FROM product WHERE id='$id'";
    $result_select_thumbnail = mysqli_query($conn, $query_select_thumbnail);

    if ($row_select_thumbnail = mysqli_fetch_assoc($result_select_thumbnail)) {
        $old_thumbnail_filename = $row_select_thumbnail['thumbnail'];

        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
            $old_thumbnail_path = "upload/" . $old_thumbnail_filename;
            if (file_exists($old_thumbnail_path)) {
                unlink($old_thumbnail_path);
            }

            $thumbnail_name = $_FILES['thumbnail']['name'];
            $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
            $thumbnail_destination = "upload/" . $thumbnail_name;
            move_uploaded_file($thumbnail_tmp, $thumbnail_destination);
            $query_update = "UPDATE product SET nama='$nama', harga='$harga', deskripsi='$deskripsi', stock='$stock',thumbnail='$thumbnail_destination' WHERE id='$id'";
        } else {
            $query_update = "UPDATE product SET nama='$nama', harga='$harga', deskripsi='$deskripsi', stock='$stock' WHERE id='$id'";
        }

        $result_update = mysqli_query($conn, $query_update);

        if ($result_update) {
            echo "Produk berhasil diupdate";
        } else {
            echo "Gagal mengupdate produk";
        }
    } else {
        echo "Thumbnail tidak ditemukan";
    }
    mysqli_close($conn);
    header("Location: home.php");
    exit(); 
} else {
    $id = $_GET['id'];
    $query_select = "SELECT * FROM product WHERE id='$id'";
    $result_select = mysqli_query($conn, $query_select);

    if ($row = mysqli_fetch_assoc($result_select)) {

        ?>
			<body>
				<div class="container">
					<form role="form" action="edit.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
						
						<div class="form-group">
							<label for="nama">Nama produk</label>
							<input type="text" name="nama" value="<?php echo $row['nama']; ?>" class="form-control" id="nama" required>
						</div>
						<div class="form-group">
							<label for="harga">Harga Produk</label>
							<input type="text" name="harga" value="<?php echo $row['harga']; ?>" class="form-control" id="harga" required>
						</div>
						<div class="form-group">
							<label for="deskripsi">Deskripsi</label>
							<input type="text" name="deskripsi" value="<?php echo $row['deskripsi']; ?>" class="form-control" id="deskripsi" required>
						</div>
						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="text" name="stock" value="<?php echo $row['stock']; ?>" class="form-control" id="stock" required>
						</div>
						<div class="form-group">
							<label for="thumbnail">Thumbnail Produk</label>
							<input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
						</div>
						<button type="submit" class="btn btn-info btn-block">Update produk</button>
					</form>
				</div>

				<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			</body>
			
        <?php
    } else {
        echo "Produk tidak ditemukan";
    }

    mysqli_close($conn);

}
?>

</html>
