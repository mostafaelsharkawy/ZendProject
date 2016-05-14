<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    //session for auth user
    protected function _initSession() {
        Zend_Session::start();
        $session = new Zend_Session_Namespace('Zend_Auth');
    }

    protected function _initRequest() {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }

    protected function _initMailsetup() {
        $aConfig = $this->getOptions();
        $this->_aMailConfig = array(
            'auth' => 'login',
            'username' => $aConfig['email']['username'],
            'password' => $aConfig['email']['password'],
            'ssl' => $aConfig['email']['ssl'],
            'port' => $aConfig['email']['port']);
        $this->_strSmtp = $aConfig['email']['server'];
        Zend_Mail::setDefaultTransport(new Zend_Mail_Transport_Smtp($this->_strSmtp, $this->_aMailConfig));
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

        $view->headLink()->prependStylesheet($view->baseUrl() . '/css/bootstrap.min.css');
        // $view->headLink()->prependStylesheet('html/ZendProject/public/css/bootstrap-rtl.css');
        
        // $view->headLink()->prependStylesheet('/ZendProject/public/css/bootstrap-rtl.css');
        // $view->headLink()->prependStylesheet('/ZendProject/public/css/bootstrap-rtl.min.css');
        //$view->headLink()->appendStylesheet('/ZendProject/public/css/sb-admin.css');
        // $view->headLink()->prependStylesheet('/ZendProject/public/css/sb-admin-rtl.css');
        $view->headLink()->appendStylesheet($view->baseUrl() . '/css/plugins/morris.css');
        $view->headLink()->appendStylesheet($view->baseUrl() . '/font-awesome/css/font-awesome.min.css');

        $view->headLink()->appendStylesheet($view->baseUrl() . '/css/animate.css');
        //   $view->headLink()->appendStylesheet('/ZendProject/public/css/queryLoader.css');
        $view->headLink()->appendStylesheet($view->baseUrl() . '/css/superslides.css');
        // $view->headLink()->appendStylesheet('/ZendProject/public/css/slick.css');    

        $view->headLink()->appendStylesheet($view->baseUrl() . '/css/jquery.tosrus.all.css');
        $view->headLink()->appendStylesheet($view->baseUrl() . '/css/themes/default-theme.css');
        $view->headLink()->appendStylesheet($view->baseUrl() . '/css/style.css');


        // Set the initial JS to load:
        // $view->headScript()->prependFile('/ZendProject/public/js/bootstrap.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/jquery.js');
        // $view->headScript()->appendFile('/ZendProject/public/js/jquery.min.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/jquery-2.1.4.min.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/bootstrap.min.js');

        //  $view->headScript()->appendFile('/ZendProject/public/js/queryloader2.min.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/wow.min.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/slick.min.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/jquery.tosrus.min.all.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/custom.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/jquery.easing.1.3.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/jquery.animate-enhanced.min.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/jquery.superslides.min.js');

        // $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/excanvas.min.js');
        // $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/flot-data.js');
        // $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.js');
        // $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.pie.js');
        // $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.resize.js');
        // $view->headScript()->prependFile('/ZendProject/public/js/plugins/flot/jquery.flot.tooltip.min.js');
        // $view->headScript()->prependFile('/ZendProject/public/js/plugins/morris/morris.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/plugins/morris/morris.min.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/plugins/morris/morris-data.js');
        $view->headScript()->appendFile($view->baseUrl() . '/js/plugins/morris/raphael.min.js');
    }

}
