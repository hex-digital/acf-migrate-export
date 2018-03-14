# acf-migrate-export
A tool to turn a PHP ACF Export into a migrations file fit for acf-migrations.phar.

[![Build Status](https://travis-ci.org/hex-digital/acf-migrate-export.svg?branch=master)](https://travis-ci.org/hex-digital/acf-migrate-export)

## Setup

    composer install

## Using

    php generate.php -f path/to/export.php [-a | if absolute path]

## Contributing

### Workflow

- **Create an issue for your work**, so all work can be tracked to this issue.
- **Create a branch called `tkt-xx`**, where xx is the issue number.
- **Prefix all commits with `[refs #xx]`**, where xx is the issue number.
- **Check all Unit Tests run successfully.**
- **Submit Pull Request to `develop`**, which is our development branch.

### Testing

Ensure all Unit Tests run before submitting code.

These can be run like so:

    ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
