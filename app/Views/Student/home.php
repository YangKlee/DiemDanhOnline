<head>
    <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>
<div style="display:flex;">
  <?php include '../../includes/sidebar.php'; ?>
  <main class="page-container">
    <div class="row">
      <div class="card col-6">
        <h3 style="margin:0 0 8px;">Điểm danh nhanh bằng QR</h3>
        <p class="muted">Quét mã QR tại lớp hoặc nhập mã phiên.</p>
        <div style="display:flex; gap:8px; margin-top:8px;">
          <!-- thêm tiền tố /Student -->
          <a class="button" href="/Student/views/student/qr_checkin.php">Quét QR</a>
          <a class="button ghost" href="/Student/views/student/attendance_history.php">Xem lịch sử</a>
        </div>
      </div>
      <div class="card col-6">
        <h3 style="margin:0 0 8px;">Tổng quan chuyên cần</h3>
        <div style="display:flex; gap:12px;">
          <span class="badge success">Có mặt: 12</span>
          <span class="badge danger">Vắng: 1</span>
        </div>
      </div>
    </div>

    <div class="card">
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <h3 style="margin:0;"><i class="bi bi-clock-history"></i>  Lịch sử điểm danh gần đây</h3>
      </div>
          <table class="table">
      <thead>
        <tr>
          <th>Môn học</th>
          <th>Giảng Viên</th>
          <th>Thời gian</th>
          <th>Trạng thái</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Lập trình ứng dụng Web</td>
          <td>Hồ Văn Lâm</td>
          <td>27/11/2025 08:00 - 15:00</td>
          <td><span class="badge success">Có mặt</span></td>
        </tr>
        <tr>
          <td>Kỹ thuật lập trình</td>
          <td>Trần Đình Luyện</td>
          <td>28/11/2025 08:00 - 08:10</td>
          <td><span class="badge danger">Vắng mặt</span></td>
        </tr>
      </tbody>
    </table>
    </div>
  </main>
</div>