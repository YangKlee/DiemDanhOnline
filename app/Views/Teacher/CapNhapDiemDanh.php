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

<h2>Cập nhật điểm danh</h2>

<input type="text" id="searchInput" placeholder="Tìm kiếm mã lớp, mã QR, ngày hoặc sinh viên...">

<table>
    <thead>
        <tr>
            <th>Mã</th>
            <th>Lớp</th>
            <th>Mã QR</th>
            <th>Thời gian QR</th>
            <th>Ngày</th>
            <th>Sửa</th>
            <th>Chi tiết</th>
            <th>Số lượng</th>
        </tr>
    </thead>

    <tbody id="sessionBody">
        <tr>
            <td>DD001</td>
            <td>CT101</td>
            <td><button onclick="viewQR('DD001')">Xem</button></td>
            <td id="time-DD001">10 phút</td>
            <td>01/12/2025</td>
            <td><button onclick="editTime('DD001')">Sửa</button></td>
            <td><button onclick="viewDetail('DD001')">Chi tiết</button></td>
            <td id="count-DD001">12/35</td>
        </tr>
    </tbody>
</table>

</div>

<!-- Popup sửa thời gian -->
<div id="timePopup" class="popupOverlay">
    <div class="popupBox" style="width:300px;">
        <h3>Chỉnh sửa thời gian QR</h3>
        <input type="number" id="newTime" min="1" placeholder="Nhập phút..." style="width: 90%; padding:5px;">
        <br><br>
        <button onclick="saveTime()">Lưu</button>
        <button onclick="closeTimePopup()">Hủy</button>
    </div>
</div>

<!-- Popup xem QR -->
<div id="qrPopup" class="popupOverlay">
    <div class="popupBox" style="width:350px; text-align:center;">
        <h3>Mã QR</h3>
        <img id="qrImage" width="300">
        <button onclick="closeQR()">Đóng</button>
    </div>
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
        <button onclick="deleteSession()">Xóa buổi điểm danh</button>
        <button onclick="closeDetail()">Đóng</button>
    </div>
</div>

<script>
// ================= DATA MẪU ====================
let currentSession = "";
let sessions = {
    "DD001": {
        lop: "CT101",
        students: [
            { mssv: "22110001", ten: "Nguyễn Văn A", trangthai: "Có mặt", time: "08:01", vitri: "Khu A" },
            { mssv: "22110002", ten: "Trần Thị B", trangthai: "Có mặt", time: "08:02", vitri: "Khu A" },
            { mssv: "22110003", ten: "Lê Văn C", trangthai: "Vắng", time: "-", vitri: "-" }
        ],
        total: 35
    }
};

// ================== XEM QR =====================
function viewQR(id) {
    document.getElementById("qrImage").src = `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${id}`;
    document.getElementById("qrPopup").style.display = "flex";
}
function closeQR() { document.getElementById("qrPopup").style.display = "none"; }

// ================== SỬA THỜI GIAN QR =====================
let editID = "";
function editTime(id) { editID=id; document.getElementById("timePopup").style.display="flex"; }
function closeTimePopup() { document.getElementById("timePopup").style.display="none"; }
function saveTime() {
    const minutes = document.getElementById("newTime").value;
    if(minutes<1) return alert("Thời gian phải lớn hơn 0!");
    document.getElementById("time-"+editID).innerHTML = minutes+" phút";
    closeTimePopup();
}

// ================== CHI TIẾT BUỔI =====================
function viewDetail(id) {
    currentSession = id;
    document.getElementById("detailTitle").innerText = id;
    const body = document.getElementById("studentBody");
    body.innerHTML = "";
    let list = sessions[id].students;
    list.forEach((sv, index)=>{
        body.innerHTML += `<tr>
            <td>${index+1}</td>
            <td>${sv.mssv}</td>
            <td>${sv.ten}</td>
            <td class="${sv.trangthai==='Có mặt'?'status-present':'status-absent'}">${sv.trangthai}</td>
            <td>${sv.time}</td>
            <td>${sv.vitri}</td>
            <td><button onclick="editStatus(${index})">Chỉnh sửa</button></td>
        </tr>`;
    });
    document.getElementById("detailPopup").style.display = "flex";
}

function closeDetail() { document.getElementById("detailPopup").style.display="none"; }

// =============== CHỈNH TRẠNG THÁI SV ================
function editStatus(i){
    let newStatus = prompt("Nhập trạng thái mới (Có mặt / Vắng):");
    if(!newStatus) return;
    newStatus = newStatus.trim();
    if(newStatus!=="Có mặt" && newStatus!=="Vắng"){ alert("Trạng thái không hợp lệ!"); return; }
    sessions[currentSession].students[i].trangthai=newStatus;
    viewDetail(currentSession);
}

// =============== XÓA BUỔI ================
function deleteSession(){
    if(!confirm("Bạn có chắc chắn muốn xóa buổi này?")) return;
    delete sessions[currentSession];
    alert("Đã xóa buổi điểm danh!");
    closeDetail();
}

// ================== TÌM KIẾM PHIÊN =====================
document.getElementById('searchInput').addEventListener('keyup', function(){
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#sessionBody tr');

    rows.forEach(row=>{
        let text = row.textContent.toLowerCase();
        // Nếu khớp sinh viên, mở chi tiết tự động
        let matched = false;
        const sessionId = row.cells[0].textContent;
        const students = sessions[sessionId]?.students || [];
        students.forEach(sv=>{
            if(sv.mssv.toLowerCase().includes(filter) || sv.ten.toLowerCase().includes(filter)) {
                matched = true;
            }
        });
        row.style.display = (text.includes(filter) || matched) ? "" : "none";
        if(matched) viewDetail(sessionId);
    });
});

// ================== TÌM KIẾM SINH VIÊN TRONG POPUP =====================
document.getElementById('searchStudent').addEventListener('keyup', function(){
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#studentBody tr');
    rows.forEach(row=>{
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>
</body>
</html>
