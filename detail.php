<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Product Detail</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 1200px;
    margin: 32px auto;
    padding: 20px;
    border-radius: 20px;
    background: #FFF;
    box-shadow: 0px 0px 12.2px 0px rgba(0, 0, 0, 0.25);">
    <h1 class="mb-4">Product Detail</h1>

<?php 
include ('./formatharga/lib.php');
?>

<?php
include('dbconnect.php');

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $query = "SELECT * FROM product WHERE id = $productId";

    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
?>
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['nama']; ?>" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h2><?php echo $row['nama']; ?></h2>
                <p><strong>Harga:</strong> <?php echo rupiah($row['harga']); ?></p>
                <p><strong>Deskripsi:</strong> <?php echo $row['deskripsi']; ?></p>
                <p><strong>Stock:</strong> <?php echo $row['stock']; ?></p>
            </div>
        </div>
<?php
    } else {
        echo "Product not found";
    }
} else {
    echo "Invalid product ID";
}
?>


        <center><a href="home.php" class="btn btn-primary mt-3">Back to List</a></center>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
