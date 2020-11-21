#### Copy And Set Settings
```bash
cp .env.example .env
```
#### Set Permissions
```bash
chmod 755 /var/www/html 
chmod 755 /var/www/html/public
chmod 644 /var/www/html/public/index.php 
chmod -R 777 /var/www/html/storage 
chmod -R 777 /var/www/html/bootstrap/cache
```
#### Run Commands:
```bash
composer install
php artisan migrate --seed
php artisan storage:link
php artisan key:generate
php artisan config:cache
```
