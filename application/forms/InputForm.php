<?php

//use Zend\InputFilter\InputFilter;


class Application_Form_InputForm extends Zend_Form {

    public function init() {
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('file Upload');
        $file->setDestination('/var/www/html/ZendProject/application/upload');
        $file->setAttrib('id', 'file');
        $file->addValidator('Extension', FALSE, 'jpg,png,pdf,ppt,docx,avi');
        $file->addValidator('Size', false, array('max' => '114194304'));
        $file->setAttrib('multiple', true);   // That's it
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn');
        $submit->setAttrib('id', 'addFile');
        $submit->setAttrib('class', 'btn-primary');
        
        $this->addElement($file);
        
        $this->addElements(array($file, $submit));
    }

}

?>