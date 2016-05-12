<?php

class MaterialsController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
         $this->_helper->layout->setLayout('admin');
        $this->model = new Application_Model_DbTable_Material();
        $this->contentmodel = new Application_Model_DbTable_MaterialContent();
    }

    public function indexAction() {
        // action body
        $this->view->materials = $this->model->getAllMaterials();
    }

    public function addAction() {
        $form = new Application_Form_Material();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                if ($data['material_type_id'] != '0' || $data['course_id'] != '0' || $data['user_id'] != '0') {
                    if ($this->model->addMaterial($data)) {
                        $this->redirect('materials/index');
                    }
                } else {
                    $this->redirect('materials/add');
                }
//                
            }
        }
        $this->view->form = $form;
    }

    public function editAction() {
        //Get material by id
        $id = $this->getRequest()->getParam('id');
        $MT = $this->model->getmaterialbyid($id);
        //Get material content
//        $content=$this->contentmodel->getMaterialContentById($id);
        $form = new Application_Form_Material();
        $form->populate($MT[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
//                $this->contentmodel->addMaterialContent($data['file'],$data['material_id']);
//                $data->removeElement($data['file']);
                if ($data['material_type_id'] != '0' || $data['course_id'] != '0' || $data['user_id'] != '0') {
                    $this->model->editMaterial($id, $data);
                    var_dump($data);
                }
                $this->redirect('materials/index');
            }
        }
        $this->view->id = $id;
        $this->view->form = $form;
//        $this->view->materials=$content;
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteMaterial($id)) {
            $this->redirect('materials/index');
        }
    }
    

}
