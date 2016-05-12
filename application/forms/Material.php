<?php

class Application_Form_Material extends Zend_Form {

    public function init() {

        /* Form Elements & Other Definitions Here ... */

	$title = new Zend_Form_Element_Text('title');
	$title->setRequired();
//	$title->setLabel('Title');
        $title->setAttrib('class', 'form-control');

        $MTS = new Application_Model_DbTable_MaterialType();
        $mtype = new Zend_Form_Element_Select('material_type_id');
        $mtype->addMultiOption(0, 'Please select...');
        foreach ($MTS->fetchAll() as $MT) {
            $mtype->addMultiOption($MT['id'], $MT['type']);
        }

        $courses = new Application_Model_DbTable_Course();
        $courseselect = new Zend_Form_Element_Select('course_id');
        $courseselect->addMultiOption(0, 'Please select...');
        $courseselect->setAttrib('required','true');
        foreach ($courses->fetchAll() as $course) {
            $courseselect->addMultiOption($course['id'], $course['title']);
        }

        $users = new Application_Model_DbTable_User();
        $userselect = new Zend_Form_Element_Select('user_id');
        $userselect->addMultiOption(0, 'Please select...');
        foreach ($users->fetchAll() as $user) {
            $userselect->addMultiOption($user['id'], $user['username']);
        }


        $approved = new Zend_Form_Element_Checkbox('is_approved');
//        $approved->setLabel('Approved');
        $approved->setAttrib('class', 'checkbox');


        $published = new Zend_Form_Element_Checkbox('is_published');
//        $published->setLabel('Published');
        $published->setAttrib('class', 'checkbox');

        $shown = new Zend_Form_Element_Checkbox('is_shown');
//        $shown->setLabel('Shown');
        $shown->setAttrib('class', 'checkbox'); $file = new Zend_Form_Element_File('file');
//        $file->setLabel('file Upload');
//        $file->setDestination('/var/www/html/ZendProject2/application/upload');
//        $file->setAttrib('id', 'file');
//        $file->addValidator('Extension', FALSE, 'jpg,png,pdf,ppt,docx');
//        $file->setAttrib('multiple', true);   // That's it
        
        //for input form
//       



        $id = new Zend_Form_Element_Hidden('id');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary');

        $this->addElements(array($id, $title, $approved, $published, $shown, $mtype, $courseselect, $userselect, $submit));
//        $this->setAttrib('enctype', 'multipart/form-data');
        
        }

}
