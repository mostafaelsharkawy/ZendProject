<?php

class CategoryController extends Zend_Controller_Action
{

     public function init() {
        $this->_helper->layout->setLayout('admin');
        $this->model = new Application_Model_DbTable_Category();
         $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
            $this->view->is_admin=Zend_Auth::getInstance()->getStorage()->read()->is_Admin;
        }

    }

    public function indexAction() {
        $this->view->categories = $this->model->getCategories();
    }

}

