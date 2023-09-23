# LOOP Backend Developer Test


The API Webshop

## Installation

Create New Laravel Project ( used laravel 9.x | MySql )
```bash
composer create-project laravel/laravel:^9.0 project-folder
```

## Follow Steps

```Step 1.```

Download Source Code
Install dependencies ( composer install )

Updated ```.env``` file and add correct database details

Download customers.csv & products.csv and put under ```/public/import ``` directory

```Step 2.```

Open terminal and run below commands
```bash
php artisan key:generate
```
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
```bash
php artisan import:customers 
```
```bash
php artisan import:products 
```
```bash
php artisan serve
```

```Step3.```

Import POSTMAN API Collection

Added collection under ```/public/api-collection``` folder

```Step4.```

Run Create Order API


```Step5.```


Run Add Product to Order API

```Step6.```

Run Payment API

```Step7.```

Try to add product on completed order, it won't allow to add product once order processed for payment

## License

[MIT](https://choosealicense.com/licenses/mit/)