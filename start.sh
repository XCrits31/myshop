#!/bin/bash
echo "Запуск сервера Laravel и NPM..."
php artisan serve &> /dev/null &
npm run dev &> /dev/null &
echo "Сервер Laravel и NPM запущены"
