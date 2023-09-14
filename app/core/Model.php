<?php

class Model extends Database
{
    protected $db_handle;

    public function __construct()
    {
        $this->db_handle = new Database;
    }


    // $query = "SELECT * FROM training_programs WHERE del_status = ? ORDER BY id";
    //             $result = $db_handle->runQuery($query, 's', array(0));
    //             if (count($result) > 0) {
    //                 foreach ($result as $value) {}}

    // get

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
