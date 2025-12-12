<?php 
require_once __DIR__ . '/../Config/db.php';
require_once __DIR__ . '/BaseController.php';
    class AccountController extends BaseController
    {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }
        public function showThongTinCaNhan()

        {
            $userModel = new User();
            //var_dump($_SESSION['UID']);
            $data = $userModel->getStudentInfo($_SESSION['UID']);
            //var_dump($studentData);
            $this->renderCommon("Thông tin cá nhân", "profile.php", ['studentData' => $data]);

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
            if (!isset($_POST['username'], $_POST['password'])) return;

            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $this->db->prepare("SELECT * FROM account WHERE UserID = ?");
            $query->execute([$username]);
            $user = $query->fetch();

            if (!$user) {
                echo "UserID không tồn tại!";
                return;
            }
            if ($password !== $user['MatKhau']) {
                echo "Sai mật khẩu!";
                return;
            }


            $_SESSION['UID'] = $user['UserID'];
            global $publicBase;
            header("Location: $publicBase/");
            exit;
        }

        public function loadUserData()
        {
            // Nếu chưa đăng nhập thì bỏ qua
            if (!isset($_SESSION['UID'])) return;

            $uid = $_SESSION['UID'];

            // Lấy thông tin tên, role, Email... tùy bạn muốn dùng gì
            $query = $this->db->prepare("
                SELECT Ten, Role
                FROM account
                WHERE UserID = ?
            ");
            $query->execute([$uid]);
            $user = $query->fetch();

            if ($user) {
                $_SESSION['Ten'] = $user['Ten'];
                $_SESSION['Role']     = $user['Role']; 
            }
        }

        public function logout()
        {
            session_destroy();
            $this->rejectPage("/Account/Login");


        }
    }
?>