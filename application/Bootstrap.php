<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initTranslator()
    {
        $translator = new Zend_Translate(
                        array(
                            'adapter' => 'array',
                            'content' => APPLICATION_PATH . '/../resources/languages', // chemin vers les fichiers
                            'locale' => 'fr',
                            'scan' => Zend_Translate::LOCALE_DIRECTORY
                        )
        );
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }

    public function _initFuseauHoraire()
    {
        date_default_timezone_set('Europe/Paris');
    }

}

