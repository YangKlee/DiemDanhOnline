<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>

<body>
<main class="page-container">
<div class="card">

<h3>Chi tiết điểm danh học phần</h3>

<?php
// Lấy dữ liệu từ Controller
$chiTiet = $data['chiTiet'];
$maLHP   = $data['MaLHP'];
?>


<table class="table">
<thead>
    <tr>
        <th>Mã phiên</th>
        <th>Thời gian</th>
        <th>Trạng thái</th>
    </tr>
</thead>
    <td>
        <tbody>
        <?php if (!empty($chiTiet)): ?>
            <?php foreach ($chiTiet as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['MaPhien']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($row['ThoiGian'])) ?></td>
                <td><?= htmlspecialchars($row['TrangThai']) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Chưa có dữ liệu điểm danh</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </td>
</table>

</div>
</main>
</body>
</html>
