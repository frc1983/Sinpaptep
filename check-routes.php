<?php
/**
 * Script para testar rotas do backend
 * Execute: php check-routes.php
 */

// Simula o ambiente de produção
define('YII_DEBUG', false);
define('YII_ENV', 'prod');

// Inclui o autoloader do Composer
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

// Carrega as configurações
require __DIR__ . '/common/config/bootstrap.php';
require __DIR__ . '/backend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/common/config/main.php',
    require __DIR__ . '/common/config/main-local.php',
    require __DIR__ . '/backend/config/main.php',
    require __DIR__ . '/environments/prod/backend/config/main-local.php'
);

// Cria a aplicação
$app = new yii\web\Application($config);

echo "=== TESTE DE ROTAS DO BACKEND ===\n\n";

// Testa URLs amigáveis
$urlManager = $app->urlManager;
$urlManager->enablePrettyUrl = true;
$urlManager->showScriptName = false;

$testRoutes = [
    'site/index' => '/',
    'site/login' => '/login',
    'socio/index' => '/socio',
    'noticia/index' => '/noticia',
    'parceiro/index' => '/parceiro',
    'categoria/index' => '/categoria',
    'anunciante/index' => '/anunciante',
    'pagina/index' => '/pagina',
];

echo "Testando criação de URLs:\n";
foreach ($testRoutes as $route => $expectedUrl) {
    try {
        $url = $urlManager->createUrl($route);
        $status = ($url === $expectedUrl) ? "✅ OK" : "❌ ERRO";
        echo sprintf("%-20s -> %-15s [%s]\n", $route, $url, $status);
    } catch (Exception $e) {
        echo sprintf("%-20s -> ERRO: %s\n", $route, $e->getMessage());
    }
}

echo "\n=== CONFIGURAÇÕES ===\n";
echo "enablePrettyUrl: " . ($urlManager->enablePrettyUrl ? "true" : "false") . "\n";
echo "showScriptName: " . ($urlManager->showScriptName ? "true" : "false") . "\n";
echo "baseUrl: '" . $urlManager->baseUrl . "'\n";
echo "Rules count: " . count($urlManager->rules) . "\n";

echo "\n=== VERIFICAÇÕES DE ARQUIVOS ===\n";
$files = [
    'backend/web/.htaccess' => 'Arquivo .htaccess',
    'backend/config/main.php' => 'Configuração principal',
    'environments/prod/backend/config/main-local.php' => 'Configuração produção',
];

foreach ($files as $file => $description) {
    $exists = file_exists($file) ? "✅ Existe" : "❌ Não existe";
    echo sprintf("%-40s: %s\n", $description, $exists);
}

echo "\n=== TESTE DE REWRITE ===\n";
$htaccessContent = file_get_contents('backend/web/.htaccess');
if (strpos($htaccessContent, 'RewriteEngine On') !== false) {
    echo "✅ RewriteEngine está ativo\n";
} else {
    echo "❌ RewriteEngine não encontrado\n";
}

if (strpos($htaccessContent, 'RewriteRule . index.php [L]') !== false) {
    echo "✅ Regra de rewrite para index.php encontrada\n";
} else {
    echo "❌ Regra de rewrite para index.php não encontrada\n";
}

echo "\n=== FIM DO TESTE ===\n"; 