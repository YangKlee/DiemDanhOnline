<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết quả điểm danh</title>
    <link rel="stylesheet" href="./public/assets/css/theme.css">
    <style>
        table { border-collapse: collapse; width: 400px; margin-top:20px; }
        th, td { border:1px solid #ccc; padding:8px; text-align:left; }
        th { background:#f2f2f2; }
    </style>
</head>
<body>
<main class="page-container">
    <h3>Kết quả điểm danh</h3>

    <?php if (!empty($data['error'])): ?>
        <p style="color:red;"><?= htmlspecialchars($data['error']) ?></p>
    <?php else: ?>
        <table>
            <tr>
                <th>MSSV</th>
                <td><?= htmlspecialchars($data['MSSV']) ?></td>
            </tr>
            <tr>
                <th>Mã phiên</th>
                <td><?= htmlspecialchars($data['MaPhien']) ?></td>
            </tr>
            <tr>
                <th>Thời gian</th>
                <td><?= htmlspecialchars($data['ThoiGian']) ?></td>
            </tr>
            <tr>
                <th>Vị trí</th>
                <td><?= htmlspecialchars($data['ViTri']) ?></td>
            </tr>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
