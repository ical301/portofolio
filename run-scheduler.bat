@echo off
echo Task mulai: %date% %time% >> C:\xampp\htdocs\laravel7\task-log.txt
cd /d C:\xampp\htdocs\laravel7
start /b C:\xampp\php\php.exe artisan schedule:run >> C:\xampp\htdocs\laravel7\laravel-scheduler.log 2>&1
echo Task selesai: %date% %time% >> C:\xampp\htdocs\laravel7\task-log.txt
