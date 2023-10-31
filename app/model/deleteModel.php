<?php

class deleteModel extends Model
{
    protected $result;

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteOne($table, $id)
    {
        $result = $this->db_handle->insert("DELETE FROM $table WHERE id = ?", "i", [$id]);
        if ($result)
            return $result;

        return false;
    }
}
