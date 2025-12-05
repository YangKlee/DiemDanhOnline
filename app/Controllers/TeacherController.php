<?php 
    class TeacherController extends BaseController
    {
        public function showHomePage()
        {
            $this->renderTeacher("Trang chủ giảng viên", "Home.php");
        }
        public function showDSLopHP()
        {
            $this->renderTeacher("Danh sách lớp học phần", "DSLHP.php");
        }
        public function showDSLopSV()
        {

        }
        public function showDSMonDayHoc()
        {
            $this->renderTeacher("Danh sách môn dạy học", "QLMH.php");
        }
        public function showTaoPhienDiemDanh()
        {
            $this->renderTeacher("Tạo phiên điểm danh", "TaoDiemDanh.php");
        }
        public function showCapNhatPhienDiemDanh()
        {
            $this->renderTeacher("Cập nhật phiên điểm danh", "CapNhapDiemDanh.php");
        }
        public function showQLDanhSachDiemDanh()
        {
            $this->renderTeacher("Danh sách điểm danh", "PhienDiemDanh.php");
        }
        public function showThongKeChuyenCan()
        {
            $this->renderTeacher("Thống kê chuyên cần", "ThongKeGV.php");
        }
    }
?>