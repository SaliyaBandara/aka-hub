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
            $columns[] = "$key = ?";
            $values[] = $value;
            $valueTypes[] = $template[$key]["type"] == "number" ? "i" : "s";
        }

        $placeholders = implode(", ", $columns);
        $query = "UPDATE $table SET $placeholders WHERE $conditionColumn = ?";
        $values[] = $conditionValue;
        $valueTypes[] = $conditionType;
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->insert($query, $valueTypesString, $values);
        return $result;
    }
}
