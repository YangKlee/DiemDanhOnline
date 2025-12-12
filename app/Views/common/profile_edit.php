<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Cập nhật thông tin</title>
  <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>
<body>
<div style="display:flex;">

  <?php include '../../includes/sidebar.php'; ?>

  <main class="page-container">
    <div class="form-center">
      <h3>Cập nhật thông tin</h3>

      <?php
        // DEMO DATA
        $user = $data['studentData'];
      ?>

      <form method="post">
        
        <label>MSSV</label>
        <input class="input"  readonly value="<?= htmlspecialchars($user['UserID']) ?>" readonly>

        <label>Họ</label>
        <input class="input" name="Ho" value="<?= htmlspecialchars($user['Ho']) ?>">

        <label>Tên</label>
        <input class="input" name="Ten" value="<?= htmlspecialchars($user['Ten']) ?>">

        <!-- <label>Giới tính</label>
        <input class="input" name="GioiTinh" value="<?= htmlspecialchars($user['GioiTinh']) ?>"> -->
        <label for="">Giới tính</label>
        <select class="input" name="GioiTinh" id="">
          <option <?= $user['GioiTinh'] === 'Nam' ? 'selected' : '' ?> value="Nam">Nam</option>
          <option <?= $user['GioiTinh'] === 'Nữ' ? 'selected' : '' ?> value="Nữ">Nữ</option>
        </select>

        <label>Ngày sinh</label>
        <input class="input" type="date" name="NgaySinh" value="<?= htmlspecialchars($user['NgaySinh']) ?>">

        <label>Số điện thoại</label>
        <input class="input" name="SoDT" value="<?= htmlspecialchars($user['SoDT']) ?>">

        <label>CCCD</label>
        <input class="input"  name="CCCD" value="<?= htmlspecialchars($user['CCCD']) ?>">

        <label>Email</label>
        <input class="input" name="Email" value="<?= htmlspecialchars($user['Email']) ?>">

        <label>Địa chỉ</label>
        <input class="input" name="DiaChi" value="<?= htmlspecialchars($user['DiaChi']) ?>">

        <div style="margin-top:12px; text-align:center;">
          <button type="submit" class="button">Lưu</button>
          <a class="button ghost" href="./Account/ThongTinCaNhan">Hủy</a>
        </div>

      </form>
    </div>
  </main>

</div>
</body>
</html>
