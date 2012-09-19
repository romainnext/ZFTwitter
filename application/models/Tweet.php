<?php

class Application_Model_Tweet extends Next_Model_Abstract
{
    protected $id;
    protected $horodatage;
    protected $message;
    protected $membre_id;
    
    private $membre;
    
    function __construct($id = 0, $horodatage = "0000-00-00 00:00:00", $message = "", $membre_id = 0)
    {
        $this->id = (int) $id;
        $this->horodatage = (string) $horodatage;
        $this->message = (string) $message;
        $this->membre_id = (int) $membre_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    public function getHorodatage()
    {
        return $this->horodatage;
    }

    public function setHorodatage($horodatage)
    {
        $this->horodatage = (string) $horodatage;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = (string) $message;
        return $this;
    }

    public function getMembre_id()
    {
        return $this->membre_id;
    }

    public function setMembre_id($membre_id)
    {
        $this->membre_id = (int) $membre_id;
        return $this;
    }

    public function getMembre()
    {
        return $this->membre;
    }

    public function setMembre(Application_Model_Membre $membre)
    {
        $this->membre = $membre;
        return $this;
    }


}

