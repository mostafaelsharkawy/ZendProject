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

        
        $categories = new Application_Model_DbTable_Course();
        $categorySelect = new Zend_Form_Element_Select('category_id');
        $categorySelect->addMultiOption(0, 'Please select...');
        $categorySelect->setAttrib('required','true');
        foreach ($categories->fetchAll() as $category) {
            $categorySelect->addMultiOption($category['id'], $category['title']);
        }
        
 


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

        $this->addElements(array($id, $title, $content, $categorySelect, $userselect, $submit));
    }



}

