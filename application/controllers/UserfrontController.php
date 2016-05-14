<?php

class UserfrontController extends Zend_Controller_Action {

	public function init() {

        $this->_helper->layout->setLayout('new');
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        // $this->model = new Application_Model_DbTable_User();
        // $this->cmodel = new Application_Model_DbTable_Comment();
        $this->coursemodel = new Application_Model_DbTable_Course();
         $this->typesmodel = new Application_Model_DbTable_MaterialType();
 		$this->mmodel = new Application_Model_DbTable_Material();
 		$this->cmodel = new Application_Model_DbTable_MaterialContent();
         $this->commentmodel = new  Application_Model_DbTable_Comment();
         $this->umodel = new  Application_Model_DbTable_User();
    }


    public function indexAction() {
        $this->_helper->layout->setLayout('new');
        


        $id = $this->getRequest()->getParam('id');

        if($id != null)
        {
        	 $this->view->categories = $this->coursemodel->getCategories();
       		$this->view->courses = $this->coursemodel->getCatCourses($id);
        }
        else
        {
        	$this->view->categories = $this->coursemodel->getCategories();
       		$this->view->courses = $this->coursemodel->getCourses();
        }
    }

    public function typesAction()
    {
    	$id = $this->getRequest()->getParam('id');
    	$this->view->categories = $this->coursemodel->getCategories();
    	$this->view->course =  	$this->coursemodel->getOneCourse($id);
    	$this->view->types =  $this->typesmodel->listMaterialTypes();
    }

    public function coursetypematerialsAction()
    {
    	$tid = $this->getRequest()->getParam('id');
    	$courseid = $this->getRequest()->getParam('course_id');
    	$this->view->course =  	$this->coursemodel->getOneCourse($courseid);
    	$this->view->depmaterials = $this->mmodel->getMaterialbytypecourse($courseid,$tid);

    	$this->view->categories = $this->coursemodel->getCategories();

    }

    public function contentsAction()
    {
    	$id = $this->getRequest()->getParam('id');
    	$this->view->contents = $this->cmodel->getMaterialContentById($id);
    	$this->view->categories = $this->coursemodel->getCategories();
    }
    public function singleAction(){
    	$id = $this->getRequest()->getParam('id');
    	$this->view->single = $this->cmodel->getMaterialbyindex($id);
    	$this->view->categories = $this->coursemodel->getCategories();

 		$admin= $this->umodel->getUserById(Zend_Auth::getInstance()->getIdentity()->id);
 		$this->view->user=$admin[0];
    	$this->view->material_id = $id;
        $this->view->comments=  $this->commentmodel->getCommentsByMaterialId($id);
    }
}

?>