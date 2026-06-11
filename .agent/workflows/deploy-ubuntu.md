---
description: Steps to deploy the Atlantic Cocoa Corporation platform on an Ubuntu server
---

Follow these steps to deploy the application on a fresh Ubuntu 22.04+ server.

### 1. System Preparation

// turbo
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl php8.2-mbstring php8.2-zip php8.2-gd php8.2-bcmath php8.2-intl unzip nginx mysql-server nodejs npm
```

### 2. Database Configuration

// turbo
```bash
sudo mysql -e "CREATE DATABASE acc_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sudo mysql -e "CREATE USER 'acc_user'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD';"
sudo mysql -e "GRANT ALL PRIVILEGES ON acc_db.* TO 'acc_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"
```

### 3. Application Deployment

// turbo
```bash
cd /var/www
sudo git clone https://github.com/your-repo/acc-share.git acc
cd acc
sudo composer install --no-dev --optimize-autoloader
sudo cp .env.example .env
```

### 4. Configuration

Edit the `.env` file to set production values:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://your-domain.com`
- `DB_DATABASE=acc_db`
- `DB_USERNAME=acc_user`
- `DB_PASSWORD=STRONG_PASSWORD`

// turbo
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Frontend Assets

// turbo
```bash
npm install
npm run build
```

### 6. Permissions

// turbo
```bash
sudo chown -R www-data:www-data /var/www/acc/storage /var/www/acc/bootstrap/cache
sudo chmod -R 775 /var/www/acc/storage /var/www/acc/bootstrap/cache
```

### 7. Nginx Configuration

Create `/etc/nginx/sites-available/acc`:
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/acc/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable the site:
// turbo
```bash
sudo ln -s /etc/nginx/sites-available/acc /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```
