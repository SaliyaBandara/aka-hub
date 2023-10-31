<?php

class Model extends Database
{
    protected $db_handle;

    public function __construct()
    {
        parent::__construct();
        $this->db_handle = new Database();
    }

    // insert
    public function insert_db($table, $data)
    {
        $columns = $placeholders = $values = $valueTypes = [];
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        foreach ($data as $name => [$value, $type]) {
            $columns[] = $name;
            $values[] = $value;
            $valueTypes[] = $type;
        }

        $query = "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES (" . $placeholders . ")";
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->insert($query, $valueTypesString, $values);
        return $result;
    }

    // update
    public function update_db($table, $data, $conditionColumn, $conditionValue, $conditionType)
    {
        $columns = $placeholders = $values = $valueTypes = [];

        foreach ($data as $name => [$value, $type]) {
            $columns[] = "$name = ?";
            $values[] = $value;
            $valueTypes[] = $type;
        }

        $placeholders = implode(", ", $columns);
        $query = "UPDATE $table SET $placeholders WHERE $conditionColumn = ?";
        $values[] = $conditionValue;
        $valueTypes[] = $conditionType;
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->insert($query, $valueTypesString, $values);
        return $result;
    }

    // delete
    public function delete_db($table, $conditions)
    {
        $columns = $placeholders = $values = $valueTypes = [];

        foreach ($conditions as $name => [$value, $type]) {
            $columns[] = "$name = ?";
            $values[] = $value;
            $valueTypes[] = $type;
        }

        $placeholders = implode(" AND ", $columns);
        $query = "DELETE FROM $table WHERE $placeholders";
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->runQuery($query, $valueTypesString, $values);
        return $result;
    }

    public function get($table, $where = [], $order = [], $limit = [])
    {
        $sql = "SELECT * FROM $table";
        if (count($where) > 0) {
            $i = 0;
            foreach ($where as $key => $value) {
                if ($i == 0)
                    $sql .= " WHERE $key = ?";
                else
                    $sql .= " AND $key = ?";

                $i++;
            }
        }
        if (count($order) > 0) {
            $i = 0;
            foreach ($order as $key => $value) {
                if ($i == 0)
                    $sql .= " ORDER BY ? ?";
                else
                    $sql .= ", ? ?";

                $i++;
            }
        }
        if (count($limit) > 0)
            $sql .= " LIMIT ?, ?";

        $result = $this->db_handle->runQuery($sql, $where, $order, $limit);
        return $result;
    }
}
