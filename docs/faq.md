#FAQ
## 1. Where is Gii?
Gii is available on:
- http://tattoopro.localhost/gii
- http://backend.tattoopro.localhost/gii

## 2. How do i enable email activation?
Edit ``frontend/config/web.php`` and set [[frontend\modules\user\Module::shouldBeActivated]] property to ``true``

## 3. How do i access mailcatcher?
In docker installation mailcatcher is running on [tattoopro.localhost:1080](tattoopro.localhost:1080)

## 4. How do i open application cli when run application in docker?
Run this command in project directory:
```
docker-compose exec app console <command> [arguments]
```
## 5. How do i change charset in existing database?
```
docker-compose exec app console app/alter-charset <charset> <collation>
```
