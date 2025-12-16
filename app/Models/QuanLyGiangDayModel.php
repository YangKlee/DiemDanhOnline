<?php

class QuanLyGiangDayModel
{
    private PDO $pdo;

    public function __construct(PDO $db)
    {
        $this->pdo = $db;
    }

    /* =========================================
       LẤY THÔNG TIN USER
    ========================================= */
    public function getUserById($userId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM account WHERE UserID = ?"
        );
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================================
       DANH SÁCH LỚP HỌC PHẦN THEO GIẢNG VIÊN
    ========================================= */
    public function getLopHPTheoGiangVien($maGV)
    {
        $sql = "
            SELECT 
                l.MaLHP,
                m.TenMonHoc,
                lh.Thu,
                t.KhungTiet,
                lh.Phong,
                h.TenHK,
                CONCAT(
                    YEAR(h.ThoiGianBatDau),
                    '-',
                    YEAR(h.ThoiGianKetThuc)
                ) AS NamHoc
            FROM lophp l
            LEFT JOIN monhoc m   ON m.MaMonHoc = l.MaMonHoc
            LEFT JOIN lichhoc lh ON lh.MaLHP   = l.MaLHP
            LEFT JOIN tiet t     ON t.MaTiet   = lh.Tiet
            LEFT JOIN hocky h    ON h.MaHK     = l.MaHK
            WHERE l.MaGV = ?
            ORDER BY h.ThoiGianBatDau DESC, m.TenMonHoc
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$maGV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================================
       DANH SÁCH MÔN HỌC GIẢNG DẠY (NĂM HIỆN TẠI)
    ========================================= */
    public function getMHTheoGiangVien($maGV)
    {
        $sql = "
            SELECT 
                m.MaMonHoc,
                m.TenMonHoc,
                m.SoTC,
                k.TenKhoa,
                COUNT(DISTINCT l.MaLHP) AS SoLopHP
            FROM monhoc m
            JOIN lophp  l ON l.MaMonHoc = m.MaMonHoc
            JOIN hocky  h ON h.MaHK     = l.MaHK
            JOIN khoa   k ON k.MaKhoa   = m.KhoaPhuTrach
            WHERE l.MaGV = ?
              AND YEAR(h.ThoiGianBatDau) = YEAR(CURDATE())
              AND YEAR(h.ThoiGianKetThuc) = YEAR(CURDATE())
            GROUP BY 
                m.MaMonHoc,
                m.TenMonHoc,
                m.SoTC,
                k.TenKhoa
            ORDER BY m.MaMonHoc
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$maGV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
