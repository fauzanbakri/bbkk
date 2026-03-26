CREATE TABLE IF NOT EXISTS users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin', 'staff', 'user') NOT NULL DEFAULT 'user',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  last_login_at DATETIME NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uk_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Opsional: seed user admin pertama.
-- Ganti nilai password_hash dengan hasil password_hash('password_asli', PASSWORD_DEFAULT) dari PHP.
-- Contoh generate hash cepat:
-- php -r "echo password_hash('Admin12345!', PASSWORD_DEFAULT), PHP_EOL;"
-- INSERT INTO users (full_name, email, password_hash, role, is_active)
-- VALUES ('Administrator BBKK', 'admin@bbkk.local', '$2y$10$REPLACE_WITH_HASH', 'admin', 1);
