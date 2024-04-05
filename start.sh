#!/bin/bash
php artisan serve &> /dev/null &
npm run dev &> /dev/null &
echo "ready"
