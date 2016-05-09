<?php
class UsersController extends Zend_Controller_Action {
    public function init()
    {
    	// $this->_helper->layout->setLayout('fronEnd');
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_User();
        //authenticated or not
        //$authorization =Zend_Auth::getInstance();
        //if(!$authorization->hasIdentity()) {
        //$this->redirect('users/login');
        //}
        
    }

    public function indexAction() {
        $this->view->users = $this->model->listusers();
    }
    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteuser($id)) {
            $this->redirect('users/index');
        }
    }

    function editAction() {
        $id = $this->getRequest()->getParam('id');
        $user = $this->model->getUserById($id);
        $form = new Application_Form_User();
        $form->username->setValidators(array());
        $form->email->setValidators(array());
        $form->removeElement('password');
        $form->populate($user[0]);
        if ($this->getRequest()->isPost()) {
            if($form->isValid($this->getRequest()->getParams())){
            $data = $form->getValues();
            if($data['photo'] == "")
            {
                $data['photo'] = $user[0]['photo'];
            }
            $this->model->editUser($id, $data);
            $this->redirect('users/index');
            }
            
        }
        $this->view->form = $form;
        $this->view->photo=$user[0]['photo'];
    }

    #registeration 
    public function addAction() {

        $form = new Application_Form_User();
        $form->removeElement('photo');
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();

                if($this->model->addUser($data)){
                     
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
                    $this->redirect('users/index');
                }
            }
        }
        $this->view->form = $form;
    }

    public function loginAction() {
        $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->redirect('users/index');
        }
        $form = new Application_Form_User();

        // get the default db adapter

        if ($this->getRequest()->isPost()) {
            $username = $this->getRequest()->getParam('username');
            $password = $this->getRequest()->getParam('password');
            $db = Zend_Db_Table::getDefaultAdapter();
            //create the auth adapter
            $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password');
//set the email and password
            $authAdapter->setIdentity($username);
            $authAdapter->setCredential(md5($password));

            $result = $authAdapter->authenticate();
            if ($result->isValid()) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($authAdapter->getResultRowObject(array('id', 'username')));
                //$authorization->username=$username;
                $this->redirect('users/index');
            } else {
                $this->redirect('users/login');
            }
        }
        $this->view->form = $form;
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->redirect('users/login');
    }
    
    public function uploadAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->redirect('users/login');
    }

}
