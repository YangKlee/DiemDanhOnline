<?php
require_once __DIR__ . '/BaseController.php';

class AttendanceController extends BaseController
{
    private PDO $pdo;

    public function __construct(PDO $db)
    {
        $this->pdo = $db;
    }

    /* =====================================================
       GIẢNG VIÊN TẠO PHIÊN ĐIỂM DANH
       API: POST /Attendance/CreateSession
       TABLE: phiendiemdanh
    ===================================================== */
   public function createSession()
{
    header('Content-Type: application/json; charset=utf-8');

    if (!isset($_SESSION['UID'])) {
        echo json_encode(['error' => 'Chưa đăng nhập']);
        exit;
    }

    $maLHP   = $_POST['MaLHP'] ?? null;
    $batDau  = $_POST['ThoiGianBatDau'] ?? null;
    $ketThuc = $_POST['ThoiGianKetThuc'] ?? null;

    if (!$maLHP || !$batDau || !$ketThuc) {
        echo json_encode(['error' => 'Thiếu dữ liệu']);
        exit;
    }

    $token = 'QR-' . $maLHP . '-' . time();

    $stmt = $this->pdo->prepare("
        INSERT INTO phiendiemdanh
        (MaLHP, StrToken, ThoiGianBatDau, ThoiGianKetThuc)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$maLHP, $token, $batDau, $ketThuc]);

    echo json_encode([
        'maPhien' => $this->pdo->lastInsertId(),
        'maLHP'   => $maLHP,
        'token'   => $token,
        'batDau'  => $batDau,
        'ketThuc' => $ketThuc
    ]);
    exit; // 🔥 BẮT BUỘC
}

    /* =====================================================
       SINH VIÊN QUÉT QR ĐIỂM DANH
       API: POST /Attendance/ScanQR
       TABLE: lichsudiemdanh
    ===================================================== */
    public function scanQR()
    {
        header('Content-Type: application/json; charset=utf-8');

        $data  = json_decode(file_get_contents("php://input"), true);
        $token = $data['Token'] ?? null;
        $mssv  = $data['MSSV'] ?? null;
        $viTri = $data['ViTri'] ?? null;

        if (!$token || !$mssv) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Thiếu Token hoặc MSSV'
            ]);
            return;
        }

        try {
            /* =============================
               1. LẤY PHIÊN ĐIỂM DANH
            ============================= */
            $stmt = $this->pdo->prepare("
                SELECT MaPhien, MaLHP, ThoiGianBatDau, ThoiGianKetThuc
                FROM phiendiemdanh
                WHERE StrToken = ?
            ");
            $stmt->execute([$token]);
            $phien = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$phien) {
                http_response_code(404);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'QR không hợp lệ'
                ]);
                return;
            }

            /* =============================
               2. KIỂM TRA THỜI GIAN
            ============================= */
            $now = date('Y-m-d H:i:s');
            if ($now < $phien['ThoiGianBatDau'] || $now > $phien['ThoiGianKetThuc']) {
                http_response_code(403);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Phiên điểm danh đã đóng'
                ]);
                return;
            }

            /* =============================
               3. KIỂM TRA SINH VIÊN ĐĂNG KÝ LỚP
               (KHỚP 100% SCHEMA – KHÔNG TrangThai)
            ============================= */
            $stmt = $this->pdo->prepare("
                SELECT 1
                FROM dangkyhocphan
                WHERE MSSV = ? AND MaLHP = ?
            ");
            $stmt->execute([$mssv, $phien['MaLHP']]);

            if (!$stmt->fetchColumn()) {
                http_response_code(403);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Sinh viên không đăng ký lớp học phần'
                ]);
                return;
            }

            /* =============================
               4. GHI LỊCH SỬ ĐIỂM DANH
               (PK: MSSV + MaPhien)
            ============================= */
            $stmt = $this->pdo->prepare("
                INSERT INTO lichsudiemdanh (MSSV, MaPhien, ThoiGian, ViTri)
                VALUES (?, ?, NOW(), ?)
                ON DUPLICATE KEY UPDATE
                    ThoiGian = NOW(),
                    ViTri = VALUES(ViTri)
            ");
            $stmt->execute([$mssv, $phien['MaPhien'], $viTri]);

            echo json_encode([
                'status'   => 'success',
                'message'  => 'Điểm danh thành công',
                'MSSV'     => $mssv,
                'MaPhien'  => $phien['MaPhien'],
                'ThoiGian' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Lỗi hệ thống',
                'detail'  => $e->getMessage()
            ]);
        }
    }
}
