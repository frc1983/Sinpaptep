<?php
/**
 * Script de verificação para servidor Locaweb
 * Coloque este arquivo na raiz do site e acesse via navegador
 */

echo "<h1>Verificação do Servidor Locaweb</h1>";

// Verifica versão do PHP
echo "<h2>1. Informações do PHP</h2>";
echo "Versão do PHP: " . phpversion() . "<br>";
echo "SAPI: " . php_sapi_name() . "<br>";
echo "Extensões carregadas: " . implode(', ', get_loaded_extensions()) . "<br>";

// Verifica extensões necessárias
echo "<h2>2. Extensões Necessárias</h2>";
$required_extensions = array('pdo', 'pdo_mysql', 'mbstring', 'openssl', 'curl');
foreach ($required_extensions as $ext) {
    echo "$ext: " . (extension_loaded($ext) ? "✅ OK" : "❌ FALTANDO") . "<br>";
}

// Verifica permissões de diretórios
echo "<h2>3. Permissões de Diretórios</h2>";
$dirs_to_check = array(
    'runtime',
    'backend/runtime',
    'frontend/runtime',
    'web/assets',
    'backend/web/assets',
    'frontend/web/assets'
);

foreach ($dirs_to_check as $dir) {
    if (file_exists($dir)) {
        $writable = is_writable($dir);
        echo "$dir: " . ($writable ? "✅ Gravável" : "❌ Não gravável") . "<br>";
    } else {
        echo "$dir: ❌ Não existe<br>";
    }
}

// Verifica arquivos de configuração
echo "<h2>4. Arquivos de Configuração</h2>";
$config_files = array(
    'vendor/autoload.php',
    'common/config/main.php',
    'frontend/config/main.php',
    'frontend/web/index.php'
);

foreach ($config_files as $file) {
    if (file_exists($file)) {
        echo "$file: ✅ Existe<br>";
    } else {
        echo "$file: ❌ Não existe<br>";
    }
}

// Testa conexão com banco de dados
echo "<h2>5. Teste de Conexão com Banco</h2>";
try {
    $pdo = new PDO(
        'mysql:host=186.202.152.152;port=3306;dbname=sinpaptep;charset=utf8mb4',
        'sinpaptep',
        'b3+T/geK,c9yx8'
    );
    echo "Conexão com banco: ✅ OK<br>";
    
    // Testa uma query simples
    $stmt = $pdo->query("SELECT 1");
    echo "Query de teste: ✅ OK<br>";
    
} catch (PDOException $e) {
    echo "Erro na conexão: ❌ " . $e->getMessage() . "<br>";
}

// Verifica módulos Apache
echo "<h2>6. Módulos Apache</h2>";
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    $required_modules = array('mod_rewrite', 'mod_headers', 'mod_deflate');
    
    foreach ($required_modules as $module) {
        echo "$module: " . (in_array($module, $modules) ? "✅ Ativo" : "❌ Inativo") . "<br>";
    }
} else {
    echo "Função apache_get_modules não disponível<br>";
}

// Verifica configurações do PHP
echo "<h2>7. Configurações do PHP</h2>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";
echo "max_execution_time: " . ini_get('max_execution_time') . "<br>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";

// Testa se o Yii2 pode ser carregado
echo "<h2>8. Teste do Yii2</h2>";
try {
    if (file_exists('vendor/autoload.php')) {
        require 'vendor/autoload.php';
        require 'vendor/yiisoft/yii2/Yii.php';
        echo "Yii2 autoload: ✅ OK<br>";
    } else {
        echo "Yii2 autoload: ❌ Vendor não encontrado<br>";
    }
} catch (Exception $e) {
    echo "Erro ao carregar Yii2: ❌ " . $e->getMessage() . "<br>";
}

echo "<h2>9. Logs de Erro</h2>";
$log_files = array(
    'runtime/logs/app.log',
    'backend/runtime/logs/app.log',
    'frontend/runtime/logs/app.log'
);

foreach ($log_files as $log) {
    if (file_exists($log)) {
        $size = filesize($log);
        echo "$log: ✅ Existe (" . number_format($size) . " bytes)<br>";
        
        if ($size > 0) {
            echo "<strong>Últimas 5 linhas:</strong><br>";
            $lines = file($log);
            $last_lines = array_slice($lines, -5);
            echo "<pre>" . implode('', $last_lines) . "</pre>";
        }
    } else {
        echo "$log: ❌ Não existe<br>";
    }
}

echo "<hr>";
echo "<p><strong>Para resolver problemas:</strong></p>";
echo "<ol>";
echo "<li>Se algum diretório não for gravável, configure permissões 755 ou 775</li>";
echo "<li>Se o vendor não existir, execute: composer install</li>";
echo "<li>Se houver erros de banco, verifique as credenciais</li>";
echo "<li>Se módulos Apache estiverem inativos, contate o suporte da Locaweb</li>";
echo "</ol>";
?> 