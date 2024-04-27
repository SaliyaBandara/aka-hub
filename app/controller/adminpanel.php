<?php
class AdminPanel extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["user_role"] != 3)) {
            //log Entry
            $action = "Unauthorized user tried to access Adminpanel";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'AdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];
        if ($_SESSION["user_role"] == 3)
            $data["title"] = "Super Admin Panel";

        $data["count_total_users"] = $this->model('readModel')->getCountAllUsers();
        $data["count_role_users"] = $this->model('readModel')->getCountRoleUsers();
        $data["count_new_users"] = $this->model('readModel')->getCountNewUsers();
        $data["chartOne"] = $this->model('readModel')->getChartOne();
        $data["chartTwo"] = $this->model('readModel')->getChartTwo();
        $data["chartThree"] = $this->model('readModel')->getChartThree();
        $data["chartFour"] = $this->model('readModel')->getChartFour();
        $data["chartFive"] = $this->model('readModel')->getChartFive();

        $this->view->render('admin/adminpanel/index', $data);
    }

    public function getPDFReport()
    {
        $this->requireLogin();

        if (($_SESSION["user_role"] != 1) && ($_SESSION["user_role"] != 3)) {
            $action = "Unauthorized user tried to access Adminpanel";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $data = [
            'title' => 'AdminPanel Report',
            'message' => 'Welcome to Aka Hub!',
        ];
        if ($_SESSION["user_role"] == 3) {
            $data["title"] = "Super Admin Panel";
        }

        $data["count_total_users"] = $this->model('readModel')->getCountAllUsers();
        $data["count_role_users"] = $this->model('readModel')->getCountRoleUsers();
        $data["count_new_users"] = $this->model('readModel')->getCountNewUsers();
        $data["chartOne"] = $this->model('readModel')->getChartOne();
        $data["chartTwo"] = $this->model('readModel')->getChartTwo();
        $data["chartThree"] = $this->model('readModel')->getChartThree();
        $data["chartFour"] = $this->model('readModel')->getChartFour();
        $data["chartFive"] = $this->model('readModel')->getChartFive();

        ob_start();
        $this->view->render('admin/report/adminpanelReport', $data);
        $htmlReport = ob_get_clean();
        require_once(__DIR__ . '/../../public/dompdf/autoload.inc.php');
        $pdf = new Dompdf\Dompdf();
        $pdf->loadHtml($htmlReport);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        while (ob_get_level()) {
            ob_end_clean();
        }
        $pdf->stream('AdminPanel_Report.pdf');
    }
}
