<?php
// error_reporting(E_ERROR | E_PARSE);

// require php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// $dir = dirname(__FILE__);
// $root = implode(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, $dir), 0, -1));
// $phpmailer_path = $root . "/PHPMailer-master/src/PHPMailer.php";
// $phpmailer = $dir . "/PHPMailer-master/src/PHPMailer.php";

require '../app/libraries/PHPMailer-master/src/Exception.php';
require '../app/libraries/PHPMailer-master/src/PHPMailer.php';
require '../app/libraries/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer();

require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require_once '../app/core/Model.php';

require_once '../public/components/common/HTMLHead.php';
require_once '../public/components/common/HTMLFooter.php';
require_once '../public/components/common/header.php';
require_once '../public/components/common/sidebar.php';
require_once '../public/components/common/welcomeSearch.php';

require_once '../public/components/common/calendar.php';


