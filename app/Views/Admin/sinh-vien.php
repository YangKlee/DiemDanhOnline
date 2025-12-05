<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sinh viên</title>
    <link rel="stylesheet" href="public/assets/css/admin.css">
    

</head>

<body>

    <div class="wrapper">

        <main class="content">
            <h1 class="page-title">Danh sách sinh viên</h1>

            <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeyup="searchSV()">
            <button onclick="showForm()" style="margin-bottom:10px;">+ Thêm sinh viên</button>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>MSSV</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>SĐT</th>
                            <th>CCCD</th>
                            <th>Email</th>
                            <th>Lớp SV</th>
                            <th>Khoa</th>
                            <th>Địa chỉ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="student-table">
                        <tr>
                            <td>SV001</td>
                            <td>Nguyễn Văn A</td>
                            <td>01/01/2004</td>
                            <td>Nam</td>
                            <td>0909333555</td>
                            <td>01234566789</td>
                            <td>sva@example.com</td>
                            <td>DHCNTT17</td>
                            <td>CNTT</td>
                            <td>HCM</td>
                            <td>
                                <button onclick="editRow(this)">Sửa</button>
                                <button onclick="deleteRow(this)">Xóa</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Popup thêm sinh viên -->
            <div id="popup-bg" class="popup-bg">
                <div class="popup-box">
                    <h3>Thêm sinh viên</h3>

                    <label>MSSV:</label>
                    <input type="text" id="mssv">
                    <label>Họ tên:</label>
                    <input type="text" id="hoten">
                    <label>Ngày sinh:</label>
                    <input type="date" id="ngaysinh">
                    <label>Giới tính:</label>
                    <input type="text" id="gioitinh">
                    <label>SĐT:</label>
                    <input type="text" id="sdt">
                    <label>CCCD:</label>
                    <input type="text" id="cccd">
                    <label>Email:</label>
                    <input type="text" id="email">
                    <label>Lớp SV:</label>
                    <input type="text" id="lop">
                    <label>Khoa:</label>
                    <input type="text" id="khoa">
                    <label>Địa chỉ:</label>
                    <input type="text" id="diachi">

                    <div style="margin-top: 15px;">
                        <button onclick="saveSV()">Lưu</button>
                        <button onclick="closePopup()">Hủy</button>
                    </div>
                </div>


        </main>
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

    // Thêm sinh viên mới
    function saveSV() {
        let mssv = document.getElementById("mssv").value;
        let hoten = document.getElementById("hoten").value;
        let ngaysinh = document.getElementById("ngaysinh").value;
        let gioitinh = document.getElementById("gioitinh").value;
        let sdt = document.getElementById("sdt").value;
        let cccd = document.getElementById("cccd").value;
        let email = document.getElementById("email").value;
        let lop = document.getElementById("lop").value;
        let khoa = document.getElementById("khoa").value;
        let diachi = document.getElementById("diachi").value;

        if (!mssv || !hoten || !ngaysinh || !gioitinh || !sdt || !cccd || !email || !lop || !khoa || !diachi) {
            alert("Không được để trống bất kỳ mục nào!");
            return;
        }

        let row = `
    <tr>
        <td>${mssv}</td>
        <td>${hoten}</td>
        <td>${ngaysinh}</td>
        <td>${gioitinh}</td>
        <td>${sdt}</td>
        <td>${cccd}</td>
        <td>${email}</td>
        <td>${lop}</td>
        <td>${khoa}</td>
        <td>${diachi}</td>
        <td>
            <button onclick="editRow(this)">Sửa</button>
            <button onclick="deleteRow(this)">Xóa</button>
        </td>
    </tr>
    `;
        document.getElementById("student-table").innerHTML += row;
        closePopup();

        // Xóa dữ liệu form
        document.getElementById("mssv").value = "";
        document.getElementById("hoten").value = "";
        document.getElementById("ngaysinh").value = "";
        document.getElementById("gioitinh").value = "";
        document.getElementById("sdt").value = "";
        document.getElementById("cccd").value = "";
        document.getElementById("email").value = "";
        document.getElementById("lop").value = "";
        document.getElementById("khoa").value = "";
        document.getElementById("diachi").value = "";
    }

    // Tìm kiếm sinh viên
    function searchSV() {
        let filter = document.getElementById("searchInput").value.toUpperCase();
        let rows = document.querySelectorAll("#student-table tr");

        rows.forEach(row => {
            let mssv = row.cells[0].innerText.toUpperCase();
            let name = row.cells[1].innerText.toUpperCase();
            if (mssv.includes(filter) || name.includes(filter)) {
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

        for (let i = 0; i < 10; i++) {
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

        for (let i = 0; i < 10; i++) {
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