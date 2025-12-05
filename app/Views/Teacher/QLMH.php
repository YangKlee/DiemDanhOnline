<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/GiangVien.css">
    <link rel="stylesheet" href="public/assets/css/GiangVienQL.css">
</head>
<body>
<div class="main-content">

<h2>Quản lý môn học</h2>

<input type="text" id="searchInput" placeholder="Tìm kiếm môn học...">

<table id="subjectTable">
    <thead>
        <tr>
            <th>Mã môn</th>
            <th>Tên môn học</th>
            <th>Số tín chỉ</th>
            <th>Khoa</th>
            <th>Mô tả</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>CT101</td>
            <td>Lập trình C</td>
            <td>3</td>
            <td>CNTT</td>
            <td>Môn học cơ bản về lập trình</td>
        </tr>

        <tr>
            <td>CT203</td>
            <td>Cấu trúc dữ liệu</td>
            <td>4</td>
            <td>CNTT</td>
            <td>Học về các cấu trúc dữ liệu cơ bản</td>
        </tr>
    </tbody>
</table>

</div>

<script>
// ======= TÌM KIẾM MÔN HỌC =======
const searchInput = document.getElementById('searchInput');
const table = document.getElementById('subjectTable').getElementsByTagName('tbody')[0];

searchInput.addEventListener('keyup', function() {
    const filter = searchInput.value.toLowerCase();
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let match = false;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().includes(filter)) {
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
