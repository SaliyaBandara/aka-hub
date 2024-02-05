<?php

class updateModel extends Model
{
    protected $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function update_one($table, $data, $template = [], $conditionColumn, $conditionValue, $conditionType)
    {
        $columns = $placeholders = $values = $valueTypes = [];

        foreach ($data as $key => $value) {
            if ($value == "" || $value == null)
                continue;

            if (!isset($template[$key]) || !isset($template[$key]["type"]))
                continue;

            $columns[] = "$key = ?";
            if (is_array($value))
                $value = implode(",", $value);
            $values[] = $value;
            $valueTypes[] = $template[$key]["type"] == "number" ? "i" : "s";
        }

        // print_r($columns);
        // print_r($values);
        // print_r($valueTypes);
        // die;

        $placeholders = implode(", ", $columns);
        $query = "UPDATE $table SET $placeholders WHERE $conditionColumn = ?";
        // print_r($query);
        $values[] = $conditionValue;
        $valueTypes[] = $conditionType;
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->insert($query, $valueTypesString, $values);
        return $result;
    }


    public function to_get_role($table, $role, $id, $num){
        $query = "UPDATE $table SET $role = $num WHERE id = ?";
        $values = [$id];
        $valueTypes = ["i"];
        $valueTypesString = implode('', $valueTypes);
    
        $result = $this->db_handle->update($query, $valueTypesString, $values);
        return $result;
    }
    
}
