# BioAqua Lab — Setup Instructions

## 1. Install dependencies
```bash
composer install
npm install && npm run build
```

## 2. Setup .env
```bash
cp .env.example .env
php artisan key:generate
```
Set DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env

## 3. Run migrations & seed
```bash
php artisan migrate:fresh --seed
```

## 4. Create storage symlink (untuk foto produk)
```bash
php artisan storage:link
```

## 5. Run server
```bash
php artisan serve
```

## Login Demo
- **Admin**: admin@bioaqua.lab / admin123
- **User**: user@bioaqua.lab / user123

Atau buka /login dan pilih role langsung (Quick Login).
