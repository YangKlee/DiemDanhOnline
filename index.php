<?php 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ini_set('display_errors', 1);
define('BASE_PATH', dirname(__DIR__));
date_default_timezone_set('Asia/Ho_Chi_Minh');

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$publicBase  = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

if ($publicBase !== '' && strpos($requestPath, $publicBase) === 0) {
    $requestPath = substr($requestPath, strlen($publicBase));
}
$requestPath = '/' . ltrim($requestPath, '/');

/* ------------------  Khởi tạo PDO  ------------------ */
$pdo = require_once __DIR__ . "/app/Config/db.php";

/* ------------------  Nạp CONTROLLER  ------------------ */
require_once __DIR__ . "/app/Controllers/StudentController.php";
require_once __DIR__ . "/app/Controllers/TeacherController.php";
require_once __DIR__ . "/app/Controllers/AdminController.php";
require_once __DIR__ . "/app/Controllers/AccountController.php";
require_once __DIR__ . "/app/Controllers/BaseController.php";

/* ------------------  Khởi tạo CONTROLLER --------------- */
$studentController = new StudentController($pdo);
$accountController = new AccountController($pdo);
$baseController    = new BaseController($pdo);
$teacherController = new TeacherController($pdo);
$adminController   = new AdminController($pdo);

/* ------------------  SESSION  ------------------ */
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

/* ----------- Kiểm tra đăng nhập ---------------- */
if (!isset($_SESSION['UID']) && $requestPath != "/Account/Login" && $_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: $publicBase/Account/Login");
    exit;
}

/* ----------- Load user nếu đã đăng nhập -------- */
if (isset($_SESSION['UID'])) {
    $accountController->loadUserData();
}

/* ------------------ ROUTER ------------------ */
switch ($requestPath)
{
    case "/":
    case "":
        $baseController->returnHomePage();
        break;

    case "/Student":
    case "/Student/Home":
        $studentController->showHomeStudent();
        break;

    case "/Student/LichSuDiemDanh":
        $studentController->showLichSuDiemDanh();
        break;

    case "/Student/LichSuDiemDanh/XemChiTiet":
        $studentController->showChiTietLichSuDiemDanh();
        break;

    case "/Student/QuetQR":
        $studentController->showCheckinQR();
        break;


    case "/Attendance/ScanQR":
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $attendanceController->scanQR();
    }
    break;

    /* ----------- Account ------------ */

    case "/Account/ThongTinCaNhan":
        $accountController->showThongTinCaNhan();
        break;

    case "/Account/ThongTinCaNhan/EditInfo":
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $accountController->submitEditInfo();

        }
        else 
        {
            $accountController->showEditInfoForm();
            
        }
        break;

    case "/Account/ChangePassword":
        $accountController->showChangePasswordLogined();
        break;

    case "/Account/Login":
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $accountController->submitLogin();
        } else {
            $accountController->showLogin();
        }
        break;

    case "/Account/DangXuat":
        $accountController->logout();
        break;



    /* ----------- Teacher ------------ */

    case "/Teacher/Home":
        $teacherController->showHomePage();
        break;

    case "/Teacher/DSLHP":
        $teacherController->showDSLopHP();
        break;

    case "/Teacher/DSLopSV":
        $teacherController->showDSLopSV();
        break;

    case "/Teacher/DSMonDayHoc":
        $teacherController->showDSMonDayHoc();
        break;

    case "/Teacher/TaoPhienDiemDanh":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teacherController->createDiemDanh();
        } else {
            $teacherController->showTaoPhienDiemDanh();
        }
        break;


    case "/Teacher/CapNhatPhienDiemDanh":
        $teacherController->showCapNhatPhienDiemDanh();
        break;
    
    case "/Teacher/CapNhatPhienDiemDanh/XemChiTiet":
        $teacherController->showCNChiTiet();
        break;

    case "/Teacher/xoaPhien":
        $teacherController->xoaPhien();
        break;

    case "/Teacher/capNhatTrangThai":
        $teacherController->capNhatTrangThai();
        break;


    case "/Teacher/QLDanhSachDiemDanh":
        $teacherController->showQLDanhSachDiemDanh();
        break;

    case "/Teacher/QLDanhSachDiemDanh/XemChiTiet":
        $teacherController->showQLDanhSachDiemDanhChiTiet();
    break;

        // Hiển thị form chỉnh hạn QR
    case "/Teacher/CapNhatPhienDiemDanh/XemChiTiet/ChinhHanQR":
        $teacherController->showFormChinhHanQR();
        break;

    case "/Teacher/CapNhatThoiGianQR":
    $teacherController->capNhatThoiGianQR();
    break;

    case "/Teacher/ThongKeChuyenCan":
        $teacherController->showThongKeChuyenCan();
        break;

    case "/Attendance/CreateSession":
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $attendanceController->createSession();
    }
    break;



    /* ----------- Admin ------------ */

    case "/Admin/Home":
        $adminController->showHomePage();
        break;

    case "/Admin/QuanLyDiemDanh":
        $adminController->showQuanLyDiemDanh();
        break;

    case "/Admin/QuanLyTaiKhoan/SinhVien":
        $adminController->showQuanLyTKSinhVien();
        break;

    case "/Admin/QuanLyTaiKhoan/GiangVien":
        $adminController->showQuanLyTKGiangVien();
        break;

    case "/Admin/QuanLyTaiKhoan/Admin":
        $adminController->showQuanLyTKAdmin();
        break;

    case "/Admin/QuanLyTaiKhoan/ResetMatKhau":
        $adminController->showResetMatKhau();
        break;

    case "/Admin/QuanLyHeThong/Khoa":
        $adminController->showQLKhoa();
        break;

    case "/Admin/QuanLyHeThong/Nganh":
        $adminController->showQlNganh();
        break;

    case "/Admin/QuanLyHeThong/Lop":
        $adminController->showQlLop();
        break;

    case "/Admin/QuanLyHeThong/HocKy":
        $adminController->showQlHocKy();
        break;

    case "/Admin/ThongKe":
        $adminController->showThongKe();
        break;

    default:
        $studentController->Error404();
        break;
}
?>
