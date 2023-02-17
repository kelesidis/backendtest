<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---
 Test task
===

#### A tour company has a range of products. Excursions, Custom Packages, Cruises and Transfers.Each product has booking limitation capacity i.e number of times it can be booked.A product considered available, if the number it has been booked is lower than its capacity, otherwise unavailable.



## Use Postgres as database.

Create the following tables:

Client
id, first_name, last_name, email, passport_num, gender, created_at, updated_at

Product
id, title, type, description, capacity, created_at, updated_at

Booking
id, client_id, product_id, booked_on, created_at, updated_at

Note:
Seed Client and Product tables. Create no less than 20 clients and 40 products.
Provide an api for a client to be able to book a product.

Provide an api for a client to book a product. A client can not book the same product twice.
Provide an api to return a list of all the bookings. Each displayed booking should have a field which identifies if it is available or unavailable.
- Available if number of bookings < capacity
- Unavailable if number of bookings >= capacity


---
## Tech stack
Laravel 10
---
Installation instructions
===
1) Copy .env.example rename to .env
2) config .env(DB_DATABASE,DB_USERNAME,DB_PASSWORD)
3) composer install
4) php artisan migrate
5) php artisan db:seed
6) php artisan key:generate
7) php artisan serve



---
 Available API
+ GET http://127.0.0.1:8000/api/bookings
+ POST http://127.0.0.1:8000/api/bookings 
(client_id,product_id,booked_on)
