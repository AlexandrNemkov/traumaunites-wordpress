#!/bin/bash

# TraumaUnites WordPress Theme Setup Script
# Для работы с предустановленным WordPress на Timeweb Cloud

echo "🏥 Настройка TraumaUnites темы для предустановленного WordPress..."

# Обновляем систему
apt update && apt upgrade -y

# Устанавливаем дополнительные пакеты
apt install -y git curl unzip wget ufw

# Создаем директории для проекта
mkdir -p /var/www/traumaunites
cd /var/www/traumaunites

# Клонируем проект из GitHub
git clone https://github.com/AlexandrNemkov/traumaunites-wordpress.git .

# Копируем кастомную тему в WordPress
cp -r /var/www/traumaunites/wordpress/wp-content/themes/traumaunites /var/www/html/wp-content/themes/
chown -R www-data:www-data /var/www/html/wp-content/themes/traumaunites
chmod -R 755 /var/www/html/wp-content/themes/traumaunites

# Настраиваем права доступа
find /var/www/traumaunites -type d -exec chmod 755 {} \;
find /var/www/traumaunites -type f -exec chmod 644 {} \;

# Переходим в директорию WordPress
cd /var/www/html

# Скачиваем WP-CLI если его нет
if ! command -v wp &> /dev/null; then
    curl -O https://raw.githubusercontent.com/wp-cli/wp-cli/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar
    mv wp-cli.phar /usr/local/bin/wp
fi

# Активируем тему TraumaUnites
sudo -u www-data wp theme activate traumaunites

# Настраиваем постоянные ссылки
sudo -u www-data wp rewrite structure '/%postname%/'
sudo -u www-data wp rewrite flush

# Создаем необходимые страницы если их нет
sudo -u www-data wp post create --post_type=page --post_title="About Us" --post_name="about" --post_status=publish --porcelain || echo "Страница About Us уже существует"
sudo -u www-data wp post create --post_type=page --post_title="Services" --post_name="services" --post_status=publish --porcelain || echo "Страница Services уже существует"
sudo -u www-data wp post create --post_type=page --post_title="Contact" --post_name="contact" --post_status=publish --porcelain || echo "Страница Contact уже существует"

# Настраиваем firewall
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw --force enable

# Создаем файл с информацией
SERVER_IP=$(curl -s ifconfig.me)
cat > /var/www/traumaunites/server-info.txt << EOF
TraumaUnites Theme Setup Complete!

🌐 Сайт: http://$SERVER_IP
👤 WordPress Admin: http://$SERVER_IP/wp-admin
🎨 Тема: TraumaUnites активирована

📁 Путь к проекту: /var/www/traumaunites
🎨 Путь к теме: /var/www/html/wp-content/themes/traumaunites

📝 Логи Nginx: /var/log/nginx/error.log
📝 Логи Apache: /var/log/apache2/error.log
EOF

echo "✅ Настройка завершена!"
echo "🌐 Сайт доступен по адресу: http://$SERVER_IP"
echo "👤 WordPress админка: http://$SERVER_IP/wp-admin"
echo "🎨 Тема TraumaUnites активирована"
echo ""
echo "📄 Подробная информация в файле: /var/www/traumaunites/server-info.txt"
