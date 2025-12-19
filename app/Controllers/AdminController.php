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
        public function xoaKhoa()
        {
            $khoaModel = new Khoa();
            $maKhoa = trim($_GET['KhoaID'] ?? '');
            $khoaModel->deleteKhoa($maKhoa);
            $this->rejectToPage("/Admin/QuanLyHeThong/Khoa","Xóa khoa thành công.");
            return;    
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
        public function showThemNganh()
        {
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            $this->renderAdmin("Thêm ngành", "ThemNganh.php", ['listKhoa' => $listKhoa]);
        }
        public function submitThemNganh()
        {
            $maNganh = trim($_POST['MaNganh'] ?? '');
            $tenNganh = trim($_POST['TenNganh'] ?? '');
            $maKhoa = trim($_POST['MaKhoa'] ?? '');
            $nganhModel = new Nganh();
            $findNganh = $nganhModel->getNganh($maNganh);
            if ($findNganh)
            {
                $this->rejectToPage("/Admin/QuanLyHeThong/Nganh","Mã ngành đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                $nganhModel->insertNganh($maNganh, $tenNganh, $maKhoa);
                $this->rejectToPage("/Admin/QuanLyHeThong/Nganh","Thêm ngành thành công.");
                return;
            }
        }
        public function showSuaNganh()
        {
            $nganhModel = new Nganh();
            $dataNganh = $nganhModel->getNganh($_GET['NganhID']);
            if(!$dataNganh)
            {
                $this->rejectToPage("/Admin/QuanLyHeThong/Nganh","Ngành không tồn tại.");
                return;
            }
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            $this->renderAdmin("Sửa ngành", "ThemNganh.php", ['dataNganh' => $dataNganh, 'listKhoa' => $listKhoa]);
        }
        public function submitSuaNganh()
        {
            $maNganh = trim($_POST['MaNganh'] ?? '');
            $tenNganh = trim($_POST['TenNganh'] ?? '');
            $maKhoa = trim($_POST['MaKhoa'] ?? '');
            $nganhModel = new Nganh();
            $nganhModel->updateNganh($maNganh, $tenNganh, $maKhoa);
            $this->rejectToPage("/Admin/QuanLyHeThong/Nganh","Cập nhật ngành thành công.");
            return;
        }
        public function xoaNganh()
        {
            $nganhModel = new Nganh();
            $maNganh = trim($_GET['NganhID'] ?? '');
            $nganhModel->deleteNganh($maNganh);
            $this->rejectToPage("/Admin/QuanLyHeThong/Nganh","Xóa ngành thành công.");
            return;    
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

            $this->renderAdmin("Quản lý lớp", "QLLop.php", ['listKhoa' => $listKhoa, 'listLop' => $listLop]
        );
        }
        public function showThemLop()
        {
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            $this->renderAdmin("Thêm lớp", "ThemLop.php", ['listKhoa' => $listKhoa]);
        }
        public function submitThemLop()
        {
            $maLop = trim($_POST['MaLop'] ?? '');
            $tenLop = trim($_POST['TenLop'] ?? '');
            $maNganh = trim($_POST['MaNganh'] ?? '');
            $lopModel = new Lop();
            $findLop = $lopModel->getLop($maLop);
            if ($findLop)
            {
                $this->rejectToPage("/Admin/QuanLyHeThong/Lop","Mã lớp đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                $lopModel->insertLop($maLop, $tenLop, $maNganh);
                $this->rejectToPage("/Admin/QuanLyHeThong/Lop","Thêm lớp thành công.");
                return;
            }
        }
        public function showSuaLop()
        {
            $lopModel = new Lop();
            $dataLop = $lopModel->getLop($_GET['LopID']);
            if(!$dataLop)
            {
                $this->rejectToPage("/Admin/QuanLyHeThong/Lop","Lớp không tồn tại.");
                return;
            }
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            $this->renderAdmin("Sửa lớp", "ThemLop.php", ['dataLop' => $dataLop, 'listKhoa' => $listKhoa]);
        }
        public function submitSuaLop()
        {
            $maLop = trim($_POST['MaLop'] ?? '');
            $tenLop = trim($_POST['TenLop'] ?? '');
            $maNganh = trim($_POST['MaNganh'] ?? '');
            $lopModel = new Lop();
            $lopModel->updateLop($maLop, $tenLop, $maNganh);
            $this->rejectToPage("/Admin/QuanLyHeThong/Lop","Cập nhật lớp thành công.");
            return;
        }
        public function xoaLop()
        {
            $maLop = trim($_GET['LopID'] ?? '');
            $lopModel = new Lop();
            $lopModel->deleteLop($maLop);
            $this->rejectToPage("/Admin/QuanLyHeThong/Lop","Xóa lớp thành công.");
            return;
        }
        public function showQlHocKy()
        {
            $this->renderAdmin("Quản lý học kỳ", "QLHocKy.php");
        }
        public function showThongKe()
        {
            $this->renderAdmin("Thống kê", "thong-ke.php");
        }
        public function getDSNganhTheoKhoa()
        {
            $khoaID = $_GET['KhoaID'];
            $nganhModel = new Nganh();
            $listNganh = $nganhModel->filterByMaKhoa($khoaID);
            header('Content-Type: application/json');
            echo json_encode($listNganh);
        }
        public function apiGetDSLop()
        {
            $lopModel = new Lop();
            $listLop = $lopModel->filterByMaNganh($_GET['NganhID']);
            header('Content-Type: application/json');
            echo json_encode($listLop);
        }

    }
    

?>