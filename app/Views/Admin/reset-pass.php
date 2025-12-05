<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Reset mật khẩu</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/admin.css">
    

</head>


<body>

    <div class="wrapper">

        <!-- Content -->
        <main class="content p-4">

            <h2 class="fw-bold mb-4">Reset mật khẩu</h2>

            <div class="card p-4 shadow-sm" style="max-width: 600px">

                <!-- 1. Chọn loại tài khoản -->
                <div class="mb-3">
                    <label class="form-label">Loại tài khoản</label>
                    <select class="form-select" id="loaiTK">
                        <option value="sv">Sinh viên</option>
                        <option value="gv">Giảng viên</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>

                <!-- 2. Nhập MSSV / Mã GV -->
                <div class="mb-3">
                    <label class="form-label" id="lbMa">MSSV</label>
                    <input type="text" id="txtMa" class="form-control" placeholder="Nhập MSSV...">
                </div>

                <button class="btn btn-primary mb-3" id="btnTim">Tìm tài khoản</button>

                <hr>

                <!-- 3. Hiển thị kết quả tìm -->
                <div id="info" class="d-none">
                    <h5 class="fw-bold">Thông tin tài khoản</h5>

                    <p class="mb-1"><b>ID:</b> <span id="outID"></span></p>
                    <p class="mb-1"><b>Họ tên:</b> <span id="outName"></span></p>
                    <p class="mb-3"><b>Loại:</b> <span id="outType"></span></p>

                    <!-- 4. Nhập mật khẩu mới -->
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" id="newPass" class="form-control" placeholder="Nhập mật khẩu mới...">

                    <button class="btn btn-success mt-3" id="btnReset">Đặt lại mật khẩu</button>
                </div>

            </div>

        </main>

    </div>


    <script>
    // Fake database mẫu (bạn thay bằng API)
    const users = {
        sv: [{
                id: "SV001",
                name: "Nguyễn Văn A"
            },
            {
                id: "SV002",
                name: "Trần Thị B"
            }
        ],
        gv: [{
                id: "GV11",
                name: "Lê Minh C"
            },
            {
                id: "GV22",
                name: "Phạm Thu D"
            }
        ],
        admin: [{
            id: "AD1",
            name: "Admin Chính"
        }]
    };


    // đổi label theo loại tài khoản
    document.getElementById("loaiTK").addEventListener("change", function() {
        const type = this.value;
        const lb = document.getElementById("lbMa");

        if (type === "sv") lb.textContent = "MSSV";
        if (type === "gv") lb.textContent = "Mã giảng viên";
        if (type === "admin") lb.textContent = "Mã quản trị";
    });


    // Tìm tài khoản
    document.getElementById("btnTim").addEventListener("click", function() {
        const type = document.getElementById("loaiTK").value;
        const code = document.getElementById("txtMa").value.trim();

        const list = users[type];
        const found = list.find(u => u.id === code);

        if (!found) {
            alert("Không tìm thấy tài khoản!");
            return;
        }

        // Hiện thông tin
        document.getElementById("outID").textContent = found.id;
        document.getElementById("outName").textContent = found.name;
        document.getElementById("outType").textContent =
            type === "sv" ? "Sinh viên" :
            type === "gv" ? "Giảng viên" : "Quản trị";

        document.getElementById("info").classList.remove("d-none");
    });


    // Reset mật khẩu
    document.getElementById("btnReset").addEventListener("click", function() {
        const pass = document.getElementById("newPass").value.trim();

        if (pass.length < 4) {
            alert("Mật khẩu phải tối thiểu 4 ký tự!");
            return;
        }

        alert("Đặt lại mật khẩu thành công!");
    });
    </script>

</body>

</html>