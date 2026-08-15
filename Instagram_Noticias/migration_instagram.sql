-- Migração: Adicionar suporte a posts do Instagram nas notícias
-- Execute este script no banco de dados sinpaptep

ALTER TABLE `Noticia`
    ADD COLUMN `Instagram_Url` VARCHAR(500) NULL DEFAULT NULL
        COMMENT 'URL do post do Instagram para embed (ex: https://www.instagram.com/p/CODE/)'
    AFTER `Texto`;
