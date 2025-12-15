<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>

<body>
    <main class="page-container">
        <div class="card">
            
            <h3>Chi tiết điểm danh học phần</h3>

            <?php
                $detail = $data['detail'];
                $maPhien = $_GET['MaPhien'];
            ?>

            <input type="text" id="searchInput" placeholder="Tìm kiếm ">

            <table class="table" id="classTable">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th>Vị trí</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($detail)): ?>
                    <?php foreach ($detail as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($row['MSSV']) ?></td>
                        <td><?= htmlspecialchars($row['TenSV']) ?></td>
                        <td>
                            <select onchange="capNhatTrangThai(
                                <?= $maPhien ?>,
                                <?= $row['MSSV'] ?>,
                                this.value
                            )">
                                <option value="Co mat" <?= $row['TrangThai']=='Có mặt' ? 'selected' : '' ?>>
                                    Có mặt
                                </option>
                                <option value="Vang" <?= $row['TrangThai']=='Vắng' ? 'selected' : '' ?>>
                                    Vắng
                                </option>
                            </select>
                        </td>

                        <td><?= isset($row['ThoiGian']) ? date('d/m/Y H:i', strtotime($row['ThoiGian'])) : '-' ?></td>
                        <td><?= htmlspecialchars($row['ViTri'] ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6">Chưa có dữ liệu điểm danh</td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table>
            <div class="action-buttons">
            <!-- CHỈNH HẠN QR -->
            <a href="./Teacher/CapNhatPhienDiemDanh/XemChiTiet/ChinhHanQR?MaPhien=<?= $maPhien ?>">
                <button>Chỉnh hạn QR</button>
            </a>
            <!-- XÓA PHIÊN -->
            <button onclick="xoaPhien(<?= $maPhien ?>)">Xóa buổi điểm danh</button>
            <!-- ĐÓNG -->
            <a href="./Teacher/QLDanhSachDiemDanh">
                <button>Đóng</button>
            </a>
        </div>
        </div>
    </main>
<script>
function xoaPhien(maPhien) {
    if (!confirm("Bạn có chắc muốn xóa phiên điểm danh này?")) return;

    fetch("./Teacher/xoaPhien", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "MaPhien=" + maPhien
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Xóa thành công!");
            window.location.href = "./Teacher/QLDanhSachDiemDanh";
        } else {
            alert("Xóa thất bại!");
        }
    });
}
</script>
<script>
function capNhatTrangThai(maPhien, mssv, trangThai) {
    fetch("./Teacher/capNhatTrangThai", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `MaPhien=${maPhien}&MSSV=${mssv}&TrangThai=${trangThai}`
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert("Cập nhật thất bại");
        }
    });
}
</script>

    <script src="public/assets/js/search.js"></script>
</body>

</html>