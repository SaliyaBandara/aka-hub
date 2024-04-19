<?php
// include_once "config.php";

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password;
    private $database;

    private $conn;

    // function __construct()
    // {
    //     $this->conn = $this->connectDB();
    // }

    function __construct($database = DB_DATABASE, $password = DB_PASS)
    {
        $this->database = $database;
        $this->password = $password;
        $this->conn = $this->connectDB();
    }

    function __destruct()
    {
        $this->conn->close();
        // echo "Connection closed";
    }

    // create transaction
    function start_transaction()
    {
        $this->conn->begin_transaction();
    }

    // commit transaction
    function commit_transaction()
    {
        $this->conn->commit();
    }

    // rollback transaction
    function rollback_transaction()
    {
        $this->conn->rollback();
    }

    function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    function getLastInsertedID()
    {
        return mysqli_insert_id($this->conn);
    }

    function runBaseQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function runQuery($query, $param_type, $param_value_array)
    {

        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if ($result->num_rows == 0)
            return array();

        if (!empty($resultset)) {
            return $resultset;
        }
    }

    function bindQueryParams($sql, $param_type, $param_value_array)
    {
        $param_value_reference[] = &$param_type;
        for ($i = 0; $i < count($param_value_array); $i++) {
            $param_value_reference[] = &$param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }

    function insert($query, $param_type, $param_value_array)
    {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        if ($sql->execute())
            return true;
        return false;
    }


    function update($query, $param_type, $param_value_array)
    {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        if ($sql->execute())
            return true;
        return false;
    }
}
