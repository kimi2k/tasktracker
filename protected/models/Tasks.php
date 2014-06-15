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
            $list = array();
            while ($row = $result->Fetch(PDO::FETCH_ASSOC)) {
                if (strtotime($row['start']) > 0) {
                    if (strtotime($row['end']) <= 0) {
                        $end = time();
                    } else {
                        $end = strtotime($row['end']);
                    }
                    $row['taskTime'] = $end - strtotime($row['start']) - intval($row['paused']);
                } else {
                    $row['taskTime'] = 0;
                }
                $list[$row['id']] = $row;
            }
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
        $sql = "DELETE FROM tasks WHERE id=".$this->db->quote($id)." LIMIT 1";
        if ($this->db->query($sql)) {
            return true;
        }
        return false;
    }

    public function update($id, $params)
    {
        unset($params['id']);
        $data = array();
        foreach ($params as $key => $value) {
            if ($value != '') {
                $data[] .= $key . '=' . $this->db->quote($value);
            }
        }

        echo $sql = "UPDATE tasks SET " . implode(",", $data). " WHERE id=".$this->db->quote($id);
        if ($this->db->query($sql)){
            return true;
        }

        return false;
    }

    public function getWorkTime($date) {
        $sql = "SELECT * FROM tasks WHERE start LIKE '{$date}%'";
        $result = $this->db->query($sql);
        $total = 0;
        if ($result) {
           while ($day = $result->Fetch(PDO::FETCH_ASSOC)){
               if (strtotime($day['end']) <= 0) {
                   $end = time();
               } else {
                   $end = strtotime($day['end']);
               }
               $total += $end - strtotime($day['start']) - intval($day['paused']);
           }
           return $total;
        }
        return false;
    }

    public function startTask($id) {
        $task = $this->db->query("SELECT * FROM tasks WHERE id=".intval($id))->Fetch(PDO::FETCH_ASSOC);
        if (!$task['start']) {
            $sql = "UPDATE tasks SET start='".date('Y-m-d H:i:s')."' WHERE id=".intval($id);
            return $this->db->query($sql);
        } elseif ($task['is_paused']==1) {
            $paused = time()-strtotime($task['end'])+intval($task['paused']);
            $sql = "UPDATE tasks SET end = Null, paused='{$paused}', is_paused=0 WHERE id=".intval($id);
            return $this->db->query($sql);
        }

    }

    public function pauseTask($id) {
        $task = $this->db->query("SELECT * FROM tasks WHERE id=".intval($id))->Fetch(PDO::FETCH_ASSOC);
        if ($task['is_paused'] != 1) {
            $sql = "UPDATE tasks SET is_paused=1, end='".date('Y-m-d H:i:s')."' WHERE id=".intval($id);
            $this->db->query($sql);
        }
    }

    public function finishTask($id) {
        $task = $this->db->query("SELECT * FROM tasks WHERE id=".intval($id))->Fetch(PDO::FETCH_ASSOC);
        $paused = $task['paused'];
        if ($task['is_paused'] == 1) {
            $paused += time()-strtotime($task['end']);
        }
        $total = time() - strtotime($task['start']) - $paused;
        $sql = "UPDATE tasks SET is_paused=0, end='".date('Y-m-d H:i:s')."',
        totaltime='".$total."', paused='".$paused."', finished=1 WHERE id=".intval($id);
        return $this->db->query($sql);
    }
}