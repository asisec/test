#!/bin/bash
set -e

# ============================================
# Textile Forum — Composer Hazırlık Scripti
# ============================================
# Erişilemeyen GitHub repolarına sahip paketleri
# composer.json'dan kaldırır ve stub oluşturur.
# ============================================

CORE_DIR="/var/www/html/public_html/core"
cd "$CORE_DIR"

echo "🔧 [1/5] Erişilemeyen paketler composer.json'dan kaldırılıyor..."

# xgenious/paymentgateway kaldır (cinetpay/cinetpay-php onun alt bağımlılığı, otomatik kalkar)
php -r "
\$c = json_decode(file_get_contents('composer.json'), true);
unset(\$c['require']['xgenious/paymentgateway']);
file_put_contents('composer.json', json_encode(\$c, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo \"   ✅ xgenious/paymentgateway kaldırıldı\n\";
"

echo "🔧 [2/5] composer.lock siliniyor (yeniden çözümleme için)..."
rm -f composer.lock

echo "🔧 [3/5] Composer update çalıştırılıyor..."
composer update \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --no-scripts

echo "🔧 [4/5] Kaldırılan paketler için stub oluşturuluyor..."

# --- cinetpay/cinetpay-php stub ---
mkdir -p vendor/cinetpay/cinetpay-php/src/CinetPay
cat > vendor/cinetpay/cinetpay-php/composer.json << 'STUB'
{"name":"cinetpay/cinetpay-php","version":"1.9.2","description":"stub","autoload":{"psr-0":{"CinetPay":"src/"}}}
STUB
cat > vendor/cinetpay/cinetpay-php/src/CinetPay/CinetPay.php << 'STUB'
<?php
namespace CinetPay;
class CinetPay {
    public function __construct() {}
    public function __call($name, $args) { return null; }
    public static function __callStatic($name, $args) { return null; }
}
STUB

# --- xgenious/paymentgateway stub ---
mkdir -p vendor/xgenious/paymentgateway/src/{Providers,Base,Facades}
cat > vendor/xgenious/paymentgateway/composer.json << 'STUB'
{"name":"xgenious/paymentgateway","version":"v4.19.0","description":"stub","autoload":{"psr-4":{"Xgenious\\Paymentgateway\\":"src/"}},"extra":{"laravel":{"providers":["Xgenious\\Paymentgateway\\Providers\\PaymentgatewayServiceProvider"]}}}
STUB
cat > vendor/xgenious/paymentgateway/src/Providers/PaymentgatewayServiceProvider.php << 'STUB'
<?php
namespace Xgenious\Paymentgateway\Providers;
use Illuminate\Support\ServiceProvider;
class PaymentgatewayServiceProvider extends ServiceProvider {
    public function register() {}
    public function boot() {}
}
STUB
cat > vendor/xgenious/paymentgateway/src/Base/PaymentGatewayHelpers.php << 'STUB'
<?php
namespace Xgenious\Paymentgateway\Base;
class PaymentGatewayHelpers {
    public static function wrapped_id($id) { return $id; }
    public function __call($name, $args) { return null; }
    public static function __callStatic($name, $args) { return null; }
}
STUB
cat > vendor/xgenious/paymentgateway/src/Base/XgPaymentGateway.php << 'STUB'
<?php
namespace Xgenious\Paymentgateway\Base;
class XgPaymentGateway {
    public function __call($name, $args) { return $this; }
    public static function __callStatic($name, $args) { return new static; }
}
STUB
cat > vendor/xgenious/paymentgateway/src/Facades/XgPaymentGateway.php << 'STUB'
<?php
namespace Xgenious\Paymentgateway\Facades;
use Illuminate\Support\Facades\Facade;
class XgPaymentGateway extends Facade {
    protected static function getFacadeAccessor() { return 'XgPaymentGateway'; }
}
STUB

echo "🔧 [5/5] Autoload yeniden oluşturuluyor..."
composer dump-autoload --optimize --no-dev --no-interaction

echo "✅ Composer hazırlık tamamlandı!"
