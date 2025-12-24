<?php 
    class MonHoc 
    {
        private $conn;
        public function __construct()
        {
            $this->conn = Database::getConnection();
        }

        public function getAllMonHoc()
        {
            $stmt = $this->conn->prepare("SELECT * FROM monhoc");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        public function getMonHocById($maMonHoc)
        {
            $stmt = $this->conn->prepare("SELECT * FROM monhoc WHERE MaMonHoc = ?");
            $stmt->bind_param("s", $maMonHoc);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        public function addMonHoc($maMonHoc, $tenMonHoc, $soTC, $khoaPhuTrach)
        {
            $stmt = $this->conn->prepare("INSERT INTO monhoc (MaMonHoc, TenMonHoc, SoTC, KhoaPhuTrach) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $maMonHoc, $tenMonHoc, $soTC, $khoaPhuTrach);
            return $stmt->execute();
        }
        public function updateMonHoc($maMonHoc, $tenMonHoc, $soTC, $khoaPhuTrach)
        {
            $stmt = $this->conn->prepare("UPDATE monhoc SET TenMonHoc = ?, SoTC = ?, KhoaPhuTrach = ? WHERE MaMonHoc = ?");
            $stmt->bind_param("siss", $tenMonHoc, $soTC, $khoaPhuTrach, $maMonHoc);
            return $stmt->execute();
        }
        public function deleteMonHoc($maMonHoc)
        {
            $stmt = $this->conn->prepare("DELETE FROM monhoc WHERE MaMonHoc = ?");
            $stmt->bind_param("s", $maMonHoc);
            return $stmt->execute();
        }
    }

?>