#!/bin/bash
set -e

# ============================================
# Textile Forum — Docker Entrypoint
# ============================================

CORE_DIR="/var/www/html/public_html/core"

echo "🚀 TextileForum Entrypoint başlatılıyor..."

# ----- .env kontrolü -----
if [ ! -f "$CORE_DIR/.env" ]; then
    echo "📋 .env dosyası bulunamadı, .env.docker kopyalanıyor..."
    cp /var/www/html/.env.docker "$CORE_DIR/.env"
fi

# ----- Storage dizin yapısını garanti et -----
echo "📁 Storage dizin yapısı kontrol ediliyor..."
mkdir -p "$CORE_DIR/storage/app/public"
mkdir -p "$CORE_DIR/storage/framework/cache/data"
mkdir -p "$CORE_DIR/storage/framework/sessions"
mkdir -p "$CORE_DIR/storage/framework/testing"
mkdir -p "$CORE_DIR/storage/framework/views"
mkdir -p "$CORE_DIR/storage/logs"
mkdir -p "$CORE_DIR/bootstrap/cache"

# ----- Upload dizinlerini garanti et -----
mkdir -p /var/www/html/public_html/assets/uploads/media-uploader
mkdir -p /var/www/html/public_html/assets/uploads/chat_image
mkdir -p /var/www/html/public_html/assets/images/banners
mkdir -p /var/www/html/public_html/assets/images/user/profile
mkdir -p /var/www/html/public_html/banner-resimleri

# ----- İzinleri ayarla -----
echo "🔐 Dosya izinleri ayarlanıyor..."
chown -R www-data:www-data "$CORE_DIR/storage"
chown -R www-data:www-data "$CORE_DIR/bootstrap/cache"
chown -R www-data:www-data /var/www/html/public_html/assets/uploads
chown -R www-data:www-data /var/www/html/public_html/assets/images
chown -R www-data:www-data /var/www/html/public_html/banner-resimleri
chmod -R 777 "$CORE_DIR/storage"
chmod -R 775 "$CORE_DIR/bootstrap/cache"

# ----- MySQL bağlantısını bekle -----
echo "⏳ MySQL bağlantısı bekleniyor..."
MAX_RETRIES=30
RETRY_COUNT=0
until mysqladmin ping -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --ssl-mode=DISABLED --silent 2>/dev/null; do
    RETRY_COUNT=$((RETRY_COUNT + 1))
    if [ $RETRY_COUNT -ge $MAX_RETRIES ]; then
        echo "❌ MySQL bağlantısı kurulamadı ($MAX_RETRIES deneme). Yine de devam ediliyor..."
        break
    fi
    echo "   Deneme $RETRY_COUNT/$MAX_RETRIES..."
    sleep 2
done

if [ $RETRY_COUNT -lt $MAX_RETRIES ]; then
    echo "✅ MySQL bağlantısı başarılı!"
fi

# ----- Laravel Cache Temizliği -----
echo "🧹 Laravel cache temizleniyor..."
cd "$CORE_DIR"
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true

# ----- Storage Link -----
echo "🔗 Storage link oluşturuluyor..."
php artisan storage:link 2>/dev/null || true

echo "✅ TextileForum hazır! Sunucu başlatılıyor..."

# Orijinal CMD'yi çalıştır
exec "$@"
