<head>
    <link rel="stylesheet" href="public/assets/css/themsinhvien.css">
</head>

<body>

    <div class="page-container">
        <h1 class="main-page-title"><?php 
            $giangVienData = $data['giangVienData'] ?? null;
        echo 
        (isset($giangVienData)) ? 'Sửa tài khoản ' : 'Thêm tài khoản giảng viên' ?></h1>

        <div class="custom-card">
            <div class="card-toolbar mb-4">
                <div class="toolbar-title">
                    <i class="bi bi-person-add me-2"></i>
                    <span><?php echo (isset($giangVienData)) ? 'Sửa tài khoản giảng viên' : 'Nhập thông tin giảng viên mới' ?></span>
                </div>
            </div>

            <form method="POST" action="">
                <div class="form-group-row">
                     <div class="form-account-input">
                    <label class="block font-medium mb-2">Mã GV: <span class="text-danger">*</span></label>
                    <input type="text" name="MaGV" required <?php echo (isset($giangVienData)) ? 'readonly' : '' ?> placeholder="Nhập mã số giảng viên..." value="<?php echo (isset($giangVienData)) ? $giangVienData['UserID'] : '' ?>">
                     </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">CCCD: <span class="text-danger">*</span></label>
                        <input type="text" name="CCCD" required placeholder="Nhập số CCCD" value="<?php echo (isset($giangVienData)) ? $giangVienData['CCCD'] : '' ?>">
                    </div>
                </div>


                <div class="form-group-row">
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Họ: <span class="text-danger">*</span></label>
                        <input type="text" name="Ho" required placeholder="Nhập họ..." value="<?php echo (isset($giangVienData)) ? $giangVienData['Ho'] : '' ?>">
                    </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Tên:<span class="text-danger">*</span></label>
                        <input type="text" name="Ten" required placeholder="Nhập tên..." value="<?php echo (isset($giangVienData)) ? $giangVienData['Ten'] : '' ?>">
                    </div>
                </div>
                <div class="form-group-row">
                                        <div class="form-account-input">
                    <label class="block font-medium mb-2">Ngày sinh: <span class="text-danger">*</span></label>
                    <input type="date" name="NgaySinh" required placeholder="Nhập ngày sinh" value="<?php echo (isset($giangVienData)) ? $giangVienData['NgaySinh'] : '' ?>">
                    </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Giới tính: <span class="text-danger">*</span></label>
                        <select name="GioiTinh" class="form-select" required>
                            <option value="Nam" <?php echo (isset($giangVienData) && $giangVienData['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
                            <option value="Nữ" <?php echo (isset($giangVienData) && $giangVienData['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group-row">
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Khoa: <span class="text-danger">*</span></label>
                        <select name="MaKhoa" required id="SelectKhoa" class="form-select" data-selected="<?php echo (isset($giangVienData)) ? $giangVienData['MaKhoa'] : '' ?>">

                            <option value="0" selected disabled>=CHỌN KHOA=</option>
                            <?php foreach ($data['listKhoa'] as $khoa) : ?>
                                <option value="<?= $khoa['MaKhoa'] ?>"><?= $khoa['TenKhoa'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if (!isset($giangVienData)): ?>
                    <div class="form-group-row">
                        <div class="form-account-input">
                            <label class="block font-medium mb-2"> Mật khẩu(nếu cài mật khẩu mặc định thì để trống): </label>
                            <input type="password" name="MatKhau" placeholder="Nhập mật khẩu..">
                        </div>
                        <div class="form-account-input">
                            <label class="block font-medium mb-2"> Xác nhận mật khẩu: </label>
                            <input type="password" name="XacNhanMatKhau" placeholder="Nhập lại mật khẩu..">
                        </div>
                    </div>
                
                <?php else: ?>
                    <a style="width: fit-content;" href="Admin/ResetMatKhau?StudentID=<?php echo $giangVienData['MSSV'] ?>" class="btn btn-submit">Reset mật khẩu</a>
                <?php endif; ?>

                <div class="form-group-row">
                    <div class="form-account-input">
                    <label class="block font-medium mb-2">Email: <span class="text-danger">*</span></label>
                    <input type="email" name="Email" required placeholder="Nhập email" value="<?php echo (isset($giangVienData)) ? $giangVienData['Email'] : '' ?>">
                    </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Số điện thoại: <span class="text-danger">*</span></label>
                        <input type="text" name="SoDT" required placeholder="Nhập số điện thoại" value="<?php echo (isset($giangVienData)) ? $giangVienData['SoDT'] : '' ?>">
                    </div>
 
                </div>

                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Địa chỉ: <span class="text-danger">*</span></label>
                        <input type="text" name="DiaChi" required placeholder="Nhập địa chỉ" value="<?php echo (isset($giangVienData)) ? $giangVienData['DiaChi'] : '' ?>">
                    </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-save2 me-2"></i>Lưu
                    </button>
                    <a href="Admin/QuanLyTaiKhoan/SinhVien" class="btn btn-cancel">Hủy bỏ</a>
                </div>

            </form>
        </div>
    </div>
    <script>

        document.addEventListener("DOMContentLoaded", () => {
            const selectKhoa = document.getElementById("SelectKhoa");
            const selectNganh = document.getElementById("SelectNganh");
            const selectLop = document.getElementById("SelectLop");

            const savedKhoa = selectKhoa.dataset.selected;
            const savedNganh = selectNganh.dataset.selected;
            const savedLop = selectLop.dataset.selected;
            const savedLopQuanLy = <?php echo isset($listLopQuanLy) ? json_encode($listLopQuanLy) : '[]'; ?>;

            function loadNganh(khoaID) {
                selectNganh.innerHTML = `<option disabled value="0">=CHỌN NGÀNH=</option>`;
                if (!khoaID || khoaID === "0") return Promise.resolve();
                return fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${khoaID}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(nganh => {
                            const op = document.createElement("option");
                            op.value = nganh.MaNganh;
                            op.textContent = nganh.TenNganh;
                            if (savedNganh && savedNganh == nganh.MaNganh) op.selected = true;
                            selectNganh.appendChild(op);
                        });
                    });
            }

            function loadLop(nganhID) {
                selectLop.innerHTML = `<option disabled value="0">=CHỌN LỚP=</option>`;
                if (!nganhID || nganhID === "0") return Promise.resolve();
                return fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${nganhID}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(lop => {
                            const op = document.createElement("option");
                            op.value = lop.MaLop;
                            op.textContent = lop.TenLop;
                            if (savedLop && savedLop == lop.MaLop) op.selected = true;
                            selectLop.appendChild(op);
                        });
                    });
            }

            function loadLopQuanLy(nganhID) {
                const wrapper = document.querySelector('.dept-item-wrapper');
                wrapper.innerHTML = "";
                if (!nganhID || nganhID === "0") return;
                return fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${nganhID}`)
                    .then(res => res.json())
                    .then(data => {

                        data.forEach(lop => {
                            const item = document.createElement("label");
                            item.className = "dept-item";
                            const checked = savedLopQuanLy.includes(lop.MaLop) ? "checked" : "";
                            item.innerHTML = `
                        <input type="checkbox" name="listLopQuanLy[]" value="${lop.MaLop}" ${checked}>
                        <span>${lop.TenLop}</span>`;
                            wrapper.appendChild(item);
                        });
                    });
            }

            if (savedKhoa) selectKhoa.value = savedKhoa;

            loadNganh(savedKhoa)
                .then(() => loadLop(savedNganh))
                .then(() => loadLopQuanLy(savedNganh));

            selectKhoa.addEventListener("change", () => {

                // Load ngành xong rồi mới xuống .then()
                loadNganh(selectKhoa.value).then(() => {

                    // Lấy ngành đầu tiên (loại bỏ option disabled)
                    const firstNganh = selectNganh.querySelector("option");

                    if (firstNganh) {
                        // Auto select ngành đầu tiên
                        selectNganh.value = firstNganh.value;

                        // Rồi mới load lớp theo ngành này
                        loadLop(firstNganh.value);

                        // Và load lớp quản lý nếu cần
                        loadLopQuanLy(firstNganh.value);
                    } else {
                        // Nếu khoa này không có ngành nào luôn
                        selectLop.innerHTML = `<option value="0" disabled>=CHỌN LỚP=</option>`;
                        document.querySelector('.dept-item-wrapper').innerHTML = "";
                    }
                });

            });


            selectNganh.addEventListener("change", () => {
                loadLop(selectNganh.value);
                loadLopQuanLy(selectNganh.value);
            });
        });


       
        // auto selected
        selectKhoa = document.getElementById("SelectKhoa");
        document.querySelectorAll("#SelectKhoa option").forEach(op => {
            if (op.value == selectKhoa.dataset.selected) {
                op.selected = true;
            }
        });
    </script>
</body>

</html>
