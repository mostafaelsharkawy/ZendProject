<?php

class Application_Form_Request extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $title = new Zend_Form_Element_Text('title');
        $title->setRequired();
        $title->setLabel('title')->setAttrib('class', 'form-label');
        $title->setAttrib('class', 'form-control');

        $content = new Zend_Form_Element_Textarea('content');
        $content->setRequired();
        
        $MTS = new Application_Model_DbTable_Course();       
        $mtype = new Zend_Form_Element_Select('course_id');
        $mtype->addMultiOption(0, 'Please select Category .');
        foreach ($MTS->getCategories() as $MT) 
        {
            $mtype->addMultiOption($MT['id'], $MT['title']);
        }
        $mtype->setAttrib('class', 'form-control');
        $content->setLabel('content')->setAttrib('class', 'form-label');
       // $content->setAttrib('class', 'form-control');
        $submit = new Zend_Form_Element_Submit('submit');
	$submit->setAttrib('class', 'btn btn-primary');
        $this->addElements(array($title,$content, $mtype,$submit));
    }


}

