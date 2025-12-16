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
        public function showSuaKhoa()
        {
            $khoaModel = new Khoa();
            $dataKhoa = $khoaModel->getKhoaByMaKhoa($_GET['KhoaID']);
            if(!$dataKhoa)
            {
                $this->rejectToPage("/Admin/QuanLyHeThong/Khoa","Khoa không tồn tại.");
                return;
            }
            $this->renderAdmin("Sửa khoa", "ThemKhoa.php", ['DataKhoa' => $dataKhoa]);
        }
        public function submitSuaKhoa()
        {
            $khoaModel = new Khoa();
            $tenKhoa = trim($_POST['TenKhoa'] ?? '');
            $maKhoa = trim($_POST['MaKhoa'] ?? '');
            $khoaModel->updateKhoa($maKhoa, $tenKhoa);
            $this->rejectToPage("/Admin/QuanLyHeThong/Khoa","Cập nhật khoa thành công.");
            return;    
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
            $nganhModel = new Nganh();
            $listKhoa = (new Khoa())->getAll();
            if(isset($_GET['search']))
            {
                $listNganh = $nganhModel->searchNganh(trim($_GET['search']));
            }
            else if(isset($_GET['KhoaID']) && $_GET['KhoaID'] != '0')
            {
                $listNganh = $nganhModel->filterByMaKhoa(trim($_GET['KhoaID']));
            }
            else
                $listNganh = $nganhModel->getAllNganh();

            $this->renderAdmin("Quản lý ngành", "QLNganh.php", ['listNganh' => $listNganh, 'listKhoa' => $listKhoa]);
        }
        public function showQlLop()
        {
            $lopModel = new Lop();
            $nganhModel = new Nganh();
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            //$listNganh = $nganhModel->getAllNganh();
            $listLop = [];
            if(isset($_GET['search']))
            {
                $listLop = $lopModel->searchLop(trim($_GET['search']));
            }
            else if(isset($_GET['KhoaID']) && $_GET['KhoaID'] != '0' && isset($_GET['NganhID']) && $_GET['NganhID'] != '0')
            {
                $listLop = $lopModel->filterByKhoaAndNganh(trim($_GET['KhoaID']), trim($_GET['NganhID']));
            }
            else if(isset($_GET['KhoaID']) && $_GET['KhoaID'] != '0')
            {
                $listLop = $lopModel->filterByMaKhoa(trim($_GET['KhoaID']));
            }
            else if(isset($_GET['NganhID']) && $_GET['NganhID'] != '0')
            {
                $listLop = $lopModel->filterByMaNganh(trim($_GET['NganhID']));
            }
            else
                $listLop = NULL;

            
            $this->renderAdmin("Quản lý lớp", "QLLop.php", ['listKhoa' => $listKhoa,'listLop' => $listLop]);
        }
        public function showThemLop()
        {
            $nganhModel = new Nganh();
            $listNganh = $nganhModel->getAllNganh();
            $this->renderAdmin("Thêm lớp sinh viên", "ThemLop.php", ['listNganh' => $listNganh]);
        }
        public function apiGetDSLop()
        {

            $lopModel = new Lop();
            $listLop = $lopModel->filterByMaNganh($_GET['NganhID']);
            header('Content-Type: application/json');
            echo json_encode($listLop);
        }
        public function getDSNganhTheoKhoa()
        {

            $khoaID = $_GET['KhoaID'];
            $nganhModel = new Nganh();
            $listNganh = $nganhModel->filterByMaKhoa($khoaID);
            header('Content-Type: application/json');
            echo json_encode($listNganh);
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