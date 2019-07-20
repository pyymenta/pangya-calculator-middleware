# Pangya HWI Middleware

This project uses the [Keorenca](https://kyorenca.wordpress.com/2013/01/27/geradores-calculadora-e-consideracoes-sobre-calculos/) concept, using his HWIs generator based in XLS files to [calculate shot](https://www.youtube.com/watch?v=uVhy7aj_Akg).

## Install the Application

### Dependencies

This projects depends on:

- Composer
- PHPUnit
- Some php dependencies(php-xml, php-mbstring, php-zip)

### Initial Setup

#### Clone this repository

```sh

git clone https://github.com/pyymenta/pangya-calculator-middleware.git

```

#### Install dependencies

```sh

composer install

```

### Running the App

To run the application in development, you can run these commands

```sh
cd pangya-calculator-middleware
composer start
```

### Running Tests

Run this command in the application directory to run the test suite

```sh
composer test
```

### Some hints

- Point your virtual host document root to your new application's `public/` directory.

- Ensure `logs/` is web writeable.

### License

[MIT License](./LICENSE)

Made with [Slim Framework](http://www.slimframework.com/)
