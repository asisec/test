<?php
/**
 * WERK BISINESS - TEXTILE FORUM TURBO DEPLOYMENT AGENT
 */

$secret_token = "TextileForumSecret2026!"; 

if (!isset($_GET['token']) || $_GET['token'] !== $secret_token) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Yetkisiz Erişim! Werk Bisiness koruması devrede.';
    exit;
}

$root_dir = '/home/textileforum/htdocs/textileforum.net';
$core_dir = $root_dir . '/public_html/core';

echo "<h2>🚀 Turbo Dağıtım Başlatıldı...</h2>";

// 1. AŞAMA: GitHub'dan yeni kodları çek
chdir($root_dir);
$git_output = shell_exec('git pull origin main 2>&1');
echo "<h3>🔄 Git Çıktısı:</h3><pre>$git_output</pre>";

// 2. AŞAMA: Laravel Core dizinine geç ve tüm önbelleği (Cache) parçala
chdir($core_dir);
$artisan_output = shell_exec('php artisan optimize:clear 2>&1');
echo "<h3>🧹 Laravel Cache Temizliği:</h3><pre>$artisan_output</pre>";

echo "<p>✅ İşlem Tamamlandı! Sistem ve arayüz artık %100 güncel.</p>";