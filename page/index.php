<?php
include "../server/config.php";
$totalItems = "SELECT * FROM `food`";
$currentPage = $_GET['page'] ?? 1;
$itemsPerPage = 6;
$start = ($currentPage - 1) * $itemsPerPage;
$sql = "SELECT * FROM `food` LIMIT $start, $itemsPerPage ";
$result = $connection->query($sql);
$totalPages = ceil($connection->query($totalItems)->num_rows / $itemsPerPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đồ ăn nhanh</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../asset/img/icon.png">

</head>

<body>
    <?php include './navbar.php' ?>
    <div class="main" style="min-height: 100vh;">
        <div class="banner">
            <img src="../asset/img/bg.png" alt="banner">
        </div>
        <div class="food-container">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="food-item-wraper">
                    <img src="../asset/img/<?= $row['image'] ?>" alt="ga-sot-tieu">
                    <div class="item-name">
                        <?= $row['name'] ?>
                    </div>
                    <div class="item-price"><?= number_format($row['price'], 0, '.', '.'); ?> đ</div>
                    <button class="btn add-to-cart">Đặt Hàng</button>
                </div>
            <?php endwhile; ?>
        </div>
        <div>
            <div class="pagination">
                <a href="?page=<?= ($currentPage > 1) ? $currentPage - 1 : 1 ?>">&laquo;</a>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?= $i ?>" class="<?= $i == $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
                <a href="?page=<?= ($currentPage < $totalPages) ? $currentPage + 1 : $totalPages ?>">&raquo</a>
            </div>
        </div>
    </div>
    <?php include './footer.php' ?>
</body>

</html>