<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>

<body>
<main class="page-container">
<div class="card">

<h3>Lịch sử điểm danh theo học kỳ</h3>

<?php
// Lấy dữ liệu từ Controller
$hocKyList = $data['hocKyList'];
$dsLHP     = $data['dsLHP'];
$maHK      = $data['maHK'];
?>

<form method="GET">
    <select name="hocky" onchange="this.form.submit()">
        <option value="">-- Chọn học kỳ --</option>
        <?php foreach ($hocKyList as $hk): ?>
            <option value="<?= $hk['MaHK'] ?>"
                <?= ($maHK == $hk['MaHK']) ? 'selected' : '' ?>>
                <?= $hk['TenHK'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

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
    <td><?= $row['CoMat'] ?> / <?= $row['TongBuoi'] ?></td>
    <td>
<a href="./Student/LichSuDiemDanh/XemChiTiet?MaLHP=<?= $row['MaLHP'] ?>">
    Chi tiết
</a>



    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5">Chưa có dữ liệu</td>
</tr>
<?php endif; ?>
</tbody>
</table>

</div>
</main>
</body>
</html>
