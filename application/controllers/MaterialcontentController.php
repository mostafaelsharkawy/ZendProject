<?php

class MaterialcontentController extends Zend_Controller_Action {

public function init() {
/* Initialize action controller here */
 $authorization = Zend_Auth::getInstance();
        if ($authorization->hasIdentity()) {
            $this->view->user_id = Zend_Auth::getInstance()->getStorage()->read()->id;
            $this->view->is_admin=Zend_Auth::getInstance()->getStorage()->read()->is_Admin;
        }


        $this->_helper->layout->setLayout('admin');

        $this->model = new Application_Model_DbTable_MaterialContent();
    }

    public function indexAction() {
        // action body
        $id = $this->getRequest()->getParam('id');
        $data = $this->model->getMaterialContentById($id);
        $this->view->data = $data;
    }

    //lock files of downloading
    public function lockAction() {
        $id = $this->getRequest()->getParam('id');
        $mid = $this->getRequest()->getParam('mid');
        $data = $this->model->lockContent($id);
        $this->redirect('materialcontent/index/id/' . $mid);
    }

    public function unlockAction() {
        $id = $this->getRequest()->getParam('id');
        $mid = $this->getRequest()->getParam('mid');
        $data = $this->model->unlockContent($id);
        $this->redirect('materialcontent/index/id/' . $mid);
    }

    //hide materials
    public function hideAction() {
        $id = $this->getRequest()->getParam('id');
        $mid = $this->getRequest()->getParam('mid');
        $data = $this->model->hideContent($id);
        $this->redirect('materialcontent/index/id/' . $mid);
    }

    //show materials
    public function showAction() {
        $id = $this->getRequest()->getParam('id');
        $mid = $this->getRequest()->getParam('mid');
        $data = $this->model->showContent($id);
        $this->redirect('materialcontent/index/id/' . $mid);
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($this->model->deleteMaterialContent($id)) {
            $this->redirect('materialcontent/index');
        }
    }

    public function uploadAction() {
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_InputForm();

        if ($form->isValid($this->getRequest()->getParams('id'))) {
            $data = $form->getValues();
            if ($this->model->addMaterialContent($data, $id)) {
                
            }
        }
        $this->view->form = $form;
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $content = $this->model->getMaterialbyindex($id);
        $form = new Application_Form_InputForm();
//        $form->type->setValidators(array());
        $form->populate($content[0]);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                if ($data['file'] != '0') {
                    echo 'hi';
                    var_dump($data['file']);
                    $this->model->editMaterialContent($data, $id);
                }
            }
        }
        $this->view->form = $form;
    }

    public function displayAction() {
        // get image content
        $id = $this->getRequest()->getParam('id');
        $content = $this->getRequest()->getParam('content');
        $ext = (new SplFileInfo($content))->getExtension();
        if ($ext == 'pdf'||$ext=='docx'||$ext=='ppt') {
            $this->_helper->layout->disableLayout();
            $file = '/var/www/html/ZendProject/application/upload/' . $content;
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=filename.pdf');
            header('Cache-Control: private, max-age=0, must-revalidate');
            header('Pragma: public');
            ini_set('zlib.output_compression', '0');
            echo file_get_contents($file);
        } elseif ($ext == 'jpg') {
            $this->_helper->layout->disableLayout();
            $file = '/var/www/html/ZendProject/application/upload/' . $content;
            $logo = file_get_contents($file);
            $type = 'image/jpg';
            $data = $this->getFrontController()->getResponse();
            $data->setHeader('Content-Type', $type, true);
            $data->setHeader('Content-Transfer-Encoding', 'binary', true);
            $data->setHeader('Cache-Control', 'max-age=3600, must-revalidate', true);
            $data->setBody($logo);
            $data->sendResponse();
            $this->view->data = $data;
        } elseif ($ext == 'docx') {
            $file = '/var/www/html/ZendProject/application/upload/' . $content;
            $this->view->file=$file;
//            $mailMerge = new Zend_Service_LiveDocx_MailMerge();
//
//            $mailMerge->setUsername('yasmin')
//                    ->setPassword('yasmina123');
//
//            $mailMerge->setLocalTemplate($file);
//
//            $mailMerge->assign('software', 'Magic Graphical Compression Suite v1.9')
//                    ->assign('licensee', 'Henry Döner-Meyer')
//                    ->assign('company', 'Co-Operation')
//                    ->assign('date', 'January 11, 2010')
//                    ->assign('time', 'January 11, 2010')
//                    ->assign('city', 'Berlin')
//                    ->assign('country', 'Germany');
//
//            $mailMerge->createDocument();
//
//            $document = $mailMerge->retrieveDocument('pdf');
////            die(file_put_contents('document.pdf', $document));
//            echo file_get_contents('/var/www/html/ZendProject/application/upload/' .$document);
//            $this->_helper->layout->disableLayout();
//            $file = '/var/www/html/ZendProject/application/upload/' . $content;
//            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
//            header('Content-Disposition: inline; filename=filename.docx');
//            header('Cache-Control: private, max-age=0, must-revalidate');
//            header('Pragma: public');
//            ini_set('zlib.output_compression', '0');
//            echo file_get_contents($file);
        } elseif ($ext == 'avi') {
            $file = '/ZendProject/application/upload/' . $content;
            $this->view->video = $file;

        }
    }

}
