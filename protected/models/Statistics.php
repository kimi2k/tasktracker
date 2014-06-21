<?php
/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 21.06.14
 * Time: 15:08
 */

class Statistics {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param $start - unixtime
     * @param $end - unixtime
     */
    public function getTimeByProject($start, $end) {
        $sql = "SELECT * FROM tasks a LEFT JOIN categories b ON a.cat_id = b.id WHERE a.created between ".$this->db->quote(date('Y-m-d',$start))." and ".$this->db->quote(date('Y-m-d',$end))." AND start <> '' AND end <> '' ORDER BY cat_id";
        $result = $this->db->query($sql);
        $out = array();
        while ($task = $result->Fetch(PDO::FETCH_ASSOC)) {
            if (!isset($out[$task['cat_id']]))  {
                if ($task['title'] == '') {
                    $task['title'] = 'Without project';
                }
                $out[$task['cat_id']] = array('total'=>0, 'title'=>$task['title']);
            }
            $out[$task['cat_id']]['total'] += strtotime($task['end']) - strtotime($task['start']) - intval($task['paused']);
        }
        return $out;
    }
}