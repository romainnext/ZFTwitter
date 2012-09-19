<?php

class Application_Form_Tweet extends EasyBib_Form
{

    public function init()
    {
        $this->setAttrib('class', 'form-horizontal');
        
        $tweet = new Zend_Form_Element_Textarea('message');
        $tweet->setRequired()
              ->addValidator('StringLength', false, array('max' => 140))
              ->setLabel('Message')
              ->setOptions(array('cols' => '70', 'rows' => '2'));
        
        $hash = new Zend_Form_Element_Hash('hash');
        
        $submit = new Zend_Form_Element_Submit('Poster');
        $cancel = new Zend_Form_Element_Button('Annuler');
        
        $this->addElements(array($tweet, $hash, $submit, $cancel));
        
        // add display group
        $this->addDisplayGroup(
            array('message', 'Poster', 'Annuler'),
            'tweet'
        );
        $this->getDisplayGroup('tweet')->setLegend('Poster un tweet');

        // set decorators
        EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'Poster', 'Annuler');
    }


}

