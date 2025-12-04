<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sidebar Menu – Bootstrap 5</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --sidebar-width: 280px;
    }
    body { background:#f8f9fa; }
    .sidebar {
      width: var(--sidebar-width);
      max-height: 100vh;
      background: var(--sidebars-color);
      
    }
    .list-group a{

    }
    .sidebar .section-title {
      font-weight: 600;

    }
    .sidebar .list-group-item {
      border: 0;
      border-radius: 0;
      padding: .75rem 1rem;
      color: #212529;
      background: transparent;
    }
    .sidebar .list-group-item:hover 
    {
      background-color: #495c6eff !important;
      color: white !important;
    }
    /* Active (đang chọn) */
    .sidebar .list-group-item.active {
      background: #0d6efd;
      color: #fff;
    }
    /* Nút mở/đóng nhóm */
    .sidebar .toggle {
      width: 100%;
      text-align: left;
      background: transparent;
      border: 0;
      padding: .75rem 1rem;
      display: flex;
      gap: .5rem;
      align-items: center;
      justify-content: space-between;
      color: #212529;
    }
    .toggle .label {
      display: inline-flex;
      gap: .5rem;
      align-items: center;
      font-weight: 600;
    }
    .toggle:focus { box-shadow: none; }
    .toggle[aria-expanded="true"] .chevron {
      transform: rotate(180deg);
    }
    .chevron {
      transition: transform .2s ease;
    }

    /* Submenu: thụt trái + vạch dọc */
    .submenu {
      margin-left: .5rem;
      border-left: 2px solid #e9ecef;
    }
    .submenu .list-group-item {
      padding-left: 1.25rem;
    }

    /* Responsive: biến thành offcanvas trên màn nhỏ */
    @media (max-width: 991.98px) {
      .sidebar { width: 100%; min-height: auto; }
    }
  </style>
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar border-end">
      <div class="p-3 pb-2">
        <span class="section-title small text-secondary text-uppercase">Menu</span>
      </div>

      <div class="list-group list-group-flush">
        <a href="Student/Home" class="list-group-item d-flex align-items-center gap-2">
          <i class="bi bi-house-door"></i> Trang chủ
        </a>
          <a href="Student/LichSuDiemDanh" class="list-group-item d-flex align-items-center gap-2">
          <i class="bi bi-clock-history"></i> Lịch sử điểm danh
        </a>
          <a href="Student/QuetQR" class="list-group-item d-flex align-items-center gap-2">
          <i class="bi bi-qr-code-scan"></i></i> Quét QR
        </a>

      </div>
    </aside>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
