-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Nov-2021 às 19:38
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `marketplace`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount_frete` decimal(11,2) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Kitchen', 'category-one.jpg'),
(2, 'Bedroom', 'category-two.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `duration` date DEFAULT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `coupons`
--

INSERT INTO `coupons` (`id`, `shop_id`, `code`, `discount`, `duration`, `created`) VALUES
(2, 1, 'raianedev_coupon', '10', '2021-11-07', '2021-11-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_payment`
--

CREATE TABLE `info_payment` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `ref_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `info_payment`
--

INSERT INTO `info_payment` (`id`, `vendor_id`, `ref_id`, `email`, `token`) VALUES
(99, 1, 'acct_1JsSePQccvEZXgWK', 'raiane.dev@gmail.com', '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');

-- --------------------------------------------------------

--
-- Estrutura da tabela `method_payment`
--

CREATE TABLE `method_payment` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `ref_id` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_exp_month` int(11) NOT NULL,
  `card_exp_year` int(11) NOT NULL,
  `card_cvc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `method_payment`
--

INSERT INTO `method_payment` (`id`, `user_id`, `ref_id`, `card_number`, `card_exp_month`, `card_exp_year`, `card_cvc`) VALUES
(2, '1', 'cus_KYpFmuOtNo73W8', '4242424242424242', 10, 28, 123);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ref_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `products_id` varchar(255) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `ref_id`, `user_id`, `vendor_id`, `products_id`, `amount`, `city`, `address`) VALUES
(7, 'pi_3JsbXAHUgQFXPmU51GOlMmiU', '1', '2', '1, 2, 2', '550762.00', 'Mostardas', 'Rua Getúlio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `images` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `colors` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `length` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `shop_id`, `category_id`, `name`, `description`, `price`, `images`, `stock`, `colors`, `weight`, `width`, `height`, `length`) VALUES
(1, 1, 1, 'Modern Clock', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '300.00', 'Product-one.webp', 4, 'yellow', 15, 15, 15, 30),
(2, 2, 0, 'Simple Comfort', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '50000.00', 'Product-two.webp', 3, 'green, red', 15, 15, 15, 30),
(3, 2, 0, 'Beige Chair', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1000.00', 'Product-three.webp', 0, 'brown', 0, 0, 0, 0),
(4, 1, 0, 'Table Decoration', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '900.00', 'Product-four.webp', 0, 'purple', 0, 0, 0, 0),
(5, 1, 0, 'Art-Deco Lamp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '100.00', 'Product-five.webp', 0, 'orange', 0, 0, 0, 0),
(6, 1, 0, 'Leather Chair', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1200.00', 'Product-six.webp', 0, 'blue', 0, 0, 0, 0),
(7, 2, 0, 'New Dining Table', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '10000.00', 'Product-seven.webp', 0, 'wine', 0, 0, 0, 0),
(8, 2, 0, 'White Sofa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '550.00', 'Product-eight.webp', 0, 'green', 0, 0, 0, 0),
(9, 1, 0, 'ORIGAMI LAMPS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, seddo eiusmod tempor. incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliqui ex ea commodo consequat. Duis aute irure dolor in reprehenderit in elit.', '220.00', 'Product-nine.jpg', 0, 'grey', 30, 50, 60, 100),
(10, 1, 1, 'Lorem ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '0.00', 'furniture-one.jpg', 1, 'red', 15, 15, 15, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ratings`
--

INSERT INTO `ratings` (`id`, `shop_id`, `user_id`, `product_id`, `stars`, `feedback`) VALUES
(1, 1, 1, 1, 5, 'Aenean commodo ligula eget dolor.'),
(2, 2, 2, 2, 4, 'Lorem ipsum dolor amet!'),
(3, 1, 2, 2, 3, 'Quis nostrud exercitation ullamco laboris nisi ut aliqui ex ea commodo consequat. Duis aute irure dolor in reprehenderit in elit.'),
(4, 2, 1, 10, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `shop`
--

INSERT INTO `shop` (`id`, `vendor_id`, `name`, `description`, `image`, `slug`) VALUES
(1, 1, 'Custom-made forniture', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'shop-two.jpg', 'custom-made-forniture'),
(2, 2, 'Clothing Home', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'shop-one.jpg', 'clothing-home');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shop_info`
--

CREATE TABLE `shop_info` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `shop_info`
--

INSERT INTO `shop_info` (`id`, `shop_id`, `cnpj`, `phone`, `email`) VALUES
(1, 1, '00.000.000/0000-00', '55 999999999', 'shop@gmail.com'),
(2, 2, '00.000.000/0000-00', '11 999999999', 'clothing@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shop_policies`
--

CREATE TABLE `shop_policies` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `privacy_policy` text NOT NULL,
  `shipping_policy` text NOT NULL,
  `refund_policy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `shop_policies`
--

INSERT INTO `shop_policies` (`id`, `shop_id`, `privacy_policy`, `shipping_policy`, `refund_policy`) VALUES
(1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\n'),
(2, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shop_schedules`
--

CREATE TABLE `shop_schedules` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `open_since` time NOT NULL,
  `close_until` time NOT NULL,
  `days_week` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `shop_schedules`
--

INSERT INTO `shop_schedules` (`id`, `shop_id`, `open_since`, `close_until`, `days_week`) VALUES
(1, 1, '08:00:00', '18:00:00', 'Monday to Friday'),
(2, 2, '09:00:00', '12:00:00', 'Monday to Monday');

-- --------------------------------------------------------

--
-- Estrutura da tabela `showroom`
--

CREATE TABLE `showroom` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `showroom`
--

INSERT INTO `showroom` (`id`, `shop_id`, `name`, `image`) VALUES
(1, 1, 'Bedroom SC', 'banner-one.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `lat_coord` varchar(255) NOT NULL,
  `long_coord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `function`, `cep`, `lat_coord`, `long_coord`) VALUES
(1, 'Raiane Dev', 'raiane.dev@gmail.com', 'raiane', 'amanda-doe.jpg', 'Admin', '96270000', '-31.0998743', '-50.913485'),
(2, 'User vendor', 'user.vendor@gmail.com', 'uservendor', '', 'Vendor', '96010140', '-50.913485', '-31.0998743'),
(3, 'John Doe', 'john.doe@gmail.com', 'johndoe', '', 'Client', '', '', ''),
(4, 'Amanda Doelc', 'amanda.doelc@gmail.com', 'amandadoelc', '', 'Client', '', '', ''),
(5, 'Harry Henry', 'harry.henry@gmail.com', 'harryhenry', '', 'Vendor', '', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `info_payment`
--
ALTER TABLE `info_payment`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `method_payment`
--
ALTER TABLE `method_payment`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `shop_policies`
--
ALTER TABLE `shop_policies`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `shop_schedules`
--
ALTER TABLE `shop_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `showroom`
--
ALTER TABLE `showroom`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `info_payment`
--
ALTER TABLE `info_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `method_payment`
--
ALTER TABLE `method_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `shop_policies`
--
ALTER TABLE `shop_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `shop_schedules`
--
ALTER TABLE `shop_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `showroom`
--
ALTER TABLE `showroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=618079;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
