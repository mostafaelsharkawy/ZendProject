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
    public function indexAction() {
        $this->view->courses = $this->model->getCourses();
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

//     public function getCategoryAction() {
//         $this->view->categories = $this->model->getCategories();
//     }

//     public function addCategoryAction() {
//         $form = new Application_Form_Category();
//         if ($this->getRequest()->isPost()) {
//             if ($form->isValid($this->getRequest()->getParams())) {
//                 $data = $form->getValues();
//                     if ($this->model->addCategory($data)) {
//                         $this->redirect('categories/index');
//                     }
//                 } else {
//                     $this->redirect('categories/add');
//                 }
// //                
//             }
//         $this->view->form = $form;
//         }
    

//     public function editCategoryAction() {

//         $id = $this->getRequest()->getParam('id');
//         $category = $this->model->getCategoryByID($id);
//         $form = new Application_Form_Category();
//         $form->populate($category[0]);
//         if ($this->getRequest()->isPost()) {
//             if ($form->isValid($this->getRequest()->getParams())) {
//                 $data = $form->getValues();
//                 $this->model->editCategories($id, $data);
//                 }
//                 $this->redirect('categories/index');
//             }
//         $this->view->id = $id;
//         $this->view->form = $form;
    
//         }

//     public function deleteCategoryAction() {
//         $id = $this->getRequest()->getParam('id');
//         if ($this->model->deleteCategory($id)) {
//             $this->redirect('categories/index');
//         }
//     }

    public function getAction() {
        $this->view->categories = $this->model->getCategories();
    }

    public function addAction() {
        $form = new Application_Form_Course();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                    if ($this->model->addCourses($data)) {
                        $this->redirect('courses/index');
                    }
                } else {
                    $this->redirect('courses/add');
                }
//                
            }
        $this->view->form = $form;
        }
    

    public function editAction() {

        $id = $this->getRequest()->getParam('id');
        $category = $this->model->getCategoryByID($id);
        $form = new Application_Form_Course();
        $form->populate($category[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $this->model->editCourses($id, $data);
                }
                $this->redirect('courses/index');
            }
        $this->view->id = $id;
        $this->view->form = $form;
        }
    

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteCourses($id)) {
            $this->redirect('courses/index');
        }
    }

}

