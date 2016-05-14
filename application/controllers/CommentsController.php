<?php

class CommentsController extends Zend_Controller_Action {

    private $model = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Comment();
        //  $this->view->user_id=$authorization->getStorage()->read()->id;
        $this->umodel = new Application_Model_DbTable_User ();
         $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
            $this->view->is_admin=Zend_Auth::getInstance()->getStorage()->read()->is_Admin;
        }

      
    }

    public function indexAction() {
        // action body
        $this->_helper->layout->setLayout('admin');

        $this->view->comments = $this->model->listComments();
    }

    public function editAction() {
        // action body
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }

        $id = $this->getRequest()->getParam('id');
        $comment = $this->model->getCommentsById($id);
        $user = $this->umodel->getUserById($id);

        $form = new Application_Form_Comment();
        $form->populate($comment[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $this->model->editComment($id, $data);
                $this->redirect("comments/show/id/" . $comment[0]['material_id']);
            }
        }
        $this->view->form = $form;
    }

    public function deleteAction() {
        // action body
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteComment($id)) {
            $this->redirect('comments/index');
        }
    }

    public function addAction() {
        // action body
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $form = new Application_Form_Comment();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $material_id = $this->getRequest()->getParam('id');
                $user = Zend_Auth::getInstance()->getIdentity()->id;
                if ($this->model->addComment($data, $material_id, $user)) {

                    /*  $tr = new Zend_Mail_Transport_Smtp('smtp.example.com',
                      array(
                      'auth' => 'login',
                      'username' => 'Zend.project.ti@gmail.com',
                      'password' => 'itiiti2016',
                      'host' => 'smtp.gmail.com',
                      'port'     => '587',
                      'ssl'      => 'tls',
                      ));
                      // Zend_Mail::setDefaultTransport($tr);
                      $mail = new Zend_Mail();
                      $mail->setBodyText('you are welcome in our website ... your username : ');
                      $mail->setFrom('Zend.project.ti@gmail.com');
                      $mail->addTo($this->getRequest()->getParam('email'));
                      $mail->setSubject('Info');
                      $mail->send();
                     */
                    $this->redirect('comments/show/id/' . $this->getRequest()->getParam('id'));
                }
            }
        }
        $this->view->material_id = $this->getRequest()->getParam('id');
        $this->view->form = $form;
    }

    public function showAction() {
        // action body
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $admin = $this->umodel->getUserById(Zend_Auth::getInstance()->getIdentity()->id);
//        echo "<pre>";
//        var_dump($admin);
//        var_dump($admin[0]["is_Admin"]);
//        echo "</pre>";
//        die("end");

        $id = $this->getRequest()->getParam('id');
//        echo $this->getRequest()->getParam('id');
//        die("end");
        $this->view->user = $admin[0];
        $this->view->material_id = $id;
        $this->view->comments = $this->model->getCommentsByMaterialId($id);

    }

}
