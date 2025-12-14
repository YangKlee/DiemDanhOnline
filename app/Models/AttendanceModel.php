<?php
require_once __DIR__ . '/../Config/database.php';

class AttendanceModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Tạo phiên điểm danh
    public function createSession($maLHP, $token, $start, $end)
    {
        $stmt = $this->db->prepare("
            INSERT INTO phiendiemdanh(MaLHP, StrToken, ThoiGianBatDau, ThoiGianKetThuc)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("isss", $maLHP, $token, $start, $end);
        return $stmt->execute();
    }

    public function getSessionByToken($token)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM phiendiemdanh WHERE StrToken = ?
        ");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // kiểm tra sinh viên thuộc lớp
    public function checkStudentInClass($mssv, $maLHP)
    {
        $stmt = $this->db->prepare("
            SELECT s.MSSV
            FROM student s
            JOIN lophp l ON l.MaLHP = ?
            WHERE s.MSSV = ?
        ");
        $stmt->bind_param("ii", $maLHP, $mssv);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    // Kiểm tra đã điểm danh
    public function isCheckedIn($mssv, $maPhien)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM lichsudiemdanh
            WHERE MSSV = ? AND MaPhien = ?
        ");
        $stmt->bind_param("ii", $mssv, $maPhien);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    // Lưu điểm danh
    public function saveAttendance($mssv, $maPhien, $time, $location)
    {
        $stmt = $this->db->prepare("
            INSERT INTO lichsudiemdanh(MSSV, MaPhien, ThoiGian, ViTri)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("iiss", $mssv, $maPhien, $time, $location);
        return $stmt->execute();
    }

    public function getClassesByTeacher($maGV)
    {
        $stmt = $this->db->prepare("
            SELECT MaLHP, MaMonHoc
            FROM lophp
            WHERE MaGV = ?
        ");
        $stmt->bind_param("i", $maGV);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function getSessionsByTeacher($maGV)
    {
        $stmt = $this->db->prepare("
            SELECT p.MaPhien, p.MaLHP,l.MaMonHoc,
                p.StrToken, p.ThoiGianBatDau, p.ThoiGianKetThuc
            FROM phiendiemdanh p
            JOIN lophp l ON p.MaLHP = l.MaLHP
            WHERE l.MaGV = ?
            ORDER BY p.MaPhien DESC
        ");
        $stmt->bind_param("i", $maGV);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function closeSession($maPhien)
    {
        $stmt = $this->db->prepare("
            UPDATE phiendiemdanh
            SET ThoiGianKetThuc = NOW()
            WHERE MaPhien = ?
        ");
        $stmt->bind_param("i", $maPhien);
        return $stmt->execute();
    }
    public function isSessionValid($token)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM phiendiemdanh
            WHERE StrToken = ?
            AND NOW() BETWEEN ThoiGianBatDau AND ThoiGianKetThuc
        ");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}
