After the basic installation setup, follow these steps:

## Installation

Add the following variables in .env with your stripe api test credentials:

```bash
STRIPE_PUB_KEY=pk_test_xxxxxxxx
STRIPE_SECRET_KEY=sk_test_xxxxxxxx
```

For migration and seeding use the following command if you are using Laravel 5.5 or greater:

```php
php artisan migrate:fresh --seed
```

Choose an email from the seeded user data. By default 5 users are generated using model factory. Use the following password for all the users at login.

```php
password
```

For testing a successful payment use the following card number with a future expiry date and cvv.

```php
4242 4242 4242 4242
```

For testing a successful payment use the following card number with a future expiry date and cvv.

```php
4000 0000 0000 0341
```

