<?php

class UsersController extends Zend_Controller_Action {

<<<<<<< HEAD
    public function init() {
=======
    public function init()
    {
    	// $this->_helper->layout->setLayout('fronEnd');
>>>>>>> 3c75e697e26f3ff5bed53132786c3c92aee47620
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_User();
        //authenticated or not
        //$authorization =Zend_Auth::getInstance();
        //if(!$authorization->hasIdentity()) {
        //$this->redirect('users/login');
        //}
    }

<<<<<<< HEAD
    public function indexAction() {
        $this->view->users = $this->model->listusers();
=======
    public function indexAction()
    {
    	// $this->_helper->layout->setLayout('backEnd');
        // action body
>>>>>>> 3c75e697e26f3ff5bed53132786c3c92aee47620
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteuser($id)) {
            $this->redirect('users/index');
        }
    }

    function editAction() {
        $id = $this->getRequest()->getParam('id');
        $user = $this->model->getUserById($id);
        $form = new Application_Form_User();
        $form->populate($user[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();

                $this->model->editUser($id, $data);
                $this->redirect('users/index');
            }
        }
        $this->view->form = $form;
    }

    public function addAction() {

        $form = new Application_Form_User();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();

                if($this->model->addUser($data)){
                    $this->redirect('users/index');
                }
            }
        }
        $this->view->form = $form;
    }

    public function loginAction() {
        $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->redirect('posts/index');
        }
        $form = new Application_Form_User();

        // get the default db adapter

        if ($this->getRequest()->isPost()) {
            $username = $this->getRequest()->getParam('username');
            $password = $this->getRequest()->getParam('password');
            $db = Zend_Db_Table::getDefaultAdapter();
            //create the auth adapter
            $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password');
//set the email and password
            $authAdapter->setIdentity($username);
            $authAdapter->setCredential(md5($password));

            $result = $authAdapter->authenticate();
            if ($result->isValid()) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($authAdapter->getResultRowObject(array('id', 'username')));
                //$authorization->username=$username;
                $this->redirect('posts/index');
            } else {
                $this->redirect('users/login');
            }
        }
        $this->view->form = $form;
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->redirect('users/login');
    }

}
