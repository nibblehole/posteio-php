# Poste.io PHP SDK

Poste.io is a full-featured mail server that features a REST API for tasks like creating mailboxes and adding domains.

## Installation

1. Install it using Composer

```
composer require tormjens/posteio
```

### Using in Laravel

If you're using Laravel 5.5, you can go ahead and skip to number 3.

1. Add the service provider to the providers array in your `config/app.php`.

```php
    'TorMorten\Posteio\Providers\PosteioServiceProvider',
```

2. Add the facade in `config/app.php`

```php
    'Posteio' => TorMorten\Posteio\Posteio::class,
```

3. Add the credentials in `config/services.php`

```php
    'posteio' => [
        'host' => 'https://myhost.com',
        'username' => 'email@myhost.com',
        'password' => 'secret'
    ],
```

### Outside Laravel

Instantiate the class like so:

```php
    $posteio = new TorMorten\Posteio\Client('https://myhost.com', 'email@myhost.com', 'secret');
```

## Usage

The API is split into two services; boxes and domains. Both have the same CRUD functions. You can find the complete documentation of what each resource takes a its parameters on their [API docs/sandbox](https://poste.io/demo).

### Laravel

In Laravel the client is bound to the service container and can be instantiated in two different ways.

The first is via dependency injection.

```php 
    Route::post('create-account', function(TorMorten\Posteio\Client $posteio) {
        $posteio->boxes()->create(['name' => 'John Doe', 'email' => 'john@myhost.com']);
    });
```

The second is via resolving it via the service container.

```php
    app('posteio')->boxes()->create(['name' => 'John Doe', 'email' => 'john@myhost.com']);
    // or
    app('TorMorten\Posteio\Client')->boxes()->create(['name' => 'John Doe', 'email' => 'john@myhost.com']);
```

## TODO

* Create a better readme.
