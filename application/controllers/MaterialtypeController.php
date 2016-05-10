<?php

class MaterialtypeController extends Zend_Controller_Action
{
    
    
    public function init()
    {
        /* Initialize action controller here */
//        $this->model = new Application_Model_DbTable_Material();
        $this->_helper->layout->setLayout('admin');
        $this->model1 = new Application_Model_DbTable_MaterialType();
    }

    public function indexAction()
    {
        // action body
        $this->view->materials = $this->model->getAllMaterials();
        // $this->render('index');
    }
    public function showAction()
    {
        $this->view->materials = $this->model1->listMaterialTypes();
        // action body
    }
    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model1->deleteMaterialType($id)) {
            $this->redirect('materialtype/show');
        }
    }

    function editAction() {
        $id = $this->getRequest()->getParam('id');
        $Type = $this->model1->getMaterialTypeById($id);
        $form = new Application_Form_MaterialType();
        $form->type->setValidators(array());
        $form->populate($Type[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $this->model1->editMaterialType($id, $data);
                $this->redirect('materialtype/show');
            }
        }
        $this->view->form = $form;
    }
    public function addAction() {

        $form = new Application_Form_MaterialType();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $form->type->addValidator(new Zend_Validate_Db_NoRecordExists(
                    array(
                        'table' => 'material_types',
                        'field' => 'type'
                    )
                ));
                if($this->model1->addMaterialType($data)){
                    $this->redirect('materialtype/show');
                }
            }
        }
        $this->view->form = $form;
    }
  
}

