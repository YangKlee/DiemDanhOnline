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
        public function setPassword($userId, $newPassword)
        {

            $stmt = $this->conn->prepare("UPDATE account SET Password = ? WHERE UserID = ?");
            $stmt->bind_param("ss", $newPassword, $userId);
            return $stmt->execute();
        }
        public function addStudent($studentId, $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi, $maLop, $password)
        {
            // Thêm vào bảng account
            $stmt = $this->conn->prepare("INSERT INTO account (UserID, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, MatKhau , Role) VALUES (?, ?, ?, ?, ?, ?, ?, ?,? , ?, '1')");
            $stmt->bind_param("ssssssssss", $studentId, $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi, $password);
            $stmt->execute();

            // Thêm vào bảng student
            $stmt2 = $this->conn->prepare("INSERT INTO student (MSSV, MaLop) VALUES (?, ?)");
            $stmt2->bind_param("ss", $studentId, $maLop);
            return $stmt2->execute();
        }
        public function updateStudentInfo($studentId, $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi)
        {
            $stmt = $this->conn->prepare("UPDATE account SET Ho = ?, Ten = ?, GioiTinh = ?, NgaySinh = ?, SoDT = ?, CCCD = ?, Email = ?, DiaChi = ? WHERE UserID = ?");
            $stmt->bind_param("sssssssss", $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi, $studentId);
            return $stmt->execute();
        }
        public function updateStudentLop($studentId, $maLop)
        {
            $stmt = $this->conn->prepare("UPDATE student SET MaLop = ? WHERE MSSV = ?");
            $stmt->bind_param("ss", $maLop, $studentId);
            return $stmt->execute();
        }
        public function getAllTeacherInfo()
        {
            $stmt = $this->conn->prepare("SELECT MaGV, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, TenKhoa FROM account 
            RIGHT JOIN giangvien on account.UserID = giangvien.MaGV
            LEFT JOIN khoa on giangvien.MaKhoa = khoa.MaKhoa ");
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        public function searchTeacherInfo($keyword)
        {
            $likeKeyword = '%' . $keyword . '%';
            $stmt = $this->conn->prepare("SELECT MaGV, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, TenKhoa FROM account 
            RIGHT JOIN giangvien on account.UserID = giangvien.MaGV
            LEFT JOIN khoa on giangvien.MaKhoa = khoa.MaKhoa 
            WHERE MaGV LIKE ? OR Ho LIKE ? OR Ten LIKE ? OR Email LIKE ?");
            $stmt->bind_param("ssss", $likeKeyword, $likeKeyword, $likeKeyword, $likeKeyword);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        public function deleteStudent($studentId)
        {
            // Xóa khỏi bảng student
            $stmt = $this->conn->prepare("DELETE FROM student WHERE MSSV = ?");
            $stmt->bind_param("s", $studentId);
            $stmt->execute();

            // Xóa khỏi bảng account
            $stmt2 = $this->conn->prepare("DELETE FROM account WHERE UserID = ?");
            $stmt2->bind_param("s", $studentId);
            return $stmt2->execute();
        }
        public function insertTeacher($teacherId, $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi, $maKhoa, $password)
        {
            // Thêm vào bảng account
            $stmt = $this->conn->prepare("INSERT INTO account (UserID, Ho, Ten, GioiTinh, NgaySinh, SoDT, CCCD, Email, DiaChi, MatKhau , Role) VALUES (?, ?, ?, ?, ?, ?, ?, ?,? , ?, '2')");
            $stmt->bind_param("ssssssssss", $teacherId, $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi, $password);
            $stmt->execute();

            // Thêm vào bảng giangvien
            $stmt2 = $this->conn->prepare("INSERT INTO giangvien (MaGV, MaKhoa) VALUES (?, ?)");
            $stmt2->bind_param("ss", $teacherId, $maKhoa);
            return $stmt2->execute();
        }
        public function updateTeacherInfo($teacherId, $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi)
        {
            $stmt = $this->conn->prepare("UPDATE account SET Ho = ?, Ten = ?, GioiTinh = ?, NgaySinh = ?, SoDT = ?, CCCD = ?, Email = ?, DiaChi = ? WHERE UserID = ?");
            $stmt->bind_param("sssssssss", $ho, $ten, $gioiTinh, $ngaySinh, $soDT, $cccd, $email, $diaChi, $teacherId);
            return $stmt->execute();
        }
        public function updateTeacherKhoa($teacherId, $maKhoa)
        {
            $stmt = $this->conn->prepare("UPDATE giangvien SET MaKhoa = ? WHERE MaGV = ?");
            $stmt->bind_param("ss", $maKhoa, $teacherId);
            return $stmt->execute();
        }
        public function deleteTeacher($teacherId)
        {
            // Xóa khỏi bảng giangvien
            $stmt = $this->conn->prepare("DELETE FROM giangvien WHERE MaGV = ?");
            $stmt->bind_param("s", $teacherId);
            $stmt->execute();

            // Xóa khỏi bảng account
            $stmt2 = $this->conn->prepare("DELETE FROM account WHERE UserID = ?");
            $stmt2->bind_param("s", $teacherId);
            return $stmt2->execute();
        }
        public function getGiangVienByKhoa($maKhoa)
        {
            $stmt = $this->conn->prepare("SELECT MaGV, Ho, Ten FROM account 
            RIGHT JOIN giangvien on account.UserID = giangvien.MaGV
            WHERE giangvien.MaKhoa = ?");
            $stmt->bind_param("s", $maKhoa);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        public function getAllGiangVien()
        {
            $stmt = $this->conn->prepare("SELECT MaGV, Ho, Ten FROM account 
            RIGHT JOIN giangvien on account.UserID = giangvien.MaGV");
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }


    }
?>