<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/GiangVien.css">
    <link rel="stylesheet" href="public/assets/css/GiangVienQL.css">
</head>
<body>
<div class="main-content">
      <?php
        // Lấy dữ liệu từ Controller truyền sang
        $dsMon = $data['dsMon'];
      ?>

<table class="table" id="classTable">
    <h3>Quản lý môn học</h3>

<input type="text" id="searchInput" placeholder="Tìm kiếm môn học...">
    <thead>
        <tr>
            <th>Mã môn</th>
            <th>Tên môn học</th>
            <th>Số tín chỉ</th>
            <th>Khoa</th>
            <th>Số lớp học phần</th>
        </tr>
    </thead>

        <tbody>
          <?php if (!empty($dsMon)): ?>
            <?php foreach ($dsMon as $lop): ?>
              <tr>
                <td><?= htmlspecialchars($lop['MaMonHoc']) ?></td>
                <td><?= htmlspecialchars($lop['TenMonHoc']) ?></td>
                <td><?= htmlspecialchars($lop['SoTC']) ?></td>
                <td><?= htmlspecialchars($lop['TenKhoa']) ?></td>
                <td><?= htmlspecialchars($lop['SoLopHP']) ?></td>
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
