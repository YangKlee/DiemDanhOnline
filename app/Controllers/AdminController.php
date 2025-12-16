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
            $title = "Khoa";
            $khoaModel = new Khoa();
            $search = isset($_GET['search']) ? $_GET['search'] : null;
            if(!is_null($search))
            {
                $listKhoa = $khoaModel->searchKhoa($search);
            }
            else
            {
                $listKhoa = $khoaModel->getAll();
            }
            $this->renderAdmin("Quản lý khoa", "QLKhoa.php", $listKhoa);
        }
        public function showThemKhoa()
        {
            $this->renderAdmin("Thêm khoa", "ThemKhoa.php");
        }
        public function submitThemKhoa()
        {
            $tenKhoa = trim($_POST['TenKhoa'] ?? '');
            $maKhoa = trim($_POST['MaKhoa'] ?? '');
            $khoaModel = new Khoa();
            $findKhoa = $khoaModel->getKhoaByMaKhoa($maKhoa);
            if ($findKhoa)
            {
                $this->rejectToPage("/Admin/QuanLyHeThong/Khoa","Mã khoa đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                $khoaModel->insertKhoa($maKhoa, $tenKhoa);
                $this->rejectToPage("/Admin/QuanLyHeThong/Khoa","Thêm khoa thành công.");
                return;
            }
        }
        public function showQlNganh()
        {
            $this->renderAdmin("Quản lý ngành", "QLNganh.php");
        }
        public function showQlLop()
        {
            $this->renderAdmin("Quản lý lớp", "QLLop.php");
        }
        public function showQlHocKy()
        {
            $this->renderAdmin("Quản lý học kỳ", "QLHocKy.php");
        }
        public function showThongKe()
        {
            $this->renderAdmin("Thống kê", "thong-ke.php");
        }
    }

?>