<?php

class CommentsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->model=new Application_Model_DbTable_Comment();
      //  $this->view->user_id=$authorization->getStorage()->read()->id;
        $this->umodel = new Application_Model_DbTable_User () ;
    }

    public function indexAction()
    {
        // action body
        $this->_helper->layout->setLayout('admin');
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





