<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['UID'])) {
    echo "Chưa đăng nhập";
    exit;
}

$mssv = $_SESSION['UID'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quét QR điểm danh</title>

<link rel="stylesheet" href="./public/assets/css/theme.css">
<script src="https://unpkg.com/jsqr/dist/jsQR.js"></script>

<style>
.page-container {
    max-width: 900px;
    margin: 30px auto;
}

.scanner-container {
    display: flex;
    gap: 30px;
    align-items: flex-start;
    flex-wrap: wrap;
}

.camera-box {
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

#camera {
    width: 320px;
    border-radius: 10px;
}

.result-card {
    flex: 1;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.result-card h4 {
    margin-top: 0;
}

.result-success {
    color: #2e7d32;
    font-weight: bold;
    margin-bottom: 10px;
}

.result-error {
    color: #c62828;
    font-weight: bold;
}

.table-info {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.table-info th {
    width: 140px;
    text-align: left;
    background: #f5f5f5;
    padding: 10px;
    border-radius: 6px 0 0 6px;
}

.table-info td {
    padding: 10px;
    background: #fafafa;
    border-radius: 0 6px 6px 0;
}

.map-link {
    color: #1976d2;
    text-decoration: none;
    font-weight: bold;
}
</style>
</head>

<body>

<main class="page-container">
<h3>📸 Quét QR điểm danh</h3>

<div class="scanner-container">

    <!-- CAMERA -->
    <div class="camera-box">
        <video id="camera" autoplay playsinline></video>
        <p style="text-align:center;margin:10px 0 0">
            Đưa mã QR vào camera
        </p>
    </div>

    <!-- KẾT QUẢ -->
    <div class="result-card" id="result">
        <p>⏳ Đang chờ quét QR...</p>
    </div>

</div>
</main>

<script>
let video = document.getElementById("camera");
let scanning = true;

// GPS
let latitude = null;
let longitude = null;

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        pos => {
            latitude = pos.coords.latitude;
            longitude = pos.coords.longitude;
        },
        () => {
            latitude = null;
            longitude = null;
        }
    );
}

// Camera
navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
.then(stream => {
    video.srcObject = stream;
    video.play();
    requestAnimationFrame(tick);
})
.catch(err => {
    document.getElementById("result").innerHTML =
        `<p class="result-error">❌ Không mở được camera</p>`;
});

// Quét QR
function tick() {
    if (!scanning) return;

    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        const canvas = document.createElement("canvas");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext("2d");
        ctx.drawImage(video, 0, 0);

        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, canvas.width, canvas.height);

        if (code) {
            scanning = false;
            stopCamera();
            sendAttendance(code.data);
            return;
        }
    }
    requestAnimationFrame(tick);
}

// Gửi điểm danh
function sendAttendance(token) {

    const locationText = (latitude && longitude)
        ? `${latitude},${longitude}`
        : "Chưa xác định";

    fetch("./Attendance/ScanQR", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            Token: token,
            MSSV: "<?= $mssv ?>",
            ViTri: locationText
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {

            const mapUrl = (latitude && longitude)
                ? `https://www.google.com/maps?q=${latitude},${longitude}`
                : null;

            document.getElementById("result").innerHTML = `
                <h4 class="result-success">✅ Điểm danh thành công</h4>
                <table class="table-info">
                    <tr><th>MSSV</th><td>${data.MSSV}</td></tr>
                    <tr><th>Mã phiên</th><td>${data.MaPhien}</td></tr>
                    <tr><th>Thời gian</th><td>${data.ThoiGian}</td></tr>
                    <tr>
                        <th>Vị trí</th>
                        <td>
                            ${mapUrl
                                ? `<a class="map-link" href="${mapUrl}" target="_blank">📍 Xem bản đồ</a>`
                                : "Không xác định"}
                        </td>
                    </tr>
                </table>
            `;
        } else {
            document.getElementById("result").innerHTML =
                `<p class="result-error">❌ ${data.message}</p>`;
        }
    })
    .catch(err => {
        document.getElementById("result").innerHTML =
            `<p class="result-error">❌ Lỗi hệ thống</p>`;
    });
}

// Tắt camera
function stopCamera() {
    if (video.srcObject) {
        video.srcObject.getTracks().forEach(t => t.stop());
    }
}
</script>

</body>
</html>
    <h3>Quét QR điểm danh</h3>

    <video id="camera" autoplay playsinline></video>
    <p id="result"></p>

    <form id="confirmForm" method="post" action="/Attendance/scanQR">
        <input type="hidden" name="token" id="qrToken">
        <input type="hidden" name="location" id="location">
        <button class="button">Xác nhận điểm danh</button>
    </form>
</main>

<script>
navigator.geolocation.getCurrentPosition(pos => {
    document.getElementById("location").value =
        pos.coords.latitude + "," + pos.coords.longitude;
});
</script>
