# RemindaNi

*https://cldup.com/dTxpPi9lDf.thumb.png*

RemindaNi е приложение, което ти позволява да следиш
задълженията си под формата на задачи, правени от потребителя.

## Какво включва приложението

- Система за създаване на задачи, които се пазят за всеки потребител.
- Валидиращ алгоритъм за Email и Discord
- Email и Discord известия при изтичащи задания


## Инсталация

За да се използва приложението е необходим web server, който
има конфигуриран PHP 7.1.
За пращане на мейли е необходим PHP mailer

```php
composer require phpmailer/phpmailer
```
Или
https://github.com/PHPMailer/PHPMailer
```php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'autoload.php';

$email = new PHPMailer(TRUE);
```

За пазене на потребители е необходима база от данни MYSQL
със следната конфигурация:
```sql
CREATE TABLE `assignments` (
  `id` int(11) UNSIGNED NOT NULL,
  `UserId` int(11) NOT NULL DEFAULT 0,
  `Title` varchar(100) NOT NULL DEFAULT '',
  `Date` varchar(10) NOT NULL,
  `Time` varchar(10) NOT NULL,
  `Description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `secret` varchar(64) NOT NULL,
  `discord_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ass`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ass`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;
```
Във файлът *config.ini* се слага информацията за базата във формат:
```ini
[database]
db_servername = db_servername
db_name       = db_name
db_username   = db_username
db_password   = db_password
db_sub_name   = db_sub_name

```
[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [dill]: <https://github.com/joemccann/dillinger>
   [git-repo-url]: <https://github.com/joemccann/dillinger.git>
   [john gruber]: <http://daringfireball.net>
   [df1]: <http://daringfireball.net/projects/markdown/>
   [markdown-it]: <https://github.com/markdown-it/markdown-it>
   [Ace Editor]: <http://ace.ajax.org>
   [node.js]: <http://nodejs.org>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
   [@tjholowaychuk]: <http://twitter.com/tjholowaychuk>
   [express]: <http://expressjs.com>
   [AngularJS]: <http://angularjs.org>
   [Gulp]: <http://gulpjs.com>

   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>
   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>
   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>
   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>
   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>
   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>
