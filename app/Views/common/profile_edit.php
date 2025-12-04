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
        $user = [
          'mssv'    => '22110123',
          'full_name' => 'Nguyễn Văn A',
          'gender'  => 'Nam',
          'dob'     => '2004-03-12',
          'phone'   => '0912345678',
          'cccd'    => '040306021045',
          'email'   => 'vana@example.com',
          'address' => 'Thôn Suối Đá, Xã Hồng Sơn, Bình Định'
        ];
      ?>

      <form method="post" action="#">
        
        <label>MSSV</label>
        <input class="input" value="<?= htmlspecialchars($user['mssv']) ?>" readonly>

        <label>Họ tên</label>
        <input class="input" value="<?= htmlspecialchars($user['full_name']) ?>">

        <label>Giới tính</label>
        <input class="input" value="<?= htmlspecialchars($user['gender']) ?>">

        <label>Ngày sinh</label>
        <input class="input" type="date" value="<?= htmlspecialchars($user['dob']) ?>">

        <label>Số điện thoại</label>
        <input class="input" value="<?= htmlspecialchars($user['phone']) ?>">

        <label>CCCD</label>
        <input class="input" value="<?= htmlspecialchars($user['cccd']) ?>">

        <label>Email</label>
        <input class="input" value="<?= htmlspecialchars($user['email']) ?>">

        <label>Địa chỉ</label>
        <input class="input" value="<?= htmlspecialchars($user['address']) ?>">

        <div style="margin-top:12px; text-align:center;">
          <button class="button">Lưu</button>
          <a class="button ghost" href="./Account/ThongTinCaNhan">Hủy</a>
        </div>

      </form>
    </div>
  </main>

</div>
</body>
</html>
