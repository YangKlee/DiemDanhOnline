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
      <!--Menu cho role sinh viên-->
      <?php if($_SESSION['Role'] == 1): ?>
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
      <!-- Menu cho role giảng viên -->
      <?php elseif($_SESSION['Role'] == 2): ?>
        <div class="list-group list-group-flush">
          <a href="./Teacher/Home" class="list-group-item d-flex align-items-center gap-2">
            <i class="bi bi-house-door"></i> Trang chủ
          </a>
          <div>
            <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpAccounts" aria-expanded="false">
              <span class="label"><i class="bi bi-mortarboard"></i> Quản lý giảng dạy</span>
              <i class="bi bi-chevron-down chevron"></i>
            </button>
            <div id="grpAccounts" class="collapse submenu">
              <a class="list-group-item" href="Teacher/DSMonDayHoc">Danh sách môn học giảng dạy</a>
              <a class="list-group-item" href="Teacher/DSLHP">Danh sách lớp học phần giảng dạy</a>
              
            </div>
          </div>
          <div>
            <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpAccounts1" aria-expanded="false">
              <span class="label"><i class="bi bi-list-check"></i>Quản lý điểm danh</span>
              <i class="bi bi-chevron-down chevron"></i>
            </button>
            <div id="grpAccounts1" class="collapse submenu">
              <a class="list-group-item" href="Teacher/TaoPhienDiemDanh">Tạo phiên điểm danh</a>
              <a class="list-group-item" href="Teacher/CapNhatPhienDiemDanh">Cập nhật phiên điểm danh</a>
              <a class="list-group-item" href="Teacher/QLDanhSachDiemDanh">Quản lý danh sách điểm danh</a>
            </div>
          </div>
          <a href="Teacher/ThongKeChuyenCan" class="list-group-item d-flex align-items-center gap-2">
            <i class="bi bi-graph-down"></i> Thống kê chuyên cần
          </a>
        </div>
      <!-- Menu cho role admin-->
      <?php elseif($_SESSION['Role'] == 3): ?>  
                <div class="list-group list-group-flush">
          <a href="./Admin/Home" class="list-group-item d-flex align-items-center gap-2">
            <i class="bi bi-house-door"></i> Trang chủ
          </a>
          <div class="list-group list-group-flush">
              <a href="./Admin/QuanLyDiemDanh" class="list-group-item d-flex align-items-center gap-2">
                <i class="bi bi-house-door"></i> Quản lý điểm danh
              </a>
              <a class="list-group-item" href="Admin/QuanLyHeThong/LopHocPhan">Lớp học phần</a>
          </div>
              <div> 
            <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpAccounts36" aria-expanded="false">
              <span class="label"><i class="bi bi-list-check"></i>Quản lý điểm danh</span>
              <i class="bi bi-chevron-down chevron"></i>
            </button>
            <div id="grpAccounts36" class="collapse submenu">
              <a href="./Admin/QuanLyDiemDanh/PhienDiemDanh" class="list-group-item d-flex align-items-center gap-2"> Phiên điểm danh
              </a>
              <a class="list-group-item" href="Admin/QuanLyDiemDanh/LopHocPhan">Lớp học phần</a>
               <a class="list-group-item" href="Admin/QuanLyDiemDanh/MonHoc">Môn học</a>
            </div>
          </div>
          <div> 
            <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpAccounts1" aria-expanded="false">
              <span class="label"><i class="bi bi-list-check"></i>Quản lý tài khoản</span>
              <i class="bi bi-chevron-down chevron"></i>
            </button>
            <div id="grpAccounts1" class="collapse submenu">
              <a class="list-group-item" href="Admin/QuanLyTaiKhoan/SinhVien">Quản lý tài khoản sinh viên</a>
              <a class="list-group-item" href="Admin/QuanLyTaiKhoan/GiangVien">Quản lý tài khoản giảng viên</a>
              <a class="list-group-item" href="Admin/QuanLyTaiKhoan/Admin">Quản lý tài khoản admin</a>
              <a class="list-group-item" href="Admin/QuanLyTaiKhoan/ResetMatKhau">Reser mật khẩu</a>
            </div>
          </div>
          <div>
            <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpAccounts" aria-expanded="false">
              <span class="label"><i class="bi bi-mortarboard"></i>Quản lý hệ thống</span>
              <i class="bi bi-chevron-down chevron"></i>
            </button>
            <div id="grpAccounts" class="collapse submenu">
              <a class="list-group-item" href="Admin/QuanLyHeThong/Khoa">Khoa</a>
              <a class="list-group-item" href="Admin/QuanLyHeThong/Nganh">Ngành</a>
              <a class="list-group-item" href="Admin/QuanLyHeThong/Lop">Lớp</a>
              
              <a class="list-group-item" href="Admin/QuanLyHeThong/HocKy">Học kỳ</a>
            </div>
          </div>
          
          <a href="Teacher/ThongKeChuyenCan" class="list-group-item d-flex align-items-center gap-2">
            <i class="bi bi-graph-down"></i> Thống kê
          </a>
        </div>
      <?php endif ?>  
    </aside>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
