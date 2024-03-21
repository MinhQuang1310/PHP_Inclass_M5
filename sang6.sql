-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 16, 2024 lúc 01:56 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sang6`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Xe Kia Soluto 1.4 AT Deluxe 2023', 'Bán Kia Soluto Deluxe 1.4AT 2023, biển 30Kxx, TN 1 chủ sử dụng, đẹp xuất sắc, odo-> 1.1 vạn km, miễn bàn chất lượng', 919000000, NULL),
(2, 'Xe Mitsubishi Triton 4x4 AT Mivec 2017', '✓Hỗ trợ vay ngân hàng lãi suất ưu đãi. ✓Bảo hành 6 tháng hoặc 10.000km động cơ, máy móc. ✓Bảo dưỡng thay nhớt một lần miễn phí trước khi giao xe. ✓Hỗ trợ test hãng có văn bản', 599, NULL),
(3, 'Xe Mazda CX5 Premium 2.0 AT 2022', 'Xe Mazda CX5 Premium 2.0 AT 2022', 999, 'uploads/m_1709473019.509.jpg'),
(4, 'Xe BMW 5 Series 528i GT 2014', 'BMW 528i GT sx 2014 Trắng/Kem, tư nhân sd lăn bánh hơn 7v miles rất đẹp. Cam kết xe không đâm đụng , không ngập nước , máy móc nguyên bản Có hỗ trợ thủ tục vay ngân hàng trả góp Có bao test xe check hãng', 999, 'uploads/m_1709175548.745.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
