<?php

class MembreController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_Mapper_Membre();
        
        $membres = $mapper->getAll();
        
        $this->view->membres = $membres;
        
        $session = new Zend_Session_Namespace('messages');
        if(isset($session->nouveauMembre))
        {
            $this->view->msgSucces = $session->nouveauMembre;
            unset($session->nouveauMembre);
        }
    }

    public function ajouterAction()
    {
        $form = new Application_Form_Membre();
        
        if($this->getRequest()->isPost())
        {
            $data = $this->_request->getPost();
            
            if($form->isValid($data))
            {
                $membre = new Application_Model_Membre();
                $membre->fromArray($data);
                
                $mapper = new Application_Model_Mapper_Membre();
                $mapper->add($membre);
                
                $session = new Zend_Session_Namespace('messages');
                $session->nouveauMembre = "Félicitation $data[login], vous êtes désormais inscrit !";
                
                $this->_helper->redirector('index');
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


}



