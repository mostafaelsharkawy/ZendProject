<?php

class MaterialtypeController extends Zend_Controller_Action
{
    
    
    public function init()
    {
        /* Initialize action controller here */
//        $this->model = new Application_Model_DbTable_Material();
        $this->view->user_id=Zend_Auth::getInstance()->getStorage()->read()->id;
        $this->_helper->layout->setLayout('admin');
        $this->model1 = new Application_Model_DbTable_MaterialType();
    }

    public function indexAction()
    {
        $id = $this->getRequest()->getParam('id');
        // action body
        $this->view->materials = $this->model1->getAllMaterialtypes();
        $this->view->id=$id;
        // $this->render('index');
    }
    public function showAction()
    {
        $this->view->materials = $this->model1->listMaterialTypes();
        // action body
    }
    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        $mid = $this->getRequest()->getParam('mid');
        if ($this->model1->deleteMaterialType($id)) {
            $this->redirect('materialtype/index/id/'.$id.'/mid/'.$mid);
        }
    }

    function editAction() {
        $id = $this->getRequest()->getParam('id');//material id
        $mid = $this->getRequest()->getParam('mid'); //material type
//        die($mid);
        $Type = $this->model1->getMaterialTypeById($id);
        $form = new Application_Form_MaterialType();
        $form->type->setValidators(array());
        $form->populate($Type[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $this->model1->editMaterialType($id, $data);
                $this->redirect('materialtype/index/id/'.$mid.'/mid/'.$id);
            }
        }
        $this->view->form = $form;
    }
    public function addAction() {
        $id = $this->getRequest()->getParam('id');
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
                    $this->redirect('materialtype/index/id/'.$id);
                }
            }
        }
        $this->view->form = $form;
    }
  
}

