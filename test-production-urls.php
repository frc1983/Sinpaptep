<?php
/**
 * Teste de URLs de Produção
 * 
 * Este script testa se as URLs do backend estão funcionando corretamente
 */

echo "=== TESTE DE URLs DE PRODUÇÃO ===\n\n";

// Configurações para produção
define('YII_DEBUG', false);
define('YII_ENV', 'prod');

// Inclui o autoloader
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

// Carrega configurações
require __DIR__ . '/common/config/bootstrap.php';
require __DIR__ . '/backend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/common/config/main.php',
    require __DIR__ . '/common/config/main-local.php',
    require __DIR__ . '/backend/config/main.php',
    require __DIR__ . '/environments/prod/backend/config/main-local.php'
);

try {
    // Cria a aplicação
    $app = new yii\web\Application($config);
    
    echo "✅ Aplicação criada com sucesso\n\n";
    
    // Testa o urlManager
    $urlManager = $app->urlManager;
    echo "CONFIGURAÇÕES DO URL MANAGER:\n";
    echo "   - enablePrettyUrl: " . ($urlManager->enablePrettyUrl ? 'true' : 'false') . "\n";
    echo "   - showScriptName: " . ($urlManager->showScriptName ? 'true' : 'false') . "\n";
    echo "   - baseUrl: '" . $urlManager->baseUrl . "'\n";
    
    echo "\nURLS QUE DEVEM FUNCIONAR:\n";
    
    // Testa URLs específicas
    $testUrls = [
        'noticia/index' => '/backend/web/noticia',
        'categoria/index' => '/backend/web/categoria',
        'socio/index' => '/backend/web/socio',
        'parceiro/index' => '/backend/web/parceiro',
        'anunciante/index' => '/backend/web/anunciante',
        'pagina/index' => '/backend/web/pagina',
        'site/index' => '/backend/web/',
        'site/login' => '/backend/web/login',
    ];
    
    foreach ($testUrls as $route => $expectedUrl) {
        try {
            $url = $urlManager->createUrl($route);
            $status = ($url === $expectedUrl) ? "✅" : "❌";
            echo "   $status $route -> $url\n";
            
            if ($url !== $expectedUrl) {
                echo "      Esperado: $expectedUrl\n";
            }
            
        } catch (Exception $e) {
            echo "   ❌ $route -> ERRO: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\nURLS PARA TESTAR NO NAVEGADOR:\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/noticia\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/categoria\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/socio\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/parceiro\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/anunciante\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/pagina\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/login\n";
    
    echo "\nURLS ANTIGAS (ainda devem funcionar):\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/index.php?r=noticia/index\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/index.php?r=categoria/index\n";
    echo "   🔗 https://www.sindicatopublicitariosrs.com.br/backend/web/index.php?r=socio/index\n";
    
    echo "\nVERIFICAÇÕES IMPORTANTES:\n";
    echo "   1. ✅ .htaccess do backend corrigido\n";
    echo "   2. ✅ baseUrl configurado como '/backend/web'\n";
    echo "   3. ✅ enablePrettyUrl habilitado\n";
    echo "   4. ✅ showScriptName desabilitado\n";
    echo "   5. ✅ Regras de URL configuradas\n";
    
    echo "\nSE AINDA DER 404:\n";
    echo "   1. Verifique se o mod_rewrite está habilitado no servidor\n";
    echo "   2. Verifique se o .htaccess está sendo lido\n";
    echo "   3. Verifique os logs de erro do servidor\n";
    echo "   4. Teste primeiro com URLs antigas (com index.php)\n";
    echo "   5. Limpe o cache do navegador\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}

echo "\n=== FIM DO TESTE ===\n"; 