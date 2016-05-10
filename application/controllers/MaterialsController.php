<?php

class MaterialsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
         $this->_helper->layout->setLayout('admin');
        $this->model = new Application_Model_DbTable_Material();
//        $this->MTmodel = new Application_Model_DbTable_MaterialType();
//        $this->Cmodel = new Application_Model_DbTable_Course();
//        $this->Umodel = new Application_Model_DbTable_User();
         
    }

    public function indexAction()
    {
        // action body
        $this->view->materials = $this->model->getAllMaterials();
        // $this->render('index');
    }
    
    public function addAction() {
            //$this->view->materials = $this->model->getAllMaterials();
          // $this->render('index');
        $form = new Application_Form_Material();
        if($this->getRequest()->isPost()){
          if($form->isValid($this->getRequest()->getParams())){
              $data = $form->getValues();
		// var_dump($data);
              if($this->model->addMaterial($data)){
                 $this->redirect('materials/index');
               }
             }
        }
         $this->view->form = $form;
    }
    
    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $MT = $this->model->getmaterialbyid($id);
        $form = new Application_Form_Material();
        $form->populate($MT[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();

                $this->model->editMaterial($id, $data);
                $this->redirect('materials/index');
            }
        }
        $this->view->id = $id;
        $this->view->form = $form;
    }
    
    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteMaterial($id)) {
            $this->redirect('materials/index');
        }
    }
    
    
}

