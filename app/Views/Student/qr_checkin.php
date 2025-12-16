<head>
    <link rel="stylesheet" href="./public/assets/css/theme.css">
    <script defer src="./public/assets/js/qr.js"></script>
</head>
<main class="page-container">
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