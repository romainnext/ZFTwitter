<?php

class Application_Model_Mapper_Tweet extends Next_Model_Mapper_Abstract
{
    public function add(Next_Model_Abstract $_obj)
    {
        $date = new Zend_Date();
         
        $_obj->setHorodatage($date->toString('YYYY/MM/dd HH:mm:ss'));
        parent::add($_obj);
    }

    
    public function getByMembre_id($_membre_id)
    {
        $select = Zend_Db_Table::getDefaultAdapter()
                                ->select()
                                ->from('tweet')
                                ->join('membre', 'membre.id = membre_id', 'login')
                                ->where('membre_id = ?', $_membre_id) 
                                ->order('horodatage DESC');
        
        $resultSet = $select->query();
        
        $tweets = array();
        
        foreach ($resultSet as $enreg)
        {
            $tweet = new Application_Model_Tweet();
            $tweet->fromArray($enreg);
            
            $membre = new Application_Model_Membre();
            $membre->setLogin($enreg['login']);
            
            $tweet->setMembre($membre);
            
            $tweets[] = $tweet;
        }
        
        return $tweets;
    }
    
    public function getAllWithMembre()
    {
        $select = Zend_Db_Table::getDefaultAdapter()
                                ->select()
                                ->from('tweet')
                                ->join('membre', 'membre.id = membre_id', 'login')
                                ->order('horodatage DESC');
        
        $resultSet = $select->query();
        
        $tweets = array();
        
        foreach ($resultSet as $enreg)
        {
            $tweet = new Application_Model_Tweet();
            $tweet->fromArray($enreg);
            
            $membre = new Application_Model_Membre();
            $membre->setLogin($enreg['login']);
            
            $tweet->setMembre($membre);
            
            $tweets[] = $tweet;
        }
        
        return $tweets;
    }
}