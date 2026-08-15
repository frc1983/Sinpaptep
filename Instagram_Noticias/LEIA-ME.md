# Instagram nas Notícias — Instruções de Instalação

## Arquivos desta pasta

| Arquivo | Destino no projeto |
|---|---|
| `migration_instagram.sql` | Executar no banco de dados |
| `Noticia.php` | `common/models/Noticia.php` |
| `_form.php` | `backend/views/noticia/_form.php` |
| `view.php` | `backend/views/noticia/view.php` |

---

## Passo a passo

### 1. Banco de dados
Abra o phpMyAdmin ou execute via MySQL:
```sql
ALTER TABLE `Noticia`
    ADD COLUMN `Instagram_Url` VARCHAR(500) NULL DEFAULT NULL
    AFTER `Texto`;
```
Ou execute o arquivo `migration_instagram.sql` diretamente.

### 2. Substituir os arquivos
Copie cada arquivo para o destino indicado na tabela acima,
substituindo os originais.

### 3. Pronto!
Não é necessário alterar nenhuma outra configuração.

---

## Como usar

1. Acesse o painel admin e abra qualquer notícia para editar (ou crie uma nova).
2. No formulário, role até o campo **"Post do Instagram"**.
3. Cole o link do post (ex: `https://www.instagram.com/p/ABC123/`).
   - Para encontrar o link: abra o post no Instagram → clique nos três pontos (···) → **Copiar link**.
4. Ao sair do campo, uma pré-visualização aparece automaticamente.
5. Salve a notícia.

O embed aparecerá na página de visualização da notícia dentro de um card dedicado.

---

## Formatos de URL aceitos

- `https://www.instagram.com/p/CODIGO/`
- `https://www.instagram.com/reel/CODIGO/`
- `https://www.instagram.com/tv/CODIGO/`

O campo é **opcional** — notícias sem Instagram continuam funcionando normalmente.
