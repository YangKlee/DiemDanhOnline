<?php 
    class LopHP
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Config/database.php";
           $this->conn = Database::getConnection();
        }
        public function getAllLopHP()
        {
            $sql = "SELECT MaLHP, MonHoc.TenMonHoc, CONCAT(account.Ho, ' ', account.Ten) AS TenGiangVien
            , HocKy.TenHK, LopHP.ThoiGianBatDau, LopHP.ThoiGianKetThuc
             FROM LopHP JOIN MonHoc ON LopHP.MaMonHoc = MonHoc.MaMonHoc
            JOIN GiangVien ON LopHP.MaGV = GiangVien.MaGV
            JOIN account ON GiangVien.MaGV = account.UserID
            JOIN HocKy ON LopHP.MaHK = HocKy.MaHK
            ORDER BY LopHP.MaLHP ASC";
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
        public function insertLopHP($MaLHP, $MaMonHoc, $MaGV, $MaHK, $ThoiGianBatDau, $ThoiGianKetThuc)
        {
            $sql = "INSERT INTO LopHP (MaLHP, MaMonHoc, MaGV, MaHK, ThoiGianBatDau, ThoiGianKetThuc) 
                    VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssssss', $MaLHP, $MaMonHoc, $MaGV, $MaHK, $ThoiGianBatDau, $ThoiGianKetThuc );
            return $stmt->execute();
        }
        public function updateLopHP($MaLHP, $MaMonHoc, $MaGV, $MaHK, $ThoiGianBatDau, $ThoiGianKetThuc)
        {
            $sql = "UPDATE LopHP SET MaMonHoc = ?, MaGV = ?, MaHK = ?, ThoiGianBatDau = ?, ThoiGianKetThuc = ? 
                    WHERE MaLHP = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssssss',  $MaMonHoc, $MaGV, $MaHK, $ThoiGianBatDau, $ThoiGianKetThuc, $MaLHP );
            return $stmt->execute();
        }
        public function deleteLopHP($MaLHP)
        {
            $sql = "DELETE FROM LopHP WHERE MaLHP = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $MaLHP);
            return $stmt->execute();
        }
        public function getLopHP($MaLHP)
        {
            $sql = "SELECT * FROM LopHP WHERE MaLHP = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $MaLHP);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                return $result->fetch_assoc();
            }
            else
                return NULL;
        }
    }
?>