# Амадо php back-end разработка

## Установка

Склонируйте репазиторий

    git clone https://github.com/noNameDiddad/amado_php_back-end.git

Перейдите в корневую папку проекта

    cd amado_php_back-end

Запустите установку через composer

    composer install

Скопируйте пример файла env и внесите необходимые изменения конфигурации в файл .env.

    cp .env.example .env

Сгенерируйте новый ключ приложения

    php artisan key:generate

Запустите миграцию базы данных

    php artisan migrate

Запустите локальный сервер разработки

    php artisan serve

Теперь вы можете получить доступ к серверу по адресу http: // localhost: 8000.
