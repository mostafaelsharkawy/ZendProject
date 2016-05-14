<?php

class Application_Form_Category extends Zend_Form
{

    public function init()
    {

        $title = new Zend_Form_Element_Text('title');
        $title->setRequired();
        $title->setLabel('title')->setAttrib('class', 'form-label');
        $title->setAttrib('class', 'form-control');
        $type->addValidator(new Zend_Validate_Db_NoRecordExists(
                array(
            'table' => 'courses',
            'field' => 'title'
                )
        ));


        $content = new Zend_Form_Element_Text('content');
        $content->setRequired();
        $content->setLabel('content');
        $content->setAttrib('class', 'form-control');
        $content->setAttrib('style', 'width:50%');
        $content->addValidator(new Zend_Validate_Db_NoRecordExists(
                array(
            'table' => 'courses',
            'field' => 'content'
                )
        ));


        $users = new Application_Model_DbTable_User();
        $userselect = new Zend_Form_Element_Select('user_id');
        $userselect->addMultiOption(0, 'Please select...');
        foreach ($users->fetchAll() as $user) {
            $userselect->addMultiOption($user['id'], $user['username']);
        }


        $id = new Zend_Form_Element_Hidden('id');
        $submit = new Zend_Form_Element_Submit('submit');
                $submit->setAttrib('class', 'btn btn-primary');
                $submit->setAttrib('style', 'margin-left:20%');
        $this->addElements(array($id,$content, $submit));
    }


}

