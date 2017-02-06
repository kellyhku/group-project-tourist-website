<?php

class BaseController extends Zend_Controller_Action
{
    public function init()
    {
        $url = constant("APPLICATION_PATH") . DIRECTORY_SEPARATOR . "configs" . DIRECTORY_SEPARATOR . "application.ini";
        $db_config = new Zend_Config_Ini($url, "mysql_travel-humter");
        $db = Zend_Db::factory($db_config->db);
        $db->query("set names utf8");
        Zend_Db_Table::setDefaultAdapter($db);
    }
}