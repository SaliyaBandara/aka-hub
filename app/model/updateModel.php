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

    public function update_election_questions($questions, $election_id, $template = [], $removed_questions = [])
    {
        $this->start_transaction();

        // delete removed questions
        if (count($removed_questions) > 0) {
            foreach ($removed_questions as $key => $question_id) {
                $result = $this->deleteOne("election_questions", $question_id);
                if (!$result) {
                    $this->rollback_transaction();
                    return false;
                }
            }
        }

        // update or insert questions
        foreach ($questions as $key => $value) {
            $question = $value;
            $question_id = $question["id"];
            unset($question["id"]);

            if ($question_id == 0) {
                $question["election_id"] = $election_id;
                $result = $this->insert_db("election_questions", $question, $template);
            } else {
                $question["updated_at"] = date("Y-m-d H:i:s");
                $result = $this->update_one("election_questions", $question, $template, "id", $question_id, "i");
            }

            if (!$result) {
                $this->rollback_transaction();
                return false;
            }
        }

        // $this->rollback_transaction();
        // return false;

        $this->commit_transaction();
        return true;
    }

    public function to_get_role($table, $role, $id, $num)
    {
        $query = "UPDATE $table SET $role = $num WHERE id = ?";
        $values = [$id];
        $valueTypes = ["i"];
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->update($query, $valueTypesString, $values);
        return $result;
    }

    public function to_update_status($table, $id)
    {
        $query = "UPDATE $table SET status = 1 WHERE user_id = ?";
        $values = [$id];
        $valueTypes = ["i"];
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->update($query, $valueTypesString, $values);
        return $result;
    }

    public function restrictUser($id)
    {
        $query = "UPDATE user SET status = 0 WHERE id = ?";
        $values = [$id];
        $valueTypes = ["i"];
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->update($query, $valueTypesString, $values);
        return $result;
    }

    public function removeRestriction($id)
    {
        $query = "UPDATE user SET status = 1 WHERE id = ?";
        $values = [$id];
        $valueTypes = ["i"];
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->update($query, $valueTypesString, $values);
        return $result;
    }

    public function update_system_variable($name, $value)
    {
        $query = "UPDATE system_variables SET value = ? WHERE name = ?";
        $values = [$value, $name];
        $valueTypes = ["s", "s"];
        $valueTypesString = implode('', $valueTypes);

        $result = $this->db_handle->update($query, $valueTypesString, $values);
        return $result;
    }
}
