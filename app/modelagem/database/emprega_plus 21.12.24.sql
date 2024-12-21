-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Dez-2024 às 10:37
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `emprega_plus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidatos`
--

CREATE TABLE `candidatos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `portfolio` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `habilidades` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `candidatos`
--

INSERT INTO `candidatos` (`id`, `user_id`, `cv`, `portfolio`, `created_at`, `updated_at`, `foto`, `descricao`, `telefone`, `habilidades`, `ativo`) VALUES
(1, 1, 'Stela Paulo Chau Exame Normal_cv_20241219_121458.pdf', 'https://chatgpt.com/c/67585251-fe04-800a-a47a-f64bd8f95d28', '2024-12-18 17:22:49', '2024-12-19 12:54:43', 'OIP (2)_fotodeperfil_20241219_145443.jpg', 'ssssssssss', '874867111', 'Programacao', 1),
(2, 5, 'Facool Developer_cv_20241220_165932.pdf', 'https://chatgpt.com/c/67585251-fe04-800a-a47a-f64bd8f95d28', '2024-12-20 14:57:59', '2024-12-20 15:00:39', 'download (2)_fotodeperfil_20241220_165932.jpg', 'ssssssssss', '844318136', 'Programacao', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidaturas`
--

CREATE TABLE `candidaturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `job_post_id` bigint(20) UNSIGNED NOT NULL,
  `carta_candidatura` text DEFAULT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `candidaturas`
--

INSERT INTO `candidaturas` (`id`, `candidato_id`, `job_post_id`, `carta_candidatura`, `anexo`, `created_at`, `updated_at`) VALUES
(20, 2, 6, 'candidaturas/G9vtkiTSfMY3XByP682DdnbaMqHwJwPGtm6MYKbJ.pdf', 'anexos/8ZCyYumE8F1Oxh2qecORzAo0bAB7FYh6Qas0AZes.pdf', '2024-12-21 07:34:08', '2024-12-21 07:34:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `job_post_id` bigint(20) UNSIGNED NOT NULL,
  `comentario` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `candidato_id`, `job_post_id`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'ola', '2024-12-19 12:55:43', '2024-12-19 12:55:43'),
(2, 1, 5, 'oi', '2024-12-19 18:05:12', '2024-12-19 18:05:12'),
(3, 1, 5, 'nnnnnnnnnnnnn', '2024-12-19 18:15:53', '2024-12-19 18:15:53'),
(7, 2, 5, 'ooooooo', '2024-12-20 19:17:53', '2024-12-20 19:23:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empregadores`
--

CREATE TABLE `empregadores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empresa_descricao` text DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `empregadores`
--

INSERT INTO `empregadores` (`id`, `user_id`, `company_name`, `created_at`, `updated_at`, `empresa_descricao`, `telefone`, `site`, `localizacao`, `profile_image`, `endereco`, `ativo`) VALUES
(2, 4, 'EleuterioZM', '2024-12-19 10:54:07', '2024-12-19 14:45:00', 'EleuterioZM', '856459479', 'https://github.com/EleuterioZM/emprega-plus', 'EleuterioZM', 'eleuterio_fotodeperfil_20241219_162814.jpg', 'Polana Canico A', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_posts`
--

CREATE TABLE `job_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empregador_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `tipo` enum('tempo integral','meio período','freelance') NOT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `documento_pdf` varchar(255) DEFAULT NULL,
  `validade` date NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `job_posts`
--

INSERT INTO `job_posts` (`id`, `empregador_id`, `titulo`, `descricao`, `localizacao`, `tipo`, `salario`, `documento_pdf`, `validade`, `ativo`, `created_at`, `updated_at`) VALUES
(5, 2, 'Criar Vaga de Emprego', 'AAAAAAAAAAAAAAAA', 'Beira, Moçambique', 'freelance', 12122.00, 'documents/Criar Vaga de Emprego_Facool Developer.pdf', '2024-12-20', 1, '2024-12-19 11:37:42', '2024-12-20 19:48:47'),
(6, 2, 'Desenvolvedor', 'aaaaaaaaaaaaaa', 'Maputo', 'meio período', 8000.00, 'documents/Desenvolvedor_Facool Developer.pdf', '2024-12-20', 1, '2024-12-19 18:23:49', '2024-12-20 19:44:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_post_likes`
--

CREATE TABLE `job_post_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidato_id` bigint(20) UNSIGNED NOT NULL,
  `job_post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `job_post_likes`
--

INSERT INTO `job_post_likes` (`id`, `candidato_id`, `job_post_id`, `created_at`, `updated_at`) VALUES
(7, 1, 5, '2024-12-19 18:15:43', '2024-12-19 18:15:43'),
(8, 2, 5, '2024-12-20 15:04:58', '2024-12-20 15:04:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(56, '2024_12_06_141738_create_job_posts_table', 1),
(93, '0001_01_01_000000_create_users_table', 2),
(94, '0001_01_01_000001_create_cache_table', 2),
(95, '0001_01_01_000002_create_jobs_table', 2),
(96, '2024_12_06_140204_create_sessions_table', 2),
(97, '2024_12_06_145646_create_candidatos_table', 3),
(98, '2024_12_06_145708_create_empregadores_table', 3),
(99, '2024_12_06_154506_update_verification_code_nullable_on_users_table', 3),
(100, '2024_12_06_182105_rename_empresa_nome_to_company_name_in_empregadores', 3),
(101, '2024_12_06_220541_add_fields_to_candidatos_table', 3),
(102, '2024_12_06_220558_add_fields_to_empregadores_table', 3),
(103, '2024_12_07_123651_add_localizacao_to_empregadores_table', 3),
(104, '2024_12_07_124120_add_columns_to_empregadores_table', 3),
(105, '2024_12_07_124850_add_ativo_to_empregadores_table', 3),
(106, '2024_12_07_140915_alter_ativo_column_in_empregadores_table', 3),
(107, '2024_12_10_150950_add_foto_descricao_telefone_habilidades_to_candidatos_table', 3),
(108, '2024_12_10_164230_add_ativo_to_candidatos_table', 3),
(109, '2024_12_18_190922_create_job_posts_table', 4),
(110, '2024_12_18_220907_alter_job_posts_table_set_ativo_default', 5),
(111, '2024_12_18_225809_create_candidaturas_table', 6),
(112, '2024_12_18_225920_create_job_post_likes_table', 6),
(113, '2024_12_18_230031_create_comentarios_table', 6),
(114, '2024_12_21_082355_add_carta_e_anexo_to_candidaturas_table', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `payload`, `last_activity`, `ip_address`, `user_agent`) VALUES
('M4p0mZj3phpTlRWj81aqYSHgqkqoyKb8cuve78lP', 5, 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU2YxTEZiMTVtMDlSSFhUbVRZZm85V2JRSVJRVW5SdHdBWkpXbXUzRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mZWVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1734773661, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('candidato','empregador') NOT NULL DEFAULT 'candidato',
  `verification_code` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `user_type`, `verification_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Eleuterio', 'juniormabecuane5@gmail.com', '2024-12-18 17:23:52', '$2y$12$vD/vFxOErPkP9UuE9JknUu64LR9WfBINvbYWCSjYJ8GlLd/RWtFW2', 'candidato', NULL, 'ativo', '2024-12-18 17:22:42', '2024-12-18 17:23:52'),
(4, 'EleuterioZM', 'eleuteriomabecuane5@gmail.com', '2024-12-19 10:54:42', '$2y$12$0DMnb2CzgAQlPJz.gyaqo.hFbmFhgZpCc9e8PE32.BwTZ/sVzY0Ae', 'empregador', NULL, 'ativo', '2024-12-19 10:53:56', '2024-12-19 10:54:42'),
(5, 'Lourenco Vasco', 'juniormabecuane7@gmail.com', '2024-12-20 14:58:15', '$2y$12$XRzyrzohSpK1oH1Z2PT4KOqfCg5Md/1b2wNV9K6.mCfXMDmvKHSW6', 'candidato', NULL, 'ativo', '2024-12-20 14:57:46', '2024-12-20 14:58:15');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidatos_user_id_foreign` (`user_id`);

--
-- Índices para tabela `candidaturas`
--
ALTER TABLE `candidaturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidaturas_candidato_id_foreign` (`candidato_id`),
  ADD KEY `candidaturas_job_post_id_foreign` (`job_post_id`);

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentarios_candidato_id_foreign` (`candidato_id`),
  ADD KEY `comentarios_job_post_id_foreign` (`job_post_id`);

--
-- Índices para tabela `empregadores`
--
ALTER TABLE `empregadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empregadores_user_id_foreign` (`user_id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_posts_empregador_id_foreign` (`empregador_id`);

--
-- Índices para tabela `job_post_likes`
--
ALTER TABLE `job_post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_post_likes_candidato_id_foreign` (`candidato_id`),
  ADD KEY `job_post_likes_job_post_id_foreign` (`job_post_id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `candidatos`
--
ALTER TABLE `candidatos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `candidaturas`
--
ALTER TABLE `candidaturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `empregadores`
--
ALTER TABLE `empregadores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `job_post_likes`
--
ALTER TABLE `job_post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `candidatos`
--
ALTER TABLE `candidatos`
  ADD CONSTRAINT `candidatos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `candidaturas`
--
ALTER TABLE `candidaturas`
  ADD CONSTRAINT `candidaturas_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`),
  ADD CONSTRAINT `candidaturas_job_post_id_foreign` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`);

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`),
  ADD CONSTRAINT `comentarios_job_post_id_foreign` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`);

--
-- Limitadores para a tabela `empregadores`
--
ALTER TABLE `empregadores`
  ADD CONSTRAINT `empregadores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `job_posts`
--
ALTER TABLE `job_posts`
  ADD CONSTRAINT `job_posts_empregador_id_foreign` FOREIGN KEY (`empregador_id`) REFERENCES `empregadores` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `job_post_likes`
--
ALTER TABLE `job_post_likes`
  ADD CONSTRAINT `job_post_likes_candidato_id_foreign` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`),
  ADD CONSTRAINT `job_post_likes_job_post_id_foreign` FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`);

--
-- Limitadores para a tabela `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
