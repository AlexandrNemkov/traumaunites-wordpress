#!/bin/bash

# Скрипт для обновления квиза на сервере
echo "🔄 Обновляем квиз на сервере..."

# Переходим в директорию темы
cd /var/www/html/wordpress/wp-content/themes/traumaunites

# Скачиваем обновленные файлы
echo "📥 Скачиваем обновленные файлы..."
wget -q https://raw.githubusercontent.com/AlexandrNemkov/traumaunites-wordpress/main/wordpress/wp-content/themes/traumaunites/assets/js/survey.js -O assets/js/survey.js
wget -q https://raw.githubusercontent.com/AlexandrNemkov/traumaunites-wordpress/main/wordpress/wp-content/themes/traumaunites/functions.php -O functions.php

# Настраиваем права
echo "🔐 Настраиваем права доступа..."
chown -R www-data:www-data assets/js/survey.js functions.php
chmod 644 assets/js/survey.js functions.php

echo "✅ Квиз обновлен! Обновите страницу в браузере."
echo "🌐 Сайт: http://$(curl -s ifconfig.me)/wordpress/"

