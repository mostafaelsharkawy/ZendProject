<?php
class Application_Form_MaterialContent extends Zend_Form {
    public function init() {
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('file Upload');
        $file->setDestination('/var/www/html/ZendProject/application/upload');
        $file->setAttrib('id', 'file');
        $file->addValidator('Extension', FALSE, 'jpg,png,pdf,ppt,docx,avi');
        $file->addValidator('Size', false, array('max' => '114194304'));
        $file->setAttrib('multiple', true);   // That's it

        
//        /* Form Elements & Other Definitions Here ... */
//        $type = new Zend_Form_Element_Text('type');
//        $type->setRequired();
////        $type->setLabel('type');
//        $type->setAttrib('class', 'form-control');
//        $type->setAttrib('style', 'width:50%');
//        $type->addValidator(new Zend_Validate_Db_NoRecordExists(
//                array(
//            'table' => 'material_types',
//            'field' => 'type'
//                )
//        ));
        $id = new Zend_Form_Element_Hidden('id');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary');

        $this->addElements(array($file,$id, $submit));
//        $this->setAttrib('enctype', 'multipart/form-data');
    }
}