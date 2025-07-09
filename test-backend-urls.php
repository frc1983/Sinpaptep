<?php
/**
 * Teste específico para URLs do backend com backend/web
 */

echo "=== TESTE DE URLs DO BACKEND ===\n\n";

// Verificar configurações
echo "1. VERIFICAÇÃO DE CONFIGURAÇÕES:\n";

$configFiles = [
    'backend/config/main.php' => 'Configuração principal',
    'environments/prod/backend/config/main-local.php' => 'Configuração produção',
];

foreach ($configFiles as $file => $description) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Verificar baseUrl
        if (strpos($content, "'baseUrl' => '/backend/web'") !== false) {
            echo "   ✅ $description: baseUrl configurado corretamente\n";
        } else {
            echo "   ❌ $description: baseUrl NÃO configurado\n";
        }
        
        // Verificar enablePrettyUrl
        if (strpos($content, "'enablePrettyUrl' => true") !== false) {
            echo "   ✅ $description: enablePrettyUrl habilitado\n";
        } else {
            echo "   ❌ $description: enablePrettyUrl NÃO habilitado\n";
        }
        
    } else {
        echo "   ❌ $description: arquivo não encontrado\n";
    }
}

echo "\n2. TESTE DE URLs ESPERADAS:\n";
echo "   URLs que devem funcionar agora:\n";
echo "   - /backend/web/categoria\n";
echo "   - /backend/web/socio\n";
echo "   - /backend/web/noticia\n";
echo "   - /backend/web/parceiro\n";
echo "   - /backend/web/anunciante\n";
echo "   - /backend/web/pagina\n";
echo "   - /backend/web/socio/create\n";
echo "   - /backend/web/noticia/view/123\n";

echo "\n3. TESTE DE URLS ANTIGAS (ainda devem funcionar):\n";
echo "   - backend/web/index.php?r=categoria/index\n";
echo "   - backend/web/index.php?r=socio/create\n";
echo "   - backend/web/index.php?r=noticia/view&id=123\n";

echo "\n4. VERIFICAÇÃO DO .HTACCESS:\n";
$htaccessFile = 'backend/web/.htaccess';
if (file_exists($htaccessFile)) {
    $content = file_get_contents($htaccessFile);
    
    if (strpos($content, 'RewriteEngine on') !== false) {
        echo "   ✅ RewriteEngine ativo\n";
    } else {
        echo "   ❌ RewriteEngine não encontrado\n";
    }
    
    if (strpos($content, 'RewriteRule . index.php') !== false) {
        echo "   ✅ Regra de rewrite encontrada\n";
    } else {
        echo "   ❌ Regra de rewrite não encontrada\n";
    }
    
    // Verificar se não há regras que bloqueiem backend
    if (strpos($content, 'RewriteRule.*backend.*- [F,L]') !== false) {
        echo "   ❌ Regra bloqueando 'backend' encontrada\n";
    } else {
        echo "   ✅ Nenhuma regra bloqueando 'backend'\n";
    }
    
} else {
    echo "   ❌ Arquivo .htaccess não encontrado\n";
}

echo "\n5. INSTRUÇÕES DE TESTE:\n";
echo "   1. Teste: http://localhost/Sinpaptep/backend/web/categoria\n";
echo "   2. Teste: http://localhost/Sinpaptep/backend/web/socio/create\n";
echo "   3. Teste: http://localhost/Sinpaptep/backend/web/noticia/view/123\n";
echo "   4. Se der 404, verifique se o mod_rewrite está habilitado\n";
echo "   5. Limpe o cache do navegador\n";

echo "\n=== FIM DO TESTE ===\n"; 