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

    public function lastInsertedId($table , $key){

        $result = $this->db_handle->runQuery("SELECT * FROM  $table ORDER BY $key DESC LIMIT 1 WHERE ?", "i", [1]);
        if(count($result)>0)
            return $result[0]->key;
        return 0;
    }

    public function getAll($table)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM $table WHERE ?", "i", [1]);
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

    public function getAllUsers()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE ?", "i", [1]);
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
            $result = $this->db_handle->runQuery("SELECT COUNT(*) as user_count FROM user WHERE created_at >= ? AND created_at <= ?", "ss", [$startDate, $endDate]);
            if ($result === false) {
                error_log("Error executing SQL query for period: $startDate to $endDate");
                continue;
            }
            if (count($result) > 0) {
                $userCount = (int) $result[0]['user_count'];
                $dataPoints[] = array("x" => $timestamp * 1000, "y" => $userCount);
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
            array("label" => "Accepted Reservation Requests", "y" => 0),
            array("label" => "Denied Reservation Requests", "y" => 0),
        );
        $resultAcceptedRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE accepted = ?", "i", [1]);
        $resultDeniedRequests = $this->db_handle->runQuery("SELECT COUNT(*) as counts FROM reservation_requests WHERE declined = ?", "i", [1]);

        $dataPoints[0]["y"] = ($resultAcceptedRequests ? (int) $resultAcceptedRequests[0]['counts'] : 0);
        $dataPoints[1]["y"] = ($resultDeniedRequests ? (int) $resultDeniedRequests[0]['counts'] : 0);

        return $dataPoints;
    }


    public function getUserSettings($id)
    {
        $sql = "SELECT * from user u, notification_settings n WHERE u.id = n.user_id AND n.user_id = ?";
        $result = $this->db_handle->runQuery($sql, "i", [$id]);
        if (count($result) > 0)
            return $result;
    }

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
        $sql = "SELECT co.name AS course_name, co.code AS course_code,co.updated_at, co.year, co.semester, cm.id As material_ID, cm.video_links, cm.reference_links, cm.short_notes, cm.description, u.name AS user_name, u.student_id, u.email from course_materials cm, user u, courses co WHERE cm.course_id = co.id AND cm.user_id = u.id AND ?";

        $result = $this->db_handle->runQuery($sql, "i", [$id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCounselors()
    {
        $sql = "SELECT * from user u , counselor c where user_id = u.id AND ?";
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
        $sql = "SELECT * from user u , counselor c where user_id = u.id AND id = ?";
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

    public function getPostComments($post_id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM post_comments WHERE post_id = ?", "i", [$post_id]);
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


    public function getAllEvents($table)
    {

        $sql = "SELECT * from main_events m, courses c where course_id = c.id AND m.end_date >= NOW() AND ? ORDER BY m.end_date ASC";
        $result = $this->db_handle->runQuery($sql, "i", [1]);

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
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE id = ?", "i", [$id]);
        if ($result !== false) {
            return $result;
        }
        return false;
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

    public function getAllClubs()
    {

        $sql = "SELECT * from clubs WHERE ?";
        $result = $this->db_handle->runQuery($sql, "i", [1]);

        // $result = $this->db_handle->runQuery("SELECT $table.*, courses.name AS course_name FROM $table LEFT OUTER JOIN courses ON $table.course_id = courses.id", "i", [1]);

        if (count($result) > 0)
            return $result;

        return false;
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

    public function getEmptyCourse()
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
                "validation" => "required"
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
                "validation" => "required",
                "skip" => true
            ],
            "status" => [
                "label" => "Status",
                "type" => "number",
                "validation" => "required",
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
                "validation" => "required",
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

    public function getEmptyCounselor(){
        $empty = [
            "id" => "",
            "contact_number" => "",
            "type" => "",
        ];

        $template = [
            "id" => [
                "label" => "User",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "contact_number" => [
                "label" => "Contact Number",
                "type" => "text",
                "validation" => "required"
            ],
            "type" => [
                "label" => "Type",
                "type" => "number",
                "validation" => "required"
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
            "start_date" => "",
            "end_date" => ""
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
            "post_image" => "",
            "posted_by" => "",
            "type" => "",
        ];

        $template = [
            "title" => [
                "label" => "Post Title",
                "type" => "text",
                "validation" => ""
            ],
            "description" => [
                "label" => "Description",
                "type" => "text",
                "validation" => "required",
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
                "validation" => "required",
                "skip" => true
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
                "validation" => "",
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
            "user_id" => "",
            "preferred_email" => "",
            "exam_notify" => "",
            "reminder_notify" => "",
            "events_notify" => "",
            "materials_notify" => "",
            "notify_duration" => ""
        ];

        $template = [
            "user_id" => [
                "label" => "Student ID",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "preferred_email" => [
                "label" => "Preferred Email Address to receive Notifications",
                "type" => "select",
                "skip" => true
            ],
            "exam_notify" => [
                "label" => "Send Exam and Assignment Notifications",
                "type" => "checkbox",
                "skip" => true
            ],
            "reminder_notify" => [
                "label" => "Send Reminder Notifications through",
                "type" => "checkbox",
                "skip" => true
            ],
            "events_notify" => [
                "label" => "Send New Club Event Post Notifications",
                "type" => "checkbox",
                "skip" => true
            ],
            "materials_notify" => [
                "label" => "Send New Material update Notifications",
                "type" => "checkbox",
                "skip" => true
            ],
            "notify_duration" => [
                "label" => "Send Reminder Notifications (No. of days before)",
                "type" => "select",
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
                "type" => "text",
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
            "id" => "",
            "name" => "",
            "year" => "",
            "date" => "",
            "start_time" => "",
            "end_time" => "",
            "cover_img" => "",
            "accepted" => "",
            "declined" => "",
        ];

        $template = [
            "name" => [
                "label" => "Name of the reservation",
                "type" => "text",
                "validation" => "required",
                "skip" => true
            ],
            "year" => [
                "label" => "Year of the student",
                "type" => "number",
                "validation" => "required",
                "skip" => true
            ],
            "date" => [
                "label" => "Reservation date",
                "type" => "date",
                "validation" => "required",
                "skip" => true
            ],

            "start_time" => [
                "label" => "Start Time",
                "type" => "time",
                "validation" => "required",
                "skip" => true
            ],
            "end_time" => [
                "label" => "End Time",
                "type" => "time",
                "validation" => "required",
                "skip" => true
            ],

            "cover_img" => [
                "label" => "Cover Image",
                "type" => "array",
                "validation" => "",
                "skip" => true
            ],
            "accepted" => [
                "label" => "Accepted",
                "type" => "number",
                "validation" => "",
                "skip" => true
            ],
            "declined" => [
                "label" => "Cover Image",
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
            "date" => "",
            "start_time" => "",
            "end_time" => "",
        ];

        $template = [
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

        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }
}
