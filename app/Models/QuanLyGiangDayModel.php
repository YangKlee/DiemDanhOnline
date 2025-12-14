<?php 
    class QuanLyGiangDayModel
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
public function getLopHPTheoGiangVien($maGV)
{
    $stmt = $this->conn->prepare("
        SELECT 
            l.MaLHP,
            m.TenMonHoc,
            lh.Thu,
            t.KhungTiet,
            lh.Phong,
            h.TenHK,
            CONCAT(YEAR(h.ThoiGianBatDau), '-', YEAR(h.ThoiGianKetThuc)) AS NamHoc
        FROM lophp AS l
        LEFT JOIN monhoc AS m   ON m.MaMonHoc = l.MaMonHoc
        LEFT JOIN lichhoc AS lh ON lh.MaLHP   = l.MaLHP
        LEFT JOIN tiet AS t     ON t.MaTiet   = lh.Tiet
        LEFT JOIN hocky AS h    ON h.MaHK     = l.MaHK
        WHERE l.MaGV = ?
    ");

    $stmt->bind_param("s", $maGV);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function getMHTheoGiangVien($maGV)
{
    $sql = "
        SELECT 
            m.MaMonHoc,                          
            m.TenMonHoc,                        
            m.SoTC,                        
            k.TenKhoa,                           
            COUNT(DISTINCT l.MaLHP) AS SoLopHP
        FROM monhoc AS m
        JOIN lophp  AS l ON l.MaMonHoc = m.MaMonHoc
        JOIN hocky  AS h ON h.MaHK     = l.MaHK
        JOIN khoa   AS k ON k.MaKhoa   = m.KhoaPhuTrach
        WHERE l.MaGV = ?
          AND YEAR(h.ThoiGianBatDau) = YEAR(CURDATE())
          AND YEAR(h.ThoiGianKetThuc) = YEAR(CURDATE())
        GROUP BY m.MaMonHoc, m.TenMonHoc, m.SoTC, k.TenKhoa
        ORDER BY m.MaMonHoc
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $maGV);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

   
    }
?>