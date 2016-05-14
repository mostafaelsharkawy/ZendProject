<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $content = new Zend_Form_Element_Text('content');
        $content->setRequired();
//        $content->setLabel('content');
        $content->setAttrib('class', 'form-control');
        $content->setAttrib('style', 'width:50%');
        
	 	$id = new Zend_Form_Element_Hidden('id');
		$submit = new Zend_Form_Element_Submit('submit');
                $submit->setAttrib('class', 'btn btn-primary');
                $submit->setAttrib('style', 'margin-left:20%');
		$this->addElements(array($id,$content, $submit));
    }


}

