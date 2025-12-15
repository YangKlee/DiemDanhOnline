<head>
    <link rel="stylesheet" href="./public/assets/css/TrangChuGV.css">
</head>
<div class="main-content">

    <!-- Header chào giảng viên -->
    <div class="home-header">
        <div>
            <h1>Xin chào,</h1>
            <p>Chào mừng bạn đến với hệ thống điểm danh sinh viên</p>
        </div>
    </div>
      <?php
        // Lấy dữ liệu từ Controller truyền sang
        $thongKeGV = $data['thongKeGV'];
      ?>
    <!-- Thống kê nhanh -->
<div class="stats-container">
    <div class="stat-box">
        <h2><?= htmlspecialchars($thongKeGV['TongLopHocPhan'] ?? 0) ?></h2>
        <p>Lớp học phần</p>
    </div>

    <div class="stat-box">
        <h2><?= htmlspecialchars($thongKeGV['TongMonHoc'] ?? 0) ?></h2>
        <p>Môn học</p>
    </div>

    <div class="stat-box">  
        <h2><?= htmlspecialchars($thongKeGV['SoBuoiDiemDanhTrongNgay'] ?? 0) ?></h2>
        <p>Buổi điểm danh hôm nay</p>
    </div>

    <div class="stat-box">
        <h2><?= htmlspecialchars($thongKeGV['TyLeChuyenCanTrongNgay'] ?? '0%') ?></h2>
        <p>Tỷ lệ chuyên cần</p>
    </div>
</div>


    <h2>Truy cập nhanh</h2>
    <!-- Dashboard chức năng -->
    <div class="feature-grid">

        <a href="Teacher/DSMonDayHoc" class="feature-card">
            <h3>Quản lý lớp học phần</h3>
            <p>Xem danh sách lớp học phần giảng dạy</p>
        </a>

        <a href="Teacher/TaoPhienDiemDanh" class="feature-card">
            <h3>Tạo phiên điểm danh</h3>
            <p>Tạo & cập nhật biểu điểm danh</p>
        </a>    

        <a href="Teacher/QLDanhSachDiemDanh" class="feature-card">
            <h3>Danh sách điểm danh</h3>
            <p>Xem danh sách điểm danh các buổi đã tạo</p>
        </a>

        <a href="Teacher/ThongKeChuyenCan" class="feature-card">
            <h3>Thống kê chuyên cần</h3>
            <p>Theo dõi & xuất báo cáo</p>
        </a>

    </div>

</div>
