<?php 
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    ini_set('display_errors', 1);
    define('BASE_PATH', dirname(__DIR__));
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // Normalize request path relative to the public directory
    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $publicBase  = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    if ($publicBase !== '' && strpos($requestPath, $publicBase) === 0) {
        $requestPath = substr($requestPath, strlen($publicBase));
    }
    $requestPath = '/' . ltrim($requestPath, '/');
    require_once __DIR__ . "/app/Controllers/StudentController.php";
    require_once __DIR__ . "/app/Controllers/AccountController.php";
    $studentController = new StudentController();
    $accountController = new AccountController();


    if(session_status() != PHP_SESSION_ACTIVE)
    {
        session_start();
    }

    // ktra session mssv
    if(!isset($_SESSION['UID']) && $requestPath != "/Account/Login" && $_SERVER['REQUEST_METHOD'] != 'POST')
    {
        header( "Location: ". $publicBase."/Account/Login");
    }

    switch ($requestPath)
    {
        case "/Student":
        {
            $studentController->showHomeStudent();
            break;
        }
        case "/Student/Home":
        {
            $studentController->showHomeStudent();
            break;
        }
        case "/Student/Home/ChiTietLichSuDiemDanh":
            {
                //$studentController->showLichSuDiemDanhHomePage();
                break;
            }
        case "/Student/LichSuDiemDanh" :
        {
            $studentController->showLichSuDiemDanh();
            break;
        }
        case "/Student/LichSuDiemDanh/XemChiTiet" :
        {
            $studentController->showChiTietLichSuDiemDanh();
            break;
        }
        case "/Student/QuetQR":
        {
            $studentController->showCheckinQR();
            break;
        }
        case "/Account/ThongTinCaNhan":
        {
            $accountController->showThongTinCaNhan();
            break;
        }
        case "/Account/ThongTinCaNhan/EditInfo":
        {
            $accountController->showEditInfoForm();
            break;
        }
        case "/Account/ChangePassword":
        {
            $accountController->showChangePasswordLogined();
            break;
        }
        case "/Account/Login":
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $accountController->submitLogin();
            }
            else 
            {
                $accountController->showLogin();
            
            }
            break;
        }
        case "/Account/DangXuat":   
        {
            $accountController->logout();
            break;
        }
        default :
        {
            $studentController->Error404();
            break;
        }
    }
?>