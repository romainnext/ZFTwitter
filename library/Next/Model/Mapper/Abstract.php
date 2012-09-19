<?php

abstract class Next_Model_Mapper_Abstract {
    /**
     *
     * @var Zend_Db_Table_Abstract 
     */
    protected $dbTable = null;
    private $className = null;
    
    public function __construct() {
        
        // get_class($this) retourne le nom de la classe instanciée avec new
        $arboTab = explode('_', get_class($this));
        // $arboTab[count($arboTab)-1] contient le dernier terme de la classe
        $this->className = $arboTab[count($arboTab)-1];
        
        $dbTableClass = 'Application_Model_DbTable_' . $this->className;
        $this->dbTable = new $dbTableClass();
    }
    
    public function getAll() {
        $resultSet = $this->dbTable->fetchAll();
        
        $resultTab = array();
        
        foreach ($resultSet as $enreg) {
            $modelClassName = 'Application_Model_' . $this->className;
            $result = new $modelClassName();
            
            $result->fromArray($enreg);
            
            $resultTab[] = $result;
        }
        
        return $resultTab;
    }
    
    public function get($_id)
    {
        $resultRet = $this->dbTable->find($_id);
        
        $enreg = $resultRet->current();
        
        if($enreg === null) {
            return null;
        }
        
        $modelClassName = 'Application_Model_' . $this->className;
        $result = new $modelClassName();
        $result->fromArray($enreg);
        
        return $result;
    }
    
    public function update(Next_Model_Abstract $_obj)
    {
        $objArray = $_obj->toArray();
        
        $this->dbTable->update($objArray, array('id = ?' => $_obj->getId()));
    }
    
    public function add(Next_Model_Abstract $_obj)
    {
        $objArray = $_obj->toArray();
        
        $this->dbTable->insert($objArray);
    }
    
    public function delete($_id)
    {
        $this->dbTable->delete(array('id = ?' => $_id));
    }
}