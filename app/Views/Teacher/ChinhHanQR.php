<?php
$phien = $data['phien'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./public/assets/css/theme.css">
</head>
<body>

<main class="page-container">
    <div class="card">
        <h3>Chỉnh hạn QR</h3>

<form method="POST"
      action="<?= $publicBase ?>/Teacher/CapNhatThoiGianQR?MaPhien=<?= $phien['MaPhien'] ?>">




    <!-- BẮT BUỘC -->
    <input type="hidden" name="MaPhien" value="<?= $phien['MaPhien'] ?>">

    <p><b>Mã phiên:</b> <?= $phien['MaPhien'] ?></p>
    <p><b>Mã lớp học phần:</b> <?= $phien['MaLHP'] ?></p>

    <label>Thời hạn QR (phút):</label>
    <input
        type="number"
        name="SoPhut"
        min="1"
        required
        value="<?php
            $batDau = new DateTime($phien['ThoiGianBatDau']);
            $ketThuc = new DateTime($phien['ThoiGianKetThuc']);
            echo ($ketThuc->getTimestamp() - $batDau->getTimestamp()) / 60;
        ?>"
    >

    <br><br>

    <button type="submit">Lưu thay đổi</button>

    <a href="/Teacher/CapNhatPhienDiemDanh/XemChiTiet?MaPhien=<?= $phien['MaPhien'] ?>">
        <button type="button">Hủy</button>
    </a>
</form>

    </div>
</main>

</body>
</html>
