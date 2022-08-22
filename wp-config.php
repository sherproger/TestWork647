<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'u923070168_test' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'u923070168_user' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'sjfg4_Y0hw7@.fh948e' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'eZz!Kaa*,)y02R2bbqtf%@%l:]:Uq`#O1cdul7Q12c>5Tyg=GtJb!qJqb E`_>P&' );
define( 'SECURE_AUTH_KEY',  'J%#_):aLal9Xlx/4p/4D72}zzE{fPP4s:]!]DEg|>/]:,s<kxyUl?NJripq|p<m#' );
define( 'LOGGED_IN_KEY',    '$J;9x#&;V#8+Psu/T4J->D~jOR}m6:gI>*ITeLZz5QXlq3A(DZM2XN9iMep`Dx[G' );
define( 'NONCE_KEY',        '<&5N3]FPLk!h3+vlHz<ZM8VF0qqS>zZ>Tmj#vxLzb0>MPI%uosCtP6]$$fOj^,Tm' );
define( 'AUTH_SALT',        '$evc55QCCoWU}d`{c%`+eFvYPzA|utqS]z(Eh%aAWP`eT#wS$WcP}[{CDK~j|;Bz' );
define( 'SECURE_AUTH_SALT', ']S-PAv AjRw],x[u+.RL(hhe1st_1wszXt;_!*bW>2rPY^]fYn<}oEIv)~6=y`M#' );
define( 'LOGGED_IN_SALT',   '!cf:Ibgz{F]@  $;GlY5jje?i[tP*(X+6/|9Yt%a-N&7lJ/Y;jeL2}m_fIZbN&ON' );
define( 'NONCE_SALT',       'PzLYdunOL!dguQb__12,US%B?1m^ +nrZ$=Yd6NNs,BS9<}5i_oq6i.M+|qd)m2B' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
