<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="public/assets/css/GiangVien.css">
<link rel="stylesheet" href="public/assets/css/ThongKeGV.css">
<title>Thống kê chuyên cần</title>
</head>
<body>
<div class="main-content">
    <h2>Thống kê chuyên cần</h2>

    <?php
        $thongKe = $data['thongKe'] ?? [];
        $MaHK = $data['MaHK'] ?? '';
        $MaLHP = $data['MaLHP'] ?? '';
    ?>

    <!-- Form lọc học kỳ & lớp học phần -->
    <div class="filter-container">
        <form method="GET" class="filter-form">
            <label for="MaHK">Học kỳ:</label>
            <select name="MaHK" id="MaHK" onchange="this.form.submit()">
                <option value="">-- Chọn học kỳ --</option>
                <?php
                $hkList = array_unique(array_column($thongKe, 'MaHK'));
                foreach ($hkList as $hk) {
                    $selected = ($MaHK == $hk) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($hk) . "' $selected>" . htmlspecialchars($hk) . "</option>";
                }
                ?>
            </select>

            <label for="MaLHP">Lớp học phần:</label>
            <select name="MaLHP" id="MaLHP" onchange="this.form.submit()">
                <option value="">-- Chọn lớp học phần --</option>
                <?php
                $lhpList = array_unique(array_column($thongKe, 'MaLHP'));
                foreach ($lhpList as $lhp) {
                    $selected = ($MaLHP == $lhp) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($lhp) . "' $selected>" . htmlspecialchars($lhp) . "</option>";
                }
                ?>
            </select>
        </form>
    </div>

    <?php if (!empty($thongKe)): 
        $stat = $thongKe[0]; 
    ?>
    <div class="stats-container">
        <div class="stat-card">
            <h3>Tổng số sinh viên</h3>
            <p><?= intval($stat['TongSoSinhVien']) ?></p>
        </div>
        <div class="stat-card">
            <h3>Điểm danh đầy đủ</h3>
            <p><?= intval($stat['SoSinhVienDiemDanhDayDu']) ?></p>
        </div>
        <div class="stat-card">
            <h3>Vắng nhiều</h3>
            <p><?= intval($stat['SoSinhVienVangNhieu']) ?></p>
        </div>
        <div class="stat-card">
            <h3>Tỷ lệ chuyên cần TB</h3>
            <p><?= htmlspecialchars($stat['TyLeChuyenCanTB']) ?></p>
        </div>
    </div>
    <?php else: ?>
        <p style="text-align:center;">Chưa có dữ liệu thống kê.</p>
    <?php endif; ?>

</div>
</body>
</html>
