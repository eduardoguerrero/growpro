##### Configure and run

To make work with application easier you can use docker-compose:

```bash
docker-compose up -d                          # start application
docker-compose down                           # stop and remove containers
docker-compose exec app bash                  # connect to container command line
docker-compose exec app php Main.php          # execute functions
docker-compose exec app ./vendor/bin/phpunit  # run tests
```
