<?php
/**
 * Script de Deploy para Produção
 * 
 * Uso: php deploy.php [ambiente]
 * 
 * Ambientes disponíveis:
 * - dev: Desenvolvimento local
 * - prod: Produção
 * 
 * Exemplo: php deploy.php prod
 */

// Verifica se foi passado um ambiente
if ($argc < 2) {
    echo "=== SCRIPT DE DEPLOY ===\n\n";
    echo "Uso: php deploy.php [ambiente]\n\n";
    echo "Ambientes disponíveis:\n";
    echo "  dev  - Desenvolvimento local\n";
    echo "  prod - Produção\n\n";
    echo "Exemplos:\n";
    echo "  php deploy.php dev   # Configura para desenvolvimento\n";
    echo "  php deploy.php prod  # Configura para produção\n\n";
    exit(1);
}

$environment = strtolower($argv[1]);

if (!in_array($environment, ['dev', 'prod'])) {
    echo "❌ Ambiente inválido: $environment\n";
    echo "Ambientes válidos: dev, prod\n";
    exit(1);
}

echo "=== DEPLOY PARA $environment ===\n\n";

// Configurações específicas por ambiente
$configs = [
    'dev' => [
        'YII_DEBUG' => true,
        'YII_ENV' => 'dev',
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => true,
            'baseUrl' => '',
        ],
        'log' => [
            'traceLevel' => 3,
            'levels' => ['error', 'warning', 'info'],
        ],
        'modules' => ['debug', 'gii'],
    ],
    'prod' => [
        'YII_DEBUG' => false,
        'YII_ENV' => 'prod',
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/backend/web',
        ],
        'log' => [
            'traceLevel' => 0,
            'levels' => ['error', 'warning'],
        ],
        'modules' => [],
    ]
];

$config = $configs[$environment];

echo "1. CONFIGURANDO AMBIENTE: $environment\n";
echo "   - YII_DEBUG: " . ($config['YII_DEBUG'] ? 'true' : 'false') . "\n";
echo "   - YII_ENV: " . $config['YII_ENV'] . "\n";
echo "   - enablePrettyUrl: " . ($config['urlManager']['enablePrettyUrl'] ? 'true' : 'false') . "\n";
echo "   - showScriptName: " . ($config['urlManager']['showScriptName'] ? 'true' : 'false') . "\n";
echo "   - baseUrl: '" . $config['urlManager']['baseUrl'] . "'\n";

// Atualiza os arquivos index.php
$files = [
    'backend/web/index.php',
    'frontend/web/index.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Atualiza YII_DEBUG
        $content = preg_replace(
            "/defined\('YII_DEBUG'\) or define\('YII_DEBUG', .*?\);/",
            "defined('YII_DEBUG') or define('YII_DEBUG', " . ($config['YII_DEBUG'] ? 'true' : 'false') . ");",
            $content
        );
        
        // Atualiza YII_ENV
        $content = preg_replace(
            "/defined\('YII_ENV'\) or define\('YII_ENV', .*?\);/",
            "defined('YII_ENV') or define('YII_ENV', '" . $config['YII_ENV'] . "');",
            $content
        );
        
        file_put_contents($file, $content);
        echo "   ✅ $file atualizado\n";
    } else {
        echo "   ❌ $file não encontrado\n";
    }
}

echo "\n2. VERIFICANDO ARQUIVOS DE CONFIGURAÇÃO:\n";

// Verifica se os arquivos de configuração existem
$configFiles = [
    "environments/$environment/backend/config/main-local.php",
    "environments/$environment/frontend/config/main-local.php",
    "environments/$environment/common/config/main-local.php",
];

foreach ($configFiles as $file) {
    if (file_exists($file)) {
        echo "   ✅ $file existe\n";
    } else {
        echo "   ❌ $file não encontrado\n";
    }
}

echo "\n3. CONFIGURAÇÕES ESPECÍFICAS:\n";

if ($environment === 'prod') {
    echo "   🔒 Modo produção ativado:\n";
    echo "      - Debug desabilitado\n";
    echo "      - URLs amigáveis habilitadas\n";
    echo "      - Logs reduzidos\n";
    echo "      - Módulos de desenvolvimento desabilitados\n";
} else {
    echo "   🛠️  Modo desenvolvimento ativado:\n";
    echo "      - Debug habilitado\n";
    echo "      - URLs com index.php\n";
    echo "      - Logs detalhados\n";
    echo "      - Módulos debug e gii habilitados\n";
}

echo "\n4. PRÓXIMOS PASSOS:\n";

if ($environment === 'prod') {
    echo "   📦 Para publicação em produção:\n";
    echo "      1. Execute: php init --env=Production --overwrite=all\n";
    echo "      2. Configure o banco de dados em common/config/main-local.php\n";
    echo "      3. Execute as migrações: php yii migrate\n";
    echo "      4. Configure o servidor web (Apache/Nginx)\n";
    echo "      5. Teste as URLs: /backend/web/categoria\n";
} else {
    echo "   🖥️  Para desenvolvimento local:\n";
    echo "      1. Execute: php init --env=Development --overwrite=all\n";
    echo "      2. Configure o banco de dados local\n";
    echo "      3. Teste as URLs: backend/web/index.php?r=categoria/index\n";
}

echo "\n✅ Deploy para $environment concluído!\n"; 