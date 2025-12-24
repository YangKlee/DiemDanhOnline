<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Lớp học phần</title>
    <link rel="stylesheet" href="public/assets/css/admin.css">
    

</head>

<body>

    <div class="wrapper">
        <main class="content">
            <h1 class="page-title">Danh sách lớp học phần</h1>

            <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeyup="searchLHP()">
            <a href="Admin/QuanLyDiemDanh/LopHocPhan/ThemLopHP" class="btn btn-primary" style="margin-bottom:10px;">+ Thêm lớp học phần</a>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>Mã lớp HP</th>
                            <th>Môn học</th>
                            <th>Giảng viên</th>
                            <th>Học kỳ</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="lhp-table">
                        <?php foreach($data['listLopHP'] as $lhp): ?>
                            <tr>
                            <td><?= htmlspecialchars($lhp['MaLHP']) ?></td>
                            <td><?= htmlspecialchars($lhp['TenMonHoc']) ?></td>
                            <td><?= htmlspecialchars($lhp['TenGiangVien']) ?></td>
                            <td><?= htmlspecialchars($lhp['TenHK']) ?></td>
                            <td><?= htmlspecialchars($lhp['ThoiGianBatDau']) ?></td>
                            <td><?= htmlspecialchars($lhp['ThoiGianKetThuc']) ?></td>
                            <td>
                                <a href="Admin/QuanLyDiemDanh/LopHocPhan/SuaLopHP?MaLop=<?= htmlspecialchars($lhp['MaLHP']) ?>">Sửa</a>
                                <a href="Admin/QuanLyDiemDanh/LopHocPhan/XoaLopHP?MaLop=<?= htmlspecialchars($lhp['MaLHP']) ?>">Xóa</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <!-- <tr>
                            <td>CT101</td>
                            <td>Lập trình C</td>
                            <td>GV001</td>
                            <td>2</td>
                            <td>08:00 01/09/2024</td>
                            <td>17:00 15/12/2024</td>
                            <td>
                                <button onclick="editRow(this)">Sửa</button>
                                <button onclick="deleteRow(this)">Xóa</button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>

            <!-- Popup thêm lớp học phần -->
            <div id="popup-bg" class="popup-bg">
                <div class="popup-box">
                    <h3>Thêm lớp học phần</h3>

                    <label>Mã lớp HP:</label>
                    <input type="text" id="malhp">

                    <label>Môn học:</label>
                    <input type="text" id="monhoc">

                    <label>Giảng viên:</label>
                    <input type="text" id="giangvien">

                    <label>Thứ:</label>
                    <input type="number" id="thu" min="2" max="7">

                    <label>Tiết:</label>
                    <input type="text" id="tiet">

                    <label>Phòng:</label>
                    <input type="text" id="phong">

                    <label>Học kỳ:</label>
                    <select id="hocky">
                        <option value="HK1">HK1</option>
                        <option value="HK2">HK2</option>
                    </select>

                    <label>Năm học:</label>
                    <input type="text" id="namhoc" placeholder="2024-2025">

                    <label>Trạng thái:</label>
                    <select id="trangthai">
                        <option value="Đang mở">Đang mở</option>
                        <option value="Đã đóng">Đã đóng</option>
                    </select>

                    <div style="margin-top: 15px;">
                        <button onclick="saveLHP()">Lưu</button>
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

    // Thêm lớp học phần mới
    function saveLHP() {
        let malhp = document.getElementById("malhp").value;
        let monhoc = document.getElementById("monhoc").value;
        let giangvien = document.getElementById("giangvien").value;
        let thu = document.getElementById("thu").value;
        let tiet = document.getElementById("tiet").value;
        let phong = document.getElementById("phong").value;
        let hocky = document.getElementById("hocky").value;
        let namhoc = document.getElementById("namhoc").value;
        let trangthai = document.getElementById("trangthai").value;

        if (!malhp || !monhoc || !giangvien || !thu || !tiet || !phong || !hocky || !namhoc || !trangthai) {
            alert("Không được để trống bất kỳ mục nào!");
            return;
        }

        let row = `
    <tr>
        <td>${malhp}</td>
        <td>${monhoc}</td>
        <td>${giangvien}</td>
        <td>${thu}</td>
        <td>${tiet}</td>
        <td>${phong}</td>
        <td>${hocky}</td>
        <td>${namhoc}</td>
        <td>${trangthai}</td>
        <td>
            <button onclick="editRow(this)">Sửa</button>
            <button onclick="deleteRow(this)">Xóa</button>
        </td>
    </tr>
    `;
        document.getElementById("lhp-table").innerHTML += row;
        closePopup();

        // Xóa dữ liệu form
        document.getElementById("malhp").value = "";
        document.getElementById("monhoc").value = "";
        document.getElementById("giangvien").value = "";
        document.getElementById("thu").value = "";
        document.getElementById("tiet").value = "";
        document.getElementById("phong").value = "";
        document.getElementById("hocky").value = "HK1";
        document.getElementById("namhoc").value = "";
        document.getElementById("trangthai").value = "Đang mở";
    }

    // Tìm kiếm lớp học phần
    function searchLHP() {
        let filter = document.getElementById("searchInput").value.toUpperCase();
        let rows = document.querySelectorAll("#lhp-table tr");

        rows.forEach(row => {
            let malhp = row.cells[0].innerText.toUpperCase();
            let monhoc = row.cells[1].innerText.toUpperCase();
            if (malhp.includes(filter) || monhoc.includes(filter)) {
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
    
    // Lưu sau khi sửa
    function saveRow(btn) {
        let row = btn.parentElement.parentElement;

        for (let i = 0; i < 9; i++) {
            if (i === 6 || i === 8) {
                let value = row.cells[i].querySelector('select').value;
                row.cells[i].innerText = value;
            } else {
                let value = row.cells[i].querySelector('input').value;
                row.cells[i].innerText = value;
            }
        }

        btn.innerText = "Sửa";
        btn.onclick = function() {
            editRow(this);
        };
    }
    </script>

</body>

</html>