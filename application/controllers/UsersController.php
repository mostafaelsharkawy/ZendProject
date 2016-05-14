<?php

class UsersController extends Zend_Controller_Action {

    public function init() {
        // $this->_helper->layout->setLayout('fronEnd');
        /* Initialize action controller here */
        $this->_helper->layout->setLayout('layout');
        $this->model = new Application_Model_DbTable_User();
        $this->cmodel = new Application_Model_DbTable_Comment();
        $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
            $this->view->is_admin=Zend_Auth::getInstance()->getStorage()->read()->is_Admin;
        }


        //authenticated or not
    }

    public function indexAction() {
        // die "sss";
        $this->_helper->layout->setLayout('admin');
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $this->view->users = $this->model->listusers();
    }

    public function deleteAction() {
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteuser($id)) {
            $this->redirect('users/index');
        }
    }

    public function adminAction() {
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        if (!Zend_Auth::getInstance()->getStorage()->read()->is_Admin == "1") {
            $this->redirect('/');
        }
        $id = $this->getRequest()->getParam('id');
        $user = $this->model->getUserById($id);
        $admin = $user[0]['is_Admin'];
        if ($admin == '0' || $admin == "") {
            $admin = '1';
        } else {
            $admin = '0';
        }
        if ($this->model->makeAdmin($id, $admin)) {
            $this->redirect('users/index');
        }
        $this->redirect('users/index');
    }

    public function bannedAction() {
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        if (!Zend_Auth::getInstance()->getStorage()->read()->is_Admin == "1") {
            $this->redirect('/');
        }
        $id = $this->getRequest()->getParam('id');
        $user = $this->model->getUserById($id);
        $is_ban = $user[0]['is_Banned'];
        if ($is_ban == '0' || $is_ban == "") {
            $is_ban = '1';
        } else {
            $is_ban = '0';
        }
        if ($this->model->banUser($id, $is_ban)) {
            $this->redirect('users/index');
        }
        $this->redirect('users/index');
    }

    function editAction() {
        $this->_helper->layout->setLayout('new');
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity()) {
            $this->redirect('users/login');
        }
        $id = $this->getRequest()->getParam('id');
        $user = $this->model->getUserById($id);
        $form = new Application_Form_User();
        $form->username->setValidators(array());
        $form->email->setValidators(array());
        $form->removeElement('password');
        $form->populate($user[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                if ($data['photo'] == "") {
                    $data['photo'] = $user[0]['photo'];
                }
                $this->model->editUser($id, $data);
                $this->redirect("users/view/id/$id");
            }
        }
        $this->view->form = $form;
        $this->view->photo = $user[0]['photo'];
    }

    #registeration 

    public function addAction() {

        $form = new Application_Form_User();
        $form->removeElement('photo');
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
#Zend.project.ti@gmail.com itiiti2016
                if ($this->model->addUser($data)) {
                    $config = array('auth' => 'login',
                        'username' => 'blog.django.iti@gmail.com',
                        'password' => 'adminadmin123',
                        'port' => '587',
                        'ssl' => 'tls');
                    $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
                    Zend_Mail::setDefaultTransport($transport);



                    $mail = new Zend_Mail();
                    $content = "you are welcome in our website ... your username :$this->getRequest()->getParam('username')
                          , your signatura:  $this->getRequest()->getParam('signature'), your password :$this->getRequest()->getParam('password')";

                    $mail->setBodyText($content);
                    $mail->setFrom('blog.django.iti@gmail.com', 'Elearning Website');
                    //   echo $this->getRequest()->getParam('email');
                    $mail->addTo($this->getRequest()->getParam('email'), $this->getRequest()->getParam('username'));
                    $mail->setSubject('welcome');
                    $sent = true;
                    try {
                        $mail->send($transport);
                    } catch (Exception $e) {
                        $sent = false;
                    }
                    if ($sent) {
                        $this->redirect('users/login');
                    }
                   

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
        $form->removeElement('country');
        $form->removeElement('email');
        $form->removeElement('gender');
        $form->removeElement('signature');
        $form->removeElement('photo');

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
                $storage->write($authAdapter->getResultRowObject(array('id', 'username', 'is_Admin', 'is_Banned')));
                //$authorization->username=$username;
                /* if(Zend_Auth::getInstance()->getStorage()->read()->is_Banned == 1){
                  $this->redirect('users/login');
                  }
                  if(Zend_Auth::getInstance()->getStorage()->read()->is_Admin == 1){
                  $this->redirect('users/index');

                  }  else {
                  $this->redirect('/');
                  }
                 */
                if (!Zend_Auth::getInstance()->getStorage()->read()->is_Banned == 1) {
                    $this->redirect('users/login');
                }
                if (!Zend_Auth::getInstance()->getStorage()->read()->is_Admin == 1) {
                    $this->redirect('/');
                }  else {
                     $this->redirect('users/index');
                }
               
                //echo Zend_Auth::getInstance()->getStorage()->read()->is_Banned;
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


#show user profile 


    public function viewAction() {
        $this->_helper->layout->setLayout('new');
        $id = $this->getRequest()->getParam('id');
        $this->view->user = $this->model->getUserById($id);
        $this->view->comments = $this->cmodel->getCommentsByUserId($id);
    }

}
