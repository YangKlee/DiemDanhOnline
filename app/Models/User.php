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
            LEFT JOIN student on account.UserID = student.MSSV  
            LEFT JOIN lopsv on  lopsv.MaLop = student.MaLop 
            LEFT JOIN nganh on lopsv.MaNganh = nganh.MaNganh 
            WHERE account.UserID = ?");
            $stmt->bind_param("s", $studentId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        public  function getAllStudentInfo()
        {
            $stmt = $this->conn->prepare("SELECT MSSV, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, TenLop, TenNganh FROM account 
            RIGHT JOIN student on account.UserID = student.MSSV  
            LEFT JOIN lopsv on  lopsv.MaLop = student.MaLop 
            LEFT JOIN nganh on lopsv.MaNganh = nganh.MaNganh ");
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        public function searchStudentInfo($keyword)
        {
            $likeKeyword = '%' . $keyword . '%';
            $stmt = $this->conn->prepare("SELECT MSSV, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, TenLop, TenNganh FROM account 
            RIGHT JOIN student on account.UserID = student.MSSV  
            LEFT JOIN lopsv on  lopsv.MaLop = student.MaLop 
            LEFT JOIN nganh on lopsv.MaNganh = nganh.MaNganh 
            WHERE MSSV LIKE ? OR Ho LIKE ? OR Ten LIKE ? OR Email LIKE ?");
            $stmt->bind_param("ssss", $likeKeyword, $likeKeyword, $likeKeyword, $likeKeyword);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        public function getTeacherInfo($teacherId)
        {
            $stmt = $this->conn->prepare("SELECT UserID, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, TenKhoa FROM account 
            LEFT JOIN giangvien on account.UserID = giangvien.MaGV
            left JOIN khoa on giangvien.MaKhoa = khoa.MaKhoa 
            WHERE account.UserID = ?");
            $stmt->bind_param("s", $teacherId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        public function getAdminInfo($adminId)
        {
            $stmt = $this->conn->prepare("SELECT UserID, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi FROM account 
            WHERE account.UserID = ?");
            $stmt->bind_param("s", $adminId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        public function updateStudentInfo($studentId, $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi)
        {
            $stmt = $this->conn->prepare("UPDATE account SET Ho = ?, Ten = ?, GioiTinh = ?, NgaySinh = ?, SoDT = ?, CCCD = ?, Email = ?, DiaChi = ? WHERE UserID = ?");
            $stmt->bind_param("sssssssss", $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi, $studentId);
            return $stmt->execute();
        }
    }
?>