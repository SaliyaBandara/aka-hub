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
}
