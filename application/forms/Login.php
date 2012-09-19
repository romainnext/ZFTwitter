<?php

class Application_Form_Login extends EasyBib_Form
{

    public function init()
    {
        $this->setAttrib('class', 'form-horizontal');
        
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login')
              ->setRequired();
        
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(32);
        
        $login->addValidator($validator);
        
        
        $pass = new Zend_Form_Element_Password('pass');
        $pass->setLabel('Mot de passe')
             ->setRequired();
        
        $hash = new Zend_Form_Element_Hash('hash');
        
        $submit = new Zend_Form_Element_Submit('connexion');
        $submit->setLabel('Se Connecter');
        
        $this->addElements(array($login, $pass, $hash, $submit));
        
        // add display group
        $this->addDisplayGroup(
            array('login', 'pass', 'connexion'),
            'users'
        );
        $this->getDisplayGroup('users')->setLegend('Se connecter');

        // set decorators
        EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'connexion');
    }


}

