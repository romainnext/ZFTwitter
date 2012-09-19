<?php

class Zend_View_Helper_Date extends Zend_View_Helper_Abstract
{
    public function date($dateSQL, $format)
    {
        $date = new Zend_Date($dateSQL, 'YYYY/MM/dd HH:mm:ss');
         
        return $date->toString($format);
    }
}