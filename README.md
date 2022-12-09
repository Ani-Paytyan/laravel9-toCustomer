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

## Development:
```bash
docker-compose run --rm node npm run dev
```

<h3>Swagger :</h3>
<p>
Generate:

docker-compose exec app php artisan l5-swagger:generate

Link:

/api/documentation
</p>

<h3>Swagger :</h3>
<p>
Generate:

docker-compose exec app php artisan l5-swagger:generate

Link:

/api/documentation
</p>

