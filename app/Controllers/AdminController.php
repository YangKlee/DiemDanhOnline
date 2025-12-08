<?php 
    require_once __DIR__ . '/BaseController.php';
    class AdminController extends BaseController
    {
        public function showHomePage()
        {
            $this->renderAdmin("Trang chủ", "admin.php");
        }
        public function showQuanLyDiemDanh()
        {
            $this->renderAdmin("Quản lý điểm danh", "attendances.php");
        }
        public function showQuanLyTKSinhVien()
        {
            $this->renderAdmin("Quản lý tài khoản sinh viên", "sinh-vien.php");
        }
        public function showQuanLyTKGiangVien()
        {
            $this->renderAdmin("Quản lý tài khoản giảng viên", "giang-vien.php");

        }
        public function showQuanLyTKAdmin()
        {
            $this->renderAdmin("Quản lý tài khoản admin", "tkadmin.php");

        }
        public function showResetMatKhau()
        {
            $this->renderAdmin("Reset mật khẩu", "reset-pass.php");
        }
        public function showQLKhoa()
        {
            $this->renderAdmin("Quản lý khoa", "ql-khoa.php");
        }
        public function showQlNganh()
        {
            $this->renderAdmin("Quản lý ngành", "ql-nganh.php");
        }
        public function showQlLop()
        {
            $this->renderAdmin("Quản lý lớp", "ql-lop.php");
        }
        public function showQlHocKy()
        {
            $this->renderAdmin("Quản lý học kỳ", "ql-hocky.php");
        }
        public function showThongKe()
        {
            $this->renderAdmin("Thống kê", "thong-ke.php");
        }
    }

?>