<?php
class AttendanceModelGV
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* ===============================
       LẤY THÔNG TIN USER
    =============================== */
    public function getUserById($userId)
    {
        $sql = "SELECT * FROM account WHERE UserID = :uid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':uid' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ===============================
       TẠO PHIÊN ĐIỂM DANH
    =============================== */
    public function insertSession($maLHP, $thoiGian, $strToken, $batDau, $ketThuc)
    {
        $sql = "INSERT INTO phiendiemdanh
                (MaLHP, ThoiGian, StrToken, ThoiGianBatDau, ThoiGianKetThuc)
                VALUES (:maLHP, :thoiGian, :token, :batDau, :ketThuc)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':maLHP'    => $maLHP,
            ':thoiGian' => $thoiGian,
            ':token'    => $strToken,
            ':batDau'   => $batDau,
            ':ketThuc'  => $ketThuc
        ]);

        return $this->pdo->lastInsertId();
    }

    /* ===============================
       DANH SÁCH PHIÊN ĐIỂM DANH THEO GV
    =============================== */
    public function getSessionsByGV($maGV)
    {
        $sql = "
            SELECT 
                pdd.MaPhien,
                lhp.MaLHP,
                mh.TenMonHoc,
                pdd.StrToken AS MaQR,
                TIMEDIFF(pdd.ThoiGianKetThuc, pdd.ThoiGianBatDau) AS ThoiGianQR,
                DATE(pdd.ThoiGian) AS Ngay,
                CONCAT(
                    COUNT(DISTINCT lsd.MSSV),
                    '/',
                    (
                        SELECT COUNT(*)
                        FROM dangkyhocphan dk2
                        WHERE dk2.MaLHP = lhp.MaLHP
                          AND dk2.TrangThai = 'Hoc'
                    )
                ) AS SoLuong
            FROM phiendiemdanh pdd
            JOIN lophp lhp ON pdd.MaLHP = lhp.MaLHP
            JOIN monhoc mh ON lhp.MaMonHoc = mh.MaMonHoc
            LEFT JOIN lichsudiemdanh lsd ON lsd.MaPhien = pdd.MaPhien
            WHERE lhp.MaGV = :maGV
            GROUP BY 
                pdd.MaPhien, lhp.MaLHP, mh.TenMonHoc,
                pdd.StrToken, pdd.ThoiGianKetThuc,
                pdd.ThoiGianBatDau, pdd.ThoiGian
            ORDER BY pdd.ThoiGian DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':maGV' => $maGV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ===============================
       CHI TIẾT ĐIỂM DANH 1 PHIÊN
    =============================== */
    public function getSessionDetail($maPhien)
    {
        $sql = "
            SELECT 
                s.MSSV,
                CONCAT(a.Ho, ' ', a.Ten) AS TenSV,
                IF(lsd.MSSV IS NULL, 'Vắng', 'Có mặt') AS TrangThai,
                lsd.ThoiGian,
                lsd.ViTri
            FROM dangkyhocphan dk
            JOIN student s ON dk.MSSV = s.MSSV
            JOIN account a ON s.MSSV = a.UserID
            LEFT JOIN lichsudiemdanh lsd 
                ON lsd.MSSV = dk.MSSV 
               AND lsd.MaPhien = :maPhien
            WHERE dk.MaLHP = (
                SELECT MaLHP FROM phiendiemdanh WHERE MaPhien = :maPhien
            )
            ORDER BY a.Ho, a.Ten
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':maPhien' => $maPhien]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ===============================
       THỐNG KÊ DASHBOARD GV
    =============================== */
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
                    ),
                    '%'
                ) AS TyLeChuyenCanTrongNgay
            FROM giangvien gv
            LEFT JOIN lophp lhp ON gv.MaGV = lhp.MaGV
            LEFT JOIN monhoc mh ON lhp.MaMonHoc = mh.MaMonHoc
            LEFT JOIN phiendiemdanh pdd 
                ON pdd.MaLHP = lhp.MaLHP 
               AND DATE(pdd.ThoiGian) = CURDATE()
            LEFT JOIN lichsudiemdanh ldd 
                ON ldd.MaPhien = pdd.MaPhien
            LEFT JOIN dangkyhocphan dk 
                ON dk.MaLHP = lhp.MaLHP 
               AND dk.TrangThai = 'Hoc'
            WHERE gv.MaGV = :maGV
            GROUP BY gv.MaGV
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':maGV' => $maGV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ===============================
       THỐNG KÊ CHUYÊN CẦN
    =============================== */
    public function getAttendanceStats($MaGV = null, $MaHK = null, $MaLHP = null)
    {
        $sql = "
            WITH SinhVienChuyenCan AS (
                SELECT 
                    dk.MSSV,
                    lhp.MaGV,
                    lhp.MaHK,
                    lhp.MaLHP,
                    COUNT(DISTINCT ldd.MaPhien) AS SoBuoiThamGia,
                    COUNT(DISTINCT pdd.MaPhien) AS TongBuoi
                FROM lophp lhp
                JOIN dangkyhocphan dk 
                    ON dk.MaLHP = lhp.MaLHP 
                   AND dk.TrangThai = 'Hoc'
                LEFT JOIN phiendiemdanh pdd 
                    ON pdd.MaLHP = lhp.MaLHP
                LEFT JOIN lichsudiemdanh ldd 
                    ON ldd.MaPhien = pdd.MaPhien 
                   AND ldd.MSSV = dk.MSSV
                GROUP BY dk.MSSV, lhp.MaGV, lhp.MaHK, lhp.MaLHP
            )
            SELECT 
                MaGV,
                MaHK,
                MaLHP,
                COUNT(MSSV) AS TongSoSinhVien,
                SUM(CASE WHEN SoBuoiThamGia = TongBuoi THEN 1 ELSE 0 END) AS SoSinhVienDiemDanhDayDu,
                SUM(CASE WHEN SoBuoiThamGia < TongBuoi / 2 THEN 1 ELSE 0 END) AS SoSinhVienVangNhieu,
                CONCAT(
                    ROUND(AVG(SoBuoiThamGia / NULLIF(TongBuoi,0) * 100), 2),
                    '%'
                ) AS TyLeChuyenCanTB
            FROM SinhVienChuyenCan
            WHERE 1=1
        ";

        $params = [];

        if ($MaGV !== null) {
            $sql .= " AND MaGV = :MaGV";
            $params[':MaGV'] = $MaGV;
        }
        if ($MaHK !== null) {
            $sql .= " AND MaHK = :MaHK";
            $params[':MaHK'] = $MaHK;
        }
        if ($MaLHP !== null) {
            $sql .= " AND MaLHP = :MaLHP";
            $params[':MaLHP'] = $MaLHP;
        }

        $sql .= " GROUP BY MaGV, MaHK, MaLHP";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function layDanhSachPhienTheoGV($MaGV)
{
    $sql = "
        SELECT 
            pd.MaPhien,
            pd.MaLHP,
            pd.StrToken AS MaQR,
            pd.ThoiGian AS Ngay,
            TIMESTAMPDIFF(MINUTE, pd.ThoiGianBatDau, pd.ThoiGianKetThuc) AS SuaHanQR,
            CONCAT(
                COUNT(DISTINCT lsd.MSSV), 
                '/', 
                (SELECT COUNT(*) 
                 FROM diemdanhonline.dangkyhocphan dk 
                 WHERE dk.MaLHP = pd.MaLHP AND dk.TrangThai = 'Hoc')
            ) AS SoLuong,
            CONCAT('./Teacher/CapNhatPhienDiemDanh/XemChiTiet?MaPhien=', pd.MaPhien) AS ChiTiet
        FROM 
            diemdanhonline.phiendiemdanh pd
        JOIN 
            diemdanhonline.lophp lhp ON pd.MaLHP = lhp.MaLHP
        LEFT JOIN 
            diemdanhonline.lichsudiemdanh lsd ON pd.MaPhien = lsd.MaPhien
        WHERE 
            lhp.MaGV = ?
        GROUP BY 
            pd.MaPhien, pd.MaLHP, pd.StrToken, pd.ThoiGian, pd.ThoiGianBatDau, pd.ThoiGianKetThuc
        ORDER BY pd.ThoiGian DESC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $MaGV); // i = integer, s = string
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC); // trả về tất cả dưới dạng mảng kết hợp
}

public function capNhatThoiGian($MaPhien, $ThoiGianBatDau, $ThoiGianKetThuc)
{
    $sql = "UPDATE phiendiemdanh SET ThoiGianBatDau = ?, ThoiGianKetThuc = ? WHERE MaPhien = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ssi", $ThoiGianBatDau, $ThoiGianKetThuc, $MaPhien);
    return $stmt->execute();
}
public function capNhatTrangThai($MaPhien, $MSSV, $TrangThai)
{
    if ($TrangThai === 'Co mat') {

        // Nếu chưa có thì thêm
        $sql = "
            INSERT INTO lichsudiemdanh (MSSV, MaPhien, ThoiGian)
            VALUES (?, ?, NOW())
            ON DUPLICATE KEY UPDATE ThoiGian = NOW()
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $MSSV, $MaPhien);
        return $stmt->execute();

    } else {

        // Vắng → xóa bản ghi
        $sql = "DELETE FROM lichsudiemdanh WHERE MSSV = ? AND MaPhien = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $MSSV, $MaPhien);
        return $stmt->execute();
    }
}

public function xoaPhien($MaPhien)
{
    $sql = "DELETE FROM phiendiemdanh WHERE MaPhien = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $MaPhien);
    return $stmt->execute();
}
public function layChiTietPhien($MaPhien)
{
    $sql = "SELECT * FROM phiendiemdanh WHERE MaPhien = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $MaPhien);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

public function layPhienTheoMa($maPhien)
{
    $sql = "SELECT * FROM phiendiemdanh WHERE MaPhien = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $maPhien);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

public function capNhatHanQR($maPhien, $soPhut)
{
    // Lấy thời gian bắt đầu
    $sql = "SELECT ThoiGianBatDau FROM phiendiemdanh WHERE MaPhien = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $maPhien);
    $stmt->execute();
    $result = $stmt->get_result();
    $phien = $result->fetch_assoc();

    if (!$phien) return false;

    // Tính thời gian kết thúc mới
    $batDau = new DateTime($phien['ThoiGianBatDau']);
    $batDau->modify("+$soPhut minutes");
    $thoiGianKetThucMoi = $batDau->format("Y-m-d H:i:s");

    // Update DB
    $sqlUpdate = "
        UPDATE phiendiemdanh
        SET ThoiGianKetThuc = ?
        WHERE MaPhien = ?
    ";
    $stmt = $this->conn->prepare($sqlUpdate);
    $stmt->bind_param("si", $thoiGianKetThucMoi, $maPhien);

    return $stmt->execute();
}


}
