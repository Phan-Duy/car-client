-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 09, 2024 lúc 05:20 AM
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
-- Cơ sở dữ liệu: `ltw_db_car`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `yearOfProduction` int(11) DEFAULT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `car`
--

INSERT INTO `car` (`id`, `name`, `thumbnail`, `brand`, `color`, `price`, `yearOfProduction`, `description`) VALUES
(29, 'Mitsubishi Xpander Cross', '6580700640023.jpg', 'Mitsubishi', 'Đen', 698000000, 2023, 'Mitsubishi Xpander Cross 2021 sở hữu ngoại hình đậm chất SUV nhưng mạnh mẽ và khỏe khoắn hơn. '),
(30, 'Honda City', '658070ed56b86.jpg', ' Honda', 'Bạc', 559000000, 2023, 'Honda City 2021 sở hữu thiết kế ấn tượng từ phiên bản G, RS đến phiên bản thể thao đều trông rất đẹp. '),
(31, 'Ford Focus hatchback', '658071458664e.jpg', 'Ford', 'Cam', 770000000, 2021, 'Ngoại hình nhỏ gọn\r\nĐược đổi mới ngoại hình mạnh mẽ và bề thế hơn\r\nKhoang nội thất trang bị nhiều chi tiết đắt giá và sang trọng'),
(32, 'Suzuki Celerio', '658071a29c0e5.jpg', 'Suzuk', 'Xanh dương', 329000000, 2021, 'Kiểu dáng nhỏ gọn, dễ dàng di chuyển.\r\nTrang bị nhiều công nghệ an ninh an toàn hiện đại.\r\nMức giá bán khá rẻ.'),
(33, 'Kia Sonet', '658072195e987.jpg', 'Kia', 'Vàng sáng', 396000000, 2021, 'Điểm nhấn đầu tiên của KIA Sonet chính là sở hữu thiết kế hiện đại, thể thao. '),
(34, 'VinFast VF 5', '658072d973e6f.jpg', 'VinFast', 'Trắng', 458000000, 2023, 'VF 5 là mẫu xe điện nhỏ nhất của VinFast, nằm ở phân khúc A+, nơi có những Kia Sonet, Toyota Raize.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `fullName` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `birthDay` date DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullName`, `address`, `email`, `birthDay`, `role`) VALUES
(10, 'LionHeart', '$2y$10$E48MJD6WinF6Y2.r0fomDOX3HUFsqA2rGAWe.Zmc.kg8C5/qWobpu', 'Bùi Công Duy', '527/20 Điện Biên Phủ', 'buicongduy@gmail.com', '2003-07-02', 'admin'),
(11, 'Diệp ', '$2y$10$xfccJxHrFOdzQ6l/46JT9OfNaPE2Gg/2RY55sgOJ5pLWzbw6bw3kO', 'Điệp Đại Minh', '36/59 Nguyễn Gia Trí', 'minhdiep@gmail.com', '2023-12-27', 'customer'),
(12, 'DuyPhan', '$2y$10$H8eTO2TpWl5Yw4V7vzTc0OqVO5ZUATfySvxro5HwCeX7xZUxjygPi', 'Phan Trường Duy', '20 võ oanh', 'duyphan12@gmail.com', '2023-12-08', 'admin'),
(13, 'NamNguyen', '$2y$10$z1or93TAqVZ/Jqv.rnbMO.F5mFNfd/K4OedD0X3MgNKNDmGBdj/sC', 'Nguyễn Phương Nam', '36/59 Nguyễn Gia Trí', 'nhuongluu@gmail.com', '2023-12-14', 'customer'),
(14, 'An', '$2y$10$/N9qoHBVf6VZUUcp0XJwSu.DXzOhflIS.jELAm2idIMm3mkmQzdRW', 'Trịnh Duy An', '20 võ oanh', 'an1@gmail.com', '2023-12-01', 'customer'),
(20, 'Duy', '$2y$10$bihDauouGKyVVEWvDudl8eWrggsyJLxsoBSOFDvx8qLaTpK63ha.6', 'Bùi Công Duy', '02/230', '21H1120035@ut.edu.vn', '2023-12-16', 'customer'),
(21, 'abcxyz', '$2y$10$gt.xypcavMV5x0hkGaoh9OGqIh1oFkRgp4QVK7Ea1dk/5CqP.jnUi', 'Nguyễn Văn A', '453 Kha Vạn Cân', 'xuongnui123km@gmail.com', '2003-01-01', 'customer'),
(22, 'congduy', '$2y$10$lX5UjLH1MWSxbVof6MotGu9zpvVh2mxgvRSjSuLgY.YwkmrQTybAq', 'Bùi Công Duy', '453 Kha Vạn Cân', 'duy@gmail.com', '2023-12-16', 'customer');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
