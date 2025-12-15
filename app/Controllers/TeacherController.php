<?php 
    require_once __DIR__ . '/BaseController.php';
    require_once __DIR__ . '/../Models/QuanLyGiangDayModel.php';
    require_once __DIR__ . '/../Models/AttendanceModelGV.php';
    class TeacherController extends BaseController
    {
        private $model;

        public function __construct($db)
        {
            $this->model = new AttendanceModelGV();
        } 
        public function showHomePage()
        {
            $attendanceModel = new AttendanceModelGV();

            if (!isset($_SESSION['UID'])) {
                $this->rejectPage("/Account/Login");
                return;
            }
            $maGV = $_SESSION['UID'];

            // Lấy thống kê cho giảng viên hiện tại
            $thongKeGV = $attendanceModel->getGVStatistics($maGV); 
            $this->renderTeacher("Trang chủ giảng viên", "Home.php", [
                'thongKeGV' => $thongKeGV
            ]);
        }

        public function showDSLopHP()
        {
            $dsLopHP = new QuanLyGiangDayModel();
            $maGV = $_SESSION['UID'];
            $data = $dsLopHP->getLopHPTheoGiangVien($maGV);
             $this->renderTeacher(
        "Danh sách lớp học phần",
        "DSLHP.php",
        ['dsLopHP' => $data]
            );
        }
        public function showDSLopSV()
        {   

        }
        public function showDSMonDayHoc()
        {
            $dsMon = new QuanLyGiangDayModel();
            $maGV = $_SESSION['UID'];
            $data = $dsMon->getMHTheoGiangVien($maGV);
             $this->renderTeacher(
        "Danh sách môn học giảng dạy",
        "QLMH.php",
        ['dsMon' => $data]
            );
        }
        public function showTaoPhienDiemDanh()
        {
        }

        public function createDiemDanh()
        {

        }  
         public function showCapNhatPhienDiemDanh()
        {
                $this->renderTeacher("Cập nhật phiên điểm danh", "CapNhapDiemDanh.php");
         }
        public function showQLDanhSachDiemDanh()
        {
             $maGV = $_SESSION['UID'];
             $dsDiemDanh = new AttendanceModelGV();
            $sessions = $dsDiemDanh -> getSessionsByGV($maGV);
            $this->renderTeacher(
                "Danh sách điểm danh",
                "PhienDiemDanh.php",
                [
                    'sessions' => $sessions]
            );
         }

         public function showQLDanhSachDiemDanhChiTiet()
        {
            $maPhien = $_GET['MaPhien'] ?? '';
            $dsDDChitiet = new AttendanceModelGV();
            $detail = $dsDDChitiet->getSessionDetail($maPhien);
            $this->renderTeacher(
                "Chi tiết điểm danh",
                "ChiTietPhienDiemDanh.php",
                ['detail' => $detail]
            );
            }
public function showThongKeChuyenCan()
{
    if (!isset($_SESSION['UID'])) {
        $this->rejectPage("/Account/Login");
        return;
    }

    $MaGV = $_SESSION['UID']; 
    $MaHK = isset($_GET['MaHK']) && $_GET['MaHK'] !== '' ? $_GET['MaHK'] : null;
    $MaLHP = isset($_GET['MaLHP']) && $_GET['MaLHP'] !== '' ? (int)$_GET['MaLHP'] : null; 



    $model = new AttendanceModelGV();
    $thongKe = $model->getAttendanceStats($MaGV, $MaHK, $MaLHP);

    // Tạo danh sách học kỳ và lớp học phần để filter
    $hocKyList = [];
    $dsLHPList = [];
    foreach ($thongKe as $row) {
        $hocKyList[$row['MaHK']] = $row['MaHK'];
        $dsLHPList[$row['MaLHP']] = $row['MaLHP']; 
    }

    $data = [
        'thongKe' => $thongKe,
        'MaHK' => $MaHK,
        'MaLHP' => $MaLHP,
        'hocKyList' => $hocKyList,
        'dsLHPList' => $dsLHPList
    ];

    $this->renderTeacher("Thống kê chuyên cần", "ThongKeGV.php", $data);
}


    }
?>