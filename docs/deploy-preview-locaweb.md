# Preview na Locaweb

O workflow **Deploy Preview Locaweb** publica o branch `dev` quando os secrets de homologação estão configurados. Sem eles, a execução termina sem enviar arquivos. Também é possível executá-lo manualmente no GitHub Actions. O site de produção, ligado ao branch `master`, não é alterado.

## Preparação única

1. No painel da Locaweb, crie um subdomínio como `preview.sindicatopublicitariosrs.com.br` e configure a raiz dele como `/public_html/preview/frontend/web`.
2. Crie um banco separado para homologação e importe nele uma cópia dos dados necessários. Não use o banco de produção.
3. No repositório GitHub, abra **Settings > Environments**, crie o ambiente `preview` e cadastre estes secrets:
   - `PREVIEW_DB_DSN`
   - `PREVIEW_DB_USERNAME`
   - `PREVIEW_DB_PASSWORD`
   - `PREVIEW_COOKIE_VALIDATION_KEY_FRONTEND`
   - `PREVIEW_COOKIE_VALIDATION_KEY_BACKEND`
   - `PREVIEW_INSTAGRAM_USER_ID` (opcional enquanto a Meta não estiver configurada)
   - `PREVIEW_INSTAGRAM_ACCESS_TOKEN` (opcional enquanto a Meta não estiver configurada)
4. Confirme que os secrets gerais `FTP_HOST`, `FTP_USER` e `FTP_PASS` continuam cadastrados no repositório. Eles são compartilhados com o deploy atual de produção.

Gere chaves longas e diferentes das usadas em produção para os dois secrets de cookie. O DSN segue o formato `mysql:host=HOST;port=3306;dbname=BANCO;charset=utf8mb4`.

## Publicação

1. Envie as alterações para o branch `dev`. Com os secrets cadastrados, a publicação começa automaticamente.
2. Para repetir uma publicação, abra **Actions > Deploy Preview Locaweb**, selecione a execução mais recente e use **Re-run all jobs**. Depois que o workflow estiver no branch padrão, também será possível usar **Run workflow**.
3. Acesse o subdomínio e valide a home, páginas internas, formulários e responsividade.

O preview recebe `noindex`, um `robots.txt` que bloqueia rastreadores, identificação visual no topo e transporte de e-mail em arquivo. Ainda assim, vale ativar a proteção por senha da Locaweb para restringir o acesso antes de compartilhar o endereço.

## Instagram

Quando as credenciais da Meta estiverem disponíveis, preencha os dois secrets opcionais e publique novamente. O cron descrito em `docs/instagram-feed.md` deve executar no diretório `/public_html/preview` se o preview precisar atualizar o feed automaticamente.
