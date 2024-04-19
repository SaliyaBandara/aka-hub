<?php

class CounselorChat extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'CounselorChat',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorChat/index', $data);
    }

    public function chat_users()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 5))
            $this->redirect();

        

        
        // $data["reservationRequest_data"] = $this->model('readModel')->getEmptyReservation();
        // $data["reservationRequest"] = $data["reservationRequest_data"]["empty"];
        // $data["reservationRequest_template"] = $data["reservationRequest_data"]["template"];

        // $data["id"] = $id;

        // if ($id != 0) {
        //     $data["reservationRequest"] = $this->model('readModel')->getOne("reservation_requests", $id);
        //     if (!$data["reservationRequest"])
        //         $this->redirect();
        // }

        // $data["chat_users"] = $this->model('readModel')->getAllChatUsers("chat_users");
        // $this->view->render('counselor/counselorChat/index', $data);

        $chat_users = $this->model('readModel')->getAllChatUsers("chat_users");
        // Return only the chat users data as JSON
        header('Content-Type: application/json');
        echo json_encode($chat_users);
    }
}
