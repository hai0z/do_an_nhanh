<?php
include_once '../server/config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `food` WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
}
if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    if ($image == '') {
        $sql = "UPDATE `food` SET `name` = '$name', `price` = '$price' WHERE `id` = $id";
        if ($connection->query($sql)) {
            $success = true;
        } else {
            $success = false;
        }
    } else {
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "../asset/img/$image");
        $sql = "UPDATE `food` SET `name` = '$name', `price` = '$price', `image` = '$image' WHERE `food`.`id` = $id";
        if ($connection->query($sql)) {
            $success = true;
        } else {
            $success = false;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit.css">
    <title>Sửa</title>
</head>

<body>
    <?php include './navbar.php' ?>
    <?php include './sidebar.php' ?>
    <div class="main">
        <h1>Sửa</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên Đồ Ăn</label> <br>
                <input type="text" name="name" id="name" placeholder="Tên Đồ Ăn" class="form-inp" value="<?php echo $row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Giá</label><br>
                <input type="number" name="price" id="price" placeholder="Giá" class="form-inp" required value="<?php echo $row['price'] ?>">
            </div>
            <div class="form-group">
                <label for="image">Ảnh</label> <br>
                <img src="../asset/img/<?php echo $row['image'] ?>" alt="">
                <input type="file" name="image" id="image" class="form-inp">
            </div>

            <div class="form-group">
                <?php if (isset($success) && $success) : ?>
                    <div>
                        Sửa thành công
                    </div>
                <?php else : ?>
                    <?php if (isset($success) && !$success) : ?>
                        <div>
                            Sửa thất bại
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Sửa" name="edit" class="btn-add">
            </div>
        </form>
</body>

</html>