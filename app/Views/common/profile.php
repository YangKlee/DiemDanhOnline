<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Thông tin cá nhân</title>
  <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>
<body>
<div style="display:flex;">

  <main class="page-container">
    <div class="profile-center">
      <h3>Thông tin cá nhân</h3>

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

      <table class="table">
        <tr>
          <th>MSSV</th>
          <td><?= htmlspecialchars($user['mssv']) ?></td>
        </tr>

        <tr>
          <th>Họ tên</th>
          <td><?= htmlspecialchars($user['full_name']) ?></td>
        </tr>

        <tr>
          <th>Giới tính</th>
          <td><?= htmlspecialchars($user['gender']) ?></td>
        </tr>

        <tr>
          <th>Ngày sinh</th>
          <td><?= htmlspecialchars($user['dob']) ?></td>
        </tr>

        <tr>
          <th>Số điện thoại</th>
          <td><?= htmlspecialchars($user['phone']) ?></td>
        </tr>

        <tr>
          <th>CCCD</th>
          <td><?= htmlspecialchars($user['cccd']) ?></td>
        </tr>

        <tr>
          <th>Email</th>
          <td><?= htmlspecialchars($user['email']) ?></td>
        </tr>

        <tr>
          <th>Địa chỉ</th>
          <td><?= htmlspecialchars($user['address']) ?></td>
        </tr>
      </table>

      <div style="margin-top:12px; text-align:center;">
        <a class="button" href="./Account/ThongTinCaNhan/EditInfo">Cập nhật thông tin</a>
        <a class="button ghost" href="./Account/ChangePassword">Đổi mật khẩu</a>
      </div>
    </div>
  </main>

</div>
</body>
</html>
