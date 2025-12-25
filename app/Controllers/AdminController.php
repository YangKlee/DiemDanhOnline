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
            if(isset($_GET['search']))
            {
                $listAccount = (new User())->searchStudentInfo(trim($_GET['search']));
            }
            else
                $listAccount = (new User())->getAllStudentInfo(); 
            $this->renderAdmin("Quản lý tài khoản sinh viên", "QLTaiKhoanSV.php",
             ['listAccount' => $listAccount]);
        }
        public function showThemTKSinhVien()
        {
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            $this->renderAdmin("Thêm tài khoản sinh viên", "ThemTKSinhVien.php",
             ['listKhoa' => $listKhoa]);
        }
        public function submitThemTKSinhVien()
        {
            $mssv = trim($_POST['MSSV'] ?? '');
            $ho = trim($_POST['Ho'] ?? '');
            $ten = trim($_POST['Ten'] ?? '');
            $gioiTinh = trim($_POST['GioiTinh'] ?? '');
            $ngaySinh = trim($_POST['NgaySinh'] ?? '');
            $soDT = trim($_POST['SoDT'] ?? '');
            $cccd = trim($_POST['CCCD'] ?? '');
            $email = trim($_POST['Email'] ?? '');
            $diaChi = trim($_POST['DiaChi'] ?? '');
            $maLop = trim($_POST['MaLop'] ?? '');
            $matKhau = trim($_POST['MatKhau'] ?? '');
            $reMatKhau = trim($_POST['XacNhanMatKhau'] ?? '');
            $userModel = new User();
            $findUser = $userModel->getUserById($mssv);
            if ($findUser)
            {
                $this->rejectToPage("/Admin/QuanLyTaiKhoan/SinhVien/ThemSinhVien","Mã sinh viên đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                if(is_null($matKhau) || $matKhau === '')
                {
                    $matKhau = $mssv; 
                }
                else 
                {
                    if($matKhau != $reMatKhau)
                    {
                        $this->rejectToPage("/Admin/QuanLyTaiKhoan/SinhVien/ThemSinhVien","Mật khẩu và xác nhận mật khẩu không khớp.");
                        return;
                    }   
                }
                $userModel->addStudent($mssv, $ho, $ten, $gioiTinh, 
                $ngaySinh, $soDT, $cccd, $email, $diaChi, 
                $maLop, $matKhau);
                $this->rejectToPage("/Admin/QuanLyTaiKhoan/SinhVien","Thêm tài khoản sinh viên thành công.");
                return;
            }
        }
        public function showSuaTKSinhVien()
        {
            $userModel = new User();
            $khoaModel = new Khoa();
             $listKhoa = $khoaModel->getAll();
            $dataUser = $userModel->getUserById(trim($_GET['MSSV'] ?? ''));
            
            $this->renderAdmin("Sửa tài khoản sinh viên",
             "ThemTKSinhVien.php", ['studentData' => $dataUser, 'listKhoa' => $listKhoa]);
        }
        public function submitSuaTKSinhVien()
        {
            $mssv = trim($_POST['MSSV'] ?? '');
            $ho = trim($_POST['Ho'] ?? '');
            $ten = trim($_POST['Ten'] ?? '');
            $gioiTinh = trim($_POST['GioiTinh'] ?? '');
            $ngaySinh = trim($_POST['NgaySinh'] ?? '');
            $soDT = trim($_POST['SoDT'] ?? '');
            $cccd = trim($_POST['CCCD'] ?? '');
            $email = trim($_POST['Email'] ?? '');
            $diaChi = trim($_POST['DiaChi'] ?? '');
            
            $userModel = new User();
            $userModel->updateStudentInfo($mssv, $ho, $ten, $gioiTinh, 
                $ngaySinh, $soDT, $cccd, $email, $diaChi);
            $userModel->updateStudentLop($mssv, trim($_POST['MaLop'] ?? '')); 
            $this->rejectToPage("/Admin/QuanLyTaiKhoan/SinhVien","Cập nhật tài khoản sinh viên thành công.");
            return;
        }
        public function xoaTKSinhVien()
        {
            $mssv = trim($_GET['MSSV'] ?? '');
            $userModel = new User();
            $userModel->deleteStudent($mssv);
            $this->rejectToPage("/Admin/QuanLyTaiKhoan/SinhVien","Xóa tài khoản sinh viên thành công.");
            return;
        }
        public function showQuanLyTKGiangVien()
        {
            $userModel = new User();
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            if(isset($_GET['search']))
            {
                $dataGV = $userModel->searchTeacherInfo(trim($_GET['search']));
            }
            else
                $dataGV = $userModel->getAllTeacherInfo();

            $this->renderAdmin("Quản lý tài khoản giảng viên", "QLTaiKhoanGV.php", ['listGV' => $dataGV]);
        }
        public function showQuanLyTKAdmin()
        {
            $this->renderAdmin("Quản lý tài khoản admin", "QLTaiKhoanAdmin.php");

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
            $hockyModel = new Term();
            $listHocKy = $hockyModel->getAllHK();
            $this->renderAdmin("Quản lý học kỳ", "QLHocKy.php", ['listHocKy' => $listHocKy]);
        }
        public function showThongKe()
        {
            $this->renderAdmin("Thống kê", "thong-ke.php");
        }
        public function showSuaHocKy()
        {
            $hockyModel = new Term();
            $dataHK = $hockyModel->getHocKyById($_GET['TermID']);
            $this->renderAdmin("Sửa học kỳ", "ThemHocKy.php", ['dataHK' => $dataHK]);
        }
        public function submitSuaHocKy()
        {
            $maHK = trim($_POST['MaHK'] ?? '');
            $tenHK = trim($_POST['TenHK'] ?? '');
            $thoiGianBatDau = trim($_POST['ThoiGianBatDau'] ?? '');
            $thoiGianKetThuc = trim($_POST['ThoiGianKetThuc'] ?? '');
            $hockyModel = new Term();
            $hockyModel->updateHocKy($maHK, $tenHK, $thoiGianBatDau, $thoiGianKetThuc);
            $this->rejectToPage("/Admin/QuanLyHeThong/HocKy","Cập nhật học kỳ thành công.");
            return;
        }
        public function xoaHocKy()
        {
            $maHK = trim($_GET['TermID'] ?? '');
            $hockyModel = new Term();
            $hockyModel->deleteHocKy($maHK);
            $this->rejectToPage("/Admin/QuanLyHeThong/HocKy","Xóa học kỳ thành công.");
            return;
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
        public function showThemHocKy()
        {
            $this->renderAdmin("Thêm học kỳ", "ThemHocKy.php");
        }
        public function submitThemHocKy()
        {
            $maHK = trim($_POST['MaHK'] ?? '');
            $tenHK = trim($_POST['TenHK'] ?? '');
            $thoiGianBatDau = trim($_POST['ThoiGianBatDau'] ?? '');
            $thoiGianKetThuc = trim($_POST['ThoiGianKetThuc'] ?? '');
            $hockyModel = new Term();
            $findHocKy = $hockyModel->getHocKyById($maHK);
            if ($findHocKy)
            {
                $this->rejectToPage("/Admin/QuanLyHeThong/HocKy","Mã học kỳ đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                $hockyModel->addHocKy($maHK, $tenHK, $thoiGianBatDau, $thoiGianKetThuc);
                $this->rejectToPage("/Admin/QuanLyHeThong/HocKy","Thêm học kỳ thành công.");
                return;
            }
        }
        public function showThemGiangVien()
        {
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            $this->renderAdmin("Thêm tài khoản giảng viên", "ThemTKGiangVien.php",
             ['listKhoa' => $listKhoa]);
        }
        public function submitThemGiangVien()
        {
            $magv = trim($_POST['MaGV'] ?? '');
            $ho = trim($_POST['Ho'] ?? '');
            $ten = trim($_POST['Ten'] ?? '');
            $gioiTinh = trim($_POST['GioiTinh'] ?? '');
            $ngaySinh = trim($_POST['NgaySinh'] ?? '');
            $soDT = trim($_POST['SoDT'] ?? '');
            $cccd = trim($_POST['CCCD'] ?? '');
            $email = trim($_POST['Email'] ?? '');
            $diaChi = trim($_POST['DiaChi'] ?? '');
            $matKhau = trim($_POST['MatKhau'] ?? '');
            $reMatKhau = trim($_POST['XacNhanMatKhau'] ?? '');
            $userModel = new User();
            $findUser = $userModel->getUserById($magv);
            if ($findUser)
            {
                $this->rejectToPage("/Admin/QuanLyTaiKhoan/GiangVien/ThemGiangVien","Mã giảng viên đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                if(is_null($matKhau) || $matKhau === '')
                {
                    $matKhau = $magv; 
                }
                else 
                {
                    if($matKhau != $reMatKhau)
                    {
                        $this->rejectToPage("/Admin/QuanLyTaiKhoan/GiangVien/ThemGiangVien","Mật khẩu và xác nhận mật khẩu không khớp.");
                        return;
                    }   
                }
                $userModel->insertTeacher($magv, $ho, $ten, $gioiTinh, 
                $ngaySinh, $soDT, $cccd, $email, $diaChi, $_POST['MaKhoa'] ?? '', $matKhau);
                $this->rejectToPage("/Admin/QuanLyTaiKhoan/GiangVien","Thêm tài khoản giảng viên thành công.");
                return;
            }
        }
        public function showSuaGiangVien()
        {
            $userModel = new User();
            $khoaModel = new Khoa();
             $listKhoa = $khoaModel->getAll();
            $dataUser = $userModel->getUserById(trim($_GET['MaGV'] ?? ''));
            
            $this->renderAdmin("Sửa tài khoản giảng viên",
             "ThemTKGiangVien.php", ['giangVienData' => $dataUser, 'listKhoa' => $listKhoa]);
        }
        public function submitSuaGiangVien()
        {
            $magv = trim($_POST['MaGV'] ?? '');
            $ho = trim($_POST['Ho'] ?? '');
            $ten = trim($_POST['Ten'] ?? '');
            $gioiTinh = trim($_POST['GioiTinh'] ?? '');
            $ngaySinh = trim($_POST['NgaySinh'] ?? '');
            $soDT = trim($_POST['SoDT'] ?? '');
            $cccd = trim($_POST['CCCD'] ?? '');
            $email = trim($_POST['Email'] ?? '');
            $diaChi = trim($_POST['DiaChi'] ?? '');
            
            $userModel = new User();
            $userModel->updateTeacherInfo($magv, $ho, $ten, $gioiTinh, 
                $ngaySinh, $soDT, $cccd, $email, $diaChi);
            $userModel->updateTeacherKhoa($magv, $_POST['MaKhoa'] ?? '');    
            $this->rejectToPage("/Admin/QuanLyTaiKhoan/GiangVien","Cập nhật tài khoản giảng viên thành công.");
            return;
        }
        public function xoaGiangVien()
        {
            $magv = trim($_GET['MaGV'] ?? '');
            $userModel = new User();
            $userModel->deleteTeacher($magv);
            $this->rejectToPage("/Admin/QuanLyTaiKhoan/GiangVien","Xóa tài khoản giảng viên thành công.");
            return;
        }
        public function showQlMonHoc()
        {
            $listMonHoc = (new MonHoc())->getAllMonHoc();
            $this->renderAdmin("Quản lý môn học", "mon-hoc.php", ['listMonHoc' => $listMonHoc]);
        }
        public function showThemMonHoc()
        {
            $listKhoa = (new Khoa())->getAll();
            $this->renderAdmin("Thêm môn học", "ThemMonHoc.php", ['listKhoa' => $listKhoa]);
        }
        public function submitThemMonHoc()
        {
            $maMH = trim($_POST['MaMon'] ?? '');
            $tenMH = trim($_POST['TenMon'] ?? '');
            $soTC = trim($_POST['SoTC'] ?? '');
            $khoaPhuTrach = trim($_POST['MaKhoa'] ?? '');
            $monHocModel = new MonHoc();
            $findMonHoc = $monHocModel->getMonHocById($maMH);
            if ($findMonHoc)
            {
                $this->rejectToPage("/Admin/QuanLyDiemDanh/MonHoc/ThemMonHoc","Mã môn học đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                $monHocModel->addMonHoc($maMH, $tenMH, $soTC, $khoaPhuTrach);
                $this->rejectToPage("/Admin/QuanLyDiemDanh/MonHoc","Thêm môn học thành công.");
                return;
            }
        }
        public function showSuaMonHoc()
        {
            $monHocModel = new MonHoc();
            $dataMH = $monHocModel->getMonHocById(trim($_GET['MaMonHoc'] ?? ''));
            if(!$dataMH)
            {
                $this->rejectToPage("/Admin/QuanLyDiemDanh/MonHoc","Môn học không tồn tại.");
                return;
            }
            $this->renderAdmin("Sửa môn học", "ThemMonHoc.php", ['dataMH' => $dataMH]);
        }
        public function submitSuaMonHoc()
        {
            $maMH = trim($_POST['MaMonHoc'] ?? '');
            $tenMH = trim($_POST['TenMonHoc'] ?? '');
            $soTC = trim($_POST['SoTC'] ?? '');
            $khoaPhuTrach = trim($_POST['KhoaPhuTrach'] ?? '');
            $monHocModel = new MonHoc();
            $monHocModel->updateMonHoc($maMH, $tenMH, $soTC, $khoaPhuTrach);
            $this->rejectToPage("/Admin/QuanLyDiemDanh/MonHoc","Cập nhật môn học thành công.");
            return;
        }
        public function xoaMonHoc()
        {
            $maMH = trim($_GET['MaMonHoc'] ?? '');
            $monHocModel = new MonHoc();
            $monHocModel->deleteMonHoc($maMH);
            $this->rejectToPage("/Admin/QuanLyDiemDanh/MonHoc","Xóa môn học thành công.");
            return;
        }
        public function showQlLopHocPhan()
        {
            $listLopHP = (new LopHP())->getAllLopHP();
            $this->renderAdmin("Quản lý lớp học phần", "lop-hoc-phan.php", ['listLopHP' => $listLopHP]);
        }
        public function showThemLopHP()
        {

            $userModel = new User();
            $listGiangVien = $userModel->getAllTeacherInfo();
            $hockyModel = new Term();
            $listHocKy = $hockyModel->getAllHK();
            $monHocModel = new MonHoc();
            $listMonHoc = $monHocModel->getAllMonHoc();
            $this->renderAdmin("Thêm lớp học phần", "ThemLopHP.php", 
            [ 'listGiangVien' => $listGiangVien, 'listHocKy' => $listHocKy, 'listMonHoc' => $listMonHoc]);
        }
        public function submitThemLopHP()
        {
            $maLHP = trim($_POST['MaLHP'] ?? '');
            $maMonHoc = trim($_POST['MaMonHoc'] ?? '');
            $maGiangVien = trim($_POST['MaGiangVien'] ?? '');
            $maHK = trim($_POST['MaHocKy'] ?? '');
            $thoiGianBatDau = trim($_POST['ThoiGianBatDau'] ?? '');
            $thoiGianKetThuc = trim($_POST['ThoiGianKetThuc'] ?? '');
            $maMonHoc = trim($_POST['MaMonHoc'] ?? '');
            $lopHPModel = new LopHP();
            $findLopHP = $lopHPModel->getLopHP($maLHP);
            if ($findLopHP)
            {
                $this->rejectToPage("/Admin/QuanLyDiemDanh/LopHocPhan/ThemLopHP","Mã lớp học phần đã tồn tại, vui lòng sử dụng mã khác.");
                return;
            }
            else 
            {
                $lopHPModel->insertLopHP($maLHP, $maMonHoc, $maGiangVien, 
                $maHK, $thoiGianBatDau, $thoiGianKetThuc);
                $this->rejectToPage("/Admin/QuanLyDiemDanh/LopHocPhan","Thêm lớp học phần thành công.");
                return;
            }
        }
        public function showSuaLopHP()
        {
            $lopHPModel = new LopHP();
            $dataLopHP = $lopHPModel->getLopHP(trim($_GET['MaLop'] ?? ''));
            if(!$dataLopHP)
            {
                $this->rejectToPage("/Admin/QuanLyDiemDanh/LopHocPhan","Lớp học phần không tồn tại.");
                return;
            }
            $userModel = new User();
            $listGiangVien = $userModel->getAllTeacherInfo();
            $hockyModel = new Term();
            $listHocKy = $hockyModel->getAllHK();
            $monHocModel = new MonHoc();
            $listMonHoc = $monHocModel->getAllMonHoc();
            $this->renderAdmin("Sửa lớp học phần", "ThemLopHP.php", 
            ['dataLopHP' => $dataLopHP, 'listGiangVien' => $listGiangVien, 
            'listHocKy' => $listHocKy, 'listMonHoc' => $listMonHoc]);
        }
        public function submitSuaLopHP()
        {
            $maLHP = trim($_POST['MaLHP'] ?? '');
            $maMonHoc = trim($_POST['MaMonHoc'] ?? '');
            $maGiangVien = trim($_POST['MaGiangVien'] ?? '');
            $maHK = trim($_POST['MaHocKy'] ?? '');
            $thoiGianBatDau = trim($_POST['ThoiGianBatDau'] ?? '');
            $thoiGianKetThuc = trim($_POST['ThoiGianKetThuc'] ?? '');
            $lopHPModel = new LopHP();
            $lopHPModel->updateLopHP($maLHP, $maMonHoc, $maGiangVien, 
                $maHK, $thoiGianBatDau, $thoiGianKetThuc);
            $this->rejectToPage("/Admin/QuanLyDiemDanh/LopHocPhan","Cập nhật lớp học phần thành công.");
            return;
        }
        public function xoaLopHP()
        {
            $maLHP = trim($_GET['LopHPID'] ?? '');
            $lopHPModel = new LopHP();
            $lopHPModel->deleteLopHP($maLHP);
            $this->rejectToPage("/Admin/QuanLyDiemDanh/LopHocPhan","Xóa lớp học phần thành công.");
            return;
        }
        public function showPhienDiemDanh()
        {
            $listPhienDD = (new PhienDiemDanh())->getAllPhienDiemDanhAdmin();
            $this->renderAdmin("Phiên điểm danh", "attendances.php", ['listPhienDD' => $listPhienDD]);
        }

    }
    

?>