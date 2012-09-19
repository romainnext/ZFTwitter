<?php

class Application_Form_Membre extends EasyBib_Form
{

    public function init()
    {
        $this->setAttrib('class', 'form-horizontal');
        
        $login = new Zend_Form_Element_Text('login');
        $login->setRequired()
              ->addValidator('StringLength', false, array('max' => 32))
              ->setLabel('Nom d\'utilisateur');
        
        $db = Zend_Db_Table::getDefaultAdapter();
        
        $validator = new Zend_Validate_Db_NoRecordExists(array('adapter' => $db, 'schema' => 'twitter','table' => 'membre', 'field' => 'login'));
        $validator->setMessage("Le login '%value%' est déjà utilisé");
        $login->addValidator($validator);
        
        $pass = new Zend_Form_Element_Password('pass');
        $pass->setLabel('Mot de passe')
             ->setRequired();
             
        
        $passConfirm = new Zend_Form_Element_Password('confirm');
        $passConfirm->setLabel('Confirmer le mot de passe');
        
        $validator = new Zend_Validate_Identical('pass');
        $validator->setMessage('La confirmation ne correspond pas au mot de passe');
        $passConfirm->addValidator($validator);
        //$passConfirm->addValidator('Identical', false, array('token'));
        
        $hash = new Zend_Form_Element_Hash('hash');
        
        $submit = new Zend_Form_Element_Submit('Inscription');
        $cancel = new Zend_Form_Element_Button('Annuler');
        
        $this->addElements(array($login, $pass, $passConfirm, $hash, $submit, $cancel));
        
        // add display group
        $this->addDisplayGroup(
            array('login', 'pass', 'confirm', 'Inscription', 'Annuler'),
            'users'
        );
        $this->getDisplayGroup('users')->setLegend('S\'inscrire');

        // set decorators
        EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'Inscription', 'Annuler');

    }


}

