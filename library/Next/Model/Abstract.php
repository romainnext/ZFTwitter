<?php

abstract class Next_Model_Abstract {
    
    public function __set($name, $value)
    {
        $setter = 'set' . ucfirst($name);
        
        if(!method_exists($this, $setter))
        {
            throw new Exception('Unwritable property');
        }
        
        $this->$setter($value);
    }
    
    public function __get($name)
    {
        $getter = 'get' . ucfirst($name);
        
        if(!method_exists($this, $getter))
        {
            throw new Exception('Unreadable property');
        }
        
        return $this->$getter();
    }
    
    public function __isset($name)
    {
        $property = "_$name";
        
        return isset($this->$property);
    }
    
    public function fromArray($_tab)
    {
        // 'id' => '1', 'dateheure' => '0000-00-00 00:00:00', 'message' => 'Log'
        
        foreach ($_tab as $key => $value) {
            
            $setter = 'set' . ucfirst($key);
            
            if(method_exists($this, $setter))
            {
                $this->$setter($value);
            }
        }
    }
    
    public function toArray()
    {
        return get_object_vars($this);
    }
}