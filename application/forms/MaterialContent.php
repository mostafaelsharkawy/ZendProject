<?php

class Application_Form_MaterialContent extends Zend_Form {

    public function init() {

        /* Form Elements & Other Definitions Here ... */
        $type = new Zend_Form_Element_Text('type');
        $type->setRequired();
//        $type->setLabel('type');
        $type->setAttrib('class', 'form-control');
        $type->setAttrib('style', 'width:50%');
        $type->addValidator(new Zend_Validate_Db_NoRecordExists(
                array(
            'table' => 'material_types',
            'field' => 'type'
                )
        ));
        $id = new Zend_Form_Element_Hidden('id');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary');
        $submit->setAttrib('style', 'margin-left:20%');
        $this->addElements(array($id, $type, $submit));
    }
//
//    public function uploadAction() {
//        $form = new Application_Form_InputForm();
//
//        $request = $this->getRequest();
//        if ($this->getRequest()->isPost()) {
//            // Make certain to merge the files info!
//            $post = array_merge_recursive(
//                    $request->getPost()->toArray(), $request->getFiles()->toArray()
//            );
//
//            $form->setData($post);
//            if ($form->isValid()) {
//                $data = $form->getData();
//                // Form is valid, save the form!
//                return $this->redirect()->toRoute('upload-form/success');
//            }
//        }
//        $this->view->form=$form;
////        return array('form' => $form);
//       
//    }

}
