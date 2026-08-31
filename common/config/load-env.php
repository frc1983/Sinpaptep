<?php
/**
 * Loads key=value pairs from the project-root .env into the process environment.
 * Existing getenv() values (Apache SetEnv, system env) are not overwritten.
 */
$envFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
if (!is_readable($envFile)) {
    return;
}

$lines = file($envFile, FILE_IGNORE_NEW_LINES);
if ($lines === false) {
    return;
}

foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || strpos($line, '#') === 0) {
        continue;
    }
    $eqPos = strpos($line, '=');
    if ($eqPos === false) {
        continue;
    }
    $name = trim(substr($line, 0, $eqPos));
    $value = trim(substr($line, $eqPos + 1));
    if ($name === '') {
        continue;
    }
    $length = strlen($value);
    if ($length >= 2) {
        $quote = $value[0];
        if (($quote === '"' || $quote === "'") && $value[$length - 1] === $quote) {
            $value = substr($value, 1, -1);
        }
    }
    if (getenv($name) === false) {
        putenv($name . '=' . $value);
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}
