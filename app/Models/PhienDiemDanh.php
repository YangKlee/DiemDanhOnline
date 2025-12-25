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
            $sql = "SELECT 
    -- Thông tin sinh viên từ danh sách lớp
    ds.MSSV, 
    CONCAT(sv.Ho, ' ', sv.Ten) AS TenSinhVien,
    
    -- Kiểm tra trạng thái
    CASE 
        WHEN lsd.MSSV IS NOT NULL THEN 1 
        ELSE 0 
    END AS TrangThai,
    
    -- Lấy thông tin chi tiết để debug
    lsd.ThoiGian AS ThoiGianDiemDanh,
    pdd.MaPhien AS PhienHienTai,
    lsd.MaPhien AS PhienTrongLichSu -- Cột này quan trọng: nếu nó NULL nghĩa là không khớp Phiên

FROM danhsachlhp ds
JOIN phiendiemdanh pdd ON ds.MaLHP = pdd.MaLHP
JOIN account sv ON ds.MSSV = sv.UserID
-- LEFT JOIN: Tìm sinh viên trong bảng lịch sử có cùng MSSV VÀ cùng MaPhien
LEFT JOIN lichsudiemdanh lsd ON ds.MSSV = lsd.MSSV AND lsd.MaPhien = pdd.MaPhien

WHERE pdd.MaPhien = ? 
ORDER BY ds.MSSV ASC;
    ";
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