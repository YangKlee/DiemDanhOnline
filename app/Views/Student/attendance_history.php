<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="./public/assets/css/theme.css">
  <title>Lịch sử điểm danh</title>
</head>
<body>
<main class="page-container">
<div class="card">

<h3>Lịch sử điểm danh theo học kỳ</h3>

<?php
$hocKyList = $data['hocKyList'] ?? [];
$dsLHP     = $data['dsLHP'] ?? [];
$maHK      = $data['maHK'] ?? '';
?>

<!-- Form lọc theo học kỳ -->
<form method="GET" class="filter-form">
    <label for="hocky">Chọn học kỳ:</label>
    <select name="hocky" id="hocky" onchange="this.form.submit()">
        <option value="">-- Chọn học kỳ --</option>
        <?php foreach ($hocKyList as $hk): ?>
            <option value="<?= htmlspecialchars($hk['MaHK']) ?>"
                <?= ($maHK == $hk['MaHK']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($hk['TenHK']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<!-- Bảng hiển thị danh sách lớp học phần -->
<table class="table">
<thead>
<tr>
    <th>Mã LHP</th>
    <th>Tên học phần</th>
    <th>Giảng viên</th>
    <th>Có mặt</th>
    <th>Chức năng</th>
</tr>
</thead>
<tbody>
<?php if (!empty($dsLHP)): ?>
    <?php foreach ($dsLHP as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['MaLHP']) ?></td>
            <td><?= htmlspecialchars($row['TenMonHoc']) ?></td>
            <td><?= htmlspecialchars($row['TenGV']) ?></td>
            <td><?= intval($row['CoMat']) ?> / <?= intval($row['TongBuoi']) ?></td>
            <td>
                <a href="./Student/LichSuDiemDanh/XemChiTiet?MaLHP=<?= urlencode($row['MaLHP']) ?>">
                    Chi tiết
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5" style="text-align:center;">Chưa có dữ liệu</td>
</tr>
<?php endif; ?>
</tbody>
</table>

</div>
</main>
</body>
</html>
