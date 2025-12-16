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


public function showHomeStudent()
{
    if (!isset($_SESSION['UID'])) {
        $this->rejectPage("/Account/Login");
        return;
    }

    $mssv = $_SESSION['UID'];
    $attendanceModel = new AttendanceModelST();

    $summary = $attendanceModel->getWeeklySummary($mssv);

    $history = $attendanceModel->getWeeklyHistory($mssv);

    $this->renderStudent(
        "Trang chủ",
        "home.php",
        [
            'summary' => $summary,
            'history' => $history
        ]
    );
}

    public function showLichSuDiemDanh()
    {
        $lsDD = new AttendanceModelST();

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


    public function showCheckinQR()
    {
        if (!isset($_SESSION['UID'])) {
            $this->rejectPage("/Account/Login");
            return;
        }

        $this->renderStudent("Quét QR", "qr_checkin.php");
    }
}
