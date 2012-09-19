<?php

class Next_Controller_Plugin_Login extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $storage = Zend_Auth::getInstance()->getStorage();
        
        if($storage->isEmpty())
        {
            $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/auth.ini');
            
            $currentController = $request->getControllerName();
            
            foreach($config->auth->adminControllers as $adminController)
            {
           
                if(strtolower($adminController) == $currentController)
                {
                    // FORM login
                    $request->setControllerName('Login');
                    $request->setActionName('index');
                }
            }
        }
        
        return parent::preDispatch($request);
    }

}