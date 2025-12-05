<?php 
    class TeacherController extends BaseController
    {
        public function showHomePage()
        {
            $this->renderTeacher("Trang chủ giảng viên", "Home.php");
        }
    }
?>