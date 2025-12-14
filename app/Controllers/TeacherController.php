<?php 
    require_once __DIR__ . '/BaseController.php';
    require_once __DIR__ . '/../Models/AttendanceModel.php';
    class TeacherController extends BaseController
    {
        private $model;

        public function __construct($db)
        {
            $this->model = new AttendanceModel();
        } 
        public function showHomePage()
        {
            $this->renderTeacher("Trang chủ giảng viên", "Home.php");
        }
        public function showDSLopHP()
        {
            $this->renderTeacher("Danh sách lớp học phần", "DSLHP.php");
        }
        public function showDSLopSV()
        {   

        }
        public function showDSMonDayHoc()
        {
            $this->renderTeacher("Danh sách môn dạy học", "QLMH.php");
        }
        public function showTaoPhienDiemDanh()
        {
            $dsLop = $this->model->getClassesByTeacher($_SESSION['UID']);
            $dsDiemDanh = $this->model->getSessionsByTeacher($_SESSION['UID']);

            $this->renderTeacher(
                "Tạo phiên điểm danh",
                "Teacher/TaoPhienDiemDanh.php",
                compact('dsLop', 'dsDiemDanh')
            );
        }

        public function createDiemDanh()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $lopId = $_POST['lop_id'];

                $token = bin2hex(random_bytes(16));
                $start = date('Y-m-d H:i:s');
                $end   = date('Y-m-d H:i:s', strtotime('+10 minutes'));

                $this->model->createSession($lopId, $token, $start, $end);

                header("Location: /Teacher/TaoPhienDiemDanh");
                exit;
            }
        }  
         public function showCapNhatPhienDiemDanh()
        {
                $this->renderTeacher("Cập nhật phiên điểm danh", "CapNhapDiemDanh.php");
         }
        public function showQLDanhSachDiemDanh()
        {
                $this->renderTeacher("Danh sách điểm danh", "PhienDiemDanh.php");
         }
        public function showThongKeChuyenCan()
        {
                $this->renderTeacher("Thống kê chuyên cần", "ThongKeGV.php");
         }
    }
?>