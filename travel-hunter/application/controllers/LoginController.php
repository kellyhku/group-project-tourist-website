<?php
require_once APPLICATION_PATH . "/models/SqlHelper.php";


class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {

    }

    public function loginprocessAction()
    {
        if ($this->getRequest()->getParam('captcha_code') != $_SESSION['captchaSession']['captcha_code']) {
            $this->view->feedback = "incorrect captcha code";
            $this->view->goUrl = "/login/login";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }
        $email_address = $this->getRequest()->getParam('email_address');
        $password = $this->getRequest()->getParam('password');

        $params = array(
            'user_email' => $email_address,
            'user_password' => $password
        );
        $sqlHelper = new SqlHelper();
        $row = $sqlHelper->select('user', $params);
        $sqlHelper->close_dbAdapter();
        if ($row != null) {
            foreach ($row[0] as $key => $item) {
                $_SESSION['user'][$key] = $item;
            }
            $this->_forward('index', 'index');
        } else {
            $this->view->feedback = "incorrect email or password! ";
            $this->view->goUrl = "/login/login";
            $this->_forward('alertfeedback', 'feedback');

        }
    }

    public function logoutAction()
    {
        if (!empty($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        $this->_forward('index', 'index');
    }


}



