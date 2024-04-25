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

    public function getCoursesByYear($year){

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year = ?", "i", [$year]);
        if (count($result) > 0)
            return $result;

        return false;

    }

    public function getCoursesBySemester($year, $semester){

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year = ? AND semester = ?", "ii", [$year,$semester]);
        if (count($result) > 0)
            return $result;

        return false;

    }

    public function getCoursesBelowYear($year){

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE year < ? ", "i", [$year]);
        if (count($result) > 0)
            return $result;

        return false;

    }

    public function getCoursesByOnlySemester($semester){

        $result = $this->db_handle->runQuery("SELECT * FROM courses WHERE semester = ? ", "i", [$semester]);
        if (count($result) > 0)
            return $result;

        return false;

    }

    public function getAllChatUsers()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM chat_users WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getAllChatMessages()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM messages WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }


    public function getAllChatMessagesById($outgoing_id, $incoming_id)
    {
        $sql = "
        SELECT * FROM messages 
        LEFT JOIN chat_users ON chat_users.unique_id = messages.outgoing_msg_id
        WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) 
        OR (outgoing_msg_id = ? AND incoming_msg_id = ?) 
        ORDER BY msg_id
        ";
        $result = $this->db_handle->runQuery($sql, "iiii", [$outgoing_id, $incoming_id, $outgoing_id, $incoming_id]);
        if (count($result) > 0)
            return $result;

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
        $result = $this->db_handle->runQuery("SELECT * FROM timeslots WHERE counselor_id = ? AND status != ?", "ii", [$id,  3]);
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
            $result = $this->db_handle->runQuery("SELECT * FROM user u, administrator a WHERE u.id = a.id AND u.id = ?", "i", [$id]);
        } else if ($userdata[0]['role'] == 5) {
            $result = $this->db_handle->runQuery("SELECT * FROM user u, counselor c WHERE u.id = c.id AND u.id = ?", "i", [$id]);
        } else if ($userdata[0]['role'] == 3) {
            $result = $this->db_handle->runQuery("SELECT * FROM user WHERE id = ?", "i", [$id]);
        } else {
            if ($userdata[0]['club_rep'] == 1) {
                $result = $this->db_handle->runQuery("SELECT u.*, s.*, cr.*, c.id, c.name AS club_name
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
        $sql = "SELECT * from user u , counselor c where c.id = u.id AND u.id = ?";
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

    public function getOnePost($post_id)
    {
        $result = $this->db_handle->runQuery("
        SELECT p.title as title, p.id as post_id, p.posted_by as posted_by, p.description as description, p.post_image as post_image, u.id as id, u.name as name,
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
                "validation" => "required",
                "skip" => true
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
                "validation" => ""
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

            "updated_datetime" => [
                "label" => "Post Updated Time",
                "type" => "timestamp",
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
