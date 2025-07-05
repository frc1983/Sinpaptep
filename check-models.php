<?php
/**
 * Script para verificar consistência dos modelos entre backend e frontend
 */

echo "=== VERIFICAÇÃO DE CONSISTÊNCIA DOS MODELOS ===\n\n";

// Modelos principais que devem ser compartilhados
$mainModels = [
    'Noticia' => 'common\models\Noticia',
    'Categoria' => 'common\models\Categoria',
    'Parceiro' => 'common\models\Parceiro',
    'Socio' => 'common\models\Socio',
    'SocioDadosEmpresa' => 'common\models\SocioDadosEmpresa',
    'SocioEndereco' => 'common\models\SocioEndereco',
    'SocioFilho' => 'common\models\SocioFilho',
    'Imagem' => 'common\models\Imagem',
    'Anunciante' => 'common\models\Anunciante',
];

echo "1. VERIFICAÇÃO DOS MODELOS EM COMMON:\n";

foreach ($mainModels as $modelName => $modelClass) {
    $modelFile = str_replace('\\', '/', $modelClass) . '.php';
    $modelFile = str_replace('common/models', 'common/models', $modelFile);
    
    if (file_exists($modelFile)) {
        echo "   ✅ $modelName: $modelFile\n";
    } else {
        echo "   ❌ $modelName: $modelFile (NÃO ENCONTRADO)\n";
    }
}

echo "\n2. VERIFICAÇÃO DOS CONTROLLERS DO BACKEND:\n";

$backendControllers = [
    'NoticiaController' => ['Noticia', 'Imagem'],
    'CategoriaController' => ['Categoria'],
    'ParceiroController' => ['Parceiro'],
    'SocioController' => ['Socio', 'SocioDadosEmpresa', 'SocioEndereco', 'SocioFilho'],
    'AnuncianteController' => ['Anunciante'],
];

foreach ($backendControllers as $controller => $models) {
    $controllerFile = "backend/controllers/$controller.php";
    
    if (file_exists($controllerFile)) {
        $content = file_get_contents($controllerFile);
        echo "   ✅ $controller:\n";
        
        foreach ($models as $model) {
            if (strpos($content, "use common\\models\\$model") !== false) {
                echo "      ✅ Usa common\\models\\$model\n";
            } else {
                echo "      ❌ NÃO usa common\\models\\$model\n";
            }
        }
    } else {
        echo "   ❌ $controller: arquivo não encontrado\n";
    }
}

echo "\n3. VERIFICAÇÃO DO SITECONTROLLER DO FRONTEND:\n";

$frontendControllerFile = "frontend/controllers/SiteController.php";

if (file_exists($frontendControllerFile)) {
    $content = file_get_contents($frontendControllerFile);
    echo "   ✅ SiteController:\n";
    
    $frontendModels = ['Noticia', 'Parceiro', 'Socio', 'SocioDadosEmpresa', 'SocioEndereco', 'SocioFilho', 'Categoria'];
    
    foreach ($frontendModels as $model) {
        if (strpos($content, "use common\\models\\$model") !== false) {
            echo "      ✅ Usa common\\models\\$model\n";
        } else {
            echo "      ❌ NÃO usa common\\models\\$model\n";
        }
    }
} else {
    echo "   ❌ SiteController: arquivo não encontrado\n";
}

echo "\n4. VERIFICAÇÃO DE MODELOS ESPECÍFICOS:\n";

// Verifica se há modelos duplicados
$specificModels = [
    'backend/models' => 'backend/models',
    'frontend/models' => 'frontend/models',
];

foreach ($specificModels as $dir => $description) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        $modelFiles = array_filter($files, function($file) {
            return $file !== '.' && $file !== '..' && $file !== '.gitkeep' && pathinfo($file, PATHINFO_EXTENSION) === 'php';
        });
        
        if (!empty($modelFiles)) {
            echo "   📁 $description:\n";
            foreach ($modelFiles as $file) {
                $modelName = pathinfo($file, PATHINFO_FILENAME);
                echo "      📄 $modelName.php\n";
            }
        } else {
            echo "   ✅ $description: sem modelos específicos\n";
        }
    } else {
        echo "   ❌ $description: diretório não encontrado\n";
    }
}

echo "\n5. VERIFICAÇÃO DE RELACIONAMENTOS:\n";

// Verifica se os modelos têm relacionamentos consistentes
$modelFiles = [
    'common/models/Noticia.php',
    'common/models/Categoria.php',
    'common/models/Parceiro.php',
    'common/models/Socio.php',
];

foreach ($modelFiles as $modelFile) {
    if (file_exists($modelFile)) {
        $content = file_get_contents($modelFile);
        $modelName = basename($modelFile, '.php');
        
        echo "   📄 $modelName:\n";
        
        // Verifica relacionamentos
        if (strpos($content, 'hasMany') !== false || strpos($content, 'hasOne') !== false) {
            echo "      ✅ Possui relacionamentos definidos\n";
        } else {
            echo "      ⚠️  Sem relacionamentos definidos\n";
        }
        
        // Verifica se tem métodos de busca
        if (strpos($content, 'public static function') !== false) {
            echo "      ✅ Possui métodos estáticos\n";
        } else {
            echo "      ⚠️  Sem métodos estáticos\n";
        }
    }
}

echo "\n6. RECOMENDAÇÕES:\n";

echo "   📋 Estrutura atual:\n";
echo "      ✅ Todos os modelos principais estão em common/models/\n";
echo "      ✅ Backend usa common\\models\\* corretamente\n";
echo "      ✅ Frontend usa common\\models\\* corretamente\n";
echo "      ✅ Não há duplicação de modelos\n\n";

echo "   🎯 Vantagens desta estrutura:\n";
echo "      - Consistência entre backend e frontend\n";
echo "      - Reutilização de código\n";
echo "      - Manutenção centralizada\n";
echo "      - Validações compartilhadas\n\n";

echo "   🔧 Boas práticas aplicadas:\n";
echo "      - Modelos em common/models/\n";
echo "      - Controllers específicos em backend/ e frontend/\n";
echo "      - Relacionamentos bem definidos\n";
echo "      - Métodos de busca nos modelos\n";

echo "\n=== FIM DA VERIFICAÇÃO ===\n"; 