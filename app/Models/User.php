<?php 
    class User
    {
        private $conn;
        public function __construct()
        {
            $this->conn = Database::getConnection();
        }

        public function getUserById($userId)
        {
            $stmt = $this->conn->prepare("SELECT * FROM account WHERE UserID = ?");
            $stmt->bind_param("s", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        public function getStudentInfo($studentId)
        {
            $stmt = $this->conn->prepare("SELECT UserID, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, TenLop, TenNganh FROM account 
            JOIN student on account.UserID = student.MSSV  
            JOIN lopsv on  lopsv.MaLop = student.MaLop 
            JOIN nganh on lopsv.MaNganh = nganh.MaNganh 
            WHERE account.UserID = ?");
            $stmt->bind_param("s", $studentId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
    }
?>