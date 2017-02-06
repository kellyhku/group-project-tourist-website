<?php
require_once APPLICATION_PATH . "/models/SqlHelper.php";


class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction()
    {
        // action body
    }

    public function searchAction()
    {
        if (empty($_SESSION['user'])) {
            $this->view->feedback = "Please log in first !";
            $this->view->goUrl = "/login/login";
            $this->_forward('alertfeedback', 'feedback');
            return;
        }

        $sqlHelper = new SqlHelper();
        $results = $sqlHelper->multiQuery('idea', 'destination', 'idea.idea_destination=destination.destination_name', array());

//        $ideas = $sqlHelper->select('idea',null);
//        $destinations = $sqlHelper->select('destination',null);
//        $this->view->ideas = $ideas;
//        $this->view->destinations = $destinations;
        $this->view->results = $results;
        $sqlHelper->close_dbAdapter();
    }

    public function searchprocessAction()
    {
        $key = $this->getRequest()->getParam('key');
        $keyword = $this->getRequest()->getParam($key);
        $sqlHelper = new SqlHelper();
        $idea_list = $sqlHelper->search('idea', array($key => $keyword));

        $this->view->idea_list = $idea_list;
        $sqlHelper->close_dbAdapter();
        $this->_forward('idealist', 'idea');
    }

}



