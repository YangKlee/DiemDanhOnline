<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/GiangVien.css">
    <link rel="stylesheet" href="public/assets/css/ThongKeGV.css">
    <body>
<div class="main-content">
    <h2>Thống kê chuyên cần</h2>

    <!-- Tìm kiếm và lọc -->
    <div class="filter-container">
        <input type="text" id="searchInput" placeholder="Tìm kiếm theo Mã SV / Tên sinh viên">

        <select id="semesterSelect">
            <option value="">Chọn học kỳ</option>
            <option value="1">Học kỳ 1</option>
            <option value="2">Học kỳ 2</option>
            <option value="3">Học kỳ hè</option>
        </select>

        <select id="yearSelect">
            <option value="">Chọn năm học</option>
            <option value="2023-2024">2023-2024</option>
            <option value="2024-2025">2024-2025</option>
            <option value="2025-2026">2025-2026</option>
        </select>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="stats-container">
        <div class="stat-card">
            <h3>Tổng số sinh viên</h3>
            <p>120</p>
        </div>
        <div class="stat-card">
            <h3>Điểm danh đầy đủ</h3>
            <p>85</p>
        </div>
        <div class="stat-card">
            <h3>Vắng nhiều</h3>
            <p>15</p>
        </div>
        <div class="stat-card">
            <h3>Tỷ lệ chuyên cần TB</h3>
            <p>88%</p>
        </div>
    </div>
</div>

</body>
</html>