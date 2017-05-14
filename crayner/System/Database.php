<?php
namespace System;

/**
*
*       @author Ammar Faizi <ammarfaizi2@gmail.com>
*       @license RedAngel PHP Concept
*
*/
class Database
{
    public function __construct($cf)
    {
        $this->_db = new \PDO($cf['driver'].':host='.$cf['host'].';dbname='.$cf['dbname'], $cf['user'], $cf['pass']);
    }
    public function prepare($statement)
    {
        return $this->_db->prepare($statement);
    }
    public function query($q)
    {
        $st = $this->_db->prepare($q);
        $st->execute();
        return $st;
    }
    public function insert($table, $data)
    {
        $prepare = '';
        $fields = '';
        $value = array();
        foreach ($data as $key => $val) {
            $fields.=$key.',';
            $prepare.=':'.$key.',';
            $value[':'.$key] = $val;
        }
        #var_dump("INSERT INTO {$table} (".rtrim($fields, ',').") VALUES (".rtrim($prepare, ',').")",$value);
        return $this->_db->prepare("INSERT INTO {$table} (".rtrim($fields, ',').") VALUES (".rtrim($prepare, ',').")")->execute($value);
    }
    public function get($table)
    {
    }
}
