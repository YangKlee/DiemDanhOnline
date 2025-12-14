<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/AttendanceModel.php';

class AttendanceController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new AttendanceModel();
    }

    // Giảng viên tạo phiên
    public function createSession()
    {
        $maLHP = $_POST['MaLHP'];

        $token = bin2hex(random_bytes(10));
        $start = date("Y-m-d H:i:s");
        $end   = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        $this->model->createSession($maLHP, $token, $start, $end);

        echo json_encode([
            "token" => $token,
            "end" => $end
        ]);
    }

    // Sinh viên quét QR
    public function scanQR()
    {
        $mssv = $_SESSION['UID'];
        $token = $_POST['token'];
        $location = $_POST['location'];
        $now = date("Y-m-d H:i:s");

        $session = $this->model->getSessionByToken($token);
        if (!$session) {
            die("QR không hợp lệ");
        }

        if ($now > $session['ThoiGianKetThuc']) {
            die("Mã QR đã hết hạn");
        }

        if (!$this->model->checkStudentInClass($mssv, $session['MaLHP'])) {
            die("Sinh viên không tồn tại trong lớp");
        }

        if ($this->model->isCheckedIn($mssv, $session['MaPhien'])) {
            die("Bạn đã điểm danh");
        }

        $this->model->saveAttendance(
            $mssv,
            $session['MaPhien'],
            $now,
            $location
        );

        echo "Điểm danh thành công";
    }
}
