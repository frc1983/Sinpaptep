-- Script de configuração do banco de dados Sinpaptep
-- Execute este script como usuário root do MySQL

-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS `sinpaptep` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Criar o usuário
CREATE USER IF NOT EXISTS 'sinpaptep'@'localhost' IDENTIFIED BY 'sinpaptep';

-- Conceder privilégios ao usuário
GRANT ALL PRIVILEGES ON `sinpaptep`.* TO 'sinpaptep'@'localhost';

-- Aplicar as alterações
FLUSH PRIVILEGES;

-- Selecionar o banco de dados
USE `sinpaptep`;

-- Verificar se o banco foi criado
SHOW DATABASES LIKE 'sinpaptep';

-- Verificar se o usuário foi criado
SELECT User, Host FROM mysql.user WHERE User = 'sinpaptep';

-- Verificar privilégios do usuário
SHOW GRANTS FOR 'sinpaptep'@'localhost'; 