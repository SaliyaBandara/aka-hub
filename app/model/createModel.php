<?php

class createModel extends Model
{
    protected $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_db($table, $data, $template = [])
    {
        $columns = "";
        $values = "";
        $types = "";
        $params = [];

        foreach ($data as $key => $value) {
            if ($value == "" || $value == null)
                continue;

            if(!isset($template[$key]) || !isset($template[$key]["type"]))
                continue;

            $columns .= $key . ",";
            $values .= "?,";
            // $types .= $value[1];
            $types .= $template[$key]["type"] == "number" ? "i" : "s";

            if (is_array($value))
                $value = implode(",", $value);
            array_push($params, $value);
        }

        $columns = rtrim($columns, ",");
        $values = rtrim($values, ",");

        // print_r($columns);
        // print_r($values);
        // print_r($types);
        // die;

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->db_handle->insert($query, $types, $params);
    }
}
