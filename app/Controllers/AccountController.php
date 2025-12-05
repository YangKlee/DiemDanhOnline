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
                global $publicBase;
                header( "Location: ". $publicBase."/");
                exit;
            }
        }

        public function loadUserData()
        {
            // get từ database qua UserID
            // các thông tin cần get: tên, role
            // để đảm bảo bảo mật và tiện cho cookies, hàm này được chạy mỗi khi chuyển trang

            // demo
            
            $_SESSION['FullName'] = "Han Sara";
            // 1 aka sinh viên
            // 2 aka giảng viên
            // 3 aka admin
            $_SESSION['Role'] = 3;
        }
        public function logout()
        {
            session_destroy();
            $this->rejectPage("/Account/Login");


        }
    }
?>