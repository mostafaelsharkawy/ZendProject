<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
         $this->model = new Application_Model_DbTable_Course();
          $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
            $this->view->is_admin=Zend_Auth::getInstance()->getStorage()->read()->is_Admin;
        }

    }

    public function indexAction()
    {
        $this->_helper->layout->setLayout('new');
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $this->view->courses = $this->model->getCourses();
        $this->view->categories = $this->model->getCategories();
        $this->view->user_id=$authorization->getStorage()->read()->id;
    }

    public function usersAction()
    {
        // action body
    }

    public function materialsAction()
    {
        // action body
    }

    public function showMaterialTypeAction()
    {
        // action body
    }


}









