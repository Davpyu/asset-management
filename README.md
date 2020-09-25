# Asset Management

CRUD Asset with basic auth

## Table of Contents

* [Installation](INSTALLATION.md)
* [Features](#features)
* [Other Notes](#other-notes)

### Features

* [Users](#users)
* [Asset Management](#asset-management)

#### Users

* [Admin](#admin)
* [User](#user)

##### Admin

First, lets create an admin via command.

Run

```bash
php artisan make:admin
```

and follow it until done.

Now you can create other admin and do [asset management](#asset-management) too.

Make sure you have do [this](INSTALLATION.md#import-postman-api) and open Auth folder. There are login, register, forgot, logout, and user details inside that folder.

First, do login.

Second, go to Register and enable params role and fill them with admin/user.

Third, fill the body and send it.

##### User

Now, lets create regular user.

Make sure you have do [this](INSTALLATION.md#import-postman-api) and open Auth folder. There are login, register, forgot, logout, and user details inside that folder.

First, go to Register.

Second, fill the body and send it.

Finally, you automatically logged in and do [asset management](#asset-management)

#### Asset Management

Make sure you have do [this](INSTALLATION.md#import-postman-api) and open Asset folder. There are CRUD with Index inside that folder.

### Other Notes

[Laravel Docs](https://laravel.com/docs/8.x)
