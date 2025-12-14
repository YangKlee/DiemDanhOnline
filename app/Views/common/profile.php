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

        $user = $data['studentData'];
      ?>

      <table class="table">
        <tr>
          <th>MSSV</th>
          <td><?= htmlspecialchars($user['UserID']) ?></td>
        </tr>

        <tr>
          <th>Họ tên</th>
          <td><?= htmlspecialchars($user['Ho'] . ' ' . $user['Ten']) ?></td>
        </tr>

        <tr>
          <th>Giới tính</th>
          <td><?= htmlspecialchars($user['GioiTinh']) ?></td>
        </tr>

        <tr>
          <th>Ngày sinh</th>
          <td><?= htmlspecialchars($user['NgaySinh']) ?></td>
        </tr>

        <tr>
          <th>Số điện thoại</th>
          <td><?= htmlspecialchars($user['SoDT']) ?></td>
        </tr>

        <tr>
          <th>CCCD</th>
          <td><?= htmlspecialchars($user['CCCD']) ?></td>
        </tr>

        <tr>
          <th>Email</th>
          <td><?= htmlspecialchars($user['Email']) ?></td>
        </tr>

        <tr>
          <th>Địa chỉ</th>
          <td><?= htmlspecialchars($user['DiaChi']) ?></td>
        </tr>
        <?php if ($_SESSION['Role'] == 1): ?>
                  <tr>
          <th>Lớp</th>
          <td><?= htmlspecialchars($user['TenLop']) ?></td>
        </tr>
          <tr>
          <th>Ngành</th>
          <td><?= htmlspecialchars($user['TenNganh']) ?></td>
        </tr>

      <?php elseif ($_SESSION['Role'] == 2): ?>
        <tr>
          <th>Khoa</th>
          <td><?= htmlspecialchars($user['TenKhoa']) ?></td>
        </tr>
      <?php else: ?>

      <?php endif; ?>
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
