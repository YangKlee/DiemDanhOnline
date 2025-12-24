<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="public/assets/css/qltaikhoan.css">
</head>

<body>

    <div class="page-container">

        <h1 class="main-page-title">QUẢN LÝ SINH VIÊN</h1>

        <div class="custom-card">

            <div class="toolbar-container mb-4">

                <div class="toolbar-left">
                    <div class="toolbar-title">
                        <i class="bi bi-building-fill me-2"></i> <span>Danh sách tài khoản sinh viên</span>
                    </div>
                </div>

                <div class="toolbar-right d-flex align-items-center gap-3">
                    <a <?php echo isset($_GET['search']) ? '' : 'style="display:none;"'; ?> href="Admin/QuanLyTaiKhoan/SinhVien">Hủy tìm kiếm</a>
                    <form action="" method="GET" class="search-wrapper position-relative">
                        <input type="search" name="search" class="form-control search-input" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Tìm kiếm sinh viên...">
                        <i class="bi bi-search search-icon"></i>
                    </form>

                    <a href="Admin/QuanLyTaiKhoan/SinhVien/ThemSinhVien" class="btn btn-primary btn-add">
                        <i class="bi bi-plus-circle me-2"></i>
                        Thêm sinh viên
                    </a>
                </div>
            </div>
            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã sinh viên</div>
                    <div class="col-cell c-ho">Họ</div>
                    <div class="col-cell c-ten">Tên</div>
                    <div class="col-cell c-lop">Lớp</div>
                    <div class="col-cell email">Email</div>
                    <<div class="col-cell phone">Số điện thoại</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>
                <!-- NgaySinh, SoDT, CCCD, Email, DiaChi -->
                <div class="table-body">
                    <?php foreach ($data['listAccount'] as $sv): ?>
                        <div class="table-row">
                            <div class="col-cell c-code"><?php echo htmlspecialchars($sv['MSSV']); ?></div>
                            <div class="col-cell c-ho"><?php echo htmlspecialchars($sv['Ho']); ?></div>
                            <div class="col-cell c-ten"><?php echo htmlspecialchars($sv['Ten']); ?></div>
                            <div class="col-cell c-lop"><?php echo htmlspecialchars($sv['TenLop']); ?></div>
                            <div class="col-cell email"><?php echo htmlspecialchars($sv['Email']); ?></div>
                            <div class="col-cell phone"><?php echo htmlspecialchars($sv['SoDT']); ?></div>
                            <div class="col-cell c-action">
                                <a href="Admin/SuaSinhVien?StudentID= <?php echo htmlspecialchars($sv['MSSV']) ?>" class="btn-icon btn-edit" title="Sửa"><i class="bi bi-pencil-square"></i>Sửa </a>
                                <a onclick="return confirm('Bạn chắc chắn muốn xóa sinh viên này, mọi dữ liệu liên quan cũng sẽ bị xóa?')" href="Admin/XoaSinhVien?StudentID= <?php echo htmlspecialchars($sv['MSSV']) ?>" class="btn-icon btn-delete" title="Xóa"><i class="bi bi-trash"></i>Xóa</a>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>



            </div>

            <div class="d-flex justify-content-center mt-4">
                <!-- <nav>
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                    </ul>
                </nav> -->
            </div>

        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectKhoa = document.getElementById("SelectKhoa");
            const selectNganh = document.getElementById("SelectNganh");
            const selectLop = document.getElementById("SelectLop");
            const maKhoa = selectKhoa.value; // giá trị khoa đang được chọn (nếu có)
            const maNganhHienTai = selectNganh.getAttribute("data-selected");
            const maLopHienTai = selectLop.getAttribute("data-selected");
            if (!maKhoa || maKhoa === "0") return;


            selectNganh.innerHTML = `<option value="0">TẤT CẢ</option>`;

            fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${maKhoa}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(nganh => {
                        const op = document.createElement("option");
                        op.value = nganh.MaNganh;
                        op.textContent = nganh.TenNganh;

                        // chọn đúng ngành hiện tại nếu có
                        if (maNganhHienTai && maNganhHienTai == nganh.MaNganh) {
                            op.selected = true;
                        }

                        selectNganh.appendChild(op);
                    });
                })
                .catch(err => console.log(err));
            fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${maNganhHienTai}`)
                .then(response => response.json())
                .then(data => {
                    const lopSelect = document.querySelector('#SelectLop');
                    lopSelect.innerHTML = '<option selected value="0">TẤT CẢ</option>';
                    data.forEach(lop => {
                        const option = document.createElement('option');
                        option.value = lop.MaLop;
                        option.textContent = lop.TenLop;
                        lopSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy danh sách lớp:', error));
        });
        document.querySelector('#SelectKhoa').addEventListener('change', function() {
            const khoaID = this.value;
            fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${khoaID}`)
                .then(response => response.json())
                .then(data => {
                    const nganhSelect = document.querySelector('#SelectNganh');
                    nganhSelect.innerHTML = '<option selected value="0">TẤT CẢ</option>';
                    const lopSelect = document.querySelector('#SelectLop');
                    lopSelect.innerHTML = '<option selected value="0">TẤT CẢ</option>';
                    data.forEach(nganh => {
                        const option = document.createElement('option');
                        option.value = nganh.MaNganh;
                        option.textContent = nganh.TenNganh;
                        nganhSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy danh sách ngành:', error));

        });


        document.querySelector('#SelectNganh').addEventListener('change', function() {
            const nganhID = this.value;
            fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${nganhID}`)
                .then(response => response.json())
                .then(data => {
                    const lopSelect = document.querySelector('#SelectLop');
                    lopSelect.innerHTML = '<option selected value="0">TẤT CẢ</option>';
                    data.forEach(lop => {
                        const option = document.createElement('option');
                        option.value = lop.MaLop;
                        option.textContent = lop.TenLop;
                        lopSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy danh sách lớp:', error));
        });
    </script>
</body>

</html>