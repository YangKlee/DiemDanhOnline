
<!DOCTYPE html>
<html lang="vi">
<head>
  <base href="<?php global $publicBase; echo $publicBase; ?>/" />
  <meta charset="utf-8">
  <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>
<body>
<div style="display:flex;">
  
  <main class="page-container">
    <div class="form-center">
      <h3>Đăng nhập</h3>
      <form method="post" action="">
        <input type="hidden" name="action" value="login">
        <label>Tài khoản</label>
        <input class="input" name="username" required>
        <label>Mật khẩu</label>
        <input class="input" type="password" name="password" required>
        <div style="margin-top:12px; text-align:center;">
          <button class="button">Đăng nhập</button>
        </div>
      </form>
    </div>
  </main>
</div>
</body>
</html>
