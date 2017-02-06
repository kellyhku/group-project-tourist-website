<?php
require_once APPLICATION_PATH . "/models/SqlHelper.php";


class IdeaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction()
    {
        // action body
    }

    public function ideaAction()
    {
        if (empty($_SESSION['user'])) {
            $this->view->feedback = "Please log in first !";
            $this->view->goUrl = "/login/login";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }
    }

    public function ideaprocessAction()
    {
        $idea_title = ($this->getRequest()->getParam("idea_title") == "") ? "Do you wannna travel with me?" : ($this->getRequest()->getParam("idea_title"));
        $idea_destination = $this->getRequest()->getParam("idea_destination");
        $destination_latitude = $this->getRequest()->getParam("latitude");
        $destination_longitude = $this->getRequest()->getParam("longitude");
        $idea_start_date = $this->getRequest()->getParam("idea_start_date");
        $idea_end_date = $this->getRequest()->getParam("idea_end_date");
        $idea_tag = ($this->getRequest()->getParam("idea_tag") == "") ? "travel" : ($this->getRequest()->getParam("idea_tag"));

        $sqlHelper = new SqlHelper();
        $params = array(
            'idea_title' => $idea_title,
            'idea_destination' => $idea_destination,
            'idea_start_date' => $idea_start_date,
            'idea_end_date' => $idea_end_date,
            'idea_tag' => $idea_tag,
            'idea_user_id' => $_SESSION['user']['user_id']
        );
        $row_effected = $sqlHelper->insert('idea', $params);
        if ($row_effected > 0) {
            $idea_id = $sqlHelper->getLastInsertId();
            $row = $sqlHelper->select('idea', array('idea_id' => $idea_id));
            if ($row != null) {
                $sqlHelper->insert('tag', array('tag_name' => $idea_tag, 'tag_idea_id' => $idea_id));
                $params = array(
                    'destination_name' => $idea_destination,
                    'destination_latitude' => $destination_latitude,
                    'destination_longitude' => $destination_longitude
                );

                $sqlHelper->insert('destination', $params);
            }

            $this->view->feedback = "You have post your idea successfully! This page will be closed automatically.";
            $this->view->goUrl = "/idea/myidealist";
        } else {
            $this->view->feedback = "There is something wrong with your idea post, please try again!  this page will return automatically. ";
            $this->view->goUrl = "/idea/idea";
        }
        $sqlHelper->close_dbAdapter();
        $this->_forward('feedback', 'feedback');


    }

    public function myidealistAction()
    {
        $sqlHelper = new SqlHelper();
        $row = $sqlHelper->select('idea', array('idea_user_id' => $_SESSION['user']['user_id']));

        $this->view->my_idea_list = $row;
        $sqlHelper->close_dbAdapter();

    }

    public function myideaAction()
    {
        $sqlHelper = new SqlHelper();
        $idea = $sqlHelper->select('idea', array('idea_id' => $this->getRequest()->getParam('idea_id')));
        if ($idea == null) {
            $this->view->feedback = "This idea has been removed permanently.Please choose another idea to check!";
            $this->view->goUrl = "/idea/myidealist";
            $this->_forward('feedback', 'feedback');
            return;
        }
        $this->view->idea = $idea[0];
        $sqlHelper->close_dbAdapter();

    }

    public function myideaeditAction()
    {
        $sqlHelper = new SqlHelper();
        $idea = $sqlHelper->select('idea', array('idea_id' => $this->getRequest()->getParam('idea_id')));
        if ($idea == null) {

            $this->view->feedback = "This idea has been removed permanently.Please choose another idea to check!";
            $this->view->goUrl = "/idea/myidealist";
            $this->_forward('feedback', 'feedback');
            return;
        }

        $destination = $sqlHelper->select('destination', array('destination_name' => $idea[0]['idea_destination']));
        if ($destination == null) {
            $this->view->feedback = "This destination has been removed permanently.Please choose another idea to check!";
            $this->view->goUrl = "/idea/myidealist";
            $this->_forward('feedback', 'feedback');
            return;
        }
        $tag = $sqlHelper->select('tag', array('tag_idea_id' => $idea[0]['idea_id']));
        if ($tag == null) {
            $this->view->feedback = "This tag has been removed permanently.Please choose another idea to check!";
            $this->view->goUrl = "/idea/myidealist";
            $this->_forward('feedback', 'feedback');
            return;
        }
        $this->view->idea = $idea[0];
        $this->view->destination = $destination[0];
        $this->view->tag = $tag[0];
        $sqlHelper->close_dbAdapter();
    }

    public function myideaeditprocessAction()
    {
        $idea_id = $this->getRequest()->getParam("idea_id");
        $destination_id = $this->getRequest()->getParam("destination_id");
        $tag_id = $this->getRequest()->getParam("tag_id");

        $idea_title = ($this->getRequest()->getParam("idea_title") == "") ? "Do you wannna travel with me?" : ($this->getRequest()->getParam("idea_title"));
        $idea_destination = $this->getRequest()->getParam("idea_destination");
        $destination_latitude = $this->getRequest()->getParam("latitude");
        $destination_longitude = $this->getRequest()->getParam("longitude");
        $idea_start_date = $this->getRequest()->getParam("idea_start_date");
        $idea_end_date = $this->getRequest()->getParam("idea_end_date");
        $idea_tag = ($this->getRequest()->getParam("idea_tag") == "") ? "travel" : ($this->getRequest()->getParam("idea_tag"));

        $sqlHelper = new SqlHelper();

        $row_effected = $sqlHelper->update('idea',
            array(
                'idea_title' => $idea_title,
                'idea_destination' => $idea_destination,
                'idea_start_date' => $idea_start_date,
                'idea_end_date' => $idea_end_date,
                'idea_tag' => $idea_tag
            ),
            array(
                'idea_id' => $idea_id
            ));

        if ($row_effected <= 0) {
            $this->view->feedback = "update idea failed! Please try again";
            $this->view->goUrl = "/idea/myidealist";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }
        $row_effected = $sqlHelper->update('destination',
            array(
                'destination_name' => $idea_destination,
                'destination_latitude' => $destination_latitude,
                'destination_longitude' => $destination_longitude
            ),
            array(
                'destination_id' => $destination_id
            ));

        if ($row_effected <= 0) {
            $this->view->feedback = "update destination failed! Please try again";
            $this->view->goUrl = "/idea/myidealist";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }
        $row_effected = $sqlHelper->update('tag',
            array(
                'tag_name' => $idea_tag
            ),
            array(
                'tag_id' => $tag_id
            ));

        if ($row_effected <= 0) {
            $this->view->feedback = "update tag failed! Please try again";
            $this->view->goUrl = "/idea/myidealist";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }

        $sqlHelper->close_dbAdapter();
        $this->view->feedback = "You have update your idea successfully! This page will be closed automatically.";
        $this->view->goUrl = "/idea/myidealist";
        $this->_forward('feedback', 'feedback');


    }

    public function idealistAction()
    {

    }

    public function ideaviewAction()
    {
        $idea_id = $this->getRequest()->getParam('idea_id');
        $sqlHelper = new SqlHelper();
        $result = $sqlHelper->multiQuery('idea', 'user', 'idea.idea_user_id=user.user_id', array('idea_id' => $idea_id));
        if ($result != null) {
            $this->view->result = $result[0];
        }
    }

}



