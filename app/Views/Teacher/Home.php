<head>
    <link rel="stylesheet" href="./public/assets/css/TrangChuGV.css">
</head>
<div class="main-content">

    <!-- Header chào giảng viên -->
    <div class="home-header">
        <div>
            <h1>Xin chào, <?php echo $_SESSION['ten_gv'] ?? "Giảng viên"; ?></h1>
            <p>Chào mừng bạn đến với hệ thống điểm danh sinh viên</p>
        </div>
    </div>

    <!-- Thống kê nhanh -->
    <div class="stats-container">
        <div class="stat-box">
            <h2>5</h2>
            <p>Lớp học phần</p>
        </div>

        <div class="stat-box">
            <h2>3</h2>
            <p>Môn học</p>
        </div>

        <div class="stat-box">
            <h2>2</h2>
            <p>Buổi điểm danh hôm nay</p>
        </div>

        <div class="stat-box">
            <h2>92%</h2>
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
            <h3>Tạo phiên điểm hanh</h3>
            <p>Tạo & cập nhật biểu điểm danh</p>
        </a>    

        <a href="Teacher/QLDanhSachDiemDanh" class="feature-card">
            <h3>Danh sách điểm danh</h3>
            <p>Xem danh sách điểm danh các buổi điểm danh đã tạo</p>
        </a>

        <a href="Teacher/ThongKeChuyenCan" class="feature-card">
            <h3>Thống kê chuyên cần</h3>
            <p>Theo dõi & xuất báo cáo</p>
        </a>

    </div>

</div>