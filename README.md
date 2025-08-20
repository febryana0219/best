# Ricwil Laravel 9

Update versi laravel dari yang sebelumnya laravel 5

## Fitur

- Untuk fitur selebihnya sama dengan aplikasi sebelumnya hanya saja ada beberapa penyesuaian serta penambahan kompres upload gambar
## Prasyarat

Sebelum memulai, pastikan Anda memiliki hal berikut:

- PHP >= 8.0
- Composer
- Database MySQ

## Instalasi
1. Jalankan perintah berikut
```
composer install
npm install
```

2. Copy .env.example
```
cp .env.example .env
```

3. Setting DB
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ricwil
DB_USERNAME=root
DB_PASSWORD=
```

4. Generate aplikasi key
```
php artisan key:generate
```

5. Jalankan project
```
php artisan serve
```

