
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Đổi mật khẩu</title>
  <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>
<body>
<div style="display:flex;">
  <main class="page-container">
    <div class="form-center">
      <h3>Đổi mật khẩu</h3>
      <form method="post" action="">
        <input type="hidden" name="action" value="change_password">
        <label>Mật khẩu cũ: </label>
        <input class="input" type="password" name="old_password" required>
        <label>Mật khẩu mới: </label>
        <input class="input" type="password" name="new_password" required>
        <label>Xác nhận mật khẩu mới: </label>
          <input class="input" type="password" name="re_new_password" required>
        <div style="margin-top:12px; text-align:center;">
          <button class="button">Xác nhận</button>
        </div>
      </form>
    </div>
  </main>
</div>
</body>
</html>
