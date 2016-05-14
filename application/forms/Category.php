<?php

class Application_Form_Category extends Zend_Form
{

    public function init()
    {

        $title = new Zend_Form_Element_Text('title');
        $title->setRequired();
        $title->setLabel('title')->setAttrib('class', 'form-label');
        $title->setAttrib('class', 'form-control');
        $title->setAttrib('style', 'width:50%');
        $title->addValidator(new Zend_Validate_Db_NoRecordExists(
                array(
            'table' => 'courses',
            'field' => 'title'
                )
        ));


        $users = new Application_Model_DbTable_User();
        $userselect = new Zend_Form_Element_Select('user_id');
        $userselect->setAttrib('class', 'form-control');
        $userselect->addMultiOption(0, 'Please select...');
        $userselect->setRequired();
        foreach ($users->fetchAll() as $user) {
            $userselect->addMultiOption($user['id'], $user['username']);
        }


        $id = new Zend_Form_Element_Hidden('id');
        $submit = new Zend_Form_Element_Submit('submit');
                $submit->setAttrib('class', 'btn btn-primary');
                $submit->setAttrib('style', 'margin-left:20%');
        $this->addElements(array($id, $title, $userselect, $submit));
    }


}

