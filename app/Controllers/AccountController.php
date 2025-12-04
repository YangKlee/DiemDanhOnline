<?php 
require_once __DIR__ . '/BaseController.php';
    class AccountController extends BaseController
    {
        public function showThongTinCaNhan()
        {
            $this->renderCommon("Thông tin cá nhân", "profile.php");
        }
        public function showEditInfoForm()
        {
            $this->renderCommon("Thông tin cá nhân", "profile_edit.php");
        }
        public function showChangePasswordLogined()
        {
            $this->renderAuth("Đổi mật khẩu", "change_password.php", 1);
        }
        public function showLogin()
        {
            $this->renderAuth("Đăng nhập", "login.php", 0);
        }
        public function submitLogin()
        {
            if(isset($_POST['username']) && isset($_POST['password']))
            {
                $_SESSION['UID'] = $_POST['username'];
                $_SESSION['Role'] = 1;
                global $publicBase;
                header( "Location: ". $publicBase."/Student/Home");

            }
        }
        public function logout()
        {
            session_destroy();
            $this->rejectPage("/Account/Login");


        }
    }
?>