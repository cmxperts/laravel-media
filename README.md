# Laravel Media Manager
Media Manager Upload/Delete Manage your Media for Laravel 10

### Installation

1. Run

```php
composer require cmxperts/media-manager
```

**_Step 2 & 3 are optional if you are using laravel 5.5_**

2. Add the following class, to "providers" array in the file config/app.php (optional on laravel 5.5)

```php
CmXperts\MediaManager\Providers\CmXpertsMediaManagerServiceProvider::class,
```
3. Run publish

```php
php artisan vendor:publish --provider="CmXperts\MediaManager\Providers\CmXpertsMediaManager"
```

5. Configure (optional) in **_config/cmx_media.php_** :

- **_CUSTOM MIDDLEWARE:_** You can add you own middleware
- **_TABLE PREFIX:_** By default this package will create 1 new table named "uploads" but you can still add your own table prefix avoiding conflict with existing table
- **_TABLE NAME_** If you want use specific name of table you have to modify that and the migrations
- **_Custom routes_** If you want to edit the route path you can edit the field

6. Run migrate

```php
php artisan migrate
```

DONE
