<?php
/**
 * Teste de URLs para verificar se as barras estão sendo mantidas
 */

// Configurações básicas
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

echo "=== TESTE DE URLs COM BARRAS ===\n\n";

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
    
    if (isset($urlManager->normalizer)) {
        echo "   - normalizer configurado\n";
        echo "     * collapseSlashes: " . ($urlManager->normalizer->collapseSlashes ? 'true' : 'false') . "\n";
        echo "     * normalizeTrailingSlash: " . ($urlManager->normalizer->normalizeTrailingSlash ? 'true' : 'false') . "\n";
    } else {
        echo "   - normalizer NÃO configurado\n";
    }
    
    echo "\nTESTE DE CRIAÇÃO DE URLs:\n";
    
    // Testa URLs com barras
    $testRoutes = [
        'categoria/index' => '/backend/web/categoria',
        'categoria/view' => '/backend/web/categoria/view',
        'categoria/view/123' => '/backend/web/categoria/view/123',
        'socio/index' => '/backend/web/socio',
        'socio/create' => '/backend/web/socio/create',
        'noticia/index' => '/backend/web/noticia',
        'parceiro/index' => '/backend/web/parceiro',
        'anunciante/index' => '/backend/web/anunciante',
        'pagina/index' => '/backend/web/pagina',
    ];
    
    foreach ($testRoutes as $route => $expectedUrl) {
        try {
            $url = $urlManager->createUrl($route);
            
            // Verifica se há %2F na URL (barras codificadas)
            if (strpos($url, '%2F') !== false) {
                $status = "❌ BARRAS CODIFICADAS";
                $problem = " (contém %2F)";
            } else {
                $status = "✅ OK";
                $problem = "";
            }
            
            echo sprintf("   %-25s -> %-20s [%s%s]\n", $route, $url, $status, $problem);
            
        } catch (Exception $e) {
            echo sprintf("   %-25s -> ERRO: %s\n", $route, $e->getMessage());
        }
    }
    
    echo "\nTESTE DE URLS ESPECÍFICAS:\n";
    
    // Testa URLs com parâmetros
    $testUrls = [
        ['route' => 'categoria/view', 'params' => ['id' => 123], 'expected' => '/backend/web/categoria/view/123'],
        ['route' => 'socio/update', 'params' => ['id' => 456], 'expected' => '/backend/web/socio/update/456'],
        ['route' => 'noticia/view', 'params' => ['id' => 789], 'expected' => '/backend/web/noticia/view/789'],
    ];
    
    foreach ($testUrls as $testData) {
        $route = $testData['route'];
        $params = $testData['params'];
        $expectedUrl = $testData['expected'];
        try {
            $url = $urlManager->createUrl(array_merge([$route], $params));
            
            if (strpos($url, '%2F') !== false) {
                $status = "❌ BARRAS CODIFICADAS";
                $problem = " (contém %2F)";
            } else {
                $status = "✅ OK";
                $problem = "";
            }
            
            echo sprintf("   %-25s -> %-20s [%s%s]\n", $route, $url, $status, $problem);
            
        } catch (Exception $e) {
            echo sprintf("   %-25s -> ERRO: %s\n", $route, $e->getMessage());
        }
    }
    
    echo "\nINSTRUÇÕES:\n";
    echo "1. Se você vê '❌ BARRAS CODIFICADAS', as URLs ainda estão com %2F\n";
    echo "2. Se você vê '✅ OK', as URLs estão corretas com /\n";
    echo "3. Teste no navegador: backend/web/categoria\n";
    echo "4. Teste no navegador: backend/web/socio/create\n";
    echo "5. URLs esperadas agora incluem '/backend/web/'\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}

echo "\n=== FIM DO TESTE ===\n"; 