<?php

class Application_Form_MaterialType extends Zend_Form
{

    public function init()
    {
	
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
		$this->addElements(array($id,$type, $submit));
                
    }


}

