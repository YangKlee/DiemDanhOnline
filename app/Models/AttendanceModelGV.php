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

    // Lấy thống kê giảng viên (dùng cho home/dashboard)
// Lấy thống kê cho 1 giảng viên (dùng cho home/dashboard)
    public function getGVStatistics($maGV)
    {
        $sql = "
        SELECT 
            gv.MaGV,
            COUNT(DISTINCT lhp.MaLHP) AS TongLopHocPhan,
            COUNT(DISTINCT mh.MaMonHoc) AS TongMonHoc,
            COUNT(DISTINCT pdd.MaPhien) AS SoBuoiDiemDanhTrongNgay,
            CONCAT(
                ROUND(
                    COUNT(ldd.MSSV) / NULLIF(COUNT(DISTINCT dk.MSSV), 0) * 100, 2
                ), '%'
            ) AS TyLeChuyenCanTrongNgay
        FROM giangvien gv
        LEFT JOIN lophp lhp ON gv.MaGV = lhp.MaGV
        LEFT JOIN monhoc mh ON lhp.MaMonHoc = mh.MaMonHoc
        LEFT JOIN phiendiemdanh pdd 
            ON pdd.MaLHP = lhp.MaLHP AND DATE(pdd.ThoiGian) = CURDATE()
        LEFT JOIN lichsudiemdanh ldd 
            ON ldd.MaPhien = pdd.MaPhien AND DATE(ldd.ThoiGian) = CURDATE()
        LEFT JOIN dangkyhocphan dk 
            ON dk.MaLHP = lhp.MaLHP AND dk.TrangThai = 'Hoc'
        WHERE gv.MaGV = ?
        GROUP BY gv.MaGV
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $maGV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Trả về 1 giảng viên
    }

public function getAttendanceStats($MaGV = null, $MaHK = null, $MaLHP = null) {
    $sql = "
        WITH SinhVienChuyenCan AS (
            SELECT 
                dk.MSSV,
                lhp.MaGV,
                lhp.MaHK,
                lhp.MaLHP,
                COUNT(DISTINCT ldd.MaPhien) AS SoBuoiThamGia,
                COUNT(DISTINCT pdd.MaPhien) AS TongBuoi
            FROM diemdanhonline.lophp lhp
            JOIN diemdanhonline.dangkyhocphan dk 
                ON dk.MaLHP = lhp.MaLHP AND dk.TrangThai = 'Hoc'
            LEFT JOIN diemdanhonline.phiendiemdanh pdd 
                ON pdd.MaLHP = lhp.MaLHP
            LEFT JOIN diemdanhonline.lichsudiemdanh ldd 
                ON ldd.MaPhien = pdd.MaPhien AND ldd.MSSV = dk.MSSV
            GROUP BY dk.MSSV, lhp.MaGV, lhp.MaHK, lhp.MaLHP
        )
        SELECT 
            MaGV,
            MaHK,
            MaLHP,
            COUNT(MSSV) AS TongSoSinhVien,
            SUM(CASE WHEN SoBuoiThamGia = TongBuoi THEN 1 ELSE 0 END) AS SoSinhVienDiemDanhDayDu,
            SUM(CASE WHEN SoBuoiThamGia < TongBuoi/2 THEN 1 ELSE 0 END) AS SoSinhVienVangNhieu,
            CONCAT(
                ROUND(AVG(SoBuoiThamGia / NULLIF(TongBuoi,0) * 100), 2),
                '%'
            ) AS TyLeChuyenCanTB
        FROM SinhVienChuyenCan
        WHERE 1=1
    ";

    $types = '';
    $params = [];
    if ($MaGV !== null) {
        $sql .= " AND MaGV = ?";
        $types .= 'i'; // hoặc 's' nếu MaGV là chuỗi
        $params[] = $MaGV;
    }
    if ($MaHK !== null) {
        $sql .= " AND MaHK = ?";
        $types .= 's';
        $params[] = $MaHK;
    }
    if ($MaLHP !== null) {
        $sql .= " AND MaLHP = ?";
        $types .= 'i';
        $params[] = $MaLHP;
    }

    $sql .= " GROUP BY MaGV, MaHK, MaLHP";

    $stmt = $this->conn->prepare($sql);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}




}
