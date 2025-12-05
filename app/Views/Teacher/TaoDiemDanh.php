<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="public/assets/css/GiangVien.css">
<link rel="stylesheet" href="public/assets/css/GiangVienQL.css">
<style>
#qrPopup, #classPopup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999;
}
.popupBox {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 350px;
    text-align: center;
}
#qrBox img {
    width: 200px;
}
.qr-expired {
    color: red;
    font-weight: bold;
}
</style>
</head>

<body>
<div class="main-content">

<h2>Tạo buổi điểm danh</h2>

<button id="createBtn" style="margin-bottom: 15px;">+ Tạo buổi điểm danh</button>

<table id="attendanceTable">
    <thead>
        <tr>
            <th>Mã điểm danh</th>
            <th>Lớp</th>
            <th>Mã QR</th>
            <th>Thời gian QR</th>
            <th>Ngày</th>
            <th>Điểm danh</th>
        </tr>
    </thead>
    <tbody id="attendanceBody"></tbody>
</table>

</div>

<!-- Popup chọn lớp -->
<div id="classPopup">
    <div class="popupBox">
        <h3>Chọn lớp học phần</h3>

        <select id="selectClass" style="padding:8px; width:90%; margin-bottom:15px;">
            <!-- Dữ liệu mẫu — khi kết nối DB, bạn thay bằng PHP lấy từ bảng lớp -->
            <option value="CT101">CT101 - Lập trình C</option>
            <option value="CT203">CT203 - Cấu trúc dữ liệu</option>
            <option value="CT305">CT305 - Lập trình Web</option>
        </select>

        <div>
            <button onclick="confirmClass()">Tạo</button>
            <button onclick="closeClassPopup()">Hủy</button>
        </div>
    </div>
</div>

<!-- Popup QR -->
<div id="qrPopup">
    <div id="qrBox" class="popupBox">
        <h3>Mã QR điểm danh</h3>
        <img id="qrImage" src="" alt="QR Code">
        <p id="qrTime"></p>
        <button onclick="closeQR()">Đóng</button>
    </div>
</div>

<script>
// ======= BIẾN QUẢN LÝ =======
let count = 1;
let selectedClass = "";
const tbody = document.getElementById("attendanceBody");

// ======= MỞ POPUP CHỌN LỚP =======
document.getElementById("createBtn").addEventListener("click", () => {
    document.getElementById("classPopup").style.display = "flex";
});

// ======= XÁC NHẬN LỚP =======
function confirmClass() {
    selectedClass = document.getElementById("selectClass").value;
    closeClassPopup();
    createSession(selectedClass);
}

function closeClassPopup() {
    document.getElementById("classPopup").style.display = "none";
}

// ======= TẠO BUỔI ĐIỂM DANH =======
function createSession(lop) {
    const now = new Date();
    const expireTime = new Date(now.getTime() + 10 * 60000);

    const id = "DD" + String(count).padStart(3, '0');
    const qrValue = id + "-" + now.getTime();

    const row = document.createElement("tr");

    row.innerHTML = `
        <td>${id}</td>
        <td>${lop}</td>
        <td><button onclick="showQR('${qrValue}', '${expireTime}')">Xem QR</button></td>
        <td class="qrTime" data-expire="${expireTime}">10 phút</td>
        <td>${now.toLocaleDateString('vi-VN')}</td>
        <td><button onclick="showQR('${qrValue}', '${expireTime}')">Điểm danh</button></td>
    `;

    tbody.appendChild(row);
    count++;
}

// ======= HIỂN THỊ QR =======
function showQR(value, expireTime) {
    document.getElementById("qrImage").src =
        `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${value}`;

    document.getElementById("qrTime").textContent =
        "QR hết hạn lúc: " + new Date(expireTime).toLocaleTimeString('vi-VN');

    document.getElementById("qrPopup").style.display = "flex";
}

function closeQR() {
    document.getElementById("qrPopup").style.display = "none";
}

// ======= KIỂM TRA QR HẾT HẠN =======
setInterval(() => {
    const rows = document.querySelectorAll(".qrTime");
    rows.forEach(cell => {
        const expire = new Date(cell.dataset.expire);
        const now = new Date();
        if (now > expire) {
            cell.innerHTML = "<span class='qr-expired'>Hết hạn</span>";
        }
    });
}, 1000);
</script>

</body>
</html>
