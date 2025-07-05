<?php
/**
 * Teste do .htaccess do backend
 */

echo "=== TESTE DO .HTACCESS ===\n\n";

// Verificar se o .htaccess foi corrigido
$htaccessFile = 'backend/web/.htaccess';
if (file_exists($htaccessFile)) {
    $content = file_get_contents($htaccessFile);
    
    echo "1. VERIFICAÇÃO DO .HTACCESS:\n";
    
    // Verificar se a regra problemática foi removida
    if (strpos($content, 'RewriteRule ^(runtime|vendor|tests|migrations|console|common|backend)/ - [F,L]') !== false) {
        echo "   ❌ REGRA PROBLEMÁTICA AINDA EXISTE!\n";
        echo "   A regra 'backend/' ainda está bloqueando o acesso\n";
    } else {
        echo "   ✅ Regra problemática removida\n";
    }
    
    // Verificar se a regra correta existe
    if (strpos($content, 'RewriteRule ^(runtime|vendor|tests|migrations|console|common)/ - [F,L]') !== false) {
        echo "   ✅ Regra correta aplicada (sem 'backend/')\n";
    } else {
        echo "   ❌ Regra correta não encontrada\n";
    }
    
    // Verificar se o RewriteEngine está ativo
    if (strpos($content, 'RewriteEngine On') !== false) {
        echo "   ✅ RewriteEngine ativo\n";
    } else {
        echo "   ❌ RewriteEngine não encontrado\n";
    }
    
    // Verificar se a regra de rewrite para index.php existe
    if (strpos($content, 'RewriteRule . index.php [L]') !== false) {
        echo "   ✅ Regra de rewrite para index.php encontrada\n";
    } else {
        echo "   ❌ Regra de rewrite para index.php não encontrada\n";
    }
    
} else {
    echo "   ❌ Arquivo .htaccess não encontrado\n";
}

echo "\n2. TESTE DE URLS:\n";
echo "   URLs que devem funcionar agora:\n";
echo "   - backend/web/index.php?r=categoria/index\n";
echo "   - backend/web/index.php?r=socio/index\n";
echo "   - backend/web/index.php?r=noticia/index\n";
echo "   - backend/web/index.php?r=parceiro/index\n";
echo "   - backend/web/index.php?r=anunciante/index\n";
echo "   - backend/web/index.php?r=pagina/index\n";

echo "\n3. INSTRUÇÕES:\n";
echo "   1. Teste a URL: backend/web/index.php?r=categoria/index\n";
echo "   2. Se ainda der 404, verifique os logs do servidor\n";
echo "   3. Certifique-se de que o mod_rewrite está habilitado\n";
echo "   4. Limpe o cache do navegador\n";

echo "\n=== FIM DO TESTE ===\n"; 