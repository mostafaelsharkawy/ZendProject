<?php

class RequestsController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        // $this->_helper->layout->setLayout('layout');
        $this->model = new Application_Model_DbTable_Request();
         $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
            $this->view->is_admin=Zend_Auth::getInstance()->getStorage()->read()->is_Admin;
        }

    }

    public function indexAction() {
        // action body
        $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
        $this->_helper->layout->setLayout('admin');
        $this->view->requests = $this->model->listRequests();
    }

    public function addAction() {
        // action body
        $this->_helper->layout->setLayout('new');
        $form = new Application_Form_Request();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $authUser = Zend_Auth::getInstance()->getStorage()->read();
                $user_id = $authUser->id;
                if ($this->model->addRequest($data, $user_id)) {
                    $this->redirect('/');
                }
            }
        }
        $this->view->form = $form;
        $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
    }

    public function deleteAction() {
        // action body
        if (!Zend_Auth::getInstance()->$storage->read()->is_Admin == "1") {
            $this->redirect('/');
        }
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteuser($id)) {
            $this->redirect('requests/index');
        }
    }

    public function hideAction() {
        // action body
         if (!Zend_Auth::getInstance()->$storage->read()->is_Admin == "1") {
            $this->redirect('/');
        }
        $this->_helper->layout->setLayout('admin');
        $id = $this->getRequest()->getParam('id');
        $hide = '1';
        if ($this->model->hideRequest($id, $hide)) {

            //$this->view->requests = $this->model->listHideRequests();
            $this->redirect('requests/viewhide');
        }
        $this->redirect('requests/viewhide');
    }

    public function showAction() {
        // action body
         if (!Zend_Auth::getInstance()->$storage->read()->is_Admin == "1") {
            $this->redirect('/');
        }
        $this->_helper->layout->setLayout('admin');
        $id = $this->getRequest()->getParam('id');
        $hide = '0';
        if ($this->model->hideRequest($id, $hide)) {

            //$this->view->requests = $this->model->listHideRequests();
            $this->redirect('requests/index');
        }
        $this->redirect('requests/index');
    }

    public function viewhideAction() {
        // action body
         if (!Zend_Auth::getInstance()->$storage->read()->is_Admin == "1") {
            $this->redirect('/');
        }
        $this->_helper->layout->setLayout('admin');

        $this->view->requests = $this->model->listHideRequests();
    }

}
