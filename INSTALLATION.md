# Installation Guide

## Prerequisites

See [Laravel prerequisites](https://laravel.com/docs/8.x/installation#server-requirements)

## Installation

### Clone the repository

```bash
git clone https://github.com/Davpyu/asset-management/
```

### Open your project

```bash
cd '\path\to\your\project'
```

### Installing Laravel Dependencies

```bash
composer install
```

### Copy .env

Windows
```bash
copy .env.example .env 
```
Linux
```bash
cp .env.example .env 
```

### Generate key

```bash
php artisan key:generate
```

### Setting database:

Make your database and update these setting in .env file

* DB_DATABASE (your local database, i.e. "asset")
* DB_USERNAME (your local db username, i.e. "root")
* DB_PASSWORD (your local db password, i.e. "")

### Run your server

```bash
php artisan serve
```

### Migrate your database

```bash
php artisan migrate
```

### Import Postman API
Import [this](postman/Asset.postman_collection.json) and [this](postman/Asset.postman_environment.json) on Postman