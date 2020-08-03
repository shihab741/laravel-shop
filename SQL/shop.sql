-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2020 at 06:23 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_desc`, `brand_image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Arong', 'Local brand', '1200px-Aarong_logo.svg.png', 1, '2020-04-23 08:02:39', '2020-05-21 09:11:02'),
(3, 'Walton', 'Local brand', 'social_link_share_logo.jpg', 1, '2020-04-27 05:36:07', '2020-05-21 09:11:40'),
(4, 'Sony', 'Japanese brand', 'top-og.jpg', 1, '2020-04-27 05:36:26', '2020-05-21 09:12:27'),
(5, 'McGraw-Hill', 'Publisher', 'index.png', 1, '2020-05-21 09:10:12', '2020-05-21 09:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_desc`, `cat_image`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Clothing', 'Description for clothing category', '6-best-vintage-clothes-shops-new-york.jpg', 1, '2020-04-26 04:31:00', '2020-05-21 09:13:47'),
(12, 'Food Items', 'Description for food items', '7f8e2f468957ced4aa1e81bbaea44a80.png', 1, '2020-04-26 04:31:23', '2020-05-21 09:14:57'),
(13, 'Book', 'Description for book', 'Books_HD_(8314929977).jpg', 1, '2020-04-27 05:37:49', '2020-05-21 09:16:29'),
(14, 'Health', 'Description for health', 'Health-Insurance-Quotes-1920x1080.jpg', 0, '2020-05-10 05:10:01', '2020-05-21 09:19:50'),
(15, 'Others', 'Description for others category', 'unnamed.jpg', 1, '2020-05-21 09:21:53', '2020-05-21 09:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email_address`, `password`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Shihab', 'Ahmed', 'shihab@example.com', '$2y$10$em0CcqhjMqhCBNDiEXl6xOU9eACH..cwhL/1EiVoSkbqCkXCPY7W6', '01715821993', 'Dhaka', '2020-05-21 04:11:00', '2020-05-21 04:11:00'),
(2, 'admin', 'admin', 'admin@example.com', '$2y$10$G7W0U3vk.pg3FBpigC2CQed65qqx.YMOUpnAXAWBestkzXzp5Ox4W', 'wew', 'sdsd', '2020-05-21 04:48:06', '2020-05-21 04:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_23_071607_create_categories_table', 1),
(4, '2020_04_23_071650_create_brands_table', 1),
(5, '2020_04_23_071727_create_products_table', 1),
(6, '2020_04_27_160353_create_product_category_relations_table', 2),
(10, '2020_04_29_072539_create_users_table', 3),
(11, '2020_05_05_092309_add_multiple_column_to_products', 4),
(12, '2020_05_05_104144_create_static_pages_table', 5),
(13, '2020_05_07_113858_create_settings_table', 6),
(14, '2020_05_08_143830_add_multiple_column_to_settings', 7),
(15, '2020_05_09_103645_add_multiple_columns_to_settings', 8),
(16, '2020_05_21_071919_create_customers_table', 9),
(17, '2020_05_21_072347_create_payments_table', 10),
(18, '2020_05_21_072601_create_order_details_table', 11),
(19, '2020_05_21_072941_create_orders_table', 12),
(20, '2020_05_21_073432_create_shippings_table', 13),
(21, '2020_06_07_082819_create_order_details_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `order_total` double(10,2) NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `shipping_id`, `order_total`, `order_status`, `created_at`, `updated_at`) VALUES
(15, 1, 14, 450.00, 'Pending', '2020-06-11 06:52:33', '2020-06-11 06:52:33'),
(16, 1, 16, 100.00, 'Pending', '2020-06-28 10:02:27', '2020-06-28 10:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `created_at`, `updated_at`) VALUES
(10, 15, 2, 'Blue shirt for men', 100.00, 1, '2020-06-11 06:52:33', '2020-06-11 06:52:33'),
(11, 15, 5, 'Pizza', 175.00, 2, '2020-06-11 06:52:33', '2020-06-11 06:52:33'),
(12, 16, 2, 'Blue shirt for men', 100.00, 1, '2020-06-28 10:02:27', '2020-06-28 10:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_type`, `payment_status`, `created_at`, `updated_at`) VALUES
(15, 15, 'cash', 'Pending', '2020-06-11 06:52:33', '2020-06-11 06:52:33'),
(16, 16, 'cash', 'Pending', '2020-06-28 10:02:27', '2020-06-28 10:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` double(10,2) NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `multiple_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `brand_id`, `short_desc`, `long_desc`, `discount_price`, `product_price`, `product_qty`, `product_size`, `product_image`, `multiple_image`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(2, 'Blue shirt for men', 2, 'Short description for Blue shirt for men.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis aliquet risus quis tincidunt. Phasellus quis cursus odio. Nam rutrum turpis nec pulvinar semper. Nulla id leo accumsan, aliquet purus ac, convallis lorem. Duis sed rhoncus justo. Nulla facilisi. Vestibulum neque nisl, tempor nec risus id, viverra aliquam sapien.</p>', 100.00, 118.00, 3, 'M', '1212.jpg', '[\"12.jpg\",\"levis-royal-blue-casual-shirt.jpg\"]', 1, '2020-04-28 08:56:44', '2020-05-21 09:24:08', 4),
(3, 'How to Win Friends and Influence People', 5, 'Short description for How to Win Friends and Influence People', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis aliquet risus quis tincidunt. Phasellus quis cursus odio. Nam rutrum turpis nec pulvinar semper. Nulla id leo accumsan, aliquet purus ac, convallis lorem. Duis sed rhoncus justo. Nulla facilisi. Vestibulum neque nisl, tempor nec risus id, viverra aliquam sapien.</p>', 0.00, 200.00, 7, 'S', 'how-to-win-friends.png', '[\"71VNaA6uAPL.jpg\",\"how-to-win-friends-and-influence-people-dale-carnegie-first-edition-signed-1937-rare.jpg\"]', 1, '2020-04-28 08:59:55', '2020-05-21 09:26:03', 3),
(5, 'Pizza', 2, 'Short description for pizza', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis aliquet risus quis tincidunt. Phasellus quis cursus odio. Nam rutrum turpis nec pulvinar semper. Nulla id leo accumsan, aliquet purus ac, convallis lorem. Duis sed rhoncus justo. Nulla facilisi. Vestibulum neque nisl, tempor nec risus id, viverra aliquam sapien.</p>', 175.00, 200.00, 12, 'S', 'Artisanal-margherita-pizza-1-e1492634150494.jpg', '[\"BFV36537_CC2017_2IngredintDough4Ways-FB.jpg\",\"img-20180906-181850-01.jpg\"]', 1, '2020-05-05 03:35:02', '2020-05-21 09:27:59', 5),
(6, 'Headphone', 4, 'Short description for headphone', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis aliquet risus quis tincidunt. Phasellus quis cursus odio. Nam rutrum turpis nec pulvinar semper. Nulla id leo accumsan, aliquet purus ac, convallis lorem. Duis sed rhoncus justo. Nulla facilisi. Vestibulum neque nisl, tempor nec risus id, viverra aliquam sapien.</p>', 0.00, 500.00, 12, 'XL', '1-500x500.jpg', '[\"270.jpg\",\"Sony-MDR-XB750-1.jpg\"]', 1, '2020-05-09 01:44:33', '2020-05-21 09:30:51', 4),
(7, 'Mobile phone', 3, 'Short description for mobile phone', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis aliquet risus quis tincidunt. Phasellus quis cursus odio. Nam rutrum turpis nec pulvinar semper. Nulla id leo accumsan, aliquet purus ac, convallis lorem. Duis sed rhoncus justo. Nulla facilisi. Vestibulum neque nisl, tempor nec risus id, viverra aliquam sapien.</p>', 1000.00, 1200.00, 12, 'S', '1-364x364.jpg', '[\"landing-page-image-01.jpg\",\"X5-364x364.jpg\"]', 1, '2020-05-21 09:34:09', '2020-05-21 09:34:09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_category_relations`
--

CREATE TABLE `product_category_relations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category_relations`
--

INSERT INTO `product_category_relations` (`id`, `cat_id`, `product_id`, `created_at`, `updated_at`) VALUES
(51, 11, 2, '2020-05-21 09:24:08', '2020-05-21 09:24:08'),
(52, 15, 2, '2020-05-21 09:24:08', '2020-05-21 09:24:08'),
(53, 13, 3, '2020-05-21 09:26:04', '2020-05-21 09:26:04'),
(54, 15, 3, '2020-05-21 09:26:04', '2020-05-21 09:26:04'),
(55, 12, 5, '2020-05-21 09:27:59', '2020-05-21 09:27:59'),
(56, 15, 6, '2020-05-21 09:30:51', '2020-05-21 09:30:51'),
(57, 15, 7, '2020-05-21 09:34:10', '2020-05-21 09:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_per_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `phone`, `email`, `address`, `created_at`, `updated_at`, `logo`, `product_per_page`) VALUES
(1, 'Laravel Dokan', '9018127131631', 'example@example.com', 'ahgas, 63463/5445. ASHgas.', '2020-05-06 18:00:00', '2020-05-10 05:22:35', 'logo2.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `full_name`, `email_address`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(14, 'Shihab Ahmed', 'shihab@example.com', '01715821993', 'Dhaka', '2020-06-11 06:52:02', '2020-06-11 06:52:02'),
(15, 'Shihab Ahmed', 'shihab@example.com', '01715821993', 'Dhaka', '2020-06-16 09:04:16', '2020-06-16 09:04:16'),
(16, 'শিহাব আহমেদ', 'shihab@example.com', '01715821993', 'Dhaka', '2020-06-28 10:02:20', '2020-06-28 10:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

CREATE TABLE `static_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`id`, `url`, `heading`, `image`, `page_content`, `status`, `created_at`, `updated_at`) VALUES
(4, 'about', 'About', 'iStock_000039291924_Medium.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue, enim et ultrices porttitor, erat velit pellentesque neque, nec euismod purus eros eu ipsum. Aenean pharetra sollicitudin urna. Sed euismod semper bibendum. Quisque a vulputate massa. Ut maximus faucibus mi, non placerat est mollis eget. Aliquam vitae risus condimentum, iaculis nulla vel, accumsan ipsum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Nunc gravida sollicitudin interdum. Integer id metus massa. Donec vitae commodo sapien. Curabitur luctus interdum neque, ac laoreet eros porttitor ut. Integer elit nunc, mollis non efficitur ac, posuere hendrerit mauris. Nunc eu elementum risus, id consectetur lectus. Duis a commodo elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce eu sagittis purus. Morbi rutrum nisi ornare ligula luctus faucibus. Nullam iaculis id est in interdum. Morbi tempor lacus in est dictum commodo. Duis tempor eleifend rutrum. Suspendisse eget lacus id nibh congue viverra id sed nisl. In hac habitasse platea dictumst.</p>\r\n\r\n<p>Donec nec leo mattis, egestas massa a, semper nulla. Suspendisse feugiat massa a elementum rutrum. Integer sit amet faucibus nisl. Fusce luctus vulputate mollis. Quisque sit amet libero augue. Integer et urna dolor. Vivamus sit amet augue non dolor porttitor fermentum. Praesent sed nisl purus. Phasellus nec ante ac felis ullamcorper congue eu quis nisl. Suspendisse sollicitudin quis nisi et auctor. Sed ac augue enim.</p>\r\n\r\n<p>Proin porttitor viverra tortor, venenatis molestie urna blandit nec. Curabitur at nisi eget ante aliquet tempor et id lacus. Praesent eu eleifend elit. Etiam quis purus elementum, rutrum lacus quis, euismod nulla. Cras suscipit pharetra eros, nec lobortis neque. Vivamus nec arcu efficitur, sodales ex sed, fermentum ante. Aenean id volutpat lacus, at pharetra purus. Donec nisl tortor, luctus sit amet auctor non, rutrum nec neque. Nunc justo risus, pretium vitae risus at, convallis pulvinar est. Vestibulum pharetra sem sit amet diam ultricies cursus. Nulla at maximus erat. Ut et magna non lectus consequat venenatis at viverra lacus. Nam viverra nunc vel turpis elementum eleifend. Mauris pharetra augue ante, quis pellentesque velit sagittis non.</p>\r\n\r\n<p>Pellentesque at mattis nibh, vel convallis massa. Nunc hendrerit nisl a mauris mollis imperdiet. Nam hendrerit quam erat, rhoncus maximus ex porttitor quis. Proin sed quam diam. Maecenas odio sem, molestie a nulla in, dapibus ullamcorper arcu. In nulla magna, varius non elit eget, dignissim blandit justo. Phasellus cursus, arcu nec vestibulum imperdiet, orci odio ornare nulla, sed fermentum nibh enim et urna. Nam eros ex, consequat et vehicula et, eleifend eu purus. Cras eget consectetur libero. Nullam fringilla consectetur neque blandit consequat. Duis egestas urna in faucibus sagittis. Sed fringilla facilisis urna sit amet fringilla. Aenean sit amet felis faucibus, vestibulum nunc ac, posuere turpis.</p>\r\n\r\n<p>&nbsp;</p>', 1, '2020-05-05 09:54:55', '2020-05-21 09:43:16'),
(5, 'faq', 'FAQ', '915238_orig.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue, enim et ultrices porttitor, erat velit pellentesque neque, nec euismod purus eros eu ipsum. Aenean pharetra sollicitudin urna. Sed euismod semper bibendum. Quisque a vulputate massa. Ut maximus faucibus mi, non placerat est mollis eget. Aliquam vitae risus condimentum, iaculis nulla vel, accumsan ipsum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Nunc gravida sollicitudin interdum. Integer id metus massa. Donec vitae commodo sapien. Curabitur luctus interdum neque, ac laoreet eros porttitor ut. Integer elit nunc, mollis non efficitur ac, posuere hendrerit mauris. Nunc eu elementum risus, id consectetur lectus. Duis a commodo elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce eu sagittis purus. Morbi rutrum nisi ornare ligula luctus faucibus. Nullam iaculis id est in interdum. Morbi tempor lacus in est dictum commodo. Duis tempor eleifend rutrum. Suspendisse eget lacus id nibh congue viverra id sed nisl. In hac habitasse platea dictumst.</p>\r\n\r\n<p>Donec nec leo mattis, egestas massa a, semper nulla. Suspendisse feugiat massa a elementum rutrum. Integer sit amet faucibus nisl. Fusce luctus vulputate mollis. Quisque sit amet libero augue. Integer et urna dolor. Vivamus sit amet augue non dolor porttitor fermentum. Praesent sed nisl purus. Phasellus nec ante ac felis ullamcorper congue eu quis nisl. Suspendisse sollicitudin quis nisi et auctor. Sed ac augue enim.</p>\r\n\r\n<p>Proin porttitor viverra tortor, venenatis molestie urna blandit nec. Curabitur at nisi eget ante aliquet tempor et id lacus. Praesent eu eleifend elit. Etiam quis purus elementum, rutrum lacus quis, euismod nulla. Cras suscipit pharetra eros, nec lobortis neque. Vivamus nec arcu efficitur, sodales ex sed, fermentum ante. Aenean id volutpat lacus, at pharetra purus. Donec nisl tortor, luctus sit amet auctor non, rutrum nec neque. Nunc justo risus, pretium vitae risus at, convallis pulvinar est. Vestibulum pharetra sem sit amet diam ultricies cursus. Nulla at maximus erat. Ut et magna non lectus consequat venenatis at viverra lacus. Nam viverra nunc vel turpis elementum eleifend. Mauris pharetra augue ante, quis pellentesque velit sagittis non.</p>\r\n\r\n<p>Pellentesque at mattis nibh, vel convallis massa. Nunc hendrerit nisl a mauris mollis imperdiet. Nam hendrerit quam erat, rhoncus maximus ex porttitor quis. Proin sed quam diam. Maecenas odio sem, molestie a nulla in, dapibus ullamcorper arcu. In nulla magna, varius non elit eget, dignissim blandit justo. Phasellus cursus, arcu nec vestibulum imperdiet, orci odio ornare nulla, sed fermentum nibh enim et urna. Nam eros ex, consequat et vehicula et, eleifend eu purus. Cras eget consectetur libero. Nullam fringilla consectetur neque blandit consequat. Duis egestas urna in faucibus sagittis. Sed fringilla facilisis urna sit amet fringilla. Aenean sit amet felis faucibus, vestibulum nunc ac, posuere turpis.</p>\r\n\r\n<p>&nbsp;</p>', 1, '2020-05-08 10:04:14', '2020-05-21 09:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `address`, `photo`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Shihab Ahmed', '63837653', 'example@example.com', NULL, '$2y$10$OmO.y2c/LPgQ9H/v7I0rCujgeLlCTf8NqtETSd3gRCYOZ0vC1rV1y', ' Dhaka.', '1-copy.jpg', 1, 1, 'wo8pcqmqyyTUUozqbDJypqjwLpJm7k1t6Q26TnGFRcvOv0U0NKUfkXc6Q6cs', '2020-04-29 05:05:46', '2020-05-05 05:33:58'),
(3, 'Demo vendor', '73434667', 'vendor@example.com', NULL, '$2y$10$eiJ.HIiJzMsrEGrrpyqYuu9abOSGTps.Rx5cY1h8ZojACnTkPdQx2', '348', 'zhivago-and-lara-dr-zhivago-plate_3_02c472da997298a01b03d164225f5217.jpg', 3, 1, 'hoqG0IcI2PfOY8O202hDmtDVVpKbaM7s3yNfon71fMP2BJ70pZON9xMzLAcD', '2020-04-29 05:12:40', '2020-04-30 01:21:11'),
(4, 'Demo Admin', '827382737', 'admin@example.com', NULL, '$2y$10$7fmlTb78daB/vYW7pbq2tugmTO1LzrGW8MBZj1jB4rvdicCKuK512', 'we', '41.jpg', 2, 1, '5abbtXVs5VyAZ9MXnKXIjeHrOa2lyxpjMlu8G07AOZtuAYCYaoS30b6GtrFJ', '2020-04-29 08:42:28', '2020-04-30 00:29:18'),
(5, 'Demo vendor 2', '355335', 'vendor2@example.com', NULL, '$2y$10$iD9IzJo73vdTDAvfFm/k/utLi6yiW3cSUQk0fN.9U/rE3qonnB7Pe', 'erer', 'Ingrid_Bergman,_Gaslight_1944-copy.jpg', 3, 1, 'tj9TM5PNTXQhu3pcpBn1hq7cjNn0d5uO7blCCcBDRVhlyBcMEeEI80nT0Q3U', '2020-05-05 03:10:33', '2020-05-05 09:12:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category_relations`
--
ALTER TABLE `product_category_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_pages`
--
ALTER TABLE `static_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_category_relations`
--
ALTER TABLE `product_category_relations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `static_pages`
--
ALTER TABLE `static_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
