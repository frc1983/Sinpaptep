# Feed do Instagram

O site exibe até seis publicações do perfil profissional `@sindicato_publirs`. A página pública lê um arquivo local, por isso uma indisponibilidade da Meta não deixa a home lenta ou fora do ar.

## Ativação

1. Confirme que o perfil é profissional e está vinculado à Página do Facebook do sindicato. No Explorador da Graph API, consulte `me/accounts?fields=id,name,access_token,instagram_business_account` com as permissões `pages_show_list`, `pages_read_engagement`, `instagram_basic` e `business_management`.
   Use `instagram_business_account.id` como ID e o `access_token` retornado para a Página como token.
2. Copie as variáveis abaixo para o `.env` da hospedagem:

   ```dotenv
   INSTAGRAM_USER_ID=ID_DA_CONTA
   INSTAGRAM_ACCESS_TOKEN=TOKEN_DE_LONGA_DURACAO
   INSTAGRAM_API_VERSION=v24.0
   ```

3. Faça a primeira sincronização:

   ```shell
   php yii instagram/sync
   ```

4. Agende `php yii instagram/sync` a cada hora no painel da hospedagem.
5. Não agende `instagram/refresh-token`: esse endpoint é exclusivo do outro modelo de Login do Instagram. Quando o Token de Página expirar ou for revogado, gere outro no Meta e substitua o secret `INSTAGRAM_ACCESS_TOKEN`.

Se as credenciais ainda não estiverem configuradas, a home mostra um convite para acessar o perfil diretamente. Se uma sincronização falhar, o último feed salvo continua disponível.

## Diagnóstico

- `Configure INSTAGRAM_USER_ID...`: alguma credencial não foi informada no `.env`.
- `A extensão cURL...`: habilite a extensão cURL no PHP usado pelo agendador.
- `A Meta recusou a consulta...`: renove a autorização do perfil e execute a sincronização novamente.
