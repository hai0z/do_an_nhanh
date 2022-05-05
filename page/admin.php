<?php
include_once '../server/config.php';
$totalItems = "SELECT * FROM `food`";
$currentPage = $_GET['page'] ?? 1;
$itemsPerPage = 6;
$start = ($currentPage - 1) * $itemsPerPage;
$sql = "SELECT * FROM `food` LIMIT $start, $itemsPerPage ";
$result = $connection->query($sql);
$totalPages = ceil($connection->query($totalItems)->num_rows / $itemsPerPage);
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `food` WHERE id = $id";
    $connection->query($sql);
    header('location: admin.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php include './sidebar.php' ?>
    <?php include './navbar.php' ?>
    <div class="main">
        <h1>Quản lí đồ ăn</h1>
        <table>
            <thead>
                <th>STT</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th colspan="2">Chức năng</th>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= number_format($row['price'], 0, '.', '.'); ?> đ</td>
                        <td><img src="../asset/img/<?= $row['image'] ?>" alt=""></td>
                        <td><a href="edit.php?id=<?= $row['id'] ?>">Sửa</a></td>
                        <td><a href="?delete_id=<?= $row['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xoá?')">Xóa</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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