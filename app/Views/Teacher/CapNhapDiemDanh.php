<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="public/assets/css/GiangVien.css">
<link rel="stylesheet" href="public/assets/css/GiangVienQL.css">

<style>
.popupOverlay {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.6);
    display:none;
    align-items:center;
    justify-content:center;
    z-index: 999;
}
.popupBox {
    background:white;
    padding:20px;
    border-radius:10px;
    width:700px;
    max-height: 90vh;
    overflow:auto;
}
table {
    width:100%;
    border-collapse: collapse;
}
th, td {
    padding:8px;
    border:1px solid #ccc;
    text-align:center;
}
button {
    padding:5px 10px;
    cursor:pointer;
}
.status-present {
    color: green;
    font-weight:bold;
}
.status-absent {
    color: red;
    font-weight:bold;
}
#searchInput, #searchStudent {
    width:300px;
    padding:6px;
    margin:10px 0;
}
</style>
</head>

<body>

<div class="main-content">

<h3>Cập nhật điểm danh</h3>

<input type="text" id="searchInput" placeholder="Tìm kiếm mã lớp, mã QR, ngày hoặc sinh viên...">

<table>
    <thead>
        <tr>
            <th>Mã</th>
            <th>Mã LHP</th>
            <th>Mã QR</th>
            <th>Thời gian QR</th>
            <th>Ngày</th>
            <th>Sửa hạn QR</th>
            <th>Số lượng</th>
            <th>Chi tiết</th>
        </tr>
    </thead>

    <tbody id="sessionBody">
        <tr>
        </tr>
    </tbody>
</table>

</div>


<!-- Popup chi tiết buổi -->
<div id="detailPopup" class="popupOverlay">
    <div class="popupBox">
        <h3>Chi tiết buổi điểm danh: <span id="detailTitle"></span></h3>

        <input type="text" id="searchStudent" placeholder="Tìm mã SV hoặc tên SV...">

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
            <tbody id="studentBody"></tbody>
        </table>

        <br>
        <button >Xóa buổi điểm danh</button>
        <button >Đóng</button>
    </div>
</div>

</body>
</html>
