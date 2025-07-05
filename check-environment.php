<?php
/**
 * Script para verificar o ambiente atual
 * 
 * Uso: php check-environment.php
 */

echo "=== VERIFICAÇÃO DE AMBIENTE ===\n\n";

// Verifica os arquivos index.php
$files = [
    'backend/web/index.php' => 'Backend',
    'frontend/web/index.php' => 'Frontend',
];

echo "1. CONFIGURAÇÕES DOS ARQUIVOS INDEX.PHP:\n";

foreach ($files as $file => $name) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Extrai YII_DEBUG
        preg_match("/YII_DEBUG.*?define\('YII_DEBUG', (.*?)\)/", $content, $debugMatch);
        $debug = isset($debugMatch[1]) ? trim($debugMatch[1]) : 'não encontrado';
        
        // Extrai YII_ENV
        preg_match("/YII_ENV.*?define\('YII_ENV', '(.*?)'/", $content, $envMatch);
        $env = isset($envMatch[1]) ? $envMatch[1] : 'não encontrado';
        
        echo "   $name:\n";
        echo "      YII_DEBUG: $debug\n";
        echo "      YII_ENV: $env\n";
        
        // Determina o ambiente
        if ($debug === 'true' && $env === 'dev') {
            echo "      Status: 🛠️  DESENVOLVIMENTO\n";
        } elseif ($debug === 'false' && $env === 'prod') {
            echo "      Status: 🚀 PRODUÇÃO\n";
        } else {
            echo "      Status: ⚠️  CONFIGURAÇÃO MISTA\n";
        }
        
    } else {
        echo "   $name: ❌ Arquivo não encontrado\n";
    }
}

echo "\n2. VERIFICAÇÃO DE CONFIGURAÇÕES:\n";

// Verifica configurações específicas
$configFiles = [
    'backend/config/main-local.php' => 'Backend Local',
    'frontend/config/main-local.php' => 'Frontend Local',
    'common/config/main-local.php' => 'Common Local',
];

foreach ($configFiles as $file => $name) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Verifica enablePrettyUrl
        if (strpos($content, "'enablePrettyUrl' => true") !== false) {
            $prettyUrl = "✅ Habilitado";
        } elseif (strpos($content, "'enablePrettyUrl' => false") !== false) {
            $prettyUrl = "❌ Desabilitado";
        } else {
            $prettyUrl = "⚠️  Não configurado";
        }
        
        // Verifica baseUrl
        if (strpos($content, "'baseUrl' => '/backend/web'") !== false) {
            $baseUrl = "/backend/web";
        } elseif (strpos($content, "'baseUrl' => ''") !== false) {
            $baseUrl = "vazio";
        } else {
            $baseUrl = "⚠️  Não configurado";
        }
        
        echo "   $name:\n";
        echo "      enablePrettyUrl: $prettyUrl\n";
        echo "      baseUrl: $baseUrl\n";
        
    } else {
        echo "   $name: ❌ Arquivo não encontrado\n";
    }
}

echo "\n3. VERIFICAÇÃO DE MÓDULOS:\n";

// Verifica se debug e gii estão ativos
$debugActive = false;
$giiActive = false;

foreach ($configFiles as $file => $name) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        if (strpos($content, "'debug'") !== false) {
            $debugActive = true;
        }
        
        if (strpos($content, "'gii'") !== false) {
            $giiActive = true;
        }
    }
}

echo "   Debug Module: " . ($debugActive ? "✅ Ativo" : "❌ Inativo") . "\n";
echo "   Gii Module: " . ($giiActive ? "✅ Ativo" : "❌ Inativo") . "\n";

echo "\n4. RECOMENDAÇÕES:\n";

// Analisa e recomenda
$hasDebug = false;
$hasPrettyUrl = false;

foreach ($files as $file => $name) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        if (strpos($content, "YII_DEBUG', true") !== false) {
            $hasDebug = true;
        }
        
        if (strpos($content, "YII_ENV', 'prod'") !== false) {
            $hasPrettyUrl = true;
        }
    }
}

if ($hasDebug && $debugActive) {
    echo "   🛠️  Ambiente de DESENVOLVIMENTO detectado\n";
    echo "      - Debug habilitado ✓\n";
    echo "      - Módulos de desenvolvimento ativos ✓\n";
    echo "      - URLs com index.php ✓\n";
} elseif (!$hasDebug && !$debugActive) {
    echo "   🚀 Ambiente de PRODUÇÃO detectado\n";
    echo "      - Debug desabilitado ✓\n";
    echo "      - Módulos de desenvolvimento inativos ✓\n";
    echo "      - URLs amigáveis ✓\n";
} else {
    echo "   ⚠️  Configuração MISTA detectada\n";
    echo "      - Recomenda-se usar: php deploy.php dev\n";
    echo "      - Ou: php deploy.php prod\n";
}

echo "\n5. COMANDOS ÚTEIS:\n";
echo "   Para desenvolvimento: php deploy.php dev\n";
echo "   Para produção: php deploy.php prod\n";
echo "   Para verificar URLs: php test-backend-urls.php\n";

echo "\n=== FIM DA VERIFICAÇÃO ===\n"; 