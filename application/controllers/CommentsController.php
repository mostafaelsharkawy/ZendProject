<?php

class CommentsController extends Zend_Controller_Action
{

    private $model = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Comment () ;
    }

    public function indexAction()
    {
        // action body
        $this->view->comments=  $this->model->listComments();
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteComment($id)) {
            $this->redirect('comments/index');
        }
    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Comment();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $material_id=$this->getRequest()->getParam('id');
                if($this->model->addComment($data,$material_id)){
                     
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
                    $this->redirect('comments/show/id/'.$this->getRequest()->getParam('id'));
                }
            }
        }
        $this->view->material_id = $this->getRequest()->getParam('id');
        $this->view->form = $form;
    }

    public function showAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
//        echo $this->getRequest()->getParam('id');
//        die("end");
        $this->view->comments=  $this->model->getCommentsByMaterialId($id);
    }


}









