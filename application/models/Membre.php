<?php

class Application_Model_Membre extends Next_Model_Abstract
{
    protected $id;
    protected $login;
    protected $pass;
    
    function __construct($_id = 0, $_login = "", $_pass = "")
    {
        $this->id = (int) $_id;
        $this->login = (string) $_login;
        $this->pass = (string) $_pass;
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

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = (string) $login;
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = (string) $pass;
        return $this;
    }
}

