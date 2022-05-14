<?php
include_once '../server/config.php';
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_tmp, "../asset/img/$image");
    $sql = "INSERT INTO `food`(`name`, `price`, `image`) VALUES ('$name','$price','$image')";
    $result = $connection->query($sql);
    if ($result) {
        $success = true;
    } else {
        $success = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Food</title>
    <link rel="stylesheet" href="../css/add.css">
    <link rel="icon" href="../asset/img/icon.png">

</head>

<body>
    <?php include './navbar.php' ?>
    <div class="main">
        <h1>Thêm Đồ Ăn</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên Đồ Ăn</label> <br>
                <input type="text" name="name" id="name" placeholder="Tên Đồ Ăn" class="form-inp" required>
                <span class="border"></span>
            </div>
            <div class="form-group">
                <label for="price">Giá</label><br>
                <input type="number" name="price" id="price" placeholder="Giá" class="form-inp" required>
                <span class="border"></span>
            </div>
            <div class="form-group">
                <label for="image">Ảnh</label> <br>
                <input type="file" name="image" id="image" class="form-inp" required>
                <span class="border"></span>
            </div>
            <div class="form-group">
                <?php if (isset($success) && $success) : ?>
                    <div>
                        Thêm thành công
                    </div>
                <?php else : ?>
                    <?php if (isset($success) && !$success) : ?>
                        <div>
                            Thêm thất bại
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
            <div class="form-group">
                <input type="submit" value="Thêm" name="add" class="btn-add">
            </div>
        </form>
    </div>
    <?php include './footer.php' ?>
</body>

</html>