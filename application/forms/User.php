<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
	
        /* Form Elements & Other Definitions Here ... */
        $username = new Zend_Form_Element_Text('username');
		$username->setRequired();
		$username->setLabel('username');
		$username->addValidator(new Zend_Validate_Db_NoRecordExists(
	    array(
	        'table' => 'users',
	        'field' => 'username'
	    )
	));

		$email = new Zend_Form_Element_Text('email');
		$email->setRequired();
		$email->setLabel('Email');
		$email->addValidator(new Zend_Validate_EmailAddress)
		->addValidator(new Zend_Validate_Db_NoRecordExists(
	    array(
	        'table' => 'users',
	        'field' => 'email'
	    )
	));

		
	 	$id = new Zend_Form_Element_Hidden('id');
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('password');
		$password->addValidator(new Zend_Validate_StringLength(array('min'=>5, 'max'=>8)));
		$gender = new Zend_Form_Element_Radio('gender');
		$gender->setLabel('gender');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('class', 'btn');
		$submit->setAttrib('class', 'btn-primary');

		$this->addElements(array($id,$username,$email, $password,$gender, $submit));


    }


}

