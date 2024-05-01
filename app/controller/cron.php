<?php
class Cron extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/");
        die();
    }

    public function view($id = 0)
    {
        $this->requireLogin();
        $this->redirect();
    }

    public function cron()
    {
        $this->model('readModel')->cron();
        die(json_encode(array("status" => "200", "desc" => "Success")));

        // to call from command line
        // php -f /var/www/html/aka-hub/app/controller/cron.php cron
        // or curl 127.0.0.1/aka-hub/cron/cron

        // on linux 
        // crontab -e
        // * * * * * curl 
    }
}
