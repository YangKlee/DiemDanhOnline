<?php 
    class PhienDiemDanh
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Config/database.php";
           $this->conn = Database::getConnection();
        }
        public function getAllPhienDiemDanhAdmin()
        {
            $sql = "SELECT MaPhien, phiendiemdanh.MaLHP,CONCAT(Ho, ' ', Ten) AS GiangVien, 
            ThoiGian, TenMonHoc, StrToken, phiendiemdanh.ThoiGianBatDau, phiendiemdanh.ThoiGianKetThuc 
            FROM PhienDiemDanh 
            JOIN LopHP ON PhienDiemDanh.MaLHP = LopHP.MaLHP
            JOIN MonHoc ON LopHP.MaMonHoc = MonHoc.MaMonHoc
            JOIN GiangVien ON LopHP.MaGV = GiangVien.MaGV
            JOIN account ON GiangVien.MaGV = account.UserID
            ORDER BY PhienDiemDanh.MaPhien ASC";
            $stmt = $this->conn->prepare($sql);
            $data = [];
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
                return $data;
            }
            else
                return NULL;
        }
        public function getLichSuDiemDanh($PhienDiemDanh)
        {
            $sql = "SELECT lichsudiemdanh.*, CONCAT(account.Ho, ' ', account.Ten) AS SinhVien from lichsudiemdanh 
            JOIN account ON lichsudiemdanh.MSSV = account.UserID
            WHERE MaPhien = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $PhienDiemDanh);
            $data = [];
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
                return $data;
            }
            else
                return NULL;
        }
    }
?>