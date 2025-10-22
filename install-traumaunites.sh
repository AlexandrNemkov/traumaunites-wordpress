#!/bin/bash

# TraumaUnites WordPress Cloud-Init Script
# Автоматическая установка и настройка сервера для проекта TraumaUnites

echo "🏥 Начинаем установку TraumaUnites WordPress..."

# Обновляем систему
apt update && apt upgrade -y

# Устанавливаем необходимые пакеты
apt install -y nginx php8.1 php8.1-fpm php8.1-mysql php8.1-curl php8.1-gd \
    php8.1-mbstring php8.1-xml php8.1-zip mariadb-server mariadb-client \
    git curl unzip wget certbot python3-certbot-nginx ufw

# Запускаем и включаем сервисы
systemctl start mariadb php8.1-fpm nginx
systemctl enable mariadb php8.1-fpm nginx

# Настраиваем MariaDB
mysql -e "CREATE DATABASE traumaunites_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -e "CREATE USER 'traumaunites'@'localhost' IDENTIFIED BY 'TraumaUnites2024!';"
mysql -e "GRANT ALL PRIVILEGES ON traumaunites_db.* TO 'traumaunites'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"

# Создаем директории
mkdir -p /var/www/traumaunites
cd /var/www/traumaunites

# Клонируем проект
git clone https://github.com/AlexandrNemkov/traumaunites-wordpress.git .

# Настраиваем права
chown -R www-data:www-data /var/www/traumaunites/wordpress
chmod -R 755 /var/www/traumaunites/wordpress

# Настраиваем PHP
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 64M/' /etc/php/8.1/fpm/php.ini
sed -i 's/post_max_size = 8M/post_max_size = 64M/' /etc/php/8.1/fpm/php.ini
sed -i 's/memory_limit = 128M/memory_limit = 256M/' /etc/php/8.1/fpm/php.ini

# Создаем конфигурацию Nginx
cat > /etc/nginx/sites-available/traumaunites << 'EOF'
server {
    listen 80;
    server_name _;
    root /var/www/traumaunites/wordpress;
    index index.php index.html index.htm;
    
    server_tokens off;
    
    location / {
        try_files $uri $uri/ /index.php?$args;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }
    
    location ~ /\. {
        deny all;
    }
    
    client_max_body_size 64M;
}
EOF

# Активируем сайт
ln -sf /etc/nginx/sites-available/traumaunites /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default
nginx -t && systemctl reload nginx

# Настраиваем WordPress конфигурацию
cat > /var/www/traumaunites/wordpress/wp-config.php << 'EOF'
<?php
define('DB_NAME', 'traumaunites_db');
define('DB_USER', 'traumaunites');
define('DB_PASSWORD', 'TraumaUnites2024!');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

define('AUTH_KEY',         'traumaunites_auth_key_2024_secure_random_string');
define('SECURE_AUTH_KEY',  'traumaunites_secure_auth_key_2024_secure_random_string');
define('LOGGED_IN_KEY',    'traumaunites_logged_in_key_2024_secure_random_string');
define('NONCE_KEY',        'traumaunites_nonce_key_2024_secure_random_string');
define('AUTH_SALT',        'traumaunites_auth_salt_2024_secure_random_string');
define('SECURE_AUTH_SALT', 'traumaunites_secure_auth_salt_2024_secure_random_string');
define('LOGGED_IN_SALT',   'traumaunites_logged_in_salt_2024_secure_random_string');
define('NONCE_SALT',       'traumaunites_nonce_salt_2024_secure_random_string');

$table_prefix = 'wp_';

define('WP_DEBUG', false);
define('WP_MEMORY_LIMIT', '256M');
define('FS_METHOD', 'direct');
define('DISALLOW_FILE_EDIT', true);
define('WP_AUTO_UPDATE_CORE', false);

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';
EOF

# Устанавливаем WP-CLI
curl -O https://raw.githubusercontent.com/wp-cli/wp-cli/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
mv wp-cli.phar /usr/local/bin/wp

# Устанавливаем WordPress
cd /var/www/traumaunites/wordpress
sudo -u www-data wp core install \
  --url="http://$(curl -s ifconfig.me)" \
  --title="TraumaUnites Medical Center" \
  --admin_user="admin" \
  --admin_password="TraumaUnites2024!" \
  --admin_email="admin@traumaunites.com" \
  --skip-email

# Активируем тему
sudo -u www-data wp theme activate traumaunites

# Настраиваем постоянные ссылки
sudo -u www-data wp rewrite structure '/%postname%/'
sudo -u www-data wp rewrite flush

# Настраиваем firewall
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw --force enable

# Перезапускаем сервисы
systemctl restart php8.1-fpm nginx

# Создаем файл с информацией
SERVER_IP=$(curl -s ifconfig.me)
cat > /var/www/traumaunites/server-info.txt << EOF
TraumaUnites WordPress Server Setup Complete!

🌐 Сайт: http://$SERVER_IP
👤 Админка: http://$SERVER_IP/wp-admin
📧 Логин: admin
🔑 Пароль: TraumaUnites2024!

🗄️ База данных: traumaunites_db
👤 DB User: traumaunites
🔑 DB Password: TraumaUnites2024!

📁 Путь к проекту: /var/www/traumaunites
📝 Логи: /var/log/nginx/error.log
EOF

echo "✅ Установка завершена!"
echo "🌐 Сайт доступен по адресу: http://$SERVER_IP"
echo "👤 Админка: http://$SERVER_IP/wp-admin"
echo "📧 Логин: admin"
echo "🔑 Пароль: TraumaUnites2024!"
echo ""
echo "📄 Подробная информация в файле: /var/www/traumaunites/server-info.txt"
