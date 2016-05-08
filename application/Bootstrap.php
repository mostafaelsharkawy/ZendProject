<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	//session for auth user
	protected function _initSession(){
		Zend_Session::start();
		$session = new Zend_Session_Namespace( 'Zend_Auth' );
	}

}
