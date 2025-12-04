<head>
    <link rel="stylesheet" href="./public/assets/css/theme.css">
    <script defer src="./public/assets/js/qr.js"></script>
</head>
<main class="page-container">
  <div class="row">
    <div class="card col-6">
      <h3>Quét mã QR</h3>
      <video id="camera" width="100%" style="border-radius:12px; background:#000;" autoplay muted playsinline></video>
      <div style="margin-top:8px; display:flex; gap:8px;">
        <button class="button" id="startScan">Bắt đầu quét</button>
        <button class="button ghost" id="stopScan">Dừng</button>
      </div>
      <p id="scanResult" class="muted" style="margin-top:8px;"></p>
    </div>
    <div class="card col-6">
      <h3>Nhập mã phiên thủ công</h3>
      <!-- thêm tiền tố /student-portal vào action -->
      <form method="post" action="/student-portal/views/student/qr_confirm.php">
        <label>Mã phiên (ví dụ: DD101)</label>
        <input class="input" name="session_code" required>
        <div style="margin-top:8px;">
          <button class="button">Xác nhận</button>
        </div>
      </form>
      <div class="badge warning" style="margin-top:12px;">Lưu ý: Cửa sổ QR có thể chỉ mở 10 giây</div>
    </div>
  </div>
</main>