-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 15, 2025 lúc 05:21 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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

CREATE TABLE `account` (
  `UserID` int(11) NOT NULL,
  `Ho` varchar(50) DEFAULT NULL,
  `Ten` varchar(50) DEFAULT NULL,
  `CCCD` varchar(12) DEFAULT NULL,
  `SoDT` varchar(10) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` enum('Nam','Nữ') DEFAULT NULL,
  `MatKhau` varchar(255) DEFAULT NULL,
  `AuthToken` varchar(255) DEFAULT NULL,
  `Role` enum('1','2','3') NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`UserID`, `Ho`, `Ten`, `CCCD`, `SoDT`, `Email`, `DiaChi`, `NgaySinh`, `GioiTinh`, `MatKhau`, `AuthToken`, `Role`) VALUES
(8000, 'Trần', 'Đình Luyện', '', '0347252733', '', '', '1986-06-18', 'Nam', 'teacher123', NULL, '2'),
(8001, 'Lê Thị', 'Hương', '034567890123', '0909222233', 'huong.gv@school.com', 'Tuy Phước', '1988-08-20', 'Nữ', 'teacher123', NULL, '2'),
(8002, 'Phạm Văn', 'Khoa', '045678901234', '0909333344', 'khoa.gv@school.com', 'An Nhơn', '1983-03-16', 'Nam', 'teacher123', NULL, '2'),
(8003, 'Trần Minh', 'Tuấn', '055678901234', '0909778899', 'tuan.gv@school.com', 'Quy Nhơn', '1986-11-10', 'Nam', 'teacher123', NULL, '2'),
(9000, 'Han', 'Sara', '012345678901', '0909000000', 'admin@system.com', 'Quy Nhon', '2000-11-17', 'Nữ', 'admin123', NULL, '3'),
(465000, 'Nguyễn Thị', 'Lan', '056789012345', '0909444455', 'lan.sv@school.com', 'Quy Nhơn', '2003-04-15', 'Nữ', 'student123', NULL, '1'),
(465001, 'Võ Minh', 'Phúc', '067890123456', '0909555566', 'phuc.sv@school.com', 'Tuy Phước', '2002-09-25', 'Nam', 'student123', NULL, '1'),
(465002, 'Trần Quốc', 'Huy', '078901234567', '0909666677', 'huy.sv@school.com', 'Phù Cát', '2004-02-10', 'Nam', 'student123', NULL, '1'),
(465003, 'Hồ Mỹ', 'Dung', '089012345678', '0909777788', 'dung.sv@school.com', 'Quy Nhơn', '2003-07-05', 'Nữ', 'student123', NULL, '1'),
(465004, 'Lê Công', 'Phong', '090123456789', '0909888899', 'phong.sv@school.com', 'An Nhơn', '2002-11-28', 'Nam', 'student123', NULL, '1'),
(465005, 'Đỗ Ngọc', 'Nga', '101234567890', '0909001122', 'nga.sv@school.com', 'Hoài Ân', '2003-12-01', 'Nữ', 'student123', NULL, '1'),
(465006, 'Nguyễn Văn', 'Quý', '112345678901', '0909002233', 'quy.sv@school.com', 'Hoài Nhơn', '2004-01-19', 'Nam', 'student123', NULL, '1'),
(465007, 'Phạm Thị', 'Tuyền', '123456789012', '0909003344', 'tuyen.sv@school.com', 'Quy Nhơn', '2003-06-06', 'Nữ', 'student123', NULL, '1'),
(465008, 'Võ Hoàng', 'An', '134567890123', '0909004455', 'anvo.sv@school.com', 'Phù Mỹ', '2002-03-12', 'Nam', 'student123', NULL, '1'),
(465009, 'Trần Thúy', 'Yên', '145678901234', '0909005566', 'yen.sv@school.com', 'Tuy Phước', '2003-10-30', 'Nữ', 'student123', NULL, '1'),
(465010, 'Hoàng Gia', 'Bảo', '156789012345', '0909006677', 'bao.sv@school.com', 'Quy Nhơn', '2004-08-08', 'Nam', 'student123', NULL, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangkyhocphan`
--

CREATE TABLE `dangkyhocphan` (
  `MSSV` int(11) NOT NULL,
  `MaLHP` int(11) NOT NULL,
  `NgayDangKy` date DEFAULT curdate(),
  `TrangThai` enum('Hoc','Rut') DEFAULT 'Hoc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `dangkyhocphan`
--

INSERT INTO `dangkyhocphan` (`MSSV`, `MaLHP`, `NgayDangKy`, `TrangThai`) VALUES
(465000, 1, '2025-12-14', 'Hoc'),
(465000, 2, '2025-12-14', 'Hoc'),
(465001, 1, '2025-12-14', 'Hoc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `MaGV` int(11) NOT NULL,
  `MaKhoa` varchar(10) DEFAULT NULL
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

CREATE TABLE `hocky` (
  `MaHK` varchar(10) NOT NULL,
  `TenHK` varchar(100) DEFAULT NULL,
  `ThoiGianBatDau` date DEFAULT NULL,
  `ThoiGianKetThuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`MaHK`, `TenHK`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
('HK231', 'Học kỳ 1 năm học 2023 - 2024', '2023-08-15', '2023-12-30'),
('HK232', 'Học kỳ 2 năm học 2023 - 2024', '2024-01-10', '2024-05-25'),
('HK23H', 'Học kỳ Hè năm 2024', '2024-06-05', '2024-07-30'),
('HK241', 'Học kỳ 1 năm học 2024 - 2025', '2024-08-15', '2024-12-30'),
('HK242', 'Học kỳ 2 năm học 2024 - 2025', '2025-01-08', '2025-05-20'),
('HK24H', 'Học kỳ Hè năm 2025', '2025-06-05', '2025-07-30'),
('HK25_1', 'Học kỳ 1 năm học 2025 - 2026', '2025-08-15', '2025-12-30'),
('HK25_2', 'Học kỳ 2 năm học 2025 - 2026', '2026-01-05', '2026-05-25'),
('HK25_HE', 'Học kỳ Hè năm học 2025 - 2026', '2026-06-05', '2026-07-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

CREATE TABLE `khoa` (
  `MaKhoa` varchar(10) NOT NULL,
  `TenKhoa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
('CK', 'Cơ khí'),
('CNTT', 'Công nghệ Thông tin'),
('DL', 'Du lịch'),
('DTVT', 'Điện tử Viễn thông'),
('HTTT', 'Hệ thống Thông tin'),
('KT', 'Kế toán'),
('KTPM', 'Kỹ thuật Phần mềm'),
('MT', 'Môi trường'),
('NN', 'Ngôn ngữ Anh'),
('QTKD', 'Quản trị Kinh doanh'),
('SP', 'Sư phạm'),
('XD', 'Xây dựng'),
('YH', 'Y học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichhoc`
--

CREATE TABLE `lichhoc` (
  `MaLHP` int(11) NOT NULL,
  `Tiet` int(11) NOT NULL,
  `Thu` tinyint(4) NOT NULL,
  `Phong` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichhoc`
--

INSERT INTO `lichhoc` (`MaLHP`, `Tiet`, `Thu`, `Phong`) VALUES
(1, 1, 2, 'A101'),
(1, 2, 2, 'A101'),
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

CREATE TABLE `lichsudiemdanh` (
  `MSSV` int(11) NOT NULL,
  `MaPhien` int(11) NOT NULL,
  `ThoiGian` datetime DEFAULT NULL,
  `ViTri` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsudiemdanh`
--

INSERT INTO `lichsudiemdanh` (`MSSV`, `MaPhien`, `ThoiGian`, `ViTri`) VALUES
(465000, 1, '2024-09-05 07:03:00', 'A101'),
(465001, 1, '2024-09-05 07:05:00', 'A101'),
(465008, 2, '2025-02-15 09:02:00', 'B202'),
(465009, 2, '2025-02-15 09:10:00', 'B202'),
(465010, 3, '2025-03-01 13:05:00', 'C303');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophp`
--

CREATE TABLE `lophp` (
  `MaLHP` int(11) NOT NULL,
  `MaMonHoc` varchar(10) DEFAULT NULL,
  `MaGV` int(11) DEFAULT NULL,
  `MaHK` varchar(10) DEFAULT NULL,
  `ThoiGianBatDau` date DEFAULT NULL,
  `ThoiGianKetThuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lophp`
--

INSERT INTO `lophp` (`MaLHP`, `MaMonHoc`, `MaGV`, `MaHK`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
(1, 'INT101', 8000, 'HK25_1', '2025-08-20', '2025-12-20'),
(2, 'INT115', 8000, 'HK25_1', '2025-08-22', '2025-12-22'),
(3, 'INT220', 8003, 'HK25_1', '2025-08-25', '2025-12-18'),
(4, 'KTPM301', 8002, 'HK25_1', '2025-08-21', '2025-12-19'),
(5, 'NN201', 8001, 'HK25_1', '2025-08-23', '2025-12-17'),
(6, 'QTKD101', 8003, 'HK25_1', '2025-08-24', '2025-12-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lopsv`
--

CREATE TABLE `lopsv` (
  `MaLop` varchar(10) NOT NULL,
  `TenLop` varchar(255) DEFAULT NULL,
  `MaNganh` varchar(10) DEFAULT NULL
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

CREATE TABLE `monhoc` (
  `MaMonHoc` varchar(10) NOT NULL,
  `TenMonHoc` varchar(100) DEFAULT NULL,
  `SoTC` int(11) DEFAULT NULL,
  `KhoaPhuTrach` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`MaMonHoc`, `TenMonHoc`, `SoTC`, `KhoaPhuTrach`) VALUES
('INT101', 'Nhập môn CNTT', 3, 'CNTT'),
('INT115', 'Lập trình C++', 3, 'CNTT'),
('INT220', 'Cơ sở dữ liệu', 3, 'HTTT'),
('KTPM301', 'Thiết kế phần mềm', 3, 'KTPM'),
('NN201', 'Ngữ pháp tiếng Anh', 3, 'NN'),
('QTKD101', 'Quản trị học', 3, 'QTKD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

CREATE TABLE `nganh` (
  `MaNganh` varchar(10) NOT NULL,
  `TenNganh` varchar(255) NOT NULL,
  `MaKhoa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`MaNganh`, `TenNganh`, `MaKhoa`) VALUES
('CK01', 'Cơ khí Chế tạo', 'CK'),
('CNTT01', 'Công nghệ Thông tin', 'CNTT'),
('HTTT01', 'Hệ thống Thông tin', 'HTTT'),
('KTPM01', 'Kỹ thuật Phần mềm', 'KTPM'),
('NN01', 'Ngôn ngữ Anh', 'NN'),
('QTKD01', 'Quản trị Kinh doanh', 'QTKD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phiendiemdanh`
--

CREATE TABLE `phiendiemdanh` (
  `MaPhien` int(11) NOT NULL,
  `MaLHP` int(11) DEFAULT NULL,
  `ThoiGian` datetime DEFAULT NULL,
  `StrToken` varchar(255) DEFAULT NULL,
  `ThoiGianBatDau` datetime DEFAULT NULL,
  `ThoiGianKetThuc` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phiendiemdanh`
--

INSERT INTO `phiendiemdanh` (`MaPhien`, `MaLHP`, `ThoiGian`, `StrToken`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
(1, 1, '2024-09-05 07:00:00', 'ABC123', '2024-09-05 07:00:00', '2024-09-05 07:15:00'),
(2, 2, '2025-02-15 09:00:00', 'XYZ789', '2025-02-15 09:00:00', '2025-02-15 09:15:00'),
(3, 3, '2025-03-01 13:00:00', 'QWE456', '2025-03-01 13:00:00', '2025-03-01 13:15:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `MSSV` int(11) NOT NULL,
  `MaLop` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`MSSV`, `MaLop`) VALUES
(465000, 'CNTT_K47'),
(465001, 'CNTT_K47'),
(465002, 'CNTT_K47'),
(465008, 'CNTT_K48'),
(465009, 'CNTT_K48'),
(465010, 'CNTT_K48'),
(465003, 'KTPM_K47'),
(465004, 'KTPM_K47'),
(465005, 'NN_K47'),
(465006, 'NN_K47'),
(465007, 'QTKD_K47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tiet`
--

CREATE TABLE `tiet` (
  `MaTiet` int(11) NOT NULL,
  `KhungTiet` varchar(20) DEFAULT NULL
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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `CCCD` (`CCCD`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `dangkyhocphan`
--
ALTER TABLE `dangkyhocphan`
  ADD PRIMARY KEY (`MSSV`,`MaLHP`),
  ADD KEY `fk_dk_lhp` (`MaLHP`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MaGV`),
  ADD KEY `MaKhoa` (`MaKhoa`);

--
-- Chỉ mục cho bảng `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`MaHK`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MaKhoa`);

--
-- Chỉ mục cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  ADD PRIMARY KEY (`MaLHP`,`Tiet`,`Thu`),
  ADD KEY `fk_lichhoc_tiet` (`Tiet`);

--
-- Chỉ mục cho bảng `lichsudiemdanh`
--
ALTER TABLE `lichsudiemdanh`
  ADD PRIMARY KEY (`MSSV`,`MaPhien`),
  ADD KEY `MaPhien` (`MaPhien`);

--
-- Chỉ mục cho bảng `lophp`
--
ALTER TABLE `lophp`
  ADD PRIMARY KEY (`MaLHP`),
  ADD KEY `MaMonHoc` (`MaMonHoc`),
  ADD KEY `MaGV` (`MaGV`),
  ADD KEY `MaHK` (`MaHK`);

--
-- Chỉ mục cho bảng `lopsv`
--
ALTER TABLE `lopsv`
  ADD PRIMARY KEY (`MaLop`),
  ADD KEY `MaNganh` (`MaNganh`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaMonHoc`),
  ADD KEY `KhoaPhuTrach` (`KhoaPhuTrach`);

--
-- Chỉ mục cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`MaNganh`),
  ADD KEY `MaKhoa` (`MaKhoa`);

--
-- Chỉ mục cho bảng `phiendiemdanh`
--
ALTER TABLE `phiendiemdanh`
  ADD PRIMARY KEY (`MaPhien`),
  ADD KEY `MaLHP` (`MaLHP`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`MSSV`),
  ADD KEY `MaLop` (`MaLop`);

--
-- Chỉ mục cho bảng `tiet`
--
ALTER TABLE `tiet`
  ADD PRIMARY KEY (`MaTiet`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `phiendiemdanh`
--
ALTER TABLE `phiendiemdanh`
  MODIFY `MaPhien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dangkyhocphan`
--
ALTER TABLE `dangkyhocphan`
  ADD CONSTRAINT `fk_dk_lhp` FOREIGN KEY (`MaLHP`) REFERENCES `lophp` (`MaLHP`),
  ADD CONSTRAINT `fk_dk_sv` FOREIGN KEY (`MSSV`) REFERENCES `student` (`MSSV`);

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
