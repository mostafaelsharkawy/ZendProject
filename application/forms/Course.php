<?php

class Application_Form_Course extends Zend_Form
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
        
        $categories = new Application_Model_DbTable_Course();
        $categorySelect = new Zend_Form_Element_Select('parent_id');
        $categorySelect->setAttrib('class', 'form-control');
        $categorySelect->addMultiOption(0, 'Please select...');
        $categorySelect->setAttrib('required','true');
        $categorySelect->setRequired();
        foreach ($categories->getCategories() as $category) {
            $categorySelect->addMultiOption($category['id'], $category['title']);
        }
        
 


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

        $this->addElements(array($id, $title, $categorySelect, $userselect, $submit));
    }



}

