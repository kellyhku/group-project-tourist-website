<?php
require_once APPLICATION_PATH . "/models/SqlHelper.php";


class CommentController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function commentAction()
    {
        $comment_content = $this->getRequest()->getParam('comment_content');
        $comment_idea_id = $this->getRequest()->getParam('comment_idea_id');
        $comment_user_id = $this->getRequest()->getParam('comment_user_id');
        $sqlHelper = new SqlHelper();
        $row_effected = $sqlHelper->insert('comment', array(
            'comment_content' => $comment_content,
            'comment_idea_id' => $comment_idea_id,
            'comment_user_id' => $comment_user_id
        ));
        $sqlHelper->close_dbAdapter();
        if ($row_effected > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function getcommentAction()
    {
        $comment_idea_id = $this->getRequest()->getParam('comment_idea_id');
        $sqlHelper = new SqlHelper();
        $comments = $sqlHelper->multiQuerywithOrder('comment', 'user', 'comment_user_id = user_id', array('comment_idea_id' => $comment_idea_id), "comment_date DESC");
        $jsonArray = json_encode($comments);
        echo $jsonArray;
        exit();
    }


}



