<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="public/assets/css/GiangVien.css">
<link rel="stylesheet" href="public/assets/css/GiangVienQL.css">
</head>

<body>
<div class="main-content">

      <table class="table" id="classTable">
           <h3>Danh sách lớp học phần</h3>
    <input type="text" id="searchInput" placeholder="Tìm kiếm lớp học phần...">

      <?php
        // Lấy dữ liệu từ Controller truyền sang
        $dsLopHP = $data['dsLopHP'];
      ?>
        <thead>
          <tr>
            <th>Mã lớp HP</th>
            <th>Môn học</th>
            <th>Thứ</th>
            <th>Tiết</th>
            <th>Phòng</th>
            <th>Học kỳ</th>
            <th>Năm học</th>
          </tr>
        </thead>

        <tbody>
  <?php if (!empty($dsLopHP)): ?>
    <?php foreach ($dsLopHP as $lop): ?>
      <tr>
        <td><?= htmlspecialchars($lop['MaLHP'] ?? '') ?></td>
        <td><?= htmlspecialchars($lop['TenMonHoc'] ?? '') ?></td>
        <td><?= htmlspecialchars($lop['Thu'] ?? '') ?></td>
        <td><?= htmlspecialchars($lop['KhungTiet'] ?? '') ?></td>
        <td><?= htmlspecialchars($lop['Phong'] ?? '') ?></td>
        <td><?= htmlspecialchars($lop['TenHK'] ?? '') ?></td>
        <td><?= htmlspecialchars($lop['NamHoc'] ?? '') ?></td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="7" style="text-align:center;">
        Không có dữ liệu lớp học phần
      </td>
    </tr>
  <?php endif; ?>
</tbody>

</table>
<script src="public/assets/js/search.js"></script>
</div>


</body>
</html>
