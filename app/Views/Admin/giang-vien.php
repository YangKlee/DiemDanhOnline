<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giảng viên</title>
    <link rel="stylesheet" href="public/assets/css/admin.css">
    

</head>

<body>

    <div class="wrapper">

        <div class="content">

            <h1>Giảng viên</h1>
            <br><br>

            <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeyup="searchGV()">

            <button onclick="showForm()" style="margin-bottom:10px;">+ Thêm giảng viên</button>
            <br><br>
            <table>
                <thead>
                    <tr>
                        <th>Mã GV</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>SĐT</th>
                        <th>CCCD</th>
                        <th>Email</th>
                        <th>Khoa</th>
                        <th>Địa chỉ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="teacher-table">
                    <tr>
                        <td>GV001</td>
                        <td>Nguyễn Văn B</td>
                        <td>Nam</td>
                        <td>0909123456</td>
                        <td>0123456789</td>
                        <td>gvb@example.com</td>
                        <td>CNTT</td>
                        <td>HCM</td>
                        <td>
                            <button onclick="editRow(this)">Sửa</button>
                            <button onclick="deleteRow(this)">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td>GV002</td>
                        <td>Nguyễn Văn A</td>
                        <td>Nam</td>
                        <td>0909123345</td>
                        <td>0123456789</td>
                        <td>gva@example.com</td>
                        <td>CNTT</td>
                        <td>Quy Nhơn</td>
                        <td>
                            <button onclick="editRow(this)">Sửa</button>
                            <button onclick="deleteRow(this)">Xóa</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- POPUP THÊM GIẢNG VIÊN -->
            <div id="popup-bg" class="popup-bg">
                <div class="popup-box">
                    <h3>Thêm giảng viên</h3>

                    <label>Mã GV:</label>
                    <input type="text" id="magv">

                    <label>Họ tên:</label>
                    <input type="text" id="hoten">

                    <label>Giới tính:</label>
                    <input type="text" id="gioitinh">

                    <label>SĐT:</label>
                    <input type="text" id="sdt">

                    <label>CCCD:</label>
                    <input type="text" id="cccd">

                    <label>Email:</label>
                    <input type="text" id="email">

                    <label>Khoa:</label>
                    <input type="text" id="khoa">

                    <label>Địa chỉ:</label>
                    <input type="text" id="diachi">

                    <div style="margin-top: 15px;">
                        <button onclick="saveGV()">Lưu</button>
                        <button onclick="closePopup()">Hủy</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    // Hiển thị popup
    function showForm() {
        document.getElementById("popup-bg").style.display = "flex";
    }

    // Đóng popup
    function closePopup() {
        document.getElementById("popup-bg").style.display = "none";
    }

    // Thêm giảng viên mới
    function saveGV() {
        let magv = document.getElementById("magv").value;
        let hoten = document.getElementById("hoten").value;
        let gioitinh = document.getElementById("gioitinh").value;
        let sdt = document.getElementById("sdt").value;
        let cccd = document.getElementById("cccd").value;
        let email = document.getElementById("email").value;
        let khoa = document.getElementById("khoa").value;
        let diachi = document.getElementById("diachi").value;

        if (!magv || !hoten || !gioitinh || !sdt || !cccd || !email || !khoa || !diachi) {
            alert("Không được để trống bất kỳ mục nào!");
            return;
        }

        let row = `
        <tr>
            <td>${magv}</td>
            <td>${hoten}</td>
            <td>${gioitinh}</td>
            <td>${sdt}</td>
            <td>${cccd}</td>
            <td>${email}</td>
            <td>${khoa}</td>
            <td>${diachi}</td>
            <td>
                <button onclick="editRow(this)">Sửa</button>
                <button onclick="deleteRow(this)">Xóa</button>
            </td>
        </tr>
    `;

        document.getElementById("teacher-table").innerHTML += row;
        closePopup();

        // Xóa dữ liệu cũ trong form
        document.getElementById("magv").value = "";
        document.getElementById("hoten").value = "";
        document.getElementById("gioitinh").value = "";
        document.getElementById("sdt").value = "";
        document.getElementById("cccd").value = "";
        document.getElementById("email").value = "";
        document.getElementById("khoa").value = "";
        document.getElementById("diachi").value = "";
    }

    // Tìm kiếm giảng viên
    function searchGV() {
        let filter = document.getElementById("searchInput").value.toUpperCase();
        let rows = document.querySelectorAll("#teacher-table tr");

        rows.forEach(row => {
            let ma = row.cells[0].innerText.toUpperCase();
            let name = row.cells[1].innerText.toUpperCase();
            if (ma.includes(filter) || name.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Xóa dòng
    function deleteRow(btn) {
        if (confirm("Bạn có chắc muốn xóa?")) {
            btn.parentElement.parentElement.remove();
        }
    }

    // Sửa dòng
    function editRow(btn) {
        let row = btn.parentElement.parentElement;

        for (let i = 0; i < 8; i++) {
            let old = row.cells[i].innerText;
            row.cells[i].innerHTML = `<input value="${old}">`;
        }

        btn.innerText = "Lưu";
        btn.onclick = function() {
            saveRow(this);
        };
    }

    // Lưu sau khi sửa
    function saveRow(btn) {
        let row = btn.parentElement.parentElement;

        for (let i = 0; i < 8; i++) {
            let value = row.cells[i].querySelector('input').value;
            row.cells[i].innerText = value;
        }

        btn.innerText = "Sửa";
        btn.onclick = function() {
            editRow(this);
        };
    }
    </script>

</body>

</html>