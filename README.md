## Install:
```bash
cp .env.example .env
docker-compose up -d --build
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
docker-compose run --rm app php artisan storage:link
docker-compose exec app php artisan optimize
docker-compose run --rm node npm install
```

## Develop:
```bash
docker-compose run --rm node npm run dev
```

