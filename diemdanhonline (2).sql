-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 25, 2025 lúc 03:45 AM
-- Phiên bản máy phục vụ: 9.1.0
-- Phiên bản PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `diemdanhonline`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `UserID` int NOT NULL,
  `Ho` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ten` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CCCD` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoDT` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaChi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` enum('Nam','Nữ') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MatKhau` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AuthToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Role` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `CCCD` (`CCCD`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`UserID`, `Ho`, `Ten`, `CCCD`, `SoDT`, `Email`, `DiaChi`, `NgaySinh`, `GioiTinh`, `MatKhau`, `AuthToken`, `Role`) VALUES
(0, 'Nguyễn Thị', 'Tuyết', '052205006222', '0356701052', 'xxx@xxx.com', 'xxx', '2021-11-11', 'Nam', '', NULL, '2'),
(8000, 'Trần Đình', 'Luyện', '023456789012', '0909111111', 'luyen.gv@school.com', 'Quy Nhon', '1985-05-12', 'Nam', 'teacher123', NULL, '2'),
(8001, 'Lê Thị', 'Hương', '034567890123', '0909222233', 'huong.gv@school.com', 'Tuy Phước', '1988-08-20', 'Nữ', 'teacher123', NULL, '2'),
(8002, 'Phạm Văn', 'Khoa', '045678901234', '0909333344', 'khoa.gv@school.com', 'An Nhơn', '1983-03-16', 'Nam', 'teacher123', NULL, '2'),
(8003, 'Trần Minh', 'Tuấn', '055678901234', '0909778899', 'tuan.gv@school.com', 'Quy Nhơn', '1986-11-10', 'Nam', 'teacher123', NULL, '2'),
(9000, 'Han', 'Sara', '012345678901', '0909000000', 'admin@system.com', 'Quy Nhon', '2000-11-17', 'Nữ', 'admin123', NULL, '3'),
(9999, 'Nguyễn Yến', 'Dương', '052205002222', '0356701052', 'abc@b.com', 'ssss', '2005-07-18', 'Nam', '9999', NULL, '1'),
(465000, 'Nguyễn Thị', 'Lan', '056789012345', '0909444455', 'lan.sv@school.com', 'Quy Nhơn', '2003-04-15', 'Nữ', 'student123', NULL, '1'),
(465001, 'Võ Minh', 'Phúc', '067890123456', '0909555566', 'phuc.sv@school.com', 'Tuy Phước', '2002-09-25', 'Nam', 'student123', NULL, '1'),
(465002, 'Trần Quốc', 'Huy', '078901234567', '0909666677', 'huy.sv@school.com', 'Phù Cát', '2004-02-10', 'Nam', 'student123', NULL, '1'),
(465004, 'Lê Công', 'Phong', '090123456789', '0909888899', 'phong.sv@school.com', 'An Nhơn', '2002-11-28', 'Nam', 'student123', NULL, '1'),
(465005, 'Đỗ Ngọc', 'Nga', '101234567890', '0909001122', 'nga.sv@school.com', 'Hoài Ân', '2003-12-01', 'Nữ', 'student123', NULL, '1'),
(465006, 'Nguyễn Văn', 'Quý', '112345678901', '0909002233', 'quy.sv@school.com', 'Hoài Nhơn', '2004-01-19', 'Nam', 'student123', NULL, '1'),
(465007, 'Phạm Thị', 'Tuyền', '123456789012', '0909003344', 'tuyen.sv@school.com', 'Quy Nhơn', '2003-06-06', 'Nữ', 'student123', NULL, '1'),
(465008, 'Võ Hoàng', 'An', '134567890123', '0909004455', 'anvo.sv@school.com', 'Phù Mỹ', '2002-03-12', 'Nam', 'student123', NULL, '1'),
(465009, 'Trần Thúy', 'Yên', '145678901234', '0909005566', 'yen.sv@school.com', 'Tuy Phước', '2003-10-30', 'Nữ', 'student123', NULL, '1'),
(465010, 'Hoàng Gia', 'Bảo', '156789012345', '0909006677', 'bao.sv@school.com', 'Quy Nhơn', '2004-08-08', 'Nam', 'student123', NULL, '1'),
(465144, 'Nguyễn Khánh', 'Dương', '052205006411', '0356701052', 'yang@gmail.com', 'xxxx', '2005-07-18', 'Nam', '465144', NULL, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachlhp`
--

DROP TABLE IF EXISTS `danhsachlhp`;
CREATE TABLE IF NOT EXISTS `danhsachlhp` (
  `MaLHP` int NOT NULL,
  `MSSV` int NOT NULL,
  PRIMARY KEY (`MaLHP`,`MSSV`),
  KEY `MSSV` (`MSSV`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachlhp`
--

INSERT INTO `danhsachlhp` (`MaLHP`, `MSSV`) VALUES
(2, 465005),
(2, 465008);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

DROP TABLE IF EXISTS `giangvien`;
CREATE TABLE IF NOT EXISTS `giangvien` (
  `MaGV` int NOT NULL,
  `MaKhoa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaGV`),
  KEY `MaKhoa` (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`MaGV`, `MaKhoa`) VALUES
(8002, 'CK'),
(8000, 'CNTT'),
(8001, 'NN'),
(8003, 'QTKD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

DROP TABLE IF EXISTS `hocky`;
CREATE TABLE IF NOT EXISTS `hocky` (
  `MaHK` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenHK` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ThoiGianBatDau` date DEFAULT NULL,
  `ThoiGianKetThuc` date DEFAULT NULL,
  PRIMARY KEY (`MaHK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`MaHK`, `TenHK`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
('HK1-2024-2', 'Học kỳ 1 năm học 2024-2025 1', '2025-09-01', '2025-01-31'),
('HK231', 'Học kỳ 1 năm học 2023 - 2024', '2023-08-15', '2023-12-30'),
('HK232', 'Học kỳ 2 năm học 2023 - 2024', '2024-01-10', '2024-05-25'),
('HK23H', 'Học kỳ Hè năm 2024', '2024-06-05', '2024-07-30'),
('HK241', 'Học kỳ 1 năm học 2024 - 2025', '2024-08-15', '2024-12-30'),
('HK242', 'Học kỳ 2 năm học 2024 - 2025', '2025-01-08', '2025-05-20'),
('HK24H', 'Học kỳ Hè năm 2025', '2025-06-05', '2025-07-30'),
('HK25_1', 'Học kỳ 1 năm học 2025 - 2026 1', '2025-08-15', '2025-12-30'),
('HK25_2', 'Học kỳ 2 năm học 2025 - 2026', '2026-01-05', '2026-05-25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

DROP TABLE IF EXISTS `khoa`;
CREATE TABLE IF NOT EXISTS `khoa` (
  `MaKhoa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenKhoa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
('as', 'a'),
('CK', 'Cơ khí'),
('CNTT', 'Công nghệ Thông tin'),
('DL', 'Du lịch'),
('DTVT', 'Điện tử Viễn thông'),
('HTTT', 'Hệ thống Thông tin1'),
('KT', 'Kế toán'),
('KTPM', 'Kỹ thuật Phần mềm'),
('MT', 'Môi trường'),
('NN', 'Ngôn ngữ Anh'),
('QTKD', 'Quản trị Kinh doanh'),
('SP', 'Sư phạm'),
('XD', 'Xây dựng'),
('xx', 's'),
('YH', 'Y học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichhoc`
--

DROP TABLE IF EXISTS `lichhoc`;
CREATE TABLE IF NOT EXISTS `lichhoc` (
  `MaLHP` int NOT NULL,
  `Tiet` int NOT NULL,
  `Thu` tinyint NOT NULL,
  `Phong` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaLHP`,`Tiet`,`Thu`),
  KEY `fk_lichhoc_tiet` (`Tiet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichhoc`
--

INSERT INTO `lichhoc` (`MaLHP`, `Tiet`, `Thu`, `Phong`) VALUES
(2, 1, 4, 'B202'),
(2, 2, 4, 'B202'),
(2, 3, 4, 'B202'),
(3, 3, 3, 'C303'),
(3, 4, 3, 'C303'),
(4, 1, 5, 'A201'),
(4, 2, 5, 'A201'),
(6, 4, 2, 'E101'),
(6, 5, 2, 'E101');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsudiemdanh`
--

DROP TABLE IF EXISTS `lichsudiemdanh`;
CREATE TABLE IF NOT EXISTS `lichsudiemdanh` (
  `MSSV` int NOT NULL,
  `MaPhien` int NOT NULL,
  `ThoiGian` datetime DEFAULT NULL,
  `ViTri` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MSSV`,`MaPhien`),
  KEY `MaPhien` (`MaPhien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsudiemdanh`
--

INSERT INTO `lichsudiemdanh` (`MSSV`, `MaPhien`, `ThoiGian`, `ViTri`) VALUES
(465008, 2, '2025-02-15 09:02:00', 'B202'),
(465009, 2, '2025-02-15 09:10:00', 'B202'),
(465010, 3, '2025-03-01 13:05:00', 'C303');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophp`
--

DROP TABLE IF EXISTS `lophp`;
CREATE TABLE IF NOT EXISTS `lophp` (
  `MaLHP` int NOT NULL,
  `MaMonHoc` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaGV` int DEFAULT NULL,
  `MaHK` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ThoiGianBatDau` date DEFAULT NULL,
  `ThoiGianKetThuc` date DEFAULT NULL,
  PRIMARY KEY (`MaLHP`),
  KEY `MaMonHoc` (`MaMonHoc`),
  KEY `MaGV` (`MaGV`),
  KEY `MaHK` (`MaHK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lophp`
--

INSERT INTO `lophp` (`MaLHP`, `MaMonHoc`, `MaGV`, `MaHK`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
(2, 'INT115', 8000, 'HK25_1', '2025-08-22', '2025-12-22'),
(3, 'INT220', 8003, 'HK25_1', '2025-08-25', '2025-12-18'),
(4, 'KTPM301', 8002, 'HK25_1', '2025-08-21', '2025-12-19'),
(5, 'NN201', 8001, 'HK25_1', '2025-08-23', '2025-12-17'),
(6, 'QTKD101', 8001, 'HK24H', '2025-08-24', '2025-12-20'),
(3333, 'INT220', 8000, 'HK242', '2222-02-22', '0322-02-12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lopsv`
--

DROP TABLE IF EXISTS `lopsv`;
CREATE TABLE IF NOT EXISTS `lopsv` (
  `MaLop` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenLop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaNganh` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaLop`),
  KEY `MaNganh` (`MaNganh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lopsv`
--

INSERT INTO `lopsv` (`MaLop`, `TenLop`, `MaNganh`) VALUES
('CNTT_K47', 'Lớp CNTT K47', 'CNTT01'),
('CNTT_K48', 'Lớp CNTT K48', 'CNTT01'),
('KTPM_K47', 'Lớp KTPM K47', 'KTPM01'),
('NN_K47', 'Lớp Ngôn ngữ Anh K47', 'NN01'),
('QTKD_K47', 'Lớp Quản trị Kinh doanh K47', 'QTKD01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

DROP TABLE IF EXISTS `monhoc`;
CREATE TABLE IF NOT EXISTS `monhoc` (
  `MaMonHoc` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenMonHoc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoTC` int DEFAULT NULL,
  `KhoaPhuTrach` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaMonHoc`),
  KEY `KhoaPhuTrach` (`KhoaPhuTrach`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`MaMonHoc`, `TenMonHoc`, `SoTC`, `KhoaPhuTrach`) VALUES
('INT115', 'Lập trình C++', 3, 'CNTT'),
('INT220', 'Cơ sở dữ liệu', 3, 'HTTT'),
('KTPM301', 'Thiết kế phần mềm', 3, 'KTPM'),
('NN201', 'Ngữ pháp tiếng Anh', 3, 'NN'),
('QTKD101', 'Quản trị học', 3, 'QTKD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

DROP TABLE IF EXISTS `nganh`;
CREATE TABLE IF NOT EXISTS `nganh` (
  `MaNganh` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenNganh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaKhoa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MaNganh`),
  KEY `MaKhoa` (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`MaNganh`, `TenNganh`, `MaKhoa`) VALUES
('CNTT01', 'Công nghệ Thông tin', 'CNTT'),
('HTTT01', 'Hệ thống Thông tin', 'HTTT'),
('KTPM01', 'Kỹ thuật Phần mềm', 'KTPM'),
('NN01', 'Ngôn ngữ Anh', 'NN'),
('QTKD01', 'Quản trị Kinh doanh', 'QTKD'),
('xx', 'xxx', 'DL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phiendiemdanh`
--

DROP TABLE IF EXISTS `phiendiemdanh`;
CREATE TABLE IF NOT EXISTS `phiendiemdanh` (
  `MaPhien` int NOT NULL AUTO_INCREMENT,
  `MaLHP` int DEFAULT NULL,
  `ThoiGian` datetime DEFAULT NULL,
  `StrToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ThoiGianBatDau` datetime DEFAULT NULL,
  `ThoiGianKetThuc` datetime DEFAULT NULL,
  PRIMARY KEY (`MaPhien`),
  KEY `MaLHP` (`MaLHP`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phiendiemdanh`
--

INSERT INTO `phiendiemdanh` (`MaPhien`, `MaLHP`, `ThoiGian`, `StrToken`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
(2, 2, '2025-02-15 09:00:00', 'XYZ789', '2025-02-15 09:00:00', '2025-02-15 09:15:00'),
(3, 3, '2025-03-01 13:00:00', 'QWE456', '2025-03-01 13:00:00', '2025-03-01 13:15:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `MSSV` int NOT NULL,
  `MaLop` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MSSV`),
  KEY `MaLop` (`MaLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`MSSV`, `MaLop`) VALUES
(9999, 'CNTT_K47'),
(465000, 'CNTT_K47'),
(465001, 'CNTT_K47'),
(465002, 'CNTT_K47'),
(465008, 'CNTT_K48'),
(465009, 'CNTT_K48'),
(465010, 'CNTT_K48'),
(465004, 'KTPM_K47'),
(465005, 'NN_K47'),
(465006, 'NN_K47'),
(465007, 'QTKD_K47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tiet`
--

DROP TABLE IF EXISTS `tiet`;
CREATE TABLE IF NOT EXISTS `tiet` (
  `MaTiet` int NOT NULL,
  `KhungTiet` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`MaTiet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tiet`
--

INSERT INTO `tiet` (`MaTiet`, `KhungTiet`) VALUES
(1, '1-2'),
(2, '3-5'),
(3, '6-7'),
(4, '8-10'),
(5, '10-11');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD CONSTRAINT `giangvien_ibfk_1` FOREIGN KEY (`MaGV`) REFERENCES `account` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `giangvien_ibfk_2` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  ADD CONSTRAINT `fk_lichhoc_tiet` FOREIGN KEY (`Tiet`) REFERENCES `tiet` (`MaTiet`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lichhoc_ibfk_1` FOREIGN KEY (`MaLHP`) REFERENCES `lophp` (`MaLHP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lichsudiemdanh`
--
ALTER TABLE `lichsudiemdanh`
  ADD CONSTRAINT `lichsudiemdanh_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `student` (`MSSV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lichsudiemdanh_ibfk_2` FOREIGN KEY (`MaPhien`) REFERENCES `phiendiemdanh` (`MaPhien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lophp`
--
ALTER TABLE `lophp`
  ADD CONSTRAINT `lophp_ibfk_1` FOREIGN KEY (`MaMonHoc`) REFERENCES `monhoc` (`MaMonHoc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lophp_ibfk_2` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lophp_ibfk_3` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lopsv`
--
ALTER TABLE `lopsv`
  ADD CONSTRAINT `lopsv_ibfk_1` FOREIGN KEY (`MaNganh`) REFERENCES `nganh` (`MaNganh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `monhoc_ibfk_1` FOREIGN KEY (`KhoaPhuTrach`) REFERENCES `khoa` (`MaKhoa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `nganh_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phiendiemdanh`
--
ALTER TABLE `phiendiemdanh`
  ADD CONSTRAINT `phiendiemdanh_ibfk_1` FOREIGN KEY (`MaLHP`) REFERENCES `lophp` (`MaLHP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `account` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`MaLop`) REFERENCES `lopsv` (`MaLop`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
