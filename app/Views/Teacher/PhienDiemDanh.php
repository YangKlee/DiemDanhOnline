<?php
$dsPhien = $data['sessions'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="./public/assets/css/theme.css">
</head>
<body>
<main class="page-container">
    <div class="card">

        <h3>Quản lý danh sách điểm danh</h3>

        <input type="text" id="searchInput" placeholder="Tìm kiếm...">

        <table class="table" id="classTable">
            <thead>
                <tr>
                    <th>Mã lớp HP</th>
                    <th>Môn học</th>
                    <th>Mã QR</th>
                    <th>Thời gian QR</th>
                    <th>Ngày</th>
                    <th>Số lượng</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dsPhien)): ?>
                    <?php foreach ($dsPhien as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['MaLHP']) ?></td>
                            <td><?= htmlspecialchars($row['TenMonHoc']) ?></td>
                            <td><?= htmlspecialchars($row['MaQR']) ?></td>
                            <td><?= isset($row['ThoiGianQR']) ? $row['ThoiGianQR'] : '-' ?></td>
                            <td><?= isset($row['Ngay']) ? date('d/m/Y', strtotime($row['Ngay'])) : '-' ?></td>
                            <td><?= htmlspecialchars($row['SoLuong']) ?></td>
                            <td>
                                <a href="./Teacher/QLDanhSachDiemDanh/XemChiTiet?MaPhien=<?= $row['MaPhien'] ?>">Chi tiết</a>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Chưa có dữ liệu điểm danh</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</main>

<script src="public/assets/js/search.js"></script>
</body>
</html>

