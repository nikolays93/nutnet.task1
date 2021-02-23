## Как установить

1) Склонируйте репозиторий `git clone https://github.com/nikolays93/nutnet.task1.git task1`  
2) Перейдите в папку с репозиторием `cd task1`
3) Запустите Laravel server `php artisan serve`

## Как наполнить данными

Введите команду `php artisan migrate` для создания структуры БД.  
Введите команду `php artisan db:seed --class=UserSeeder` для добавления пользователя (администратора) с Email `admin@example.com` и паролем `password`.  
Введите комманду `php artisan db:seed --class=RecordSeeder` для наполнения тестовыми данными.
