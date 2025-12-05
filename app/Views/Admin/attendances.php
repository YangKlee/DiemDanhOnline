<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Admin - Điểm danh QR</title>

<link rel="stylesheet" href="public/assets/css/admin.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

<div class="wrapper">
<main class="content">

    <h3 class="mb-3">Điểm danh lớp học phần</h3>

    <!-- Thanh tìm kiếm + lọc -->
    <div class="card p-3 mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-4">
                <input id="searchInput" class="form-control" placeholder="Tìm kiếm...">
            </div>
            <div class="col-md-4">
                <select id="filterClass" class="form-select">
                    <option value="">Lọc theo mã lớp học phần</option>
                    <option>CT101</option>
                    <option>CT201</option>
                </select>
            </div>
            <div class="col-md-4">
                <input id="dateFilter" type="date" class="form-control">
            </div>
        </div>
    </div>

    <!-- Bảng chính -->
    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="tableDD">
                <thead class="table-light">
                    <tr>
                        <th>Mã điểm danh</th>
                        <th>Mã lớp học phần</th>
                        <th>Tên lớp học phần</th>
                        <th>Mã QR</th>
                        <th>Thời gian QR</th>
                        <th>Ngày</th>
                        <th>Điểm danh</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Render từ JS -->
                </tbody>
            </table>
        </div>
    </div>

</main>
</div>

<!-- Modal QR -->
<div class="modal fade" id="modalQR">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
            <div class="modal-header">
                <h5 class="modal-title">Mã QR</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="qrContainer" class="d-flex justify-content-center mb-2"></div>
                <div id="qrInfo" class="small-muted"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Chi tiết -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Chi tiết điểm danh — <span id="detailHeader"></span>
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- THANH TÌM KIẾM SINH VIÊN -->
                <input id="searchStudent" class="form-control mb-3" placeholder="Tìm sinh viên...">

                <div class="table-responsive">
                    <table class="table table-bordered" id="tableDetail">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px">STT</th>
                                <th>Mã sinh viên</th>
                                <th>Tên sinh viên</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                                <th>Vị trí</th>
                                <!-- ĐÃ XÓA CỘT HÀNH ĐỘNG -->
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>

            <div class="modal-footer">
                <div class="me-auto small-muted" id="countInfo"></div>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
/* ------------------------
   DATA GIẢ LẬP CÓ SẴN
------------------------- */

const ITEMS = [
    {
        id: "DD101",
        maLHP: "CT101",
        tenLHP: "Lập trình C cơ bản",
        timeRange: "08:00 - 08:10",
        date: "2025-12-01",
        attendees: [
            {code:"SV001", name:"Nguyễn Văn A", status:"D", time:"08:02", loc:"B1-01"},
            {code:"SV002", name:"Trần Thị B", status:"A", time:"", loc:""},
            {code:"SV003", name:"Nguyễn Văn C", status:"D", time:"08:05", loc:"B1-03"},
        ],
        total: 3
    }
];

/* ------------------------
   RENDER BẢNG CHÍNH
------------------------- */

function renderTable() {
    const tbody = document.querySelector("#tableDD tbody");
    tbody.innerHTML = "";

    ITEMS.forEach(item => {
        const tr = document.createElement("tr");

        tr.innerHTML = `
            <td>${item.id}</td>
            <td>${item.maLHP}</td>
            <td>${item.tenLHP}</td>
            <td><button class="btn btn-outline-secondary btn-sm btnQR" data-id="${item.id}">Xem QR</button></td>
            <td>${item.timeRange}</td>
            <td>${formatDate(item.date)}</td>
            <td>${item.attendees.filter(a=>a.status==="D").length}/${item.total}</td>
            <td><button class="btn btn-info btn-sm text-white btnDetail" data-id="${item.id}">Chi tiết</button></td>
        `;

        tbody.appendChild(tr);
    });

    bindEvents();
}

function formatDate(s) {
    const d = new Date(s);
    return d.toLocaleDateString("vi-VN");
}

/* ------------------------
   SỰ KIỆN
------------------------- */

function bindEvents() {
    document.querySelectorAll(".btnQR").forEach(btn => {
        btn.onclick = () => openQR(btn.dataset.id);
    });

    document.querySelectorAll(".btnDetail").forEach(btn => {
        btn.onclick = () => openDetail(btn.dataset.id);
    });
}

/* ------------------------
   QR
------------------------- */

function openQR(id) {
    const item = ITEMS.find(x => x.id === id);

    document.getElementById("qrContainer").innerHTML = "";
    new QRCode(document.getElementById("qrContainer"), {
        text: item.id, width: 200, height: 200
    });

    document.getElementById("qrInfo").innerText =
        `${item.id} • ${item.maLHP} • ${item.timeRange}`;

    bootstrap.Modal.getOrCreateInstance(document.getElementById("modalQR")).show();
}

/* ------------------------
   CHI TIẾT + TÌM KIẾM SINH VIÊN
------------------------- */

function openDetail(id) {
    const item = ITEMS.find(x => x.id === id);

    document.getElementById("detailHeader").innerText =
        `${item.id} — ${item.maLHP} — ${item.tenLHP}`;

    const tbody = document.querySelector("#tableDetail tbody");
    tbody.innerHTML = "";

    item.attendees.forEach((stu, i) => {
        const tr = document.createElement("tr");
        tr.classList.add("student-row");
        tr.innerHTML = `
            <td>${i+1}</td>
            <td class="svCode">${stu.code}</td>
            <td class="svName">${stu.name}</td>
            <td>${statusLabel(stu.status)}</td>
            <td>${stu.time || ""}</td>
            <td>${stu.loc || ""}</td>
        `;
        tbody.appendChild(tr);
    });

    updateCount(item);

    // Tìm kiếm real-time
    document.getElementById("searchStudent").onkeyup = function () {
        const key = this.value.toLowerCase();
        document.querySelectorAll("#tableDetail tbody tr").forEach(row => {
            const code = row.querySelector(".svCode").innerText.toLowerCase();
            const name = row.querySelector(".svName").innerText.toLowerCase();
            row.style.display = (code.includes(key) || name.includes(key)) ? "" : "none";
        });
    };

    bootstrap.Modal.getOrCreateInstance(document.getElementById("modalDetail")).show();
}

function statusLabel(s) {
    if (s === "D") return `<span class="badge bg-success">Đã điểm danh</span>`;
    if (s === "A") return `<span class="badge bg-danger">Vắng</span>`;
    return `<span class="badge bg-secondary">Chưa</span>`;
}

function updateCount(item) {
    const c = item.attendees.filter(a => a.status === "D").length;
    document.getElementById("countInfo").innerText =
        `Đã điểm danh: ${c}/${item.total}`;
}

/* ------------------------
   KHỞI TẠO
------------------------- */
renderTable();

</script>

</body>
</html>
