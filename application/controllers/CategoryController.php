<?php

class CategoryController extends Zend_Controller_Action
{

     public function init() {
        $this->_helper->layout->setLayout('admin');
        $this->model = new Application_Model_DbTable_Category();
    }

    public function indexAction() {
        $this->view->categories = $this->model->getCategories();
    }

}

