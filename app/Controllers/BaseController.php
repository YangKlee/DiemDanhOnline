<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/AttendanceModelST.php';
require_once __DIR__ . '/../Models/AttendanceModelGV.php';
require_once __DIR__ . '/../Models/QuanLyGiangDayModel.php';
require_once __DIR__ . '/../Models/Khoa.php';
require_once __DIR__ . '/../Models/Lop.php';
require_once __DIR__ . '/../Models/Nganh.php';
require_once __DIR__ . '/../Models/Term.php';
require_once __DIR__ . '/../Config/database.php';
require_once __DIR__ . '/../Models/MonHoc.php';
require_once __DIR__ . '/../Models/LopHP.php';
require_once __DIR__ . '/../Models/PhienDiemDanh.php';

class BaseController
{

    protected function renderStudent($title, $render,$data = [])
    {
        $render = __DIR__ . "/../Views/Student/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
    }
    protected function renderTeacher($title, $render,$data = [])
    {
        $render = __DIR__ . "/../Views/Teacher/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
    }
    protected function renderAdmin($title, $render,$data = [])
    {
        $render = __DIR__ . "/../Views/Admin/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
    }
    protected function renderCommon($title, $render, $data = [])
    {
        
        $render = __DIR__ . "/../Views/common/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
        
    }
    protected function renderAuth($title, $render, $isLayout, $data = [])
    {
        if (!$isLayout) {
            require_once __DIR__ . "/../Views/auth/" . $render;
            return;
        }
        $render = __DIR__ . "/../Views/auth/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
    }
    public function rejectPage($url)
    {
        global $publicBase;
        header("Location: " . $publicBase . $url);
    }
    public function Error404()
    {
        $title = "Trang không hợp lệ";
        $render = __DIR__ . "/../Views/404.php";
        require_once __DIR__ . "/../Views/layout.php";
    }
    public function returnHomePage()
    {
        global $publicBase;
        if ($_SESSION['Role'] == 1) {
            header("Location: " . $publicBase . "/Student/Home");
            exit;
        } else if ($_SESSION['Role'] == 2) {
            header("Location: " . $publicBase . "/Teacher/Home");
            exit;
        } else if ($_SESSION['Role'] == 3) {
            header("Location: " . $publicBase . "/Admin/Home");
            exit;
        } else {
            header("Location: " . $publicBase . "/Error");
            exit;
        }
    }
    public function rejectToPage($path, $message)
    {
        $_SESSION['message'] = $message;
        global $publicBase;
        header("Location: " . $publicBase . $path);

    }
}
