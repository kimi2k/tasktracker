<?php

/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 29.05.14
 * Time: 1:58
 */
class Tasks
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getList($arFilter = false, $arOrder = false)
    {
        $sql = "SELECT * FROM tasks";
        if ($arFilter) {
            $arr = array();
            foreach ($arFilter as $key => $val) {
                if ($key[0] == '%') {

                    $arr[] = substr($key, 1, strlen($key)) . " LIKE '%" . $val . "%'";
                } else {
                    $arr[] = $key . "=" . $this->db->quote($val);
                }
            }
            $sql .= " WHERE " . implode(", ", $arr);
        }
        if ($arOrder) {
            $sql .= " ORDER BY " . $arOrder[0] . " " . $arOrder[1];
        }
        if ($result = $this->db->query($sql)) {
            $list = $result->FetchAll(PDO::FETCH_ASSOC);
            if ($list && !empty($list)) {
                return $list;
            }
        }
    }

    public function add($params)
    {
        $data = array();
        foreach ($params as $key => $value) {
            if ($value != '') {
                $data[] .= $key . '=' . $this->db->quote($value);
            }
        }

        $sql = "INSERT INTO tasks SET " . implode(",", $data);
        echo $sql;
        if ($this->db->query($sql))
            return true;

        return false;
    }

    public function delete($id)
    {
        $sql = "DELETE * FROM tasks WHERE id=".$this->db->quote(id)." LIMIT 1";
        if ($this->db->query($sql)) {
            return true;
        }
        return false;
    }

    public function update($id, $params)
    {
        unset($params['id']);
        foreach ($params as $key => $value) {
            if ($value != '') {
                $data[] .= $key . '=' . $this->db->quote($value);
            }
        }

        $sql = "UPDATE tasks SET " . implode(",", $data). " WHERE id=".$this->db->query($id);
        if ($this->db->query($sql)){
            return true;
        }

        return false;
    }
}