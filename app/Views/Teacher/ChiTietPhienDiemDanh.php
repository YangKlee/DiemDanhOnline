
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
$detail = $data['detail'];
?>

        <input type="text" id="searchInput" placeholder="Tìm kiếm sinh viên...">

        <table class="table" id="classTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                    <th>Vị trí</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($detail)): ?>
                <?php foreach ($detail as $index => $row): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($row['MSSV']) ?></td>
                    <td><?= htmlspecialchars($row['TenSV']) ?></td>
                    <td><?= htmlspecialchars($row['TrangThai']) ?></td>
                    <td><?= isset($row['ThoiGian']) ? date('d/m/Y H:i', strtotime($row['ThoiGian'])) : '-' ?></td>
                    <td><?= htmlspecialchars($row['ViTri'] ?? '-') ?></td>
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
