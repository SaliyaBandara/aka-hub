<?php

class Model extends Database
{
    protected $db_handle;

    public function __construct()
    {
        parent::__construct();
        $this->db_handle = new Database();
    }

    // transaction
    public function start_transaction()
    {
        $this->db_handle->start_transaction();
    }

    public function commit_transaction()
    {
        $this->db_handle->commit_transaction();
    }

    public function rollback_transaction()
    {
        $this->db_handle->rollback_transaction();
    }

    // insert
    public function insert_db($table, $data, $template = null)
    {
        if ($template == null) {
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
        } else {
            $columns = "";
            $values = "";
            $types = "";
            $params = [];

            foreach ($data as $key => $value) {
                if ($value == "" || $value == null)
                    continue;

                if (!isset($template[$key]) || !isset($template[$key]["type"]))
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

    public function deleteOne($table, $id)
    {
        $result = $this->db_handle->insert("DELETE FROM $table WHERE id = ?", "i", [$id]);
        if ($result)
            return $result;

        return false;
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
