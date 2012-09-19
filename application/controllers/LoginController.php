<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Application_Form_Login();
        
        if($this->getRequest()->isPost())
        {
            $data = $this->getRequest()->getPost();
            
            if($form->isValid($data))
            {
                $login = $form->getValue('login'); // <input name='login'>
                $pass = md5($form->getValue('pass'));
                
                $adaptateur = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
                $adaptateur->setTableName('membre')
                           ->setIdentityColumn('login')
                           ->setCredentialColumn('pass')
                           ->setIdentity($login)
                           ->setCredential($pass);
                
                if($adaptateur->authenticate()->isValid())
                {
                    // BRAVO
                    $storage = Zend_Auth::getInstance()->getStorage();
                    
                    $mapper = new Application_Model_Mapper_Membre();
                    $membre = $mapper->getByLogin($login);
                    
                    $storage->write($membre);
                    
                    $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/auth.ini');
                    
                    $controller = $config->auth->defaultController;
                    $action = $config->auth->defaultAction;
                    
                    $this->_helper->getHelper('Redirector')->gotoSimple($action, $controller);
                }
                else
                {
                    $this->view->msgErreur = "Mauvais login/pass";
                    $form->populate($data);
                }
            }
            else
            {
                $form->populate($data);
                $form->buildBootstrapErrorDecorators();
                $this->view->msgErreur = "Veuillez vérifier votre formulaire !";
            }
        }
        
        $this->view->form = $form;
    }

    public function deconnexionAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        
        $auth = Zend_Auth::getInstance();
        $auth->getStorage()->clear();
        
        $this->_redirect('/');
    }


}



