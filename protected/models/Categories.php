<?php

/**
 * User: Sergey Prokhorov <sergey_prokhorov@list.ru>
 * Date: 29.05.14
 * Time: 4:09
 */
class Categories
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    private function allowFields()
    {
        return array(
            'id',
            'title',
            'description'
        );
    }

    public function getList()
    {
        $sql = "SELECT * FROM categories";
        if ($result = $this->db->query($sql)) {
            $out = array();
            while ($row = $result->Fetch(PDO::FETCH_ASSOC)) {
                $out[$row['id']] = $row;
            }

            if ($out && !empty($out)) {
                return $out;
            }
        }
        return false;
    }

    public function add($params)
    {
        $p = array();
        foreach ($params as $key => $val) {
            if (in_array($key, $this->allowFields())) {
                $p[] = $key . '=' . $this->db->quote($val);
            }
        }

        if (!empty($p)) {
            $sql = "INSERT INTO categories SET " . implode(", ", $p);
            if ($this->db->query($sql))
                return true;
        }
        return false;
    }

    public function delete()
    {

    }

    public function update()
    {

    }
} 