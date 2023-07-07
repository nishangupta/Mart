# Mart Laravel

## 環境需求

- PHP 8.1+
- Laravel 10+

## 安裝

Clone 到本地後，執行 Composer 安裝套件

```
composer install
```

複製 `.env` 並產生 key

```
cp .env.example .env
php artisan key:generate
```

設定資料庫，已有設定好 Docker Compose，可以直接透過指令啟動：

```
docker-compose up -d
```

執行 Migration

```
php artisan migrate:fresh --seed
```

執行 PHP built-in 伺服器

```
php artisan serve
```

打開 http://localhost:8000 即可看到首頁。打開 http://localhost:8000/admin/login 可登入後台 

預設帳號如下，密碼統一為 `password`

```
# 管理員
admin@2023.laravelconf.tw

# 一般帳號
miles@2023.laravelconf.tw
nathan@2023.laravelconf.tw
ban@2023.laravelconf.tw
```
