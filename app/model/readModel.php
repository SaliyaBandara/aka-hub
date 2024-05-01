<?php

class readModel extends Model
{
    protected $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function getOne($table, $id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM $table WHERE id = ?", "i", [$id]);
        if (count($result) > 0)
            return $result[0];

        return false;
    }

    //temp
    public function getOneChatUser($id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM chat_users WHERE unique_id = ?", "i", [$id]);
        if (count($result) > 0)
            return $result[0];

        return false;
    }


    public function getOneByColumns($table, $columns, $values, $types)
    {
        $query = "SELECT * FROM $table WHERE ";
        $query .= implode(" = ? AND ", $columns);
        $query .= " = ?";

        $result = $this->db_handle->runQuery($query, implode("", $types), $values);
        if (count($result) > 0)
            return $result[0];

        return false;
    }

    public function lastInsertedId($table, $key)
    {

        $result = $this->db_handle->runQuery("SELECT id FROM  $table  WHERE ? ORDER BY $key DESC LIMIT 1", "i", [1]);
        if (count($result) > 0)
            return $result[0];
        return 0;
    }

    public function getSystemDetails()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM system_variables WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAll($table)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM $table WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    // public function getAllSort("forum_posts", "created_at", "DESC")
    public function getAllSort($table, $column, $order)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM $table WHERE ? ORDER BY $column $order", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAllByColumn($table, $column, $value, $type = "s")
    {
        $result = $this->db_handle->runQuery("SELECT * FROM $table WHERE $column = ?", $type, [$value]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function isEmailExist($email)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE email = ?", "s", [$email]);
        if (count($result) > 0)
            return $result;
        return false;
    }

    public function isCodeExist($code)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE code = ?", "s", [$code]);
        if (count($result) > 0)
            return $result[0];
        return false;
    }

    public function isCourseExist($course_name)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE name = ?", "s", [$course_name]);
        if (count($result) > 0)
            return $result[0];
        return false;
    }

    public function getAllUsers()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getPassword($id)
    {
        $result = $this->db_handle->runQuery("SELECT password FROM user WHERE id = ?", "i", [$id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCoursesByYear($year)
    {

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year = ?", "i", [$year]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCoursesByCode($code)
    {

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE code = ?", "s", [$code]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCoursesBySemester($year, $semester)
    {

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year = ? AND semester = ?", "ii", [$year, $semester]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCoursesBySearch($year, $searchValue)
    {

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year = ? AND (name LIKE ? OR code LIKE ?)", "iss", [$year, "%$searchValue%", "%$searchValue%"]);
        if (count($result) > 0)
            return $result;

        return false;
    }


    public function findWhetherRestricted($id)
    {
        $result = $this->db_handle->runQuery("SELECT status FROM user WHERE id = ? AND status = ?", "ii", [$id, 0]);
        if (count($result) > 0)
            return true;

        return false;
    }

    public function getCoursesBelowYear($year)
    {

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year < ? ", "i", [$year]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCoursesBelowYearSearch($year, $searchValue)
    {

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year <= ? AND (name LIKE ? OR code LIKE ?)", "iss", [$year, "%$searchValue%", "%$searchValue%"]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCoursesByOnlySemester($semester)
    {

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE semester = ? ", "i", [$semester]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAllCalendarEventsById($id)
    {
        $events = $this->db_handle->runQuery("SELECT * FROM calendar WHERE id = ?", "i", [$id]);
        if (count($events) > 0)
            return $events;

        return false;
    }

    public function getNotifications()
    {
        // -- Type
        // --     1 - Exam
        // --     2 - Reminder
        // --     3 - Events
        // --     4 - Materials
        // --     5 - Election

        // -- is_broadcast
        // --     0 - Personal
        // --     1 - Broadcast

        // -- Target
        // --    0 - All
        // --    5 - All Students
        // --      1 - Student - 1st Year
        // --      2 - Student - 2nd Year
        // --      3 - Student - 3rd Year
        // --      4 - Student - 4th Year
        // --    6 - Counsellor

        // -- parent id
        // --   the notification redirection id

        // CREATE TABLE notifications (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     is_broadcast TINYINT(1) NOT NULL DEFAULT 0,
        //     target TINYINT(1) NOT NULL DEFAULT 0,
        //     user_id INT DEFAULT NULL,
        //     parent_id INT DEFAULT NULL,
        //     title VARCHAR(255) NOT NULL,
        //     description TEXT DEFAULT NULL,
        //     link VARCHAR(255) DEFAULT NULL,
        //     type TINYINT(1) NOT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     sent_email TINYINT(1) NOT NULL DEFAULT 0,
        //     viewed TINYINT(1) NOT NULL DEFAULT 0,
        //     FOREIGN KEY (user_id) REFERENCES user(id)
        // );

        // check if student or counselor
        $user_id = $_SESSION["user_id"];
        $user_role = $_SESSION["user_role"];
        $role = "";
        if ($user_role == 5)
            $role = "counselor";
        else if ($user_role != 1 && $user_role != 3)
            $role = "student";

        $notifications = [];

        if ($role == "student") {

            $user_year = $this->db_handle->runQuery("SELECT year FROM student WHERE id = ?", "i", [$user_id])[0]['year'];
            // get all notifications for this user by user_id and target
            $notifications = $this->db_handle->runQuery(
                "SELECT * FROM notifications WHERE 
                    (is_broadcast = ? AND user_id = ?) OR 
                    (is_broadcast = ? AND (target = ? OR target = ? OR target = ?))
                    ORDER BY created_at DESC",
                "iiiiii",
                [0, $user_id, 1, 0, $user_year, 5]
            );

            if (count($notifications) > 0) {
                foreach ($notifications as $key => $notification) {
                    $url = "";
                    if ($notification['link'] != "")
                        $url = BASE_URL . $notification['link'];

                    $notifications[$key] = [
                        "title" => $notification['title'],
                        "description" => $notification['description'],
                        "link" => $url,
                        "created_at" => $notification['created_at'],
                    ];
                    // $notifications[$key+1] = [
                    //     "title" => $notification['title'],
                    //     "description" => $notification['description'],
                    //     "link" => $url,
                    //     "created_at" => $notification['created_at'],
                    // ];
                }
            }

            // print_r($notifications);
        }

        return $notifications;
    }

    // get forum posts
    public function getForumPosts()
    {
        // get all forum posts with user details
        $posts = $this->db_handle->runQuery("SELECT * FROM forum_posts WHERE ? ORDER BY created_at DESC", "i", [1]);
        if (count($posts) > 0) {
            foreach ($posts as $key => $post) {

                // select user name profile img and year from user and student tables
                $user = $this->db_handle->runQuery(
                    "SELECT u.name, u.profile_img, s.year FROM user u 
                    LEFT JOIN student s ON u.id = s.id 
                    WHERE u.id = ?",
                    "i",
                    [$post['user_id']]
                )[0];

                // get the number of comments for this post
                $comments = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM forum_comments WHERE post_id = ?", "i", [$post['id']])[0]['count'];

                $posts[$key] = [
                    "id" => $post['id'],
                    "title" => $post['title'],
                    "content" => $post['content'],
                    "image" => $post['cover_img'],
                    "created_at" => $post['created_at'],
                    "user" => $user,
                    "num_comments" => $comments
                ];
            }

            return $posts;
        }

        return [];
    }

    // get one forum post with user details and comments
    public function getForumPost($id)
    {
        // get the forum post with user details
        $post = $this->db_handle->runQuery("SELECT * FROM forum_posts WHERE id = ?", "i", [$id]);
        if (count($post) > 0) {
            $post = $post[0];

            // select user name profile img and year from user and student tables
            $user = $this->db_handle->runQuery(
                "SELECT u.name, u.profile_img, s.year FROM user u 
                LEFT JOIN student s ON u.id = s.id 
                WHERE u.id = ?",
                "i",
                [$post['user_id']]
            )[0];

            // CREATE TABLE forum_comments (
            //     id INT AUTO_INCREMENT PRIMARY KEY,
            //     user_id INT NOT NULL,
            //     post_id INT NOT NULL,
            //     parent_id INT DEFAULT NULL,
            //     content TEXT NOT NULL,
            //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            //     FOREIGN KEY (user_id) REFERENCES user(id),
            //     FOREIGN KEY (post_id) REFERENCES forum_posts(id),
            //     FOREIGN KEY (parent_id) REFERENCES forum_comments(id)
            // );

            $comments = $this->db_handle->runQuery(
                "SELECT c.id, c.content, c.created_at, c.parent_id, u.name, u.profile_img, s.year 
                FROM forum_comments c
                LEFT JOIN user u ON c.user_id = u.id
                LEFT JOIN student s ON u.id = s.id
                WHERE c.post_id = ?",
                "i",
                [$id]
            );

            $num_comments = 0;
            if (count($comments) > 0)
                $num_comments = count($comments);

            // recursively build threaded comments
            function buildThreadedComments($comments, $parent_id = null)
            {
                $threaded = [];
                foreach ($comments as $comment) {
                    if ($comment['parent_id'] == $parent_id) {
                        $replies = buildThreadedComments($comments, $comment['id']);
                        $comment['user'] = [
                            "name" => $comment['name'],
                            "profile_img" => $comment['profile_img'],
                            "year" => $comment['year']
                        ];
                        $comment['replies'] = $replies;
                        $threaded[] = $comment;
                    }
                }
                return $threaded;
            }

            $threaded_comments = buildThreadedComments($comments);

            $post = [
                "id" => $post['id'],
                "title" => $post['title'],
                "content" => $post['content'],
                "image" => $post['cover_img'],
                "created_at" => $post['created_at'],
                "user" => $user,
                // "comments" => $comments,
                "comments" => $threaded_comments,
                "num_comments" => $num_comments
            ];

            return $post;
        }

        return false;
    }

    // get calendar events
    public function getAllPublicEvents()
    {

        // -- is_broadcast
        // --     0 - Personal
        // --     1 - Broadcast


        // -- target
        // --    0 - All
        // --    5 - All Students
        // --      1 - Student - 1st Year
        // --      2 - Student - 2nd Year
        // --      3 - Student - 3rd Year
        // --      4 - Student - 4th Year
        // --    6 - Counsellor

        // CREATE TABLE calendar (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     user_id INT DEFAULT NULL,
        //     is_broadcast TINYINT(1) NOT NULL DEFAULT 0,
        //     target TINYINT(1) NOT NULL DEFAULT 0,
        //     title VARCHAR(255) NOT NULL,
        //     module VARCHAR(255) DEFAULT NULL,
        //     description TEXT DEFAULT NULL,
        //     date DATETIME NOT NULL,
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     FOREIGN KEY (user_id) REFERENCES user(id)
        // );

        $events = $this->db_handle->runQuery("SELECT * FROM calendar WHERE is_broadcast = ?", "i", [1]);
        // print_r($events);
        // die;
        if (count($events) > 0)
            return $events;
    }

    public function getAllCalendarEvents()
    {
        $events = $this->db_handle->runQuery("SELECT * FROM calendar WHERE ?", "i", [1]);
        if (count($events) > 0)
            return $events;

        return false;
    }

    public function getUserCalendarEvents($date = "")
    {
        $user_id = $_SESSION["user_id"];
        $user_role = $_SESSION["user_role"];
        $role = "";
        if ($user_role == 5)
            $role = "counselor";
        else if ($user_role != 1 && $user_role != 3)
            $role = "student";
        else if ($user_role == 1 || $user_role == 3)
            $role = "admin";

        $events = [];
        if ($role == "student") {
            $user_year = $this->db_handle->runQuery("SELECT year FROM student WHERE id = ?", "i", [$user_id])[0]['year'];
            // get all notifications for this user by user_id and target
            $events = $this->db_handle->runQuery(
                "SELECT * FROM calendar WHERE 
                    (is_broadcast = ? AND user_id = ?) OR 
                    (is_broadcast = ? AND (target = ? OR target = ? OR target = ?))
                    ORDER BY date DESC",
                "iiiiii",
                [0, $user_id, 1, 0, $user_year, 5]
            );
        } else if ($role == "counselor") {
            $events = $this->db_handle->runQuery("SELECT * FROM calendar WHERE user_id = ? AND is_broadcast = ?", "ii", [$user_id, 0]);
            // TODO: get counsellor reservations as well
            // reservation_requests status == 1


        } else if ($role == "admin") {
            $events = $this->db_handle->runQuery("SELECT * FROM calendar WHERE ?", "i", [1]);
        }

        if (count($events) > 0) {
            foreach ($events as $key => $event) {
                $events[$key] = [
                    "title" => $event['title'],
                    "description" => $event['description'],
                    "module" => $event['module'],
                    "date" => $event['date'],
                    "type" => $event['type'],
                ];
            }
        }

        // if date is set, filter events for that date
        if ($date != "") {

            $timestampSeconds = $date / 1000; // Convert milliseconds to seconds
            $date = date("Y-m-d", $timestampSeconds);

            if (strtotime($date) === false)
                return [];

            $date = date("Y-m-d", strtotime($date));
            $filtered_events = [];
            foreach ($events as $event) {
                if (date("Y-m-d", strtotime($event['date'])) == $date)
                    $filtered_events[] = $event;
            }
            $events = $filtered_events;
        }

        // print_r($events);
        // die;

        return $events;
    }

    // CREATE TABLE elections (
    // CREATE TABLE elections (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT NOT NULL,
    //     name VARCHAR(255) NOT NULL,
    //     description TEXT DEFAULT NULL,
    //     start_date DATETIME NOT NULL,
    //     end_date DATETIME NOT NULL,
    //     cover_img VARCHAR(255) DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     type TINYINT(1) NOT NULL DEFAULT 0,
    //     FOREIGN KEY (user_id) REFERENCES user(id)
    // );

    // -- election questions table

    // CREATE TABLE election_questions (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     election_id INT NOT NULL,
    //     question VARCHAR(255) NOT NULL,
    //     question_type VARCHAR(255) NOT NULL,
    //     question_options TEXT DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (election_id) REFERENCES elections(id)
    // );

    // -- election votes table

    // CREATE TABLE election_votes (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     election_id INT NOT NULL,
    //     user_id INT NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (election_id) REFERENCES elections(id),
    //     FOREIGN KEY (user_id) REFERENCES user(id)
    // );

    // -- election responses table

    // CREATE TABLE election_responses (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     election_id INT NOT NULL,
    //     user_id INT NOT NULL,
    //     question_id INT NOT NULL,
    //     response_option VARCHAR(255) DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (election_id) REFERENCES elections(id),
    //     FOREIGN KEY (user_id) REFERENCES user(id),
    //     FOREIGN KEY (question_id) REFERENCES election_questions(id)
    // );

    // election analytics
    public function getElectionAnalytics($election_id)
    {

        $analytics = [];

        // for each election question get the unique responses and their counts
        $question = $this->getAllByColumn("election_questions", "election_id", $election_id, "i");
        if ($question) {
            foreach ($question as $q) {
                $question_id = $q['id'];
                $question_type = $q['question_type'];
                $question_options = json_decode($q['question_options'], true);

                $has_images = 0;
                if (is_array($question_options)) {
                    foreach ($question_options as $option) {
                        if (isset($option['cover_img']) && $option['cover_img'] != "") {
                            $has_images = 1;
                            break;
                        }
                    }
                }

                $responses = $this->getAllByColumn("election_responses", "question_id", $question_id, "i");
                // Voter Turnout Over Time chart over each 2 hours of the election period
                $vote_times = [];

                if ($responses) {
                    $response_count = [];

                    // count the responses for each option
                    foreach ($responses as $response) {
                        $response_count[$response['response_option']] = isset($response_count[$response['response_option']]) ? $response_count[$response['response_option']] + 1 : 1;

                        // get the time of the vote
                        $vote_times[] = $response['created_at'];
                    }

                    // sort the vote times to groups of 2 hours
                    $vote_times = array_map(function ($time) {
                        return date("Y-m-d H:00:00", strtotime($time));
                    }, $vote_times);

                    // print_r($vote_times);
                    // die;

                    // set the counts for each option
                    $option_index = 1;
                    $images = [];
                    foreach ($question_options as $key => $option) {
                        if (isset($response_count[$option_index]))
                            $question_options[$key]['count'] = $response_count[$option_index];
                        else
                            $question_options[$key]['count'] = 0;

                        if ($has_images)
                            $images[] = $option['cover_img'];

                        $option_index++;
                    }

                    // sort responses_count in ascending order of keys
                    ksort($response_count);

                    $analytics[] = [
                        "question" => $q['question'],
                        "question_id" => $question_id,
                        "question_type" => $question_type,
                        "has_images" => $has_images,
                        "images" => $images, // "images" => "img1.jpg, img2.jpg, img3.jpg
                        "question_options" => $question_options,
                        "response_count" => $response_count
                    ];
                }
            }
        }

        // print_r($analytics);
        // die;

        // format the counts for chartjs
        $chart_data = [];
        foreach ($analytics as $question) {
            $question_data = [
                "labels" => [],
                "count" => [],
                "has_images" => $question['has_images'],
                "images" => $question['images']
            ];
            // $question_data = [
            //     "question" => $question['question'],
            //     "question_id" => $question['question_id'],
            //     "question_type" => $question['question_type'],
            //     "has_images" => $question['has_images'],
            //     "question_options" => [],
            //     "response_count" => []
            // ];

            foreach ($question['question_options'] as $option) {
                $question_data['labels'][] = $option['option'];
                $question_data['count'][] = $option['count'];
            }

            $chart_data[] = $question_data;
        }

        // print_r($chart_data);
        // die;

        $analytics["all"] = $analytics;
        $analytics["chart_data"] = $chart_data;

        return $analytics;
    }

    function getElectionAnalyticsAlt($election_id)
    {
        $analytics = [];
        $result = $this->db_handle->runQuery(
            "SELECT eq.id AS question_id, eq.question, eq.question_type, eq.question_options,
                eo.option_id, eo.option_text
                FROM election_questions eq
                LEFT JOIN (
                    SELECT question_id, JSON_ARRAYAGG(JSON_OBJECT('id', id, 'text', text)) AS option_text
                    FROM election_question_options
                    GROUP BY question_id
                ) eo ON eq.id = eo.question_id
                WHERE eq.election_id = ?",
            "i",
            [$election_id]
        );

        if ($result) {
            foreach ($result as $question) {

                $question_id = $question['question_id'];
                $question = $question['question'];
                $question_type = $question['question_type'];
                $question_options = json_decode($question['question_options'], true);

                $has_images = 0;
                foreach ($question_options as $option) {
                    if (isset($option['cover_img']) && $option['cover_img'] != "") {
                        $has_images = 1;
                        break;
                    }
                }

                $response_count = [];
                $responses = $this->db_handle->runQuery(
                    "SELECT response_option, COUNT(*) AS response_count
                        FROM election_responses
                        WHERE question_id = ?
                        GROUP BY response_option",
                    "i",
                    [$question_id]
                );

                if ($responses) {
                    foreach ($responses as $response) {
                        $response_count[$response['response_option']] = $response['count'];
                    }

                    // set the counts for each option
                    $option_index = 1;
                    foreach ($question_options as $key => $option) {
                        if (isset($response_count[$option_index]))
                            $question_options[$key]['count'] = $response_count[$option_index];
                        else
                            $question_options[$key]['count'] = 0;
                        $option_index++;
                    }

                    // sort responses_count in ascending order of keys
                    ksort($response_count);

                    $analytics[] = [
                        "question" => $question['question'],
                        "question_id" => $question_id,
                        "question_type" => $question_type,
                        "has_images" => $has_images,
                        "question_options" => $question_options,
                        "response_count" => $response_count
                    ];
                }
            }
        }

        print_r($analytics);
    }

    // $sql = "
    //         SELECT eq.id, eq.question, eq.question_type, eq.question_options, 
    //         (SELECT COUNT(er.id) FROM election_responses er WHERE er.question_id = eq.id GROUP BY er.question_id) AS responsesCount
    //         FROM election_questions eq
    //         WHERE eq.election_id = ?";
    //     $result = $this->db_handle->runQuery($sql, "i", [$election_id]);

    //     if ($result !== false) {
    //         return $result;
    //     }

    //     return false;

    public function getAllChatUsers()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM chat_users WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAllStudentChatUsers()
    {
        $sql = "SELECT cu.*, u.name, u.profile_img 
                FROM chat_users cu 
                INNER JOIN user u ON cu.unique_id = u.id 
                WHERE cu.role = ?";

        $result = $this->db_handle->runQuery($sql, "i", [0]); //change 5 to 0

        if (!empty($result))
            return $result;

        return false;
    }

    public function getAllTimeSlotsByDateRange($id, $startDate, $endDate)
    {
        // $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE date >= ? AND date <= ?", "ss", [$startDate, $endDate]);4
        // $query = "SELECT * FROM timeslots WHERE counselor_id = ? AND status != ? AND `date` >= ? AND `date` <= ? AND CONCAT(`date`, ' ', start_time) >= NOW()";
        $query = "SELECT * FROM timeslots WHERE counselor_id = ? AND status != ? AND `date` >= ? AND `date` <= ? ";
        $result = $this->db_handle->runQuery($query, "iiss", [$id, 3, $startDate, $endDate]);
        if (count($result) > 0)
            return $result;

        return false;
    }
    // public function getTimeSlotsByCounselorId($id)
    // {
    //     // $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE counselor_id = ? AND status != ?", "ii", [$id,  3]);
    //     $query = "SELECT * FROM timeslots WHERE counselor_id = ?  AND status != ?  AND CONCAT(date, ' ', start_time) >= NOW()";

    //     $result = $this->db_handle->runQuery($query, "ii", [$id, 3]);

    //     if (count($result) > 0)
    //         return $result;

    //     return false;
    // }

    public function getAllChatMessages()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM messages WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }


    public function getAllChatMessagesById($outgoing_id, $incoming_id)
    {
        // $sql = "
        // SELECT * FROM messages 
        // LEFT JOIN chat_users ON chat_users.unique_id = messages.outgoing_msg_id
        // WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) 
        // OR (outgoing_msg_id = ? AND incoming_msg_id = ?) 
        // ORDER BY msg_id
        // ";

        $sql = "
        SELECT messages.*, chat_users.*, user.profile_img 
        FROM messages 
        LEFT JOIN chat_users ON chat_users.unique_id = messages.outgoing_msg_id
        LEFT JOIN user ON user.id = chat_users.unique_id
        WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) 
        OR (outgoing_msg_id = ? AND incoming_msg_id = ?) 
        ORDER BY msg_id
        ";

        $result = $this->db_handle->runQuery($sql, "iiii", [$outgoing_id, $incoming_id, $incoming_id, $outgoing_id]);
        if (count($result) > 0) {

            // for each message decrypt msg
            foreach ($result as $key => $message) {
                // check if base64 encoded message
                if (base64_encode(base64_decode($message['msg'], true)) === $message['msg'])
                    $result[$key]['msg'] = $this->decrypt($result[$key]['msg']);
            }

            return $result;
        }

        return "$outgoing_id $incoming_id";

        return false;
    }

    public function getAddedTimeSlots()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE booked = ?", "i", [0]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getTimeSlotsByCounselorId($id)
    {
        // $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE counselor_id = ? AND status != ?", "ii", [$id,  3]);
        $query = "SELECT * FROM timeslots WHERE counselor_id = ?  AND status != ?  AND CONCAT(date, ' ', start_time) >= NOW()";

        $result = $this->db_handle->runQuery($query, "ii", [$id, 3]);

        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getNotBookedTimeSlotsByCounselorId($id)
    {
        // $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE counselor_id = ? AND status = ?", "ii", [$id, 1]);
        $result = $this->db_handle->runQuery("SELECT * FROM timeslots t WHERE counselor_id = ? AND CONCAT(t.date, ' ', t.start_time) >= NOW() AND status = ?", "ii", [$id, 1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function checkExistingReservations($id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM reservation_requests WHERE student_id = ? AND (status = ? OR status = ?)", "iii", [$id, 0, 1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getNotBookedTimeSlots()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE added = ? AND booked = ?", "ii", [1, 0]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getReservationsByStudent($user_id, $counselor_id)
    {
        $result = $this->db_handle->runQuery("SELECT t.*, r.status as reservation_status, r.timeslot_id as timeslot_id, r.student_id as student_id, r.id as reservation_id FROM reservation_requests r, timeslots t WHERE r.timeslot_id = t.id AND r.student_id = ? AND t.counselor_id = ? AND (r.status != ? AND r.status != ? AND r.status != ?)", "iiiii", [$user_id, $counselor_id, 2, 4, 5]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getStudentIdByReservation($reservation_id)
    {
        $result = $this->db_handle->runQuery("SELECT student_id FROM reservation_requests WHERE id = ?", "i", [$reservation_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }



    public function getReservationsByStatus($status, $user_id, $counselor_id)
    {
        $result = $this->db_handle->runQuery("SELECT t.*, r.status as reservation_status, r.timeslot_id as timeslot_id, r.student_id as student_id, r.id as reservation_id FROM reservation_requests r, timeslots t WHERE r.timeslot_id = t.id AND r.status = ? AND r.student_id = ? AND t.counselor_id = ?", "iii", [$status, $user_id, $counselor_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }



    public function getAvailableReservationRequestsByCounselorId($id)
    {
        $result = $this->db_handle->runQuery("
            SELECT r.*, u.name, u.email, u.profile_img, s.year 
            FROM reservation_requests r
            JOIN user u ON r.student_id = u.id
            JOIN student s ON r.student_id = s.id
            JOIN timeslots t ON r.timeslot_id = t.id
            WHERE r.status = ? 
            AND t.counselor_id = ?
        ", "ii", [0, $id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getOneReservationRequest($counselor_id, $id)
    {
        // $result = $this->db_handle->runQuery("SELECT * FROM $table WHERE id = ?", "i", [$id]);
        $result = $this->db_handle->runQuery("
            SELECT r.*, u.name, u.email, u.profile_img, s.year, t.date, t.start_time, t.end_time 
            FROM reservation_requests r
            JOIN user u ON r.student_id = u.id
            JOIN student s ON r.student_id = s.id
            JOIN timeslots t ON r.timeslot_id = t.id
            WHERE r.status = ? 
            AND t.counselor_id = ?
            AND r.id = ?
        ", "iii", [0, $counselor_id, $id]);
        if (count($result) > 0)
            return $result[0];

        return false;
    }

    public function getReservationRequestsByStatus($status, $id)
    {
        // $result = $this->db_handle->runQuery("SELECT * FROM reservation_requests WHERE accepted = ? AND cancelled = ? AND completed = ?", "iii", [1, 0, 0]);
        $result = $this->db_handle->runQuery("
            SELECT r.*, u.name, u.email, u.profile_img, s.year , t.date, t.start_time, t.end_time
            FROM reservation_requests r
            JOIN user u ON r.student_id = u.id
            JOIN student s ON r.student_id = s.id
            JOIN timeslots t ON r.timeslot_id = t.id
            WHERE r.status = ?
            AND t.counselor_id = ?
        ", "ii", [$status, $id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAcceptedReservationRequests($id)
    {
        // $result = $this->db_handle->runQuery("SELECT * FROM reservation_requests WHERE accepted = ? AND cancelled = ? AND completed = ?", "iii", [1, 0, 0]);
        $result = $this->db_handle->runQuery("
            SELECT r.*, u.name, u.email, u.profile_img, s.year , t.date, t.start_time, t.end_time
            FROM reservation_requests r
            JOIN user u ON r.student_id = u.id
            JOIN student s ON r.student_id = s.id
            JOIN timeslots t ON r.timeslot_id = t.id
            WHERE r.status = ?
            AND t.counselor_id = ?
        ", "ii", [1, $id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function checkForOverlappingTimeSlots($counselor_id, $start_time, $end_time, $date)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE counselor_id = ? AND ((date = ? AND start_time <= ? AND end_time > ?) OR (date = ? AND start_time < ? AND end_time >= ?) OR (date = ? AND ? < start_time AND ? > end_time))", "ssssssssss", [$counselor_id, $date, $start_time, $start_time, $date, $end_time, $end_time, $date, $start_time, $end_time]);

        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCountAllUsers()
    {
        $result = $this->db_handle->runQuery("SELECT COUNT(*) as total_users FROM user WHERE ?", "i", [1]);
        if ($result !== null && isset($result[0]['total_users'])) {
            return $result[0]['total_users'];
        }
        return false;
    }

    public function getCountAcceptedReservations()
    {
        $result = $this->db_handle->runQuery("SELECT COUNT(*) as accepted_reservations FROM reservation_requests WHERE status = ?", "i", [1]);
        if ($result !== null && isset($result[0]['accepted_reservations'])) {
            return $result[0]['accepted_reservations'];
        }
        return false;
    }

    public function getCountFreeTimeSlots()
    {
        $result = $this->db_handle->runQuery("SELECT COUNT(*) as free_timeslots FROM timeslots WHERE status = ? OR status = ? ", "ii", [0,1]);
        if ($result !== null && isset($result[0]['free_timeslots'])) {
            return $result[0]['free_timeslots'];
        }
        return false;
    }

    public function getCountReservationRequests()
    {
        $result = $this->db_handle->runQuery("SELECT COUNT(*) as requests FROM reservation_requests WHERE status = ?", "i", [0]);
        if ($result !== null && isset($result[0]['requests'])) {
            return $result[0]['requests'];
        }
        return false;
    }


    public function getCountRoleUsers()
    {
        $result = $this->db_handle->runQuery("SELECT COUNT(*) as role_users FROM user WHERE role = ? OR role =? OR student_rep = ? OR club_rep = ? OR teaching_student = ?", "iiiii", [1, 5, 1, 1, 1]);
        if ($result && count($result) > 0) {
            return $result[0]['role_users'];
        }
        return false;
    }


    public function getCountNewUsers()
    {
        $currentYear = date('Y');

        $startDate = "{$currentYear}-01-01 00:00:00";
        $endDate = "{$currentYear}-12-31 23:59:59";

        $result = $this->db_handle->runQuery("SELECT COUNT(*) as new_users_count FROM user WHERE created_at BETWEEN ? AND ?", "ss", [$startDate, $endDate]);

        if ($result && count($result) > 0) {
            return $result[0]['new_users_count'];
        }

        return 0;
    }

    public function getChartOne()
    {
        $dataPoints = array();
        $currentTimestamp = time();
        for ($i = 0; $i < 48; $i++) {
            $timestamp = strtotime("-{$i} months", $currentTimestamp);
            $startOfMonth = strtotime('first day of', $timestamp);
            $endOfMonth = strtotime('last day of', $timestamp);
            $startDate = date('Y-m-d', $startOfMonth);
            $endDate = date('Y-m-d', $endOfMonth);
            // $result = $this->db_handle->runQuery("SELECT COUNT(*) as user_count FROM reservation_requests WHERE created_at >= ? AND created_at <= ?", "ss", [$startDate, $endDate]);
            $sql = "SELECT t.id as timeslot_id, COUNT(r.id) as reservation_count
                    FROM timeslots t
                    LEFT JOIN reservation_requests r ON r.timeslot_id = t.id
                    WHERE t.date >= ? AND t.date <= ?";
            
            $result = $this->db_handle->runQuery($sql, "ss", [$startDate, $endDate]);

            if ($result === false) {
                error_log("Error executing SQL query for period: $startDate to $endDate");
                continue;
            }
            if (count($result) > 0) {
                $reservationCount = (int) $result[0]['reservation_count'];
                $dataPoints[] = array("x" => $timestamp * 1000, "y" => $reservationCount);
            } else {
                error_log("No user creation records found for period: $startDate to $endDate");
            }
        }
        $dataPoints = array_reverse($dataPoints);
        return $dataPoints;
    }



    public function getChartTwo()
    {
        $dataPoints = array(
            array("label" => "Admin", "y" => 0),
            array("label" => "Super Admin", "y" => 0),
            array("label" => "Club Rep", "y" => 0),
            array("label" => "Student Rep", "y" => 0),
            array("label" => "Counselor", "y" => 0),
            array("label" => "Teaching_Student", "y" => 0)
        );
        $resultAdmin = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM user WHERE role = ?", "i", [1]);
        $resultSuperAdmin = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM user WHERE role = ?", "i", [2]);
        $resultClubRep = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM user WHERE club_rep = ?", "i", [1]);
        $resultStudentRep = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM user WHERE student_rep = ?", "i", [1]);
        $resultCounselor = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM user WHERE role = ?", "i", [5]);
        $resultTeachingStudent = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM user WHERE teaching_student = ?", "i", [1]);

        $dataPoints[0]["y"] = ($resultAdmin ? (int) $resultAdmin[0]['count'] : 0);
        $dataPoints[1]["y"] = ($resultSuperAdmin ? (int) $resultSuperAdmin[0]['count'] : 0);
        $dataPoints[2]["y"] = ($resultClubRep ? (int) $resultClubRep[0]['count'] : 0);
        $dataPoints[3]["y"] = ($resultStudentRep ? (int) $resultStudentRep[0]['count'] : 0);
        $dataPoints[4]["y"] = ($resultCounselor ? (int) $resultCounselor[0]['count'] : 0);
        $dataPoints[5]["y"] = ($resultTeachingStudent ? (int) $resultTeachingStudent[0]['count'] : 0);

        return $dataPoints;
    }

    public function getChartThree()
    {
        $dataPoints = array(
            array("label" => "First Year", "y" => 0),
            array("label" => "Second Year", "y" => 0),
            array("label" => "Third Year", "y" => 0),
            array("label" => "Fourth Year", "y" => 0),
        );
        $resultFirstYear = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM student WHERE year = ?", "i", [1]);
        $resultSecondYear = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM student WHERE year = ?", "i", [2]);
        $resultThirdYear = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM student WHERE year = ?", "i", [3]);
        $resultFourthYear = $this->db_handle->runQuery("SELECT COUNT(*) as count FROM student WHERE year = ?", "i", [4]);

        $dataPoints[0]["y"] = ($resultFirstYear ? (int) $resultFirstYear[0]['count'] : 0);
        $dataPoints[1]["y"] = ($resultSecondYear ? (int) $resultSecondYear[0]['count'] : 0);
        $dataPoints[2]["y"] = ($resultThirdYear ? (int) $resultThirdYear[0]['count'] : 0);
        $dataPoints[3]["y"] = ($resultFourthYear ? (int) $resultFourthYear[0]['count'] : 0);

        return $dataPoints;
    }

    public function getChartFour()
    {
        $dataPoints = array(
            array("label" => "Club Events", "y" => 0),
            array("label" => "Main Events", "y" => 0),
            array("label" => "Clubs", "y" => 0),
            array("label" => "Courses", "y" => 0),
            array("label" => "Course Materials", "y" => 0),
            array("label" => "Elections", "y" => 0),
            array("label" => "Posts", "y" => 0),
            array("label" => "Reservation Requests", "y" => 0),
            array("label" => "Timeslots", "y" => 0),
        );
        $resultClubEvents = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM club_events WHERE ?", "i", [1]);
        $resultMainEvents = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM main_events WHERE ?", "i", [1]);
        $resultClubs = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM clubs WHERE ?", "i", [1]);
        $resultCourses = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM courses WHERE ?", "i", [1]);
        $resultCourseMaterials = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM course_materials WHERE ?", "i", [1]);
        $resultElections = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM elections WHERE ?", "i", [1]);
        $resultPosts = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM posts WHERE ?", "i", [1]);
        $resultReservationRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE ?", "i", [1]);
        $resultTimeslots = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM timeslots WHERE ?", "i", [1]);

        $dataPoints[0]["y"] = ($resultClubEvents ? (int) $resultClubEvents[0]['counts'] : 0);
        $dataPoints[1]["y"] = ($resultMainEvents ? (int) $resultMainEvents[0]['counts'] : 0);
        $dataPoints[2]["y"] = ($resultClubs ? (int) $resultClubs[0]['counts'] : 0);
        $dataPoints[3]["y"] = ($resultCourses ? (int) $resultCourses[0]['counts'] : 0);
        $dataPoints[4]["y"] = ($resultCourseMaterials ? (int) $resultCourseMaterials[0]['counts'] : 0);
        $dataPoints[5]["y"] = ($resultElections ? (int) $resultElections[0]['counts'] : 0);
        $dataPoints[6]["y"] = ($resultPosts ? (int) $resultPosts[0]['counts'] : 0);
        $dataPoints[7]["y"] = ($resultReservationRequests ? (int) $resultReservationRequests[0]['counts'] : 0);
        $dataPoints[8]["y"] = ($resultTimeslots ? (int) $resultTimeslots[0]['counts'] : 0);

        return $dataPoints;
    }

    public function getChartFive()
    {
        $dataPoints = array(
            array("label" => "Created Reservation Requests", "y" => 0),
            array("label" => "Accepted Reservation Requests", "y" => 0),
            array("label" => "Denied Reservation Requests", "y" => 0),
            array("label" => "Completed Reservation Requests", "y" => 0),
            array("label" => "Canceled Reservation Requests", "y" => 0),
        );
        $resultCreatedRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE status = ?", "i", [0]);
        $resultAcceptedRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE status = ?", "i", [1]);
        $resultDeniedRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE status = ?", "i", [2]);
        $resultCompletedRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE status = ?", "i", [3]);
        $resultCanceledRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE status = ?", "i", [4]);

        $dataPoints[0]["y"] = ($resultCreatedRequests ? (int) $resultCreatedRequests[0]['counts'] : 0);
        $dataPoints[1]["y"] = ($resultAcceptedRequests ? (int) $resultAcceptedRequests[0]['counts'] : 0);
        $dataPoints[2]["y"] = ($resultDeniedRequests ? (int) $resultDeniedRequests[0]['counts'] : 0);
        $dataPoints[3]["y"] = ($resultCompletedRequests ? (int) $resultCompletedRequests[0]['counts'] : 0);
        $dataPoints[4]["y"] = ($resultCanceledRequests ? (int) $resultCanceledRequests[0]['counts'] : 0);

        return $dataPoints;
    }

    public function getUserSettings($id)
    {
        $sql = "SELECT * from user u, notification_settings n WHERE u.id = n.id AND n.id = ?";
        $result = $this->db_handle->runQuery($sql, "i", [$id]);
        if (count($result) > 0)
            return $result;
    }

    // public function getRecentCourses($id)
    // {
    //     $sql = "SELECT * from student WHERE id = ? ";
    //     $result = $this->db_handle->runQuery($sql, "i", [$id]);
    //     if (count($result) > 0)
    //         return $result;
    // }

    public function getUserDetails($id)
    {
        $sql = "SELECT * from user u, student s WHERE u.id = s.id AND s.id = ?";
        $result = $this->db_handle->runQuery($sql, "i", [$id]);
        if (count($result) > 0)
            return $result;
    }

    public function getUser($id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE id = ?", "i", [$id]);
        if (count($result) > 0)
            return $result[0];

        return false;
    }

    public function getPreviewUser($id)
    {

        $userdata = $this->db_handle->runQuery("SELECT * FROM user WHERE id = ?", "i", [$id]);

        if ($userdata[0]['role'] == 1) {
            $result = $this->db_handle->runQuery("SELECT u.*,a.contact_number, a.whatsapp_number, a.address  FROM user u, administrator a WHERE u.id = a.id AND u.id = ?", "i", [$id]);
        } else if ($userdata[0]['role'] == 5) {
            $result = $this->db_handle->runQuery("SELECT u.*, c.type, c.contact FROM user u, counselor c WHERE u.id = c.id AND u.id = ?", "i", [$id]);
        } else if ($userdata[0]['role'] == 3) {
            $result = $this->db_handle->runQuery("SELECT * FROM user WHERE id = ?", "i", [$id]);
        } else {
            if ($userdata[0]['club_rep'] == 1) {
                $result = $this->db_handle->runQuery("SELECT u.*, s.index_number, s.faculty, s.degree, s.year, cr.club_id, cr.user_id, cr.status, c.name AS club_name
                FROM user u
                JOIN student s ON u.id = s.id
                JOIN club_representative cr ON u.id = cr.user_id
                JOIN clubs c ON cr.club_id = c.id
                WHERE u.id = ?
                ", "i", [$id]);
            } else {
                $result = $this->db_handle->runQuery("SELECT * FROM user u, student s WHERE u.id = s.id AND u.id = ?", "i", [$id]);
            }
        }

        if (count($result) > 0)
            return $result[0];

        return false;
    }

    public function getCourseMaterial($course_id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM course_materials WHERE course_id = ?", "i", [$course_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getMaterials()
    {
        $sql = "SELECT co.name AS course_name, co.code AS course_code, co.year, co.semester, cm.id As material_ID,
        u.name AS user_name, u.student_id, u.email from course_materials cm , courses co, user u where course_id = co.id AND user_id = u.id AND ?";
        $result = $this->db_handle->runQuery($sql, "i", [1]);
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    public function getMaterialToView($id)
    {
        $sql = "SELECT co.id AS course_id , co.name AS course_name, co.code AS course_code,co.updated_at, co.year, co.semester, cm.id As material_ID, cm.video_links, cm.reference_links, cm.short_notes, cm.description, u.name AS user_name, u.student_id, u.email from course_materials cm, user u, courses co WHERE cm.course_id = co.id AND cm.user_id = u.id AND cm.id=?";

        $result = $this->db_handle->runQuery($sql, "i", [$id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCourses()
    {
        $sql = "SELECT * from courses WHERE ?";
        $result = $this->db_handle->runQuery($sql, "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public  function getCourseIdFromMaterial($id)
    {
        $sql = "SELECT course_id from course_materials WHERE id = ?";
        $result = $this->db_handle->runQuery($sql, "i", [$id]);
        if (count($result) > 0)
            return $result;
        return false;
    }

    public function getCounselors()
    {
        $sql = "SELECT * from user u , counselor c where c.id = u.id AND ?";
        $result = $this->db_handle->runQuery($sql, "i", [5]);
        if (count($result) > 0)
            return $result;

        return false;
    }
    public function getAdmin()
    {
        $sql = "SELECT * from user where role = ?";
        $result = $this->db_handle->runQuery($sql, "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }


    public function getOneCounselor($id)
    {
        $sql = "SELECT u.*, c.id as counselor_id, c.type as type, c.contact as contact from user u , counselor c where c.id = u.id AND u.id = ?";
        $result = $this->db_handle->runQuery($sql, "i", [$id]);
        if (count($result) > 0)
            return $result;

        return false;
    }
    
    public function getOneAdmin($id)
    {
        $sql = "SELECT * from user u , administrator a where u.id = a.id AND role = ? AND u.id = ?";
        $result = $this->db_handle->runQuery($sql, "ii", [1, $id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    // public function getOneCounselor($id)
    // {
    //     $sql = "SELECT * from user u , administrator a where u.id = a.id AND role = ? AND u.id = ?";
    //     $result = $this->db_handle->runQuery($sql, "ii", [1, $id]);
    //     if (count($result) > 0)
    //         return $result;

    //     return false;
    // }

    public function getCounselorPosts($type, $posted_by)
    {
        $sql = "
        SELECT p.*, u.profile_img, u.name,
            (SELECT COUNT(l.id) 
            FROM post_likes l 
            WHERE l.post_id = p.id
            GROUP BY l.post_id) AS likesCount 

            FROM posts p, user u
            WHERE p.type = ? 
            AND p.posted_by = u.id
            AND p.posted_by = ? 
            ORDER BY p.created_datetime DESC
        ";
        $result = $this->db_handle->runQuery($sql, "ii", [$type, $posted_by]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAllCounselorPosts($type)
    {
        $sql = "
        SELECT p.*,u.profile_img, u.name,
            (SELECT COUNT(l.id) 
            FROM post_likes l 
            WHERE l.post_id = p.id
            GROUP BY l.post_id) AS likesCount 

            FROM posts p , user u
            WHERE p.type = ? 
            AND p.posted_by = u.id
            AND ?
            ORDER BY p.created_datetime DESC
        ";
        $result = $this->db_handle->runQuery($sql, "ii", [$type, 1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getPostsOfClubs($club_id)
    {
        $sql = "
        SELECT p.*,u.profile_img, u.name,
            (SELECT COUNT(l.id) 
            FROM post_likes l 
            WHERE l.post_id = p.id
            GROUP BY l.post_id) AS likesCount 

            FROM posts p , user u , club_representative as cr, clubs as c
            WHERE p.type = 2 
            AND p.posted_by = u.id
            AND p.posted_by = cr.user_id
            AND cr.club_id = c.id
            AND c.id = ?
            ORDER BY p.created_datetime DESC
        ";
        $result = $this->db_handle->runQuery($sql, "i", [$club_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getPostsOfClubsBySearch($searchValue)
    {
        $sql = "
        SELECT p.*,u.profile_img, u.name,
            (SELECT COUNT(l.id) 
            FROM post_likes l 
            WHERE l.post_id = p.id
            GROUP BY l.post_id) AS likesCount 

            FROM posts p , user u , club_representative as cr, clubs as c
            WHERE p.type = 2 
            AND p.posted_by = u.id
            AND p.posted_by = cr.user_id
            AND cr.club_id = c.id
            AND c.name LIKE ?
            ORDER BY p.created_datetime DESC
        ";
        $result = $this->db_handle->runQuery($sql, "s", ["%$searchValue%"]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getOnePost($post_id)
    {
        $result = $this->db_handle->runQuery("
        SELECT p.title as title, p.id as post_id, p.posted_by as posted_by, p.description as description, p.post_image as post_image, u.id as id, u.name as name, p.link as link,
            (SELECT COUNT(l.id) 
            FROM post_likes l 
            WHERE l.post_id = p.id
            GROUP BY l.post_id) AS likesCount 
        FROM posts p, user u WHERE p.posted_by = u.id AND p.id = ? ", "i", [$post_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getPostComments($post_id)
    {
        $result = $this->db_handle->runQuery(
            "
        SELECT p.post_id as post_id,u.profile_img as profile_img, u.name as name, p.comment as comment, p.user_id as user_id, ps.posted_by as posted_by, p.id as id FROM post_comments p, user u, posts ps WHERE p.user_id = u.id AND  p.post_id = ps.id AND post_id = ? ",
            "i",
            [$post_id]
        );
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getPostLikes($post_id, $user_id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM post_likes WHERE post_id = ? AND user_id = ?", "ii", [$post_id, $user_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getClubRep($user_id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM club_representative cr, clubs c WHERE cr.club_id = c.id AND status = 1 AND user_id = ? ", "i", [$user_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getClubRepByUser($user_id, $status)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM club_representative cr WHERE user_id = ? AND status = ? ", "ii", [$user_id, $status]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    // public function getPostLikesCount($post_id)
    // {
    //     $result = $this->db_handle->runQuery("SELECT COUNT(l.id) as likesCount FROM posts p, post_likes l WHERE p.id = l.post_id AND p.id = ? GROUP BY l.post_id" , "i" ,[$post_id] );
    //     if (count($result) > 0)
    //         return $result;

    //     return false;
    // }

    public function getEvent($event_id)
    {
        $query = "
            SELECT main_events.*, courses.name AS course_name
            FROM main_events
            LEFT OUTER JOIN courses ON main_events.course_id = courses.id
            WHERE main_events.event_id = ?
        ";

        $result = $this->db_handle->runQuery($query, "i", [$event_id]);

        if ($result !== false && count($result) > 0) {
            return $result[0];  // Assuming you expect only one result for a given event_id
        }

        return false;
    }



    // public function getAllEvents($table)
    // {

    //     $sql = "SELECT * from main_events m, courses c where course_id = c.id AND m.end_date >= NOW() AND ? ORDER BY m.end_date ASC";
    //     $result = $this->db_handle->runQuery($sql, "i", [1]);

    //     // $result = $this->db_handle->runQuery("SELECT $table.*, courses.name AS course_name FROM $table LEFT OUTER JOIN courses ON $table.course_id = courses.id", "i", [1]);

    //     if (count($result) > 0)
    //         return $result;

    //     return false;
    // }

    public function getAllEvents($year)
    {

        $sql = "SELECT * from calendar c where c.date >= NOW() AND (c.type = 1 OR c.type = 2) AND (c.target = ? OR c.target = 5) ORDER BY c.date ASC";
        $result = $this->db_handle->runQuery($sql, "i", [$year]);

        // $result = $this->db_handle->runQuery("SELECT $table.*, courses.name AS course_name FROM $table LEFT OUTER JOIN courses ON $table.course_id = courses.id", "i", [1]);

        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getRequestsToApprove()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE student_rep = ? OR club_rep = ?", "ii", [2, 2]);
        if ($result !== false) {
            return $result;
        }
        return false;
    }

    public function getUsersToLimitAccess()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE student_rep = ? OR club_rep = ? OR teaching_student = ?", "iii", [1, 1, 1]);
        if ($result !== false) {
            return $result;
        }
        return false;
    }

    public function getTeachingStudentsToLimitAccess()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE teaching_student = ?", "i", [1]);
        if ($result !== false) {
            return $result;
        }
        return false;
    }

    public function getTeachingStudentsToApprove()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE teaching_student = ?", "i", [2]);
        if ($result !== false) {
            return $result;
        }
        return false;
    }

    public function getPreviewRepresentative($id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user u, student s WHERE u.id=s.id AND u.id = ?", "i", [$id]);
        if ($result !== false) {
            return $result;
        }
        return false;
    }

    public function getPreviewRepresentativeWithClub($id)
    {
        $userdata = $this->db_handle->runQuery("SELECT * FROM user WHERE id = ?", "i", [$id]);
        $result = [];
        if ($userdata[0]['club_rep'] == 1) {
            $result = $this->db_handle->runQuery("SELECT u.*, s.*, cr.*, c.id AS club_id, c.name AS club_name
            FROM user u
            JOIN student s ON u.id = s.id
            JOIN club_representative cr ON u.id = cr.user_id
            JOIN clubs c ON cr.club_id = c.id
            WHERE u.id = ?
                ", "i", [$id]);
        } else {
            $result = $this->db_handle->runQuery("SELECT * FROM user u, student s WHERE u.id = s.id AND u.id = ?", "i", [$id]);
        }
        if (count($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function getOngoingElections($table)
    {

        $sql = "SELECT * from elections e where e.end_date >= NOW() AND e.start_date <= NOW() AND ? ORDER BY e.end_date ASC";
        $result = $this->db_handle->runQuery($sql, "i", [1]);

        // $result = $this->db_handle->runQuery("SELECT $table.*, courses.name AS course_name FROM $table LEFT OUTER JOIN courses ON $table.course_id = courses.id", "i", [1]);

        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getPreviousElections($table)
    {

        $sql = "SELECT * from elections e where e.end_date <= NOW() AND ? ORDER BY e.end_date ASC";
        $result = $this->db_handle->runQuery($sql, "i", [1]);

        // $result = $this->db_handle->runQuery("SELECT $table.*, courses.name AS course_name FROM $table LEFT OUTER JOIN courses ON $table.course_id = courses.id", "i", [1]);

        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getMaterialsForCourse($course_id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM course_materials WHERE course_id = ?", "i", [$course_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAllClubs()
    {

        $sql = "SELECT * from clubs WHERE ?";
        $result = $this->db_handle->runQuery($sql, "i", [1]);

        // $result = $this->db_handle->runQuery("SELECT $table.*, courses.name AS course_name FROM $table LEFT OUTER JOIN courses ON $table.course_id = courses.id", "i", [1]);

        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getLatestReservation($user_id, $counselor_id)
    {

        $sql = "SELECT * from reservation_requests r, timeslots t WHERE r.timeslot_id = t.id AND r.status = 1 AND  CONCAT(t.date, ' ', t.start_time) >= NOW() AND r.student_id = ? AND t.counselor_id = ? ORDER BY CONCAT(t.date, ' ', t.start_time) LIMIT 1";
        $result = $this->db_handle->runQuery($sql, "ii", [$user_id, $counselor_id]);

        // $result = $this->db_handle->runQuery("SELECT $table.*, courses.name AS course_name FROM $table LEFT OUTER JOIN courses ON $table.course_id = courses.id", "i", [1]);

        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getOneTimeSlot($id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE id = ?", "i", [$id]);
        if ($result !== false) {
            return $result;
        }
        return false;
    }


    public function readLogEntries()
    {
        $filename = "userlog.txt";

        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $logEntries = [];
        $i = 0;
        foreach ($lines as $line) {
            $parts = explode("\t", $line);

            $logData = [
                "id" => $i++,
                'email' => $parts[0],
                'ip_address' => $parts[1],
                'timestamp' => $parts[2],
                'message' => $parts[3],
                'url' => $parts[4],
                'response_code' => $parts[5]
            ];

            $logEntries[] = $logData;
        }

        return $logEntries;
    }

    public function getLogAnalyticsChartOne()
    {
        $dataPoints = array(
            array("label" => "12 PM", "y" => 0),
            array("label" => "01 PM", "y" => 0),
            array("label" => "02 PM", "y" => 0),
            array("label" => "03 PM", "y" => 0),
            array("label" => "04 PM", "y" => 0),
            array("label" => "05 PM", "y" => 0),
            array("label" => "06 PM", "y" => 0),
            array("label" => "07 PM", "y" => 0),
            array("label" => "08 PM", "y" => 0),
            array("label" => "09 PM", "y" => 0),
            array("label" => "10 PM", "y" => 0),
            array("label" => "11 PM", "y" => 0),
            array("label" => "12 AM", "y" => 0),
            array("label" => "01 AM", "y" => 0),
            array("label" => "02 AM", "y" => 0),
            array("label" => "03 AM", "y" => 0),
            array("label" => "04 AM", "y" => 0),
            array("label" => "05 AM", "y" => 0),
            array("label" => "06 AM", "y" => 0),
            array("label" => "07 AM", "y" => 0),
            array("label" => "08 AM", "y" => 0),
            array("label" => "09 AM", "y" => 0),
            array("label" => "10 AM", "y" => 0),
            array("label" => "11 AM", "y" => 0)
        );

        $filename = "userlog.txt";
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $parts = explode("\t", $line);
            $timestamp = strtotime($parts[2]);
            $statusCode = (int) substr($parts[5], 0, 3);
            if (($statusCode === 603) || ($statusCode === "603")) {
                $hour = date('h A', $timestamp);
                foreach ($dataPoints as &$point) {
                    if ($point["label"] === $hour) {
                        $point["y"]++;
                        break;
                    }
                }
            }
        }
        $dataPoints = array_reverse($dataPoints);
        return $dataPoints;
    }

    public function getLogAnalyticsChartTwo()
    {
        $dataPoints = array(
            array("label" => "Success (200)", "y" => 0),
            array("label" => "Created (201)", "y" => 0),
            array("label" => "Bad Request (400)", "y" => 0),
            array("label" => "Unauthorized (401)", "y" => 0),
            array("label" => "User Created (600)", "y" => 0),
            array("label" => "User Updated (601)", "y" => 0),
            array("label" => "User Deleted (602)", "y" => 0),
            array("label" => "User Logged In (603)", "y" => 0),
            array("label" => "User Logged Out (604)", "y" => 0),
            array("label" => "User Password Changed (605)", "y" => 0),
            array("label" => "User Granted Permission (606)", "y" => 0),
            array("label" => "User Revoked Permission (607)", "y" => 0)
        );
        $filename = "userlog.txt";
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            preg_match('/(\d{3})\s*$/', $line, $matches);
            $statusCode = isset($matches[1]) ? (int)$matches[1] : null;
            if ($statusCode !== null) {
                foreach ($dataPoints as &$point) {
                    if (strpos($point["label"], $statusCode) !== false) {
                        $point["y"]++;
                        break;
                    }
                }
            }
        }

        return $dataPoints;
    }




    public function getLogAnalyticsChartThree()
    {
        $dataPoints = array(
            array("label" => "Unauthorized (401)", "y" => 0),
            array("label" => "User Created (600)", "y" => 0),
            array("label" => "User Updated (601)", "y" => 0),
            array("label" => "User Deleted (602)", "y" => 0),
            array("label" => "User Logged In (603)", "y" => 0),
            array("label" => "User Logged Out (604)", "y" => 0),
            array("label" => "User Password Changed (605)", "y" => 0),
            array("label" => "User Granted Permission (606)", "y" => 0),
            array("label" => "User Revoked Permission (607)", "y" => 0)
        );
        $filename = "userlog.txt";
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            preg_match('/(\d{3})\s*$/', $line, $matches);
            $statusCode = isset($matches[1]) ? (int)$matches[1] : null;
            if ($statusCode !== null) {
                foreach ($dataPoints as &$point) {
                    if (strpos($point["label"], $statusCode) !== false) {
                        $point["y"]++;
                        break;
                    }
                }
            }
        }

        return $dataPoints;
    }

    public function getLogAnalyticsChartFour()
    {
        $dataPoints = array(
            array("label" => "Success (200)", "y" => 0),
            array("label" => "Created (201)", "y" => 0),
            array("label" => "Bad Request (400)", "y" => 0),
        );
        $filename = "userlog.txt";
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            preg_match('/(\d{3})\s*$/', $line, $matches);
            $statusCode = isset($matches[1]) ? (int)$matches[1] : null;
            if ($statusCode !== null) {
                foreach ($dataPoints as &$point) {
                    if (strpos($point["label"], $statusCode) !== false) {
                        $point["y"]++;
                        break;
                    }
                }
            }
        }

        return $dataPoints;
    }

    public function getLogAnalyticsChartFive()
    {
        $dataPoints = array(
            array("label" => "Granted Permission (606)", "y" => 0),
            array("label" => "Revoked Permission (607)", "y" => 0)
        );
        $filename = "userlog.txt";
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            preg_match('/(\d{3})\s*$/', $line, $matches);
            $statusCode = isset($matches[1]) ? (int)$matches[1] : null;
            if ($statusCode !== null) {
                foreach ($dataPoints as &$point) {
                    if (strpos($point["label"], $statusCode) !== false) {
                        $point["y"]++;
                        break;
                    }
                }
            }
        }

        return $dataPoints;
    }

    public function getLogAnalytics()
    {

        $filename = "userlog.txt";
        $statusCodes = [
            401 => "Unauthorized",
            600 => "User Created",
            602 => "User Deleted",
            603 => "User Logged In",
            606 => "User Granted Permission",
            607 => "User Revoked Permission"
        ];
        $statusCounts = array_fill_keys(array_keys($statusCodes), 0);
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $parts = explode("\t", $line);
            $statusCode = intval(trim(end($parts)));
            if (isset($statusCounts[$statusCode])) {
                $statusCounts[$statusCode]++;
            }
        }
        $analytics = [];
        foreach ($statusCounts as $code => $count) {
            $analytics[] = [
                "status_code" => $code,
                "description" => $statusCodes[$code],
                "count" => $count
            ];
        }

        return $analytics;
    }


    // get all the posts of the counselor
    // public function getCounselorPosts()
    // {
    //     $result = $this->db_handle->runQuery("SELECT * FROM posts where ?", "i", [1]);
    //     if (count($result) > 0)
    //         return $result;

    //     return false;
    // }

    /**
     * Courses Model
     */

    // CREATE TABLE `courses` (
    //     `id` int(11) NOT NULL AUTO_INCREMENT,
    //     `name` varchar(255) NOT NULL,
    //     `code` varchar(255) NOT NULL,
    //     `description` varchar(255) DEFAULT NULL,
    //     `year` int(11) NOT NULL,
    //     `semester` int(11) NOT NULL,
    //     `created_at` DATETIME default current_timestamp,
    //     `updated_at` DATETIME default current_timestamp,
    //     PRIMARY KEY (`id`),
    //     UNIQUE KEY `code` (`code`)
    //   );   


    public function getEmptyCourseForAdmin()
    {

        $empty = [
            "name" => "",
            "code" => "",
            "description" => "",
            "year" => "",
            "semester" => ""
        ];

        $template = [
            "name" => [
                "label" => "Course Name",
                "type" => "text",
                "validation" => "required"
            ],
            "code" => [
                "label" => "Course Code",
                "type" => "text",
                "validation" => "required"
            ],
            "description" => [
                "label" => "Course Description",
                "type" => "text",
                "validation" => ""
            ],
            "year" => [
                "label" => "Year",
                "type" => "number",
                "validation" => "required",
            ],
            "semester" => [
                "label" => "Semester",
                "type" => "number",
                "validation" => "required"
            ],
            "cover_img" => [
                "label" => "Cover Image",
                "type" => "array",
                "validation" => "required",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }


    public function getEmptyCourse()
    {

        $empty = [
            "name" => "",
            "code" => "",
            "description" => "",
            "semester" => ""
        ];

        $template = [
            "name" => [
                "label" => "Course Name",
                "type" => "text",
                "validation" => "required"
            ],
            "code" => [
                "label" => "Course Code",
                "type" => "text",
                "validation" => "required"
            ],
            "description" => [
                "label" => "Course Description",
                "type" => "text",
                "validation" => ""
            ],
            "year" => [
                "label" => "Year",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "semester" => [
                "label" => "Semester",
                "type" => "number",
                "validation" => "required"
            ],
            "cover_img" => [
                "label" => "Cover Image",
                "type" => "array",
                "validation" => "required",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyAcademinEndDateStartDate()
    {
        $empty = [
            "academic_start_date" => "",
            "academic_end_date" => ""
        ];

        $template = [
            "start_date" => [
                "label" => "Start Date",
                "type" => "date",
                "validation" => "required"
            ],
            "end_date" => [
                "label" => "End Date",
                "type" => "date",
                "validation" => "required"
            ]
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }



    /**
     * Course Material Model
     */

    //  CREATE TABLE `course_materials` (
    //     `id` int(11) NOT NULL AUTO_INCREMENT,
    //     `course_id` int(11) NOT NULL,
    //     `user_id` int(11) NOT NULL,
    //     `video_links` varchar(500) NULL,
    //     `reference_links` varchar(500) NULL,
    //     `short_notes` varchar(500) NULL,
    //     `description` varchar(255) DEFAULT NULL,
    //     `created_at` DATETIME default current_timestamp,
    //     `updated_at` DATETIME default current_timestamp,
    //     PRIMARY KEY (`id`),
    //     FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE
    //   );    

    public function getEmptyCourseMaterialForAdmin()
    {
        $empty = [
            "course_id" => "",
            "video_links" => "",
            "reference_links" => "",
            "short_notes" => "",
            "description" => ""
        ];

        $template = [
            "course_id" => [
                "label" => "Course",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "video_links" => [
                "label" => "Video Links",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "reference_links" => [
                "label" => "Reference Links",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "short_notes" => [
                "label" => "Short Notes",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "description" => [
                "label" => "Description",
                "type" => "text",
                "validation" => ""
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyCourseMaterial()
    {

        $empty = [
            "course_id" => "",
            "user_id" => "",
            "video_links" => "",
            "reference_links" => "",
            "short_notes" => "",
            "description" => ""
        ];

        $template = [
            "course_id" => [
                "label" => "Course",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "user_id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "video_links" => [
                "label" => "Video Links",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "reference_links" => [
                "label" => "Reference Links",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "short_notes" => [
                "label" => "Short Notes",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "description" => [
                "label" => "Description",
                "type" => "text",
                "validation" => ""
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    // CREATE TABLE election_responses (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     election_id INT NOT NULL,
    //     user_id INT NOT NULL,
    //     question_id INT NOT NULL,
    //     response_option VARCHAR(255) DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (election_id) REFERENCES elections(id),
    //     FOREIGN KEY (user_id) REFERENCES user(id),
    //     FOREIGN KEY (question_id) REFERENCES election_questions(id)
    // );

    public function getEmptyElectionResponse()
    {

        $empty = [
            "election_id" => "",
            "user_id" => "",
            "question_id" => "",
            "response_option" => ""
        ];

        $template = [
            "election_id" => [
                "label" => "Election",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "user_id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "question_id" => [
                "label" => "Question",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "response_option" => [
                "label" => "Response Option",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    // -- forum post
    // CREATE TABLE forum_posts (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT NOT NULL,
    //     title VARCHAR(255) NOT NULL,
    //     content TEXT NOT NULL,
    //     image VARCHAR(255) DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (user_id) REFERENCES user(id)
    // );

    // -- forum comments
    // -- thread style
    // CREATE TABLE forum_comments (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT NOT NULL,
    //     post_id INT NOT NULL,
    //     parent_id INT DEFAULT NULL,
    //     content TEXT NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (user_id) REFERENCES user(id),
    //     FOREIGN KEY (post_id) REFERENCES forum_posts(id),
    //     FOREIGN KEY (parent_id) REFERENCES forum_comments(id)
    // );


    public function getEmptyForumPost()
    {
        $empty = [
            "user_id" => "",
            "title" => "",
            "content" => "",
            "cover_img" => ""
        ];

        $template = [
            "user_id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "title" => [
                "label" => "Title",
                "type" => "text",
                "validation" => "required"
            ],
            "content" => [
                "label" => "Content",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "cover_img" => [
                "label" => "Image",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    // CREATE TABLE forum_comments (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT NOT NULL,
    //     post_id INT NOT NULL,
    //     parent_id INT DEFAULT NULL,
    //     content TEXT NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (user_id) REFERENCES user(id),
    //     FOREIGN KEY (post_id) REFERENCES forum_posts(id),
    //     FOREIGN KEY (parent_id) REFERENCES forum_comments(id)
    // );

    public function getEmptyForumComment()
    {
        $empty = [
            "user_id" => "",
            "post_id" => "",
            "parent_id" => "",
            "content" => ""
        ];

        $template = [
            "user_id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "post_id" => [
                "label" => "Post",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "parent_id" => [
                "label" => "Parent",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "content" => [
                "label" => "Content",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    // -- is_broadcast
    // --     0 - Personal
    // --     1 - Broadcast


    // -- target
    // --    0 - All
    // --    5 - All Students
    // --      1 - Student - 1st Year
    // --      2 - Student - 2nd Year
    // --      3 - Student - 3rd Year
    // --      4 - Student - 4th Year
    // --    6 - Counsellor

    // CREATE TABLE calendar (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     user_id INT DEFAULT NULL,
    //     is_broadcast TINYINT(1) NOT NULL DEFAULT 0,
    //     target TINYINT(1) NOT NULL DEFAULT 0,
    //     title VARCHAR(255) NOT NULL,
    //     module VARCHAR(255) DEFAULT NULL,
    //     description TEXT DEFAULT NULL,
    //     type TINYINT(1) NOT NULL DEFAULT 1,
    //     date DATETIME NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (user_id) REFERENCES user(id)
    // );

    public function getEmptyCalendarEvent()
    {
        $empty = [
            "user_id" => "",
            "is_broadcast" => "",
            "target" => "",
            "title" => "",
            "module" => "",
            "description" => "",
            "date" => "",
            "type" => ""
        ];

        $template = [
            "user_id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "is_broadcast" => [
                "label" => "Broadcast",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "target" => [
                "label" => "Target",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "title" => [
                "label" => "Title",
                "type" => "text",
                "validation" => "required"
            ],
            "module" => [
                "label" => "Module Name (Optional)",
                "type" => "text",
                "validation" => ""
            ],
            "description" => [
                "label" => "Description (Optional)",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "date" => [
                "label" => "Date",
                "type" => "datetime-local",
                "validation" => "required"
            ],
            "type" => [
                "label" => "Type",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }


    /**
     * User Model
     */

    //  CREATE TABLE `user` (
    //     `id` int(11) NOT NULL AUTO_INCREMENT,
    //     `student_id` varchar(255) DEFAULT NULL,
    //     `password` varchar(255) NOT NULL,
    //     `email` varchar(255) NOT NULL,
    //     `alt_email` varchar(255) DEFAULT NULL,
    //     `name` varchar(255) NOT NULL,
    //     `role` smallint(6) NOT NULL DEFAULT '0',
    //     `status` smallint(6) NOT NULL DEFAULT '1',
    //     `profile_img` varchar(255) DEFAULT NULL,
    //     `student_rep` int NOT NULL DEFAULT '0',
    //     `club_rep` int NOT NULL DEFAULT '0',
    //     `teaching_student` int NOT NULL DEFAULT '0',
    //     `created_at` DATETIME default current_timestamp,
    //     `updated_at` DATETIME default current_timestamp,
    //     PRIMARY KEY (`id`),
    //     UNIQUE KEY `email` (`email`)
    //   );

    public function getEmptyUser()
    {

        $empty = [
            "student_id" => "",
            "password" => "",
            "email" => "",
            "alt_email" => "",
            "name" => "",
            "role" => "",
            "status" => "",
            "profile_img" => "",
            "student_rep" => "",
            "club_rep" => "",
            "teaching_student" => ""
        ];

        $template = [
            "student_id" => [
                "label" => "Student ID",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "password" => [
                "label" => "Password",
                "type" => "password",
                "validation" => ""
            ],
            "email" => [
                "label" => "Email",
                "type" => "email",
                "validation" => "required"
            ],
            "alt_email" => [
                "label" => "Alternate Email",
                "type" => "email",
                "validation" => ""
            ],
            "name" => [
                "label" => "Name",
                "type" => "text",
                "validation" => "required"
            ],
            "role" => [
                "label" => "Role",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "status" => [
                "label" => "Status",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "profile_img" => [
                "label" => "Profile Image",
                "type" => "array",
                "validation" => "",
                "skip" => true
            ],
            "student_rep" => [
                "label" => "Student Rep",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "club_rep" => [
                "label" => "Club Rep",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "teaching_student" => [
                "label" => "Teaching Student",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyAdmin()
    {

        $empty = [
            "id" => "",
            "contact_number" => "",
            "whatsapp_number" => "",
            "address" => "",
        ];

        $template = [
            "id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "contact_number" => [
                "label" => "Contact Number",
                "type" => "text",
                "validation" => "required"
            ],
            "whatsapp_number" => [
                "label" => "Whatsapp Number",
                "type" => "text",
                "validation" => "required"
            ],
            "address" => [
                "label" => "Address",
                "type" => "text",
                "validation" => "required"
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyCounselor()
    {
        $empty = [
            "id" => "",
            "contact" => "",
            "type" => "",
        ];

        $template = [
            "id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "contact" => [
                "label" => "Contact Number",
                "type" => "text",
                "validation" => "required"
            ],
            "type" => [
                "label" => "Type",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyChatUser()
    {
        $empty = [
            "unique_id" => "",
            "role" => "",
        ];

        $template = [
            "unique_id" => [
                "label" => "User",
                "type" => "number",
                "validation" => ""
            ],
            "role" => [
                "label" => "Contact Number",
                "type" => "text",
                "validation" => ""
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyElection()
    {

        $empty = [
            "user_id" => "",
            "name" => "",
            "description" => "",
            "start_date" => "",
            "end_date" => "",
            "type" => "",
            "target" => ""
        ];

        $template = [
            "user_id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "name" => [
                "label" => "Election Name",
                "type" => "text",
                "validation" => "required"
            ],
            "description" => [
                "label" => "Description",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "start_date" => [
                "label" => "Start Date",
                "type" => "datetime-local",
                "validation" => "required"
            ],
            "end_date" => [
                "label" => "End Date",
                "type" => "datetime-local",
                "validation" => "required"
            ],
            "cover_img" => [
                "label" => "Cover Image",
                "type" => "array",
                "validation" => "required",
                "skip" => true
            ],
            "type" => [
                "label" => "Election Type",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "target" => [
                "label" => "Target",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    /**
     * Elections Questions Model
     */


    // CREATE TABLE election_questions (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     election_id INT NOT NULL,
    //     question VARCHAR(255) NOT NULL,
    //     question_type VARCHAR(255) NOT NULL,
    //     question_options VARCHAR(255) DEFAULT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     FOREIGN KEY (election_id) REFERENCES elections(id)
    // );

    public function getEmptyElectionQuestion()
    {

        $empty = [
            "election_id" => "",
            "question" => "",
            "question_type" => "",
            "question_options" => ""
        ];

        $template = [
            "election_id" => [
                "label" => "Election",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "question" => [
                "label" => "Question",
                "type" => "text",
                "validation" => "required"
            ],
            "question_type" => [
                "label" => "Question Type",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "question_options" => [
                "label" => "Question Options",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }



    /**
     * Counselor Feed Model
     */

    //  CREATE TABLE `counselor_posts` (
    //     `id` int(11) NOT NULL AUTO_INCREMENT,
    //     `user_id` int(11) NOT NULL,
    //     `title` varchar(255) NULL,
    //     `description` varchar(255) DEFAULT NULL,
    //     `image` varchar(255) DEFAULT NULL,
    //     `created_at` DATETIME default current_timestamp,
    //     `updated_at` DATETIME default current_timestamp,
    //     PRIMARY KEY (`id`),
    //     FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
    //   );

    public function getEmptyCounselorPost()
    {

        $empty = [
            "title" => "",
            "description" => "",
            "link" => "",
            "post_image" => "",
            "posted_by" => "",
            "type" => "",
            "updated_datetime" => ""
        ];

        $template = [
            "title" => [
                "label" => "Post Title",
                "type" => "text",
                "validation" => "required"
            ],
            "description" => [
                "label" => "Description",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "link" => [
                "label" => "Link",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],
            "post_image" => [
                "label" => "Image",
                "type" => "array",
                "validation" => "required",
                "skip" => true
            ],
            "posted_by" => [
                "label" => "User",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "type" => [
                "label" => "Type",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "updated_datetime" => [
                "label" => "Updated Date Time",
                "type" => "datetime-local",
                "validation" => "required",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyPostComments()
    {

        $empty = [
            "comment" => "",
            "post_id" => "",
            "user_id" => ""
        ];

        $template = [
            "comment" => [
                "label" => "Comment",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "post_id" => [
                "label" => "Post ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "user_id" => [
                "label" => "User ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ]
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyMessage()
    {

        $empty = [
            // "msg_id" => "",
            "incoming_msg_id" => "",
            "outgoing_msg_id" => "",
            "msg" => "",
        ];

        $template = [
            // "msg_id" => [
            //     "label" => "Message ID",
            //     "type" => "number",
            //     "validation" => "",
            // ],
            "incoming_msg_id" => [
                "label" => "Incoming Message ID",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "outgoing_msg_id" => [
                "label" => "Outgoing Message ID",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "msg" => [
                "label" => "Message",
                "type" => "text",
                "validation" => "required"
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyPostLikes()
    {

        $empty = [
            "post_id" => "",
            "user_id" => ""
        ];

        $template = [
            "post_id" => [
                "label" => "Post ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "user_id" => [
                "label" => "User ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ]
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyClub()
    {

        $empty = [
            "id" => "",
            "name" => ""
        ];

        $template = [
            "id" => [
                "label" => "Club ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "name" => [
                "label" => "Club Name",
                "type" => "text",
                "validation" => "required"
            ]
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyClubReps()
    {

        $empty = [
            "club_id" => "",
            "user_id" => "",
            "status" => ""
        ];

        $template = [
            "club_id" => [
                "label" => "Club ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "user_id" => [
                "label" => "User ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "status" => [
                "label" => "Status",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],

        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    /**
     * Student Profile Model
     */

    //  CREATE TABLE student_profile (
    //     id INT(5) AUTO_INCREMENT PRIMARY KEY,
    //     student_id VARCHAR(255) UNIQUE,
    //     degree VARCHAR(255),
    //     alt_email VARCHAR(255),
    //     profile_picture VARCHAR(255),
    //     email VARCHAR(255) UNIQUE,
    //     preferred_email INT(1) DEFAULT 0,
    //     exam_notify INT(1) DEFAULT 0,
    //     reminder_notify INT(1) DEFAULT 0,
    //     events_notify INT(1) DEFAULT 0,
    //     materials_notify INT(1) DEFAULT 0,
    //     notify_duration INT(1) DEFAULT 0
    // );


    public function getEmptyNotificationSetting()
    {

        $empty = [
            "id" => "",
            "preferred_email" => "",
            "exam_notify" => "",
            "reminder_notify" => "",
            "events_notify" => "",
            "materials_notify" => "",
            "notify_duration" => ""
        ];

        $template = [
            "id" => [
                "label" => "Student ID",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "preferred_email" => [
                "label" => "Preferred Email Address to receive Notifications",
                "type" => "select",
                "validation" => "",
                "skip" => true
            ],
            "exam_notify" => [
                "label" => "Send Exam and Assignment Notifications",
                "type" => "checkbox",
                "validation" => "",
            ],
            "reminder_notify" => [
                "label" => "Send Reminder Notifications through",
                "type" => "checkbox",
                "validation" => "",
            ],
            "events_notify" => [
                "label" => "Send New Club Event Post Notifications",
                "type" => "checkbox",
                "validation" => "",
            ],
            "materials_notify" => [
                "label" => "Send New Material update Notifications",
                "type" => "checkbox",
                "validation" => "",
            ],
            "notify_duration" => [
                "label" => "Send Reminder Notifications (No. of days before)",
                "type" => "select",
                "validation" => "",
                "skip" => true
            ],

        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyStudent()
    {

        $empty = [
            "id" => "",
            "index_number" => "",
            "faculty" => "",
            "degree" => "",
            "year" => "",
            "recent_courses" => "",
        ];

        $template = [
            "id" => [
                "label" => "User ID",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "index_number" => [
                "label" => "Index Number",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "faculty" => [
                "label" => "Faculty",
                "type" => "text",
                "validation" => "required"
            ],
            "degree" => [
                "label" => "Degree",
                "type" => "text",
                "validation" => "required"
            ],
            "year" => [
                "label" => "Year",
                "type" => "number",
                "validation" => "required"
            ],
            "recent_courses" => [
                "label" => "Recent Courses",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ]


        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }


    /**
     * Student Profile Model
     */

    //  CREATE TABLE main_events (
    //     event_id INT(11) AUTO_INCREMENT,
    //     type INT(11),
    //     status INT(11),
    //     title VARCHAR(255),
    //     description VARCHAR(255),
    //     end_date DATE,
    //     start_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     user_id INT(11),
    //     course_id INT(11),
    //     PRIMARY KEY (event_id),
    //     FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE RESTRICT ON UPDATE RESTRICT,
    //     FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
    // );



    public function getEmptyMainEvent()
    {

        $empty = [
            "event_id" => "",
            "type" => "",
            "status" => "",
            "title" => "",
            "description" => "",
            "end_date" => "",
            "start_date" => "",
            "user_id" => "",
            "course_id" => "",

        ];

        $template = [
            "type" => [
                "label" => "Event Type",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "status" => [
                "label" => "Event Status",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],

            "title" => [
                "label" => "Title of the event",
                "type" => "text",
                "validation" => ""
            ],
            "description" => [
                "label" => "Event Description",
                "type" => "text"
            ],
            "end_date" => [
                "label" => "Event Ending Date",
                "type" => "date"
            ],
            "start_date" => [
                "label" => "Event Starting Date",
                "type" => "date"
            ],

        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    //Counselor and Club Representative Posts

    public function getEmptyPost()
    {

        $empty = [
            "id" => "",
            "type" => "",
            "description" => "",
            "image" => "",
            "created_datetime" => "",
            "posted_by" => "",
            "title" => "",
            "updated_datetime" => "",
        ];

        $template = [
            "type" => [
                "label" => "Type of the post",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "description" => [
                "label" => "Description",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "image" => [
                "label" => "Post Image",
                "type" => "array",
                "validation" => "",
                "skip" => true
            ],

            "title" => [
                "label" => "Title of the post",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],

            "posted_by" => [
                "label" => "Who posted the post",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],

            "updated_datetime" => [
                "label" => "Post Updated Time",
                "type" => "text",
                "validation" => "",
                "skip" => true
            ],

        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    //Virajith

    public function getEmptyReservation()
    {

        $empty = [
            "timeslot_id" => "",
            "student_id" => "",
            "status" => "",
        ];

        $template = [
            "timeslot_id" => [
                "label" => "Time Slot",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],

            "student_id" => [
                "label" => "User ID",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "status" => [
                "label" => "Status",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getEmptyTimeSlot()
    {

        $empty = [
            "id" => "",
            "counselor_id" => "",
            "date" => "",
            "start_time" => "",
            "end_time" => "",
            "status" => "",
        ];

        $template = [
            "counselor_id" =>
            [
                "label" => "Counselor ID",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "date" => [
                "label" => "Date",
                "type" => "date",
                "validation" => "required",

            ],

            "start_time" => [
                "label" => "Start Time",
                "type" => "time",
                "validation" => "required",

            ],

            "end_time" => [
                "label" => "End Time",
                "type" => "time",
                "validation" => "required",

            ],
            "status" => [
                "label" => "Status",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],

        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }
}
