<?php
require_once __DIR__ . '/../Config/database.php';

class AttendanceModelGV
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
     // Lấy danh sách phiên điểm danh cho giảng viên
public function getSessionsByGV($maGV)
{
    $sql = "
SELECT 
    pdd.MaPhien,
    lhp.MaLHP AS MaLHP,
    mh.TenMonHoc AS TenMonHoc,
    pdd.StrToken AS MaQR,
    TIMEDIFF(pdd.ThoiGianKetThuc, pdd.ThoiGianBatDau) AS ThoiGianQR,
    DATE(pdd.ThoiGian) AS Ngay,
    CONCAT(
        COUNT(DISTINCT lsd.MSSV),
        '/',
        (SELECT COUNT(*) 
         FROM diemdanhonline.student sv2
         JOIN diemdanhonline.dangkyhocphan dk2 ON sv2.MSSV = dk2.MSSV
         WHERE dk2.MaLHP = lhp.MaLHP)
    ) AS SoLuong
FROM phiendiemdanh pdd
JOIN lophp lhp ON pdd.MaLHP = lhp.MaLHP
JOIN monhoc mh ON lhp.MaMonHoc = mh.MaMonHoc
JOIN dangkyhocphan dk ON dk.MaLHP = lhp.MaLHP
JOIN student sv ON sv.MSSV = dk.MSSV
LEFT JOIN lichsudiemdanh lsd ON lsd.MaPhien = pdd.MaPhien
WHERE lhp.MaGV = ?
GROUP BY 
    pdd.MaPhien, lhp.MaLHP, mh.TenMonHoc, pdd.StrToken, 
    pdd.ThoiGianKetThuc, pdd.ThoiGianBatDau, pdd.ThoiGian
ORDER BY pdd.ThoiGian DESC;

    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $maGV);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


    // Lấy chi tiết sinh viên của một phiên
    public function getSessionDetail($maPhien)
    {
        $sql = "
            SELECT s.MSSV, CONCAT(a.Ho, ' ', a.Ten) AS TenSV, 
                   IF(lsd.MSSV IS NULL, 'Vắng', 'Có mặt') AS TrangThai,
                   lsd.ThoiGian, lsd.ViTri
            FROM dangkyhocphan dk
            JOIN student s ON dk.MSSV = s.MSSV
            JOIN account a ON s.MSSV = a.UserID
            LEFT JOIN lichsudiemdanh lsd 
                   ON dk.MSSV = lsd.MSSV AND lsd.MaPhien = ?
            WHERE dk.MaLHP = (SELECT MaLHP FROM phiendiemdanh WHERE MaPhien = ?)
            ORDER BY a.Ho, a.Ten
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $maPhien, $maPhien);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
