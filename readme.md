# Sports teams

## Fix storage folder permissions
- sudo chmod -R 775 storage
- sudo chown -R $USER:www-data storage

## Setup
- configure .env file and set DB params
- composer install
- yarn install
- php artisan migrate (will create database tables);
- php artisan db:seed ( will seed user,teams,players)

## Run project
You can configure apache to serve this project or use 'php artisan serve' . Than open http://127.0.0.1:8000 .

### Clear cache
php artisan cache:clear

### Dev commands
start watcher 'yarn run watch'

## API endpoints
Import 'Sports.postman_collection.json' to Postman . 
Run 'Login' endpoint , it will return JWT token, copy it, edit collection and set collection variable 'jwtToken' and save. After that you will be able to use API endpoints.