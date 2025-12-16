<?php
require_once __DIR__ . '/../Config/database.php';

class AttendanceModelST
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
    /* ===============================
       1. Lấy danh sách học kỳ
    =============================== */
public function getAllHocKyByMSSV($mssv)
{
    $stmt = $this->conn->prepare("
        SELECT DISTINCT h.MaHK, h.TenHK
        FROM hocky h
        JOIN lophp l ON l.MaHK = h.MaHK
        JOIN dangkyhocphan d ON d.MaLHP = l.MaLHP
        WHERE d.MSSV = ?
        ORDER BY h.ThoiGianBatDau DESC
    ");
    $stmt->bind_param("i", $mssv);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


    /* =========================================
       2. Lấy lớp học phần theo MSSV + học kỳ
    ========================================= */
public function getLHPByStudentAndHK($mssv, $maHK = null)
{
    // Nếu có mã học kỳ, thêm điều kiện WHERE, nếu không thì bỏ qua
    if (!empty($maHK)) {
        $sql = "
            SELECT 
                lhp.MaLHP,
                mh.TenMonHoc,
                CONCAT(acc.Ho, ' ', acc.Ten) AS TenGV,
                COUNT(DISTINCT pdd.MaPhien) AS TongBuoi,
                SUM(CASE WHEN lsd.MSSV IS NOT NULL THEN 1 ELSE 0 END) AS CoMat
            FROM dangkyhocphan dk
            JOIN lophp lhp ON dk.MaLHP = lhp.MaLHP
            JOIN monhoc mh ON lhp.MaMonHoc = mh.MaMonHoc
            JOIN giangvien gv ON lhp.MaGV = gv.MaGV
            JOIN account acc ON acc.UserID = gv.MaGV
            LEFT JOIN phiendiemdanh pdd ON lhp.MaLHP = pdd.MaLHP
            LEFT JOIN lichsudiemdanh lsd 
                   ON pdd.MaPhien = lsd.MaPhien 
                  AND lsd.MSSV = dk.MSSV
            WHERE dk.MSSV = ?
              AND lhp.MaHK = ?
            GROUP BY lhp.MaLHP
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $mssv, $maHK);
    } else {
        $sql = "
            SELECT 
                lhp.MaLHP,
                mh.TenMonHoc,
                CONCAT(acc.Ho, ' ', acc.Ten) AS TenGV,
                COUNT(DISTINCT pdd.MaPhien) AS TongBuoi,
                SUM(CASE WHEN lsd.MSSV IS NOT NULL THEN 1 ELSE 0 END) AS CoMat
            FROM dangkyhocphan dk
            JOIN lophp lhp ON dk.MaLHP = lhp.MaLHP
            JOIN monhoc mh ON lhp.MaMonHoc = mh.MaMonHoc
            JOIN giangvien gv ON lhp.MaGV = gv.MaGV
            JOIN account acc ON acc.UserID = gv.MaGV
            LEFT JOIN phiendiemdanh pdd ON lhp.MaLHP = pdd.MaLHP
            LEFT JOIN lichsudiemdanh lsd 
                   ON pdd.MaPhien = lsd.MaPhien 
                  AND lsd.MSSV = dk.MSSV
            WHERE dk.MSSV = ?
            GROUP BY lhp.MaLHP
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $mssv);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


    /* =====================================
       3. Chi tiết điểm danh 1 lớp học phần
    ===================================== */
    public function getAttendanceDetail($mssv, $maLHP)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                pdd.MaPhien,
                pdd.ThoiGian,
                CASE 
                    WHEN lsd.MSSV IS NULL THEN 'Vắng'
                    ELSE 'Có mặt'
                END AS TrangThai
            FROM phiendiemdanh pdd
            LEFT JOIN lichsudiemdanh lsd 
                   ON pdd.MaPhien = lsd.MaPhien 
                  AND lsd.MSSV = ?
            WHERE pdd.MaLHP = ?
            ORDER BY pdd.ThoiGian
        ");

        $stmt->bind_param("ii", $mssv, $maLHP);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

        // Lấy tổng quan điểm danh trong tuần (có mặt / vắng)
    public function getWeeklySummary($mssv)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                SUM(CASE WHEN lsd.MSSV IS NOT NULL THEN 1 ELSE 0 END) AS CoMat,
                SUM(CASE WHEN lsd.MSSV IS NULL THEN 1 ELSE 0 END) AS Vang
            FROM phiendiemdanh pdd
            LEFT JOIN lichsudiemdanh lsd 
                   ON pdd.MaPhien = lsd.MaPhien 
                  AND lsd.MSSV = ?
            WHERE pdd.ThoiGian >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
              AND pdd.ThoiGian < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY)
        ");
        $stmt->bind_param("i", $mssv);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Lấy lịch sử điểm danh trong tuần
    public function getWeeklyHistory($mssv)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                mh.TenMonHoc,
                CONCAT(acc.Ho, ' ', acc.Ten) AS TenGV,
                pdd.ThoiGian,
                CASE 
                    WHEN lsd.MSSV IS NULL THEN 'Vắng'
                    ELSE 'Có mặt'
                END AS TrangThai
            FROM phiendiemdanh pdd
            JOIN lophp lhp ON pdd.MaLHP = lhp.MaLHP
            JOIN monhoc mh ON lhp.MaMonHoc = mh.MaMonHoc
            JOIN giangvien gv ON lhp.MaGV = gv.MaGV
            JOIN account acc ON acc.UserID = gv.MaGV
            LEFT JOIN lichsudiemdanh lsd 
                   ON pdd.MaPhien = lsd.MaPhien 
                  AND lsd.MSSV = ?
            WHERE pdd.ThoiGian >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
              AND pdd.ThoiGian < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY)
            ORDER BY pdd.ThoiGian DESC
        ");
        $stmt->bind_param("i", $mssv);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
}
