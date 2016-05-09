<?php

class MaterialcontentController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_MaterialContent();
    }

    public function indexAction()
    {
        // action body
        $this->view->materials = $this->model->listMaterialContent();
    }
     public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteMaterialContent($id)) {
            $this->redirect('materialcontent/index');
        }
    }


}

