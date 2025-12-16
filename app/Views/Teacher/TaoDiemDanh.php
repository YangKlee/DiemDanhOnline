<!-- Views/Teacher/TaoDiemDanh.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo phiên điểm danh</title>
    <link rel="stylesheet" href="<?= $publicBase ?>/public/assets/css/theme.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 40px;
            gap: 40px;
        }
        .form-card {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 480px;
        }
        .form-card h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        table {
            border-collapse: collapse;
            width: 700px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }
        th {
            background: #f2f2f2;
        }
       #qrPopup {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
    }

    .popupBox {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 360px;
        text-align: center;
    }

    </style>
</head>
<body>

<div class="container">

    <!-- FORM TẠO PHIÊN -->
    <div class="form-card">
        <h3>Tạo phiên điểm danh</h3>

        <form id="createForm">
            <div class="form-group">
                <label>Môn học</label>
                <select name="MaMonHoc" id="MaMonHoc" required>
                    <?php foreach ($dsMonHoc as $mon): ?>
                        <option value="<?= htmlspecialchars($mon['MaMonHoc']) ?>">
                            <?= htmlspecialchars($mon['TenMonHoc']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Lớp học phần</label>
                <select name="MaLHP" id="MaLHP" required>
                    <?php foreach ($dsLopHP as $lop): ?>
                        <option value="<?= htmlspecialchars($lop['MaLHP']) ?>">
                            <?= htmlspecialchars($lop['MaLHP']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Thời gian bắt đầu</label>
                <input type="datetime-local" name="ThoiGianBatDau" required>
            </div>

            <div class="form-group">
                <label>Thời gian kết thúc</label>
                <input type="datetime-local" name="ThoiGianKetThuc" required>
            </div>

            <button type="submit">Tạo phiên điểm danh</button>
        </form>
    </div>

    <!-- DANH SÁCH PHIÊN -->
    <table>
        <thead>
        <tr>
            <th>Mã phiên</th>
            <th>Môn học</th>
            <th>Lớp HP</th>
            <th>Bắt đầu</th>
            <th>Kết thúc</th>
            <th>QR</th>
        </tr>
        </thead>
        <tbody id="sessionBody">
        <?php if (!empty($sessions)): ?>
            <?php foreach ($sessions as $s): ?>
                <tr>
                    <td><?= $s['MaPhien'] ?></td>
                    <td><?= $s['TenMonHoc'] ?></td>
                    <td><?= $s['MaLHP'] ?></td>
                    <td><?= $s['ThoiGianBatDau'] ?></td>
                    <td><?= $s['ThoiGianKetThuc'] ?></td>
                    <td>
                        <button onclick="showQR('<?= $s['StrToken'] ?>')">Xem QR</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Chưa có phiên điểm danh</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- POPUP QR -->
<div id="qrPopup">
    <div class="popupBox">
        <h3>Mã QR điểm danh</h3>
        <img id="qrImage">
        <p id="qrInfo"></p>
        <button id="btnCloseQR">Đóng</button>
    </div>
</div>


<script>
const popup = document.getElementById("qrPopup");
const qrImg = document.getElementById("qrImage");
const qrInfo = document.getElementById("qrInfo");
const tbody = document.getElementById("sessionBody");

/* ===== ĐÓNG POPUP ===== */
document.getElementById("btnCloseQR").onclick = function () {
    popup.style.display = "none";
};

/* ===== SUBMIT FORM ===== */
document.getElementById("createForm").addEventListener("submit", async function(e){
    e.preventDefault();

    const res = await fetch("<?= $publicBase ?>/Attendance/CreateSession", {
        method: "POST",
        body: new FormData(this)
    });

    const text = await res.text();
    console.log("RESPONSE:", text);

    let data;
    try {
        data = JSON.parse(text);
    } catch {
        alert("Backend không trả JSON");
        return;
    }

    if (data.error) {
        alert(data.error);
        return;
    }

    /* ===== HIỆN QR ===== */
    qrImg.src =
      `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${data.token}`;
    qrInfo.textContent = "Token: " + data.token;
    popup.style.display = "flex";

    /* ===== THÊM DÒNG VÀO BẢNG ===== */
    const tr = document.createElement("tr");
    tr.innerHTML = `
        <td>${data.maPhien}</td>
        <td>${document.getElementById("MaMonHoc").selectedOptions[0].text}</td>
        <td>${data.maLHP}</td>
        <td>${data.batDau}</td>
        <td>${data.ketThuc}</td>
        <td><button onclick="showQR('${data.token}')">Xem QR</button></td>
    `;
    tbody.appendChild(tr);
});

/* ===== XEM QR CŨ ===== */
function showQR(token) {
    qrImg.src =
      `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${token}`;
    qrInfo.textContent = "Token: " + token;
    popup.style.display = "flex";
}
</script>



</body>
</html>
