# Advance Stream Stats


Advance Stream Stats is a simple implementation of subscription process using `Braintree`.
The project is built on `Laravel(Backend)` & `Vue.js(FrontEnd SPA)`.

## Technology Stack
It is built on Laravel and Vue.js, accompanied with beautiful UI using Bootsrap. The authentication system has been implemneted using third party package passport.
* Laravel
* Vue
* MySQL
* Bootsrap

Currenlty the implementaion uses braintree accepts payments via CreditCard and Paypal Only using `Custom Payment Driver`.


## Features
* User Login/Signup
* `Custom Payment Driver`
* Subscriptions
* Manage Subcription
* Stats


## Demo Video
https://drive.google.com/file/d/1jXYXr31d4_3WphCxYm3QjH6GphNYJOnd/view?usp=share_link



## Installation

Create `.env` file at the root of the project and add database credentials.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lab
DB_USERNAME=root
DB_PASSWORD=

```

Now add braintree credentials in `.env`.

```bash
BT_ENVIRONMENT=sandbox
BT_MERCHANT_ID=xxxxxxxxx
BT_PUBLIC_KEY=xxxxxxxxxx
BT_PRIVATE_KEY=xxxxxxxxx

```

Now set payment driver to `braintree` in `.env`.

```bash
PAYMENT_DRIVER=braintree
```

Install composer vendor packages by following command via [composer]

```bash
composer install
```

Install node modules  by following command via [npm]

```bash
npm install
```

As for token based authetication passport package is installed therfore you have to make your own key so run

```bash
php artisan passport:install
```

Run migrations by following command

```bash
php artisan migrate:fresh --seed
```

Clear Cache

```bash
php artisan optimize
```
[Node.js]: https://nodejs.org/en/
[npm]: https://www.npmjs.com/
[composer]:https://getcomposer.org/
[npm install]: https://docs.npmjs.com/getting-started/installing-npm-packages-locally
[sandbox]: https://docs.npmjs.com/getting-started/installing-npm-packages-locally

## Tips

First signup to the brantree [sandbox] and make plans, the plans will automatically be imported to the database when seeders run.

## Troubleshooting

Run following commands for troubleshooting

```bash
php artisan optimize
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

