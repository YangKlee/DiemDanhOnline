<?php 
    require_once __DIR__ . '/BaseController.php';

    class StudentController extends BaseController
    {
        public function showHomeStudent()
        {
            $this->renderStudent("Trang chủ", "home.php");
        }
        public function showLichSuDiemDanh()
        {
            $this->renderStudent("Lịch sử điểm danh", "attendance_history.php");
        }
        public function showChiTietLichSuDiemDanh()
        {
            $this->renderStudent("Lịch sử điểm danh", "attendance_detail.php");
        }
        public function showCheckinQR()
        {
            $this->renderStudent("Quét QR", "qr_checkin.php");
        }

    }
?>