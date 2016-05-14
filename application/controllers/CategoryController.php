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


    public function addAction() {
        $form = new Application_Form_Category();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                    if ( $data['user_id'] != '0' ) {
                    if ($this->model->addCategory($data)) {
                        $this->redirect('category/index');
                    }
                } else {
                    $this->redirect('category/add');
                }
            }
        }
        $this->view->form = $form;
    }
    

    public function editAction() {

        $id = $this->getRequest()->getParam('id');
        $category = $this->model->getCategoryByID($id);
        $form = new Application_Form_Category();
        $form->populate($category[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $this->model->editCategories($id, $data);
                }
                $this->redirect('category/index');
            }
        $this->view->id = $id;
        $this->view->form = $form;
    
        }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteCategory($id)) {
            $this->redirect('category/index');
        }
    }

}

