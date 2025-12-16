<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Mã QR điểm danh</title>
</head>
<body>
    <h3>Mã QR điểm danh cho lớp <?= htmlspecialchars($data['maLHP']) ?></h3>
    <p>Bắt đầu: <?= htmlspecialchars($data['batDau']) ?></p>
    <p>Kết thúc: <?= htmlspecialchars($data['ketThuc']) ?></p>

    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=<?= urlencode($data['token']) ?>" alt="QR Code">

    <p>Token: <?= htmlspecialchars($data['token']) ?></p>
</body>
</html>
