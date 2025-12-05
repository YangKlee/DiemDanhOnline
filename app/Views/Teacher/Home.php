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

    <!-- Dashboard chức năng -->
    <div class="feature-grid">

        <a href="#" class="feature-card">
            <h3>Quản lý lớp học phần</h3>
            <p>Xem danh sách lớp sinh viên</p>
        </a>

        <a href="#" class="feature-card">
            <h3>Quản lý môn học</h3>
            <p>Danh sách các môn giảng dạy</p>
        </a>

        <a href="#" class="feature-card">
            <h3>Quản lý điểm danh</h3>
            <p>Tạo & cập nhật biểu điểm danh</p>
        </a>

        <a href="#" class="feature-card">
            <h3>Danh sách phiên</h3>
            <p>Xem các buổi điểm danh đã tạo</p>
        </a>

        <a href="#" class="feature-card">
            <h3>Thống kê chuyên cần</h3>
            <p>Theo dõi & xuất báo cáo</p>
        </a>

    </div>

</div>