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
                        <th>Giảng viên</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['listPhienDD'] as $phien): ?>
                    <tr>
                        <td><?= htmlspecialchars($phien['MaPhien']) ?></td>
                        <td><?= htmlspecialchars($phien['MaLHP']) ?></td>
                        <td><?= htmlspecialchars($phien['TenMonHoc']) ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary btnQR" 
                                data-id="<?= htmlspecialchars($phien['MaPhien']) ?>"
                                data-token="<?= htmlspecialchars($phien['StrToken']) ?>"
                                data-malhp="<?= htmlspecialchars($phien['MaLHP']) ?>"
                                data-time="<?= htmlspecialchars($phien['ThoiGianBatDau']) . ' - ' . htmlspecialchars($phien['ThoiGianKetThuc']) ?>"
                            >Xem QR</button>
                        </td>
                        <td><?= htmlspecialchars($phien['ThoiGianBatDau']) . '-' . htmlspecialchars($phien['ThoiGianKetThuc']) ?> phút</td>
                        <td><?= htmlspecialchars($phien['ThoiGian']) ?></td>
                        <td><?= htmlspecialchars($phien['GiangVien']) ?></td>
                        <td>
                            <button class="btn btn-sm btn-info btnDetail" data-id="<?= htmlspecialchars($phien['MaPhien']) ?>">Xem chi tiết</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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

function formatDate(s) {
    const d = new Date(s);
    return d.toLocaleDateString("vi-VN");
}

/* ------------------------
   SỰ KIỆN
------------------------- */

function bindEvents() {
    document.querySelectorAll(".btnQR").forEach(btn => {
        btn.onclick = () => openQR(btn);
    });

    document.querySelectorAll(".btnDetail").forEach(btn => {
        btn.onclick = () => openDetail(btn.dataset.id);
    });
}

/* ------------------------
   QR
------------------------- */

function openQR(btn) {
    const id = btn.dataset.id;
    const token = btn.dataset.token;
    const maLHP = btn.dataset.malhp;
    const time = btn.dataset.time;

    document.getElementById("qrContainer").innerHTML = "";
    new QRCode(document.getElementById("qrContainer"), {
        text: token, width: 200, height: 200
    });

    document.getElementById("qrInfo").innerText =
        `${id} • ${maLHP} • ${time}`;

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
bindEvents();

</script>

</body>
</html>
