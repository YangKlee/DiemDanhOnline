<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/GiangVien.css">
    <link rel="stylesheet" href="public/assets/css/GiangVienQL.css">

</head>
<body>
<div class="main-content">
<h2>Danh sách lớp học phần</h2>

<input type="text" id="searchInput" placeholder="Tìm kiếm lớp học phần...">

<table id="classTable">
    <thead>
        <tr>
            <th>Mã lớp HP</th>
            <th>Môn học</th>
            <th>Thứ</th>
            <th>Tiết</th>
            <th>Phòng</th>
            <th>Học kỳ</th>
            <th>Năm học</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>CT101</td>
            <td>Lập trình C</td>
            <td>2</td>
            <td>1-3</td>
            <td>A102</td>
            <td>HK1</td>
            <td>2024-2025</td>
        </tr>
       
    </tbody>
</table>
</div>

<script>
const searchInput = document.getElementById('searchInput');
const table = document.getElementById('classTable').getElementsByTagName('tbody')[0];

searchInput.addEventListener('keyup', function() {
    const filter = searchInput.value.toLowerCase();
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let match = false;
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        rows[i].style.display = match ? '' : 'none';
    }
});
</script>

</body>
</html>
