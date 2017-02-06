<?php
require_once APPLICATION_PATH . "/models/SqlHelper.php";

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function userAction()
    {

    }

    public function updateinfoAction()
    {

    }

    public function updateinfoprocessAction()
    {
        $user_email = $this->getRequest()->getParam('user_email');
        $user_password_orignal = $this->getRequest()->getParam('user_password_orignal');
        $user_password_first = $this->getRequest()->getParam('user_password_first');
        $user_password_second = $this->getRequest()->getParam('user_password_second');
        $user_first_name = $this->getRequest()->getParam('user_first_name');
        $user_last_name = $this->getRequest()->getParam('user_last_name');


        if (!preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i", $user_email)) {
            $this->view->feedback = "Error: invalid email!";
            $this->view->goUrl = "/user/updateinfo";
            $this->_forward('alertfeedback', 'feedback');
            return;

        }
        if (!preg_match("/^([a-zA-Z])+$/", $user_first_name)) {
            $this->view->feedback = "Error: invalid first name!";
            $this->view->goUrl = "/user/updateinfo";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }
        if (!preg_match("/^([a-zA-Z])+$/", $user_last_name)) {
            $this->view->feedback = "Error: invalid last name!";
            $this->view->goUrl = "/user/updateinfo";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }
        if ($user_password_orignal == '') {
            $user_password = $_SESSION['user']['user_password'];
        } else if ($user_password_orignal != $_SESSION['user']['user_password']) {
            $this->view->feedback = "Error: orignal password incorrect!";
            $this->view->goUrl = "/user/updateinfo";
            $this->_forward('alertfeedback', 'feedback');
            return;
        } else if (!preg_match("/^[0-9a-zA-Z_]{4,}$/", $user_password_first)) {
            $this->view->feedback = "Error: invalid new password!";
            $this->view->goUrl = "/user/updateinfo";
            $this->_forward('alertfeedback', 'feedback');
            return;
        } else if ($user_password_first != $user_password_second) {
            $this->view->feedback = "Error: confirm password incorrect";
            $this->view->goUrl = "/user/updateinfo";
            $this->_forward('alertfeedback', 'feedback');
            return;
        } else {
            $user_password = $user_password_first;
        }

        $sqlHelper = new SqlHelper();
        $set = array(
            'user_email' => $user_email,
            'user_password' => $user_password,
            'user_first_name' => $user_first_name,
            'user_last_name' => $user_last_name
        );

        $where = array(
            'user_email' => $_SESSION['user']['user_email']
        );
        $row_affected = $sqlHelper->update('user', $set, $where);
        if ($row_affected > 0) {
            $params = array(
                'user_email' => $user_email
            );
            $row = $sqlHelper->select('user', $params);
            if ($row != null) {
                foreach ($row[0] as $key => $item) {
                    $_SESSION['user'][$key] = $item;
                }
            }
            $this->view->feedback = "Success: update successfully!";
            $this->view->goUrl = "/user/user";
            $this->_forward('alertfeedback', 'feedback');
        } else {
            $this->view->feedback = "update failed, nothing changed!";
            $this->view->goUrl = "/user/updateinfo";
            $this->_forward('alertfeedback', 'feedback');
        }
        $sqlHelper->close_dbAdapter();


//        exit();


    }

    public function uploadimgAction()
    {

    }

    public function uploadimgprocessAction()
    {
        $uploadAdapter = new Zend_File_Transfer_Adapter_Http();
        $uploadAdapter->setValidators(array('Size' => array('min' => 20, 'max' => 500000)));
        $uploadAdapter->setDestination("/Users/chumingjun/PhpstormProjects/travel-hunter/public/images/user_img");
        $arr = explode("/", (String)$uploadAdapter->getFileName());
        $user_img_url_path = "";
        for ($i = 0; $i < count($arr) - 1; $i++) {
            $user_img_url_path .= $arr[$i] . "/";

        }
        $user_img_url_name = $arr[count($arr) - 1];
        $user_img_url = "/images/user_img/" . $user_img_url_name;
        $user_img_remove_arr = explode("user_img/", $_SESSION['user']['user_img_url']);
        $user_img_remove = $user_img_url_path . $user_img_remove_arr[count($user_img_remove_arr) - 1];
        if (!$uploadAdapter->receive()) {
            $messages = $uploadAdapter->getMessages();
            $this->view->feedback = "image upload failed";
            $this->view->goUrl = "/user/uploadimg";
            $this->_forward('alertfeedback', 'feedback');
            return -1;
        }
        $sqlHelper = new SqlHelper();
        $row_affected = $sqlHelper->update('user', array('user_img_url' => $user_img_url), array('user_email' => $_SESSION['user']['user_email']));
        if ($row_affected > 0) {
            if ($user_img_remove_arr[count($user_img_remove_arr) - 1] != "images/user_img/img_default/default.png") {
                unlink($user_img_remove);

            }
            $_SESSION['user']['user_img_url'] = $user_img_url;
            $this->view->feedback = "image upload Successfully!";
            $this->view->goUrl = "/user/user";
            $this->_forward('alertfeedback', 'feedback');
            return 1;
        } else {
            $this->view->feedback = "user image update failed";
            $this->view->goUrl = "/user/uploadimg";
            $this->_forward('alertfeedback', 'feedback');
            return -1;
        }

    }


}



