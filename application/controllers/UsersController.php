<?php

class UsersController extends Zend_Controller_Action
{

	private $model;

    public function init(){
        /* Initialize action controller here */
		$this->model = new Application_Model_DbTable_Users();
    }

    public function indexAction()
    {
     	$this->view->users = $this->model->listUsers();

    }

}

