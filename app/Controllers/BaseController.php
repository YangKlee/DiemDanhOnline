<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/AttendanceModelST.php';
require_once __DIR__ . '/../Models/AttendanceModelGV.php';
require_once __DIR__ . '/../Models/QuanLyGiangDayModel.php';
require_once __DIR__ . '/../Config/database.php';

class BaseController
{
    protected function renderStudent($title, $render, $data = [])
    {
        extract($data);
        $render = __DIR__ . "/../Views/Student/" . $render;
        require __DIR__ . "/../Views/layout.php";
    }

    protected function renderTeacher($title, $render, $data = [])
    {
        extract($data); // 🔥 BẮT BUỘC
        $render = __DIR__ . "/../Views/Teacher/" . $render;
        require __DIR__ . "/../Views/layout.php";
    }

    protected function renderAdmin($title, $render, $data = [])
    {
        extract($data);
        $render = __DIR__ . "/../Views/Admin/" . $render;
        require __DIR__ . "/../Views/layout.php";
    }

    protected function renderCommon($title, $render, $data = [])
    {
        extract($data);
        $render = __DIR__ . "/../Views/common/" . $render;
        require __DIR__ . "/../Views/layout.php";
    }

    protected function renderAuth($title, $render, $isLayout, $data = [])
    {
        extract($data);

        if (!$isLayout) {
            require __DIR__ . "/../Views/auth/" . $render;
            return;
        }

        $render = __DIR__ . "/../Views/auth/" . $render;
        require __DIR__ . "/../Views/layout.php";
    }

    public function rejectPage($url)
    {
        global $publicBase;
        header("Location: " . $publicBase . $url);
        exit;
    }

    public function Error404()
    {
        $title = "Trang không hợp lệ";
        $render = __DIR__ . "/../Views/404.php";
        require __DIR__ . "/../Views/layout.php";
    }

    public function returnHomePage()
    {
        global $publicBase;

        if ($_SESSION['Role'] == 1) {
            header("Location: " . $publicBase . "/Student/Home");
        } elseif ($_SESSION['Role'] == 2) {
            header("Location: " . $publicBase . "/Teacher/Home");
        } elseif ($_SESSION['Role'] == 3) {
            header("Location: " . $publicBase . "/Admin/Home");
        } else {
            header("Location: " . $publicBase . "/Error");
        }
        exit;
    }

    public function rejectToPage($path, $message)
    {
        $_SESSION['message'] = $message;
        global $publicBase;
        header("Location: " . $publicBase . $path);
        exit;
    }
}
