<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {	
        /* Form Elements & Other Definitions Here ... */
      
        $username = new Zend_Form_Element_Text('username');
		$username->setRequired();
		$username->setLabel('username')->setAttrib('class', 'form-label');
		$username->setAttrib('class', 'form-control');
		$username->addValidator(new Zend_Validate_Db_NoRecordExists(
	    array(
	        'table' => 'users',
	        'field' => 'username'
	    )
	));

		$email = new Zend_Form_Element_Text('email');
		$email->setRequired();
		$email->setLabel('Email');
		$email->setAttrib('class', 'form-control');
		$email->addValidator(new Zend_Validate_EmailAddress)
		->addValidator(new Zend_Validate_Db_NoRecordExists(
	    array(
	        'table' => 'users',
	        'field' => 'email'
	    )
	));

		
	 	$id = new Zend_Form_Element_Hidden('id');
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('password')->setAttrib('class', 'control-label');
		$password->setAttrib('class', 'form-control');
		$password->addValidator(new Zend_Validate_StringLength(array('min'=>5, 'max'=>8)));

		$gender = new Zend_Form_Element_Radio('gender');
                $gender->setLabel('What is your gender ?');
                $gender->addMultiOption('Male','Male');
		$gender->addMultiOption('Female','Female');
		$gender->setAttrib('class', 'radio radio-inline');

		$country = new Zend_Form_Element_Select('country');
		$country->addMultiOption(0,'Please select...');
		$country->addMultiOption('Cairo', 'Cairo');
		$country->addMultiOption('Mansoura', 'Mansoura');
		$country->addMultiOption('Dammietta', 'Dammietta');;
		$country->setAttrib('class', 'form-control');

		$signature = new Zend_Form_Element_Text('signature');
		$signature->setLabel('signature')->setAttrib('class', 'form-label');
		$signature->setAttrib('class', 'form-control');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('class', 'btn btn-primary');
		$this->setAttrib('class', 'form-horizontal');
                /*
                $MTS = new Application_Model_DbTable_MaterialType();
                $mtype = new Zend_Form_Element_Select('country');
                $mtype->addMultiOption(0, 'Please select...');
                foreach ($MTS->fetchAll() as $MT) {
                    $mtype->addMultiOption($MT['id'], $MT['type']);
                }*/
                
     
                $photo = new Zend_Form_Element_File('photo');  
                $photo->setLabel('Photo') ;
                $photo->setDestination('/var/www/html/ZendProject/public/images/profile_images/');     
		$this->addElements(array($id,$username,$email, $password,$gender,$country,$signature,$photo, $submit));
    }


}

