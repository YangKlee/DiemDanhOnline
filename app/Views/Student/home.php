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
          <a class="button" href="/Student/views/student/qr_checkin.php">Quét QR</a>
          <a class="button ghost" href="/Student/LichSuDiemDanh">Xem lịch sử</a>
        </div>
      </div>
      <div class="card col-6">
        <h3 style="margin:0 0 8px;">Tổng quan chuyên cần trong tuần</h3>
        <div style="display:flex; gap:12px;">
          <span class="badge success">Có mặt: <?= $data['summary']['CoMat'] ?? 0 ?></span>
          <span class="badge danger">Vắng: <?= $data['summary']['Vang'] ?? 0 ?></span>
        </div>
      </div>
    </div>

    <div class="card">
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <h3 style="margin:0;"><i class="bi bi-clock-history"></i> Lịch sử điểm danh trong tuần</h3>
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
        <?php if (!empty($data['history'])): ?>
          <?php foreach ($data['history'] as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['TenMonHoc']) ?></td>
              <td><?= htmlspecialchars($row['TenGV']) ?></td>
              <td><?= date('d/m/Y H:i', strtotime($row['ThoiGian'])) ?></td>
              <td><?= htmlspecialchars($row['TrangThai']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4">Chưa có dữ liệu điểm danh trong tuần</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
