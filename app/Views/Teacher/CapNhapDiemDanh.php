<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/GiangVien.css">
    <link rel="stylesheet" href="public/assets/css/GiangVienQL.css">

</head>

<body>

            <?php
                $dsPhien = $data['dsPhien'] ?? '';
             ?>

    <div class="page-container">
        <table class="table" id="classTable">
            <h3>Cập nhật điểm danh</h3>
            <input type="text" id="searchInput" placeholder="Tìm kiếm mã lớp, mã QR, ngày hoặc sinh viên...">
            <thead>
                <tr>
                    <th>Mã phiên</th>
                    <th>Mã LHP</th>
                    <th>Mã QR</th>
                    <th>Ngày</th>
                    <th>Hạn QR</th>
                    <th>Số lượng</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($dsPhien)): ?>
                    <?php foreach ($dsPhien as $phien): ?>
                        <tr>
                           <td><?= htmlspecialchars($phien['MaPhien'] ?? '') ?></td>
                            <td><?= htmlspecialchars($phien['MaLHP'] ?? '') ?></td>
                            <td><?= htmlspecialchars($phien['MaQR'] ?? 'Chưa tạo') ?></td>
                            <td><?= htmlspecialchars($phien['Ngay'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($phien['SuaHanQR'] ?? '0') ?> phút</td>
                            <td><?= htmlspecialchars($phien['SoLuong'] ?? '0/0') ?></td>
                            <td><a href="<?php echo htmlspecialchars($phien['ChiTiet']); ?>">Xem chi tiết</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Chưa có phiên điểm danh nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    </div>
<script src="public/assets/js/search.js"></script>
</body>

</html>