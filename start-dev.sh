#!/bin/bash

# TraumaUnites WordPress Development Setup Script

echo "🏥 TraumaUnites WordPress Development Setup"
echo "=========================================="

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.0+ first."
    exit 1
fi

# Check if MySQL is running
if ! command -v mysql &> /dev/null; then
    echo "❌ MySQL is not installed. Please install MySQL first."
    exit 1
fi

echo "✅ PHP and MySQL are available"

# Navigate to WordPress directory
cd wordpress

# Check if wp-config.php exists
if [ ! -f "wp-config.php" ]; then
    echo "❌ wp-config.php not found. Please configure WordPress first."
    exit 1
fi

echo "✅ WordPress configuration found"

# Start PHP development server
echo "🚀 Starting WordPress development server..."
echo "📱 Open your browser and go to: http://localhost:8000"
echo "🔧 WordPress admin: http://localhost:8000/wp-admin"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

php -S localhost:8000
