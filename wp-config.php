<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'bebeauty_new');

/** Имя пользователя MySQL */
define('DB_USER', 'for_change');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'Ca5MoHwp');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'h}^CWo&X5r*t|OMR@yD%ND)UKH;]nigPk`U6n]#;zvV;=GZ9pdzMnJ);t^gkoCjw');
define('SECURE_AUTH_KEY',  '~wqs^l_H2$Sr#h`_9gUqX<*{`nIFcY>eUBGO]J4&i+lCVb)u9`!WBJd!V|9B Nrn');
define('LOGGED_IN_KEY',    '6vSbpGOR*!$)iUR~@zQk~_wZI}HKu1a]udHs-1T`,tou7g&c+t7h,J]L2@NU2z0L');
define('NONCE_KEY',        '=Rp,/XBRwr{qFs>iV*_&@GAnF[hyu}&5#wouk9vU3.HGFd)QX CO)._3;F4pRKd,');
define('AUTH_SALT',        '|t1k@<y|{UvvI2pM6k2>4KWP9BBvp;P4uYuOO]HKgs-@NVxJAdIVn= UDsfY5ONN');
define('SECURE_AUTH_SALT', '9nQldP?b[sf`&<2s|CJD7cWYg&L7Yw5G.vEpn@ o8fo1y ph;5$5ju6T-bv$5^!#');
define('LOGGED_IN_SALT',   ',qJ?J~BQQ)dd6L$!u)(MUG+Mxk0VP%NcCBhx^(VMyMcGI-=_$F2xz1%w^UwHod/i');
define('NONCE_SALT',       'dH=S${5MT@|juOw!;NgJJaG7o(F< ]GgrLaw,j;.XG&85+1ag/CD*FD>f,gma8(6');
define('WP_ALLOW_REPAIR', true);
/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'zts_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
