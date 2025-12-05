<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

class BaseController
{

    public function renderStudent($title, $render)
    {
        $render = __DIR__ . "/../Views/Student/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
    }
    public function renderTeacher($title, $render)
    {
        $render = __DIR__ . "/../Views/Teacher/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
    }
    public function renderCommon($title, $render)
    {
        $render = __DIR__ . "/../Views/common/" . $render;
        require_once __DIR__ . "/../Views/layout.php";
    }
    public function renderAuth($title, $render, $isLayout)
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
}
