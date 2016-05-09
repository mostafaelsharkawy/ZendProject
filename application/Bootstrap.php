<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	//session for auth user
	protected function _initSession(){
		Zend_Session::start();
		$session = new Zend_Session_Namespace( 'Zend_Auth' );
	}

	protected function _initPlaceholders() {
        $this->bootstrap('View');
        $view = $this->getResource('View');
        $view->doctype('XHTML1_STRICT');
			//Meta
        $view->headMeta()->appendName('keywords', 'framework, PHP')->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
        $view->headTitle('Admin Panel')->setSeparator(' :: ');
			// Set the initial stylesheet:
        // $view->headLink()->prependStylesheet('/ZendProject/public/css/bootstrap.css');
		$view->headLink()->prependStylesheet('/ZendProject/public/css/bootstrap.min.css');
		// $view->headLink()->prependStylesheet('/ZendProject/public/css/bootstrap-rtl.css');
		// $view->headLink()->prependStylesheet('/ZendProject/public/css/bootstrap-rtl.min.css');
		$view->headLink()->appendStylesheet('/ZendProject/public/css/sb-admin.css');
		// $view->headLink()->prependStylesheet('/ZendProject/public/css/sb-admin-rtl.css');
		$view->headLink()->appendStylesheet('/ZendProject/public/css/plugins/morris.css');
		$view->headLink()->appendStylesheet('/ZendProject/public/font-awesome/css/font-awesome.min.css');
			// Set the initial JS to load:
		// $view->headScript()->prependFile('/ZendProject/public/js/bootstrap.js');
		$view->headScript()->prependFile('/ZendProject/public/js/bootstrap.min.js');
		$view->headScript()->appendFile('/ZendProject/public/js/jquery.js');
		// $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/excanvas.min.js');
		// $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/flot-data.js');
		// $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.js');
		// $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.pie.js');
		// $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.resize.js');
		// $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.tooltip.min.js');
		// $view->headScript()->prependFile('/ZendProject/public/js/plugins/morris/morris.js');
		$view->headScript()->appendFile('/ZendProject/public/js/plugins/morris/morris.min.js');
		$view->headScript()->appendFile('/ZendProject/public/js/plugins/morris/morris-data.js');
		$view->headScript()->appendFile('/ZendProject/public/js/plugins/morris/raphael.min.js');
   }

}
