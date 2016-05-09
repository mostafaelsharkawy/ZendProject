<?php

class MaterialsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Material();
    }

    public function indexAction()
    {
        // action body
        $this->view->materials = $this->model->getAllMaterials();
        // $this->render('index');
    }




}

