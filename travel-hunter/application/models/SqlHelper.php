<?php


class SqlHelper
{
    protected $dbAdapter;
    protected $lastInsertId;

    public function SqlHelper()
    {
        $url = constant("APPLICATION_PATH") . DIRECTORY_SEPARATOR . "configs" . DIRECTORY_SEPARATOR . "application.ini";
        $db_config = new Zend_Config_Ini($url, "mysql_travel-humter");
        $this->dbAdapter = Zend_Db::factory($db_config->db);
        $this->dbAdapter->query("set names utf8");
        Zend_Db_Table::setDefaultAdapter($this->dbAdapter);
    }

    public function insert($db_table, $params)
    {
        $row_affected = $this->dbAdapter->insert($db_table, $params);
        $this->lastInsertId = $this->dbAdapter->lastInsertId();
        return $row_affected;
    }

    public function select($table, $where)
    {
        $select = $this->dbAdapter->select();
        $select->from($table, "*");
        foreach ($where as $key => $item) {
            $select->where("{$key} = ?", $item);
        }
        $sql = $select->assemble();
        $row = $this->dbAdapter->query($sql)->fetchAll();
        return $row;


    }

    public function update($table, $set, $param)
    {
        foreach ($param as $key => $item) {
            $where = $this->dbAdapter->quoteInto("{$key} = ?", $item);
        }
        $row_affected = $this->dbAdapter->update($table, $set, $where);
        return $row_affected;
    }


    public function multiQuery($table1, $table2, $join, $where)
    {
        $select = $this->dbAdapter->select();
        $select->from($table1, "*");
        $select->join($table2, $join, "*");
        foreach ($where as $key => $item) {
            $select->where("{$key} = ?", $item);
        }
        $sql = $select->assemble();
        $row = $this->dbAdapter->query($sql)->fetchAll();
        return $row;
    }

    public function multiQuerywithOrder($table1, $table2, $join, $where, $order)
    {
        $select = $this->dbAdapter->select();
        $select->from($table1, "*");
        $select->join($table2, $join, "*");
        foreach ($where as $key => $item) {
            $select->where("{$key} = ?", $item);
        }
        $select->order($order);
        $sql = $select->assemble();
        $row = $this->dbAdapter->query($sql)->fetchAll();
        return $row;
    }

    public function search($table, $where)
    {
        $select = $this->dbAdapter->select();
        $select->from($table, "*");
        foreach ($where as $key => $item) {
            $select->where("{$key} like ?", "%" . $item . "%");
        }
        $sql = $select->assemble();
        $row = $this->dbAdapter->query($sql)->fetchAll();
        return $row;
    }


    public function close_dbAdapter()
    {
        if ($this->dbAdapter->isConnected()) {
            $this->dbAdapter->closeConnection();
        }
    }


    public function getLastInsertId()
    {
        return $this->lastInsertId;
    }


    public function setLastInsertId($lastInsertId)
    {
        $this->lastInsertId = $lastInsertId;
    }


}