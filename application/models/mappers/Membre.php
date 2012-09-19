<?php

class Application_Model_Mapper_Membre extends Next_Model_Mapper_Abstract
{
    // Redéfinition de la méthode add pour ajouter le pass en MD5
    public function add(Next_Model_Abstract $_obj)
    {
        $_obj->setPass(md5($_obj->getPass()));
        parent::add($_obj);
    }

    
    public function getByLogin($_login)
    {
        $resultSet = $this->dbTable->fetchAll(array('login = ?' => $_login));
        
        $enreg = $resultSet->current();
        
        if($enreg === null) {
            return null;
        }
        
        $membre = new Application_Model_Membre();
        $membre->fromArray($enreg);
        
        return $membre;
    }
}