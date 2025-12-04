const data = [
  {course:'Cấu trúc dữ liệu', class:'CT101', date:'2025-11-27', time:'08:00 - 08:10', status:'present', code:'DD101'},
  {course:'Lập trình Web', class:'WB202', date:'2025-11-20', time:'13:30 - 13:40', status:'late', code:'DD245'},
  {course:'Toán rời rạc', class:'MA201', date:'2025-11-13', time:'15:00 - 15:10', status:'absent', code:'DD301'}
];

function badge(status) {
  if (status==='present') return '<span class="badge success">Có mặt</span>';
  if (status==='late') return '<span class="badge warning">Muộn</span>';
  return '<span class="badge danger">Vắng</span>';
}

function render(rows) {
  const tbody = document.querySelector('#historyList tbody');
  tbody.innerHTML = rows.map(r =>
    `<tr>
      <td>${r.course}</td><td>${r.class}</td>
      <td>${new Date(r.date).toLocaleDateString('vi-VN')}</td>
      <td>${r.time}</td>
      <td>${badge(r.status)}</td>
      <td>${r.code}</td>
    </tr>`
  ).join('');
}

function apply() {
  const sem = document.getElementById('filterSemester').value;
  const course = document.getElementById('filterCourse').value.toLowerCase();
  const status = document.getElementById('filterStatus').value;
  const filtered = data.filter(r => {
    const okCourse = !course || r.course.toLowerCase().includes(course);
    const okStatus = !status || r.status === status;
    const okSem = !sem || r.date.startsWith(sem.split('-')[0]); // demo theo năm
    return okCourse && okStatus && okSem;
  });
  render(filtered);
}

document.addEventListener('DOMContentLoaded', () => {
  render(data);
  document.getElementById('filterSemester').addEventListener('change', apply);
  document.getElementById('filterCourse').addEventListener('input', apply);
  document.getElementById('filterStatus').addEventListener('change', apply);
});
