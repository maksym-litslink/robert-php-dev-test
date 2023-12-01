1. Start docker container
```bash
docker-compose up -d
```

2. Run tests
```bash
make tests
```

3. Run migrations
```bash
symfony console doctrine:migrations:migrate
```

4. Build frontend
```bash
npm run build
```

5. Run server
```bash
symfony serve -d
```

6. Open the page
```bash
symfony open:local
```

7. You can check api docs at `/api`
