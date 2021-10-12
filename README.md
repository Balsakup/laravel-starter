# Balsakup's Laravel Starter

## Installation

### Install composer
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

### Generate key
```shell
sail artisan key:generate
```

### Migrate and seed
```shell
sail artisan migrate:fresh --seed
```
