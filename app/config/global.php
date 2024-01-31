<?php
require_once 'secret.php';

define("DB_DRIVER", "mysql");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_DATABASE", "akahub");
define("DB_CHARSET", "utf8");

define("BASE_URL", "http://" . $_SERVER['SERVER_NAME'] . "/aka-hub");
define("ASSETS_PATH", BASE_URL . "/public/assets/");
define("USER_IMG_PATH", BASE_URL . "/public/assets/user_uploads/img/");
define("USER_PDF_PATH", BASE_URL . "/public/assets/user_uploads/pdf/");
