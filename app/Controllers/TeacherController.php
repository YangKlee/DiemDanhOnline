<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/QuanLyGiangDayModel.php';
require_once __DIR__ . '/../Models/AttendanceModelGV.php';

class TeacherController extends BaseController {
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
    $phienModel = new AttendanceModelGV();

    $maGV = $_SESSION['UID'];

    $data = $phienModel->layDanhSachPhienTheoGV($maGV);

    $this->renderTeacher(
        "Cập nhật phiên điểm danh",
        "CapNhapDiemDanh.php",
        ['dsPhien' => $data]
    );
}

         public function showCNChiTiet()
        {
            $maPhien = $_GET['MaPhien'] ?? '';
            $dsDDChitiet = new AttendanceModelGV();
            $detail = $dsDDChitiet->getSessionDetail($maPhien);
            $this->renderTeacher(
                "Chi tiết điểm danh",
                "ChiTietCNDD.php",
                ['detail' => $detail]
            );
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


public function capNhatThoiGian()
{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $MaPhien = $_POST['MaPhien'];
        $ThoiGianBatDau = $_POST['ThoiGianBatDau'];
        $ThoiGianKetThuc = $_POST['ThoiGianKetThuc'];

        $model = new AttendanceModelGV();
        $success = $model->capNhatThoiGian($MaPhien, $ThoiGianBatDau, $ThoiGianKetThuc);

        echo json_encode(['success' => $success]);
    }
}
public function capNhatTrangThai()
{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $MaPhien = $_POST['MaPhien'];
        $MSSV = $_POST['MSSV'];
        $TrangThai = $_POST['TrangThai'];

        $model = new AttendanceModelGV();
        $success = $model->capNhatTrangThai($MaPhien, $MSSV, $TrangThai);

        echo json_encode(['success' => $success]);
    }
}
public function xoaPhien()
{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $MaPhien = $_POST['MaPhien'];

        $model = new AttendanceModelGV();
        $success = $model->xoaPhien($MaPhien);

        echo json_encode(['success' => $success]);
    }
}

public function showFormChinhHanQR()
{
    if (!isset($_GET['MaPhien'])) {
        die("Thiếu mã phiên");
    }

    $maPhien = $_GET['MaPhien'];

    $model = new AttendanceModelGV();
    $phien = $model->layPhienTheoMa($maPhien);

    $this->renderTeacher(
        "Chỉnh hạn QR",
        "ChinhHanQR.php",
        ['phien' => $phien]
    );
}
public function capNhatThoiGianQR()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Phương thức không hợp lệ");
    }

    if (!isset($_POST['MaPhien'], $_POST['SoPhut'])) {
        die("Thiếu dữ liệu");
    }
    $maPhien = $_POST['MaPhien'];
    $soPhut  = $_POST['SoPhut'];

    $model = new AttendanceModelGV();
    $model->capNhatHanQR($maPhien, $soPhut);

    // 🔹 LẤY LẠI DỮ LIỆU PHIÊN SAU KHI UPDATE
    $phien = $model->layPhienTheoMa($maPhien);
    // 🔹 TRẢ VỀ VIEW CẬP NHẬT PHIÊN ĐIỂM DANH
    $this->renderTeacher(
        "Cập nhật điểm danh chi tiết",
        "ChiTietCNDD.php",
        [
            'phien'      => $phien
        ]
    );
}





    /* ===============================
       TRANG CHỦ GIẢNG VIÊN
    =============================== */
    // public function showHomePage()
    // {
    //     if (!isset($_SESSION['UID'])) {
    //         $this->rejectPage("/Account/Login");
    //         return;
    //     }

    //     $maGV = $_SESSION['UID'];
    //     $thongKeGV = $this->attendanceModel->getGVStatistics($maGV);

    //     $this->renderTeacher("Trang chủ giảng viên", "Home.php", [
    //         'thongKeGV' => $thongKeGV
    //     ]);
    // }

    /* ===============================
       DANH SÁCH LỚP HỌC PHẦN
    =============================== */
    // public function showDSLopHP()
    // {
    //     $maGV = $_SESSION['UID'];
    //     $data = $this->qlgdModel->getLopHPTheoGiangVien($maGV);

    //     $this->renderTeacher("Danh sách lớp học phần", "DSLHP.php", [
    //         'dsLopHP' => $data
    //     ]);
    // }

    /* ===============================
       DANH SÁCH MÔN DẠY
    =============================== */
    public function showDSMonDayHoc()
    {
        $maGV = $_SESSION['UID'];
        $data = $this->qlgdModel->getMHTheoGiangVien($maGV);

        $this->renderTeacher("Danh sách môn học giảng dạy", "QLMH.php", [
            'dsMon' => $data
        ]);
    }

    /* ===============================
       FORM TẠO PHIÊN ĐIỂM DANH
    =============================== */
  public function showTaoPhienDiemDanh()
{
    $maGV = $_SESSION['UID'];

    /* ====== DANH SÁCH MÔN HỌC GIẢNG VIÊN DẠY ====== */
    $stmt = $this->pdo->prepare("
        SELECT DISTINCT m.MaMonHoc, m.TenMonHoc
        FROM monhoc m
        JOIN lophp l ON l.MaMonHoc = m.MaMonHoc
        WHERE l.MaGV = ?
    ");
    $stmt->execute([$maGV]);
    $dsMonHoc = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* ====== DANH SÁCH LỚP HỌC PHẦN ====== */
    $stmt = $this->pdo->prepare("
        SELECT MaLHP
        FROM lophp
        WHERE MaGV = ?
    ");
    $stmt->execute([$maGV]);
    $dsLopHP = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* ====== DANH SÁCH PHIÊN ĐIỂM DANH ====== */
    $stmt = $this->pdo->prepare("
        SELECT p.MaPhien, p.MaLHP, p.ThoiGianBatDau, p.ThoiGianKetThuc, p.StrToken,
               m.TenMonHoc
        FROM phiendiemdanh p
        JOIN lophp l ON p.MaLHP = l.MaLHP
        JOIN monhoc m ON l.MaMonHoc = m.MaMonHoc
        WHERE l.MaGV = ?
        ORDER BY p.MaPhien DESC
    ");
    $stmt->execute([$maGV]);
    $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* ====== RENDER VIEW ====== */
    $this->renderTeacher(
        'Tạo phiên điểm danh',
        'TaoDiemDanh.php',
        [
            'dsMonHoc' => $dsMonHoc,
            'dsLopHP'  => $dsLopHP,
            'sessions' => $sessions
        ]
    );
}



    /* ===============================
       TẠO PHIÊN ĐIỂM DANH (AJAX)
    =============================== */
    public function createDiemDanh()
    {
        header('Content-Type: application/json; charset=utf-8');

        $maLHP   = $_POST['MaLHP'] ?? null;
        $batDau  = $_POST['ThoiGianBatDau'] ?? null;
        $ketThuc = $_POST['ThoiGianKetThuc'] ?? null;

        if (!$maLHP || !$batDau || !$ketThuc) {
            echo json_encode(['error' => 'Thiếu dữ liệu']);
            exit;
        }

        $batDau  = date("Y-m-d H:i:s", strtotime($batDau));
        $ketThuc = date("Y-m-d H:i:s", strtotime($ketThuc));

        $token = "QR-" . $maLHP . "-" . time();
        $thoiGianTao = date('Y-m-d H:i:s');

        $maPhien = $this->attendanceModel->insertSession(
            $maLHP,
            $thoiGianTao,
            $token,
            $batDau,
            $ketThuc
        );

        echo json_encode([
            'maPhien' => $maPhien,
            'maLHP'   => $maLHP,
            'token'   => $token,
            'batDau'  => $batDau,
            'ketThuc' => $ketThuc
        ]);
        exit;
    }

    /* ===============================
       DANH SÁCH PHIÊN ĐIỂM DANH
    =============================== */
    public function showQLDanhSachDiemDanh()
    {
        $maGV = $_SESSION['UID'];
        $sessions = $this->attendanceModel->getSessionsByGV($maGV);

        $this->renderTeacher("Danh sách điểm danh", "PhienDiemDanh.php", [
            'sessions' => $sessions
        ]);
    }

    /* ===============================
       CHI TIẾT 1 PHIÊN ĐIỂM DANH
    =============================== */
    public function showQLDanhSachDiemDanhChiTiet()
    {
        $maPhien = $_GET['MaPhien'] ?? null;
        if (!$maPhien) {
            $this->rejectPage("/Teacher/QLDanhSachDiemDanh");
            return;
        }

        $detail = $this->attendanceModel->getSessionDetail($maPhien);

        $this->renderTeacher("Chi tiết điểm danh", "ChiTietPhienDiemDanh.php", [
            'detail' => $detail
        ]);
    }

    /* ===============================
       CẬP NHẬT PHIÊN ĐIỂM DANH
    =============================== */
    public function showCapNhatPhienDiemDanh()
    {
        $maPhien = $_GET['MaPhien'] ?? null;
        if (!$maPhien) {
            $this->rejectPage("/Teacher/QLDanhSachDiemDanh");
            return;
        }

        $detail = $this->attendanceModel->getSessionDetail($maPhien);

        $this->renderTeacher("Cập nhật điểm danh", "CapNhapDiemDanh.php", [
            'detail'  => $detail,
            'maPhien' => $maPhien
        ]);
    }

    /* ===============================
       THỐNG KÊ CHUYÊN CẦN
    =============================== */
    public function showThongKeChuyenCan()
    {
        if (!isset($_SESSION['UID'])) {
            $this->rejectPage("/Account/Login");
            return;
        }

        $MaGV  = $_SESSION['UID'];
        $MaHK  = $_GET['MaHK']  ?? null;
        $MaLHP = $_GET['MaLHP'] ?? null;

        if ($MaLHP === '') $MaLHP = null;
        if ($MaHK === '')  $MaHK  = null;

        $thongKe = $this->attendanceModel->getAttendanceStats($MaGV, $MaHK, $MaLHP);

        $hocKyList = [];
        $dsLHPList = [];
        foreach ($thongKe as $row) {
            $hocKyList[$row['MaHK']]  = $row['MaHK'];
            $dsLHPList[$row['MaLHP']] = $row['MaLHP'];
        }

        $this->renderTeacher("Thống kê chuyên cần", "ThongKeGV.php", [
            'thongKe'   => $thongKe,
            'MaHK'      => $MaHK,
            'MaLHP'     => $MaLHP,
            'hocKyList' => $hocKyList,
            'dsLHPList' => $dsLHPList
        ]);
    }
}
