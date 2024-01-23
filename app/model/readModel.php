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

    public function getAll($table)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM $table WHERE ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCourseMaterial($course_id)
    {
        $result = $this->db_handle->runQuery("SELECT * FROM course_materials WHERE course_id = ?", "i", [$course_id]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    public function getCounselors()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE role = ?", "i", [5]);
        if (count($result) > 0)
            return $result;

        return false;
    }

    // get all the posts of the counselor
    public function getCounselorPosts()
    {
        $result = $this->db_handle->runQuery("SELECT * FROM counselor_posts ?", "i", [1]);
        if (count($result) > 0)
            return $result;

        return false;
    }

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
            "description" => "",
            "image" => ""
        ];

        $template = [
            "user_id" => [
                "label" => "User",
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
                "label" => "Image",
                "type" => "array",
                "validation" => "",
                "skip" => true
            ],
        ];

        return [
            "empty" => $empty,
            "template" => $template
        ];
    }

    public function getRequestsToApprove(){
        $result = $this->db_handle->runQuery("SELECT * FROM user WHERE student_rep = ? OR club_rep = ?", "ii", [2, 2]);
        if ($result !== false) {
            return $result;
        }
        return false;
    }
}
