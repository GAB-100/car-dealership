## Run the project

Before run the project, you have to install the plugins and modules with the following actions.

To install node modules, please run 

npm install


To install php libraries, please run

composer install


After finish these actions, please run the following command in the terminal to migrate DB data.

php artisan migrate


And then you need to run the following commands in the different terminals

npm run dev

php artisan serve
