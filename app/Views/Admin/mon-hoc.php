<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Môn học</title>
    <link rel="stylesheet" href="public/assets/css/admin.css">
    

</head>

<body>

    <div class="wrapper">

        <main class="content">
            <h1 class="page-title">Danh sách môn học</h1>

            <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeyup="searchMH()">
            <button onclick="showForm()" style="margin-bottom:10px;">+ Thêm môn học</button>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>Mã môn</th>
                            <th>Tên môn học</th>
                            <th>Số tín chỉ</th>
                            <th>Khoa phụ trách</th>
                            <th>Mã GV phụ trách</th>
                            <th>Tên GV phụ trách</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Học kỳ</th>
                            <th>Năm</th>
                            <th>Mã lớp học phần</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="mh-table">
                        <tr>
                            <td>MH001</td>
                            <td>Lập trình C</td>
                            <td>3</td>
                            <td>CNTT</td>
                            <td>GV001</td>
                            <td>Nguyễn Văn B</td>
                            <td>01/01/2025</td>
                            <td>30/04/2025</td>
                            <td>1</td>
                            <td>2025</td>
                            <td>LHP001</td>
                            <td>
                                <button onclick="editRow(this)">Sửa</button>
                                <button onclick="deleteRow(this)">Xóa</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <!-- Popup thêm môn học -->
            <div id="popup-bg" class="popup-bg">
                <div class="popup-box">
                    <h3>Thêm môn học</h3>

                    <label>Mã môn:</label>
                    <input type="text" id="mamh">

                    <label>Tên môn học:</label>
                    <input type="text" id="tenmh">

                    <label>Số tín chỉ:</label>
                    <input type="number" id="sotc" min="1">

                    <label>Khoa phụ trách:</label>
                    <input type="text" id="khoa">

                    <label>Mã GV phụ trách:</label>
                    <input type="text" id="magv">

                    <label>Tên GV phụ trách:</label>
                    <input type="text" id="tengv">

                    <label>Thời gian bắt đầu:</label>
                    <input type="date" id="tgbd">

                    <label>Thời gian kết thúc:</label>
                    <input type="date" id="tgkt">

                    <label>Học kỳ:</label>
                    <input type="number" id="hocky" min="1">

                    <label>Năm:</label>
                    <input type="number" id="nam" min="2000">
                    <label>Mã lớp học phần:</label>
                    <input type="text" id="malhp">


                    <div style="margin-top: 15px;">
                        <button onclick="saveMH()">Lưu</button>
                        <button onclick="closePopup()">Hủy</button>
                    </div>
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

    // Thêm môn học mới
    function saveMH() {
        let mamh = document.getElementById("mamh").value;
        let tenmh = document.getElementById("tenmh").value;
        let sotc = document.getElementById("sotc").value;
        let khoa = document.getElementById("khoa").value;
        let magv = document.getElementById("magv").value;
        let tengv = document.getElementById("tengv").value;
        let tgbd = document.getElementById("tgbd").value;
        let tgkt = document.getElementById("tgkt").value;
        let hocky = document.getElementById("hocky").value;
        let nam = document.getElementById("nam").value;
        let malhp = document.getElementById("malhp").value;

        if (!mamh || !tenmh || !sotc || !khoa || !magv || !tengv || !tgbd || !tgkt || !hocky || !nam || !malhp) {
            alert("Không được để trống bất kỳ mục nào!");
            return;
        }

        let row = `
    <tr>
        <td>${mamh}</td>
        <td>${tenmh}</td>
        <td>${sotc}</td>
        <td>${khoa}</td>
        <td>${magv}</td>
        <td>${tengv}</td>
        <td>${tgbd}</td>
        <td>${tgkt}</td>
        <td>${hocky}</td>
        <td>${nam}</td>
        <td>${malhp}</td>
        <td>
            <button onclick="editRow(this)">Sửa</button>
            <button onclick="deleteRow(this)">Xóa</button>
        </td>
    </tr>
    `;
        document.getElementById("mh-table").innerHTML += row;
        closePopup();

        // Reset form
        ["mamh", "tenmh", "sotc", "khoa", "magv", "tengv", "tgbd", "tgkt", "hocky", "nam", "malhp"].forEach(id => {
            document.getElementById(id).value = "";
        });
    }


    // Sửa dòng
    function editRow(btn) {
        let row = btn.parentElement.parentElement;

        for (let i = 0; i < 10; i++) { // 10 cột dữ liệu
            let old = row.cells[i].innerText;
            row.cells[i].innerHTML = `<input value="${old}">`;
        }

        btn.innerText = "Lưu";
        btn.onclick = function() {
            saveRow(this);
        };
    }


    // Tìm kiếm môn học
    function searchMH() {
        let filter = document.getElementById("searchInput").value.toUpperCase();
        let rows = document.querySelectorAll("#mh-table tr");

        rows.forEach(row => {
            let mamh = row.cells[0].innerText.toUpperCase();
            let tenmh = row.cells[1].innerText.toUpperCase();
            if (mamh.includes(filter) || tenmh.includes(filter)) {
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

        for (let i = 0; i < 11; i++) { // 11 cột dữ liệu
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

        for (let i = 0; i < 11; i++) {
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