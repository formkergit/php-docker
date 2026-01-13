<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup</title>
        <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

<?php
define('DB_HOST', 'db');
define('DB_NAME', 'taxis');
define('DB_USER', 'root');
define('DB_PASS', 'root');

$backupDir = __DIR__ . '/backups';

if (!is_dir($backupDir)):
    mkdir($backupDir, 0755, true);
endif;

$filename = 'backup-' . DB_NAME . '-' . date('d-m-Y_H-i-s') . '.sql';
$filepath = $backupDir . '/' . $filename;

$command = sprintf(
    'MYSQL_PWD=%s mysqldump -h%s -u%s --skip-ssl %s > %s 2>&1',
    escapeshellarg(DB_PASS),
    escapeshellarg(DB_HOST),
    escapeshellarg(DB_USER),
    escapeshellarg(DB_NAME),
    escapeshellarg($filepath)
);

exec($command, $output, $returnCode);

exec($command, $output, $returnCode);

if ($returnCode === 0 && file_exists($filepath)) {
    $size = filesize($filepath);
    echo "<h2>Backup Réusssi: {$filename} (" . round($size/1024, 2) . " KB)</h2>";
} else {
    http_response_code(500);
    echo "<h1>Echec Backup !!! : " . implode("\n", $output) . "</h1>";
}

?>
    
</body>
</html>