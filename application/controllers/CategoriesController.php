<?php

class CategoriesController extends Zend_Controller_Action

{
    private $model;

    public function init(){
        /* Initialize action controller here */
		$this->model = new Application_Model_DbTable_Categories();
    }

    public function indexAction()
    {
     	$this->view->categories = $this->model->listCategories();

    }


}

