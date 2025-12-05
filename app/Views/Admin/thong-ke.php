<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thống kê</title>
    <link rel="stylesheet" href="public/assets/css/admin.css">
    


    <!-- Export Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>

    <script>
    document.addEventListener("DOMContentLoaded", () => {

        // ===== XUẤT EXCEL =====
        document.getElementById("btnExcel").addEventListener("click", function() {
            const table = document.querySelector(".table-box table");
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Thống kê"
            });
            XLSX.writeFile(wb, "ThongKe.xlsx");
        });

        // ===== XUẤT PDF =====
        document.getElementById("btnPDF").addEventListener("click", function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            let y = 10;
            doc.setFontSize(14);
            doc.text("BÁO CÁO THỐNG KÊ", 70, y);
            y += 12;

            const rows = document.querySelectorAll(".table-box table tbody tr");

            doc.setFontSize(11);

            rows.forEach(row => {
                const cells = row.querySelectorAll("td");
                const line = `${cells[0].innerText}: ${cells[1].innerText}`;
                doc.text(line, 10, y);
                y += 8;
            });

            doc.save("ThongKe.pdf");
        });

    });
    </script>


    <div class="wrapper">
        <main class="content">
            <h1 class="page-title">Thống kê</h1>
            <div class="form-box">
                <label>Học kỳ:</label>
                <select>
                    <option>HK1</option>
                    <option>HK2</option>
                </select>

                <label>Năm học:</label>
                <select>
                    <option>2023-2024</option>
                    <option>2024-2025</option>
                </select>

                <button class="btn">Xem thống kê</button>
            </div>

            <br>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>Chỉ số</th>
                            <th>Giá trị</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Số lớp học phần đang hoạt động</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td>Số buổi học đã diễn ra</td>
                            <td>146</td>
                        </tr>
                        <tr>
                            <td>Tỉ lệ điểm danh trung bình</td>
                            <td>87%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>
            <h2>Danh sách sinh viên vắng nhiều</h2>

            <div class="table-box">
                <table>
                    <thead>
                        <tr>
                            <th>MSSV</th>
                            <th>Họ tên</th>
                            <th>Số buổi vắng</th>
                            <th>Lớp học phần</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <br>

            <!-- Nút xuất file có ID -->
            <button class="btn" id="btnExcel">Xuất Excel</button>
            <button class="btn" id="btnPDF">Xuất PDF</button>

        </main>
    </div>

</body>

</html>