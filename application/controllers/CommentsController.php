<?php

class CommentsController extends Zend_Controller_Action
{
    private $model;
    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Comment () ;
    }

    public function indexAction()
    {
        // action body
        $this->view->comments=  $this->model->listComments();
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }


}





