<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

</head>
<body>
	<?php 

	include ('./formatharga/lib.php');
	?>

	<?php

	include('dbconnect.php');


	$query = "SELECT * FROM product";

	$result = mysqli_query($conn , $query);

	?>

	<div class="containerhome">
		
		<center><h1>Online Store</h1></center>
		<div class="row">
			<div class="col-sm-4">
				<h3>Tambah Produk</h3>
				<form role="form" action="insert.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama produk</label>
						<input type="text" name="nama" class="form-control">
					</div>
					<div class="form-group">
						<label>Harga Produk</label>
						<input type="text" name="harga" class="form-control">
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<input type="text" name="deskripsi" class="form-control">
					</div>
					<div class="form-group">
						<label>Stock</label>
						<input type="text" name="stock" class="form-control">
					</div>
					<div class="form-group">
						<label>thumbnail Produk</label>
						<input type="file" name="thumbnail" class="form-control-file">
					</div>
					<button type="submit" class="btn btn-info btn-block">Tambah produk</button>
				</form>
			</div>
			<div class="col-sm-8">
				<h3>List Product</h3>
				<table class="table table-striped table-hover dtabel">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Product</th>
							<th>Gambar</th>
							<th>Harga</th>
							<th>Deskripsi</th>
							<th>Stock</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody> 
						
						<?php
							$no = 1;  
							while ($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row['nama']; ?></td>
							<td>
								<img src="<?php echo $row['thumbnail']; ?>" alt="Product Image" style="max-width: 100px; max-height: 100px;">
							</td>
							<td><?php echo rupiah ($row['harga']); ?></td>
							<td><?php echo $row['deskripsi']; ?></td>
							<td><?php echo $row['stock']; ?></td>
							
							<td>
								<a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-success" role="button">Edit</a>
								<a href="detail.php?id=<?php echo $row['id'];?>" class="btn btn-success" role="button">Detail</a>
								<a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger" role="button">Delete</a>
							</td>
						</tr>

						<?php
							}
							mysqli_close($conn); 
						?>
					</tbody>
				</table>
			</div>
			
		</div>
		
	</div>
</body>

	<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<script>
	$(document).ready(function() {
		$('.dtabel').DataTable();
	} );
	</script>

</html> 