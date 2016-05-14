<?php

class CoursesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->view->user_id=Zend_Auth::getInstance()->getStorage()->read()->id;
         $this->_helper->layout->setLayout('admin');
         $this->model = new Application_Model_DbTable_Course();
    }

    public function indexAction()
    {
        // action body
    }
     public function listcAction()
    {
        // action body
        $this->_helper->layout->setLayout('new');
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $this->view->courses = $this->model->getCourses();
    }
    public function listctAction()
    {
        // action body
        $this->_helper->layout->setLayout('new');
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $this->view->courses = $this->model->getCategories();
    }


}

