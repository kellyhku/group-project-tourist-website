<?php
require_once APPLICATION_PATH . "/models/SqlHelper.php";

class RegisterController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction()
    {
        // action body
    }

    public function registerAction()
    {

    }

    public function registerprocessAction()
    {
        if ($this->getRequest()->getParam('captcha_code') != $_SESSION['captchaSession']['captcha_code']) {
            $this->view->feedback = "incorrect captcha code";
            $this->view->goUrl = "/register/register";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }
        $email_address = $this->getRequest()->getParam('email_address');
        $password = $this->getRequest()->getParam('password_first');
        $first_name = $this->getRequest()->getParam('first_name');
        $last_name = $this->getRequest()->getParam('last_name');
        $params = array(
            'user_email' => $email_address,
            'user_password' => $password,
            'user_first_name' => $first_name,
            'user_last_name' => $last_name
        );

        $sqlHelper = new SqlHelper();
        $row_affected = $sqlHelper->insert('user', $params);
        if ($row_affected > 0) {
            $row = $sqlHelper->select('user', $params);
            if ($row != null) {
                foreach ($row[0] as $key => $item) {
                    $_SESSION['user'][$key] = $item;
                }
                $this->view->feedback = "You have Sign up successfully! This page will be closed automatically. ";
                $this->view->goUrl = "/user/user";
            } else {
                $this->view->feedback = "Sign up failed for some reason, this page will return automatically. ";
                $this->view->goUrl = "/register/register";

            }

        } else {
            $this->view->feedback = "Sign up failed for some reason, this page will return automatically. ";
            $this->view->goUrl = "/register/register";
        }
        $sqlHelper->close_dbAdapter();
        $this->_forward('feedback', 'feedback');


    }

    public function registerfeedbackAction()
    {

    }

    public function jquerycheckemailAction()
    {
        $email_address = $this->getRequest()->getParam('email_address');
        $sqlHelper = new SqlHelper();
        $where = array('user_email' => $email_address);
        if ($sqlHelper->select('user', $where)) {
            echo "<font color='red'>email has existed</font>";
        } else {
            echo "<font color='green'>acceptable</font>";
        }
        $sqlHelper->close_dbAdapter();
        exit();

    }

}



