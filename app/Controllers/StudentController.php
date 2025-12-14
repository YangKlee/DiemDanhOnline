<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/AttendanceModelST.php';

class StudentController extends BaseController
{
    private $attendanceModel;

    public function __construct()
    {
        $this->attendanceModel = new AttendanceModelST();
    }

    /* ===============================
       Trang chủ sinh viên
    =============================== */
    public function showHomeStudent()
    {
        $this->renderStudent("Trang chủ", "home.php");
    }

    /* ======================================
       Lịch sử điểm danh theo học kỳ
    ====================================== */
    public function showLichSuDiemDanh()
    {
        $lsDD = new AttendanceModelST();
        // Chưa đăng nhập
        if (!isset($_SESSION['UID'])) {
            $this->rejectPage("/Account/Login");
            return;
        }
    $maSV = $_SESSION['UID'];
    $maHK = $_GET['hocky'] ?? '';

    $hocKyList = $lsDD->getAllHocKyByMSSV($maSV);
    $dsLHP = $lsDD->getLHPByStudentAndHK($maSV, $maHK);

    $this->renderStudent(
        "Lịch sử điểm danh",
        "attendance_history.php",
        [
            'hocKyList' => $hocKyList,
            'dsLHP'     => $dsLHP,
            'maHK'      => $maHK
        ]
    );
}

    
    /* ======================================
       Chi tiết điểm danh 1 lớp học phần
    ====================================== */
    public function showChiTietLichSuDiemDanh()
    {
        $lsDD = new AttendanceModelST();
        if (!isset($_SESSION['UID'])) {
            $this->rejectPage("/Account/Login");
            return;
        }

        if (!isset($_GET['MaLHP'])) {
            die("Thiếu mã lớp học phần");
        }

        $mssv  = $_SESSION['UID'];
        $maLHP = $_GET['MaLHP'];

        $chiTiet = $lsDD->getAttendanceDetail($mssv, $maLHP);

        $this->renderStudent(
            "Chi tiết điểm danh",
            "attendance_detail.php",
            ['chiTiet' => $chiTiet,
                    'MaLHP'   => $maLHP]
        );
    }

    /* ===============================
       Quét QR điểm danh
    =============================== */
    public function showCheckinQR()
    {
        if (!isset($_SESSION['UID'])) {
            $this->rejectPage("/Account/Login");
            return;
        }

        $this->renderStudent("Quét QR", "qr_checkin.php");
    }
}
