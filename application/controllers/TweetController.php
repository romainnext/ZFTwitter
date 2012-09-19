<?php

class TweetController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $login = $this->getRequest()->getParam('membre');
        
        if(empty($login))
        {
            $this->_redirect('/');
        }
        
        $mapperMembre = new Application_Model_Mapper_Membre();
        
        $membre = $mapperMembre->getByLogin($login);
        
        $this->view->membre = $membre;
        
        $mapperTweet = new Application_Model_Mapper_Tweet();
        
        $tweets = $mapperTweet->getByMembre_id($membre->getId());
        
        $this->view->tweets = $tweets;
        
        $session = new Zend_Session_Namespace('messages');
        if(isset($session->tweetSucces))
        {
            $this->view->msgSucces = $session->tweetSucces;
            unset($session->tweetSucces);
        }
    }

    public function posterAction()
    {
        $form = new Application_Form_Tweet();
        
        if($this->getRequest()->isPost())
        {
            $data = $this->_request->getPost();
            
            if($form->isValid($data))
            {
                $tweet = new Application_Model_Tweet();
                $tweet->fromArray($data);
                
                $membre = Zend_Auth::getInstance()->getStorage()->read();
                
                // Récupération de l'id de la personne connectée
                $tweet->setMembre_id($membre->getId());
                
                $mapper = new Application_Model_Mapper_Tweet();
                $mapper->add($tweet);
                
                $session = new Zend_Session_Namespace('messages');
                $session->tweetSucces = "Votre tweet à bien été posté !";
                
                $this->_helper->getHelper('Redirector')->gotoSimple(array('action' => 'index', 'membre' => $membre->getLogin()));
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





