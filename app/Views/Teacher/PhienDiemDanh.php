<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="public/assets/css/GiangVien.css">
<link rel="stylesheet" href="public/assets/css/GiangVienQL.css">
</head>

<body>
<div class="main-content">

<h2>Quản lý phiên điểm danh</h2>

<input type="text" id="searchInput" placeholder="Tìm kiếm mã lớp, mã QR, ngày,...">

<table id="sessionTable">
    <thead>
        <tr>
            <th>Mã</th>
            <th>Lớp</th>
            <th>Mã QR</th>
            <th>Thời gian QR</th>
            <th>Ngày</th>
            <th>Số lượng</th>
            <th>Chi tiết</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>DD001</td>
            <td>CT101</td>
            <td>QR-ABC123</td>
            <td>Hết hạn</td>
            <td>01/12/2025</td>
            <td>12/35</td>
            <td><button class="btn-detail" onclick="openDetail('DD001')">Chi tiết</button></td>
        </tr>

        <tr>
            <td>DD002</td>
            <td>CT102</td>
            <td>QR-XYZ789</td>
            <td>08:30 - 08:40</td>
            <td>02/12/2025</td>
            <td>30/45</td>
            <td><button class="btn-detail" onclick="openDetail('DD002')">Chi tiết</button></td>
        </tr>
    </tbody>
</table>



<!-- ===================== POPUP CHI TIẾT ======================= -->
<div id="detailPopup" class="popup">
    <div class="popup-content">
        <h3>Chi tiết điểm danh: <span id="sessionCode"></span></h3>

        <input type="text" id="searchStudent" placeholder="Tìm mã sinh viên hoặc tên sinh viên...">

        <table id="studentTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                    <th>Vị trí</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>

            <tbody id="studentBody">
                <tr>
                    <td>1</td>
                    <td>SV001</td>
                    <td>Nguyễn Văn A</td>
                    <td>Có mặt</td>
                    <td>08:33</td>
                    <td>Quy Nhơn</td>
                    <td><button>Sửa</button></td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>SV055</td>
                    <td>Trần Thị B</td>
                    <td>Vắng</td>
                    <td>-</td>
                    <td>-</td>
                    <td><button>Sửa</button></td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>SV202</td>
                    <td>Lê Hoàng C</td>
                    <td>Có mặt</td>
                    <td>08:36</td>
                    <td>Quy Nhơn</td>
                    <td><button>Sửa</button></td>
                </tr>
            </tbody>
        </table>

        <button class="btn-close" onclick="closeDetail()">Đóng</button>
    </div>
</div>


<style>
.popup {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.4);
}

.popup-content {
    background: #fff;
    width: 70%;
    margin: 5% auto;
    padding: 20px;
    border-radius: 8px;
}

.btn-detail {
    padding: 5px 10px;
    cursor: pointer;
}

.btn-close {
    margin-top: 15px;
    padding: 8px 12px;
}
</style>

<script>
// ================== TÌM KIẾM PHIÊN & SINH VIÊN TRONG BẢNG CHÍNH =====================
document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#sessionTable tbody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});


// ===================== MỞ POPUP CHI TIẾT ==========================
function openDetail(code) {
    document.getElementById("detailPopup").style.display = "block";
    document.getElementById("sessionCode").textContent = code;
}

function closeDetail() {
    document.getElementById("detailPopup").style.display = "none";
}



// ===================== TÌM KIẾM SINH VIÊN TRONG POPUP ======================
document.getElementById('searchStudent').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#studentBody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>

</div>
</body>
</html>
