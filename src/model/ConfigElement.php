<?php

namespace ConfigGenerator\Model;

/**
 * ConfigElement
 * 
 * @package ConfigCreator
 * @author Peter Dohmen peterdohmen.de
 */
class ConfigElement
{
    private $_Code;
    private $_Name;
    private $_Type;
    private $_Default;
    private $_description;
    private $_max;
    private $_min;
    private $_step;
    private $_link;
    
    /**
     * __construct
     *
     * @param  mixed $aCode
     * @param  mixed $aName
     * @return void
     */
    public function __construct(string $aCode, string $aName):void
    {
        $this->_SetCode($aCode);
        $this->set_name($aName);
    }

    /**
     * Get the value of _Code
     */ 
    public function getCode()
    {
        return $this->_Code;
    }

    /**
     * Set the value of Code
     *
     * @return  self
     */ 
    private function _SetCode($code)
    {
        $this->_Code = $code;

        return $this;
    }

    /**
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->_Name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->_Name = $name;

        return $this;
    }

    /**
     * Get the value of Type
     */ 
    public function getType()
    {
        return $this->_Type;
    }

    /**
     * Set the value of Type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->_Type = $type;

        return $this;
    }

    /**
     * Get the value of Default
     */ 
    public function getDefault()
    {
        return $this->_Default;
    }

    /**
     * Set the value of Default
     * 
     * @return  self
     */ 
    public function setDefault($default)
    {
        $this->_Default = $default;

        return $this;
    }

    /**
     * Get the value of _description
     */ 
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Set the value of _description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->_description = $description;

        return $this;
    }

    /**
     * Get the value of _max
     */ 
    public function getMax()
    {
        return $this->_max;
    }

    /**
     * Set the value of _max
     *
     * @return  self
     */ 
    public function setMax($max)
    {
        $this->_max = $max;

        return $this;
    }

    /**
     * Get the value of min
     */ 
    public function getMin()
    {
        return $this->_min;
    }

    /**
     * Set the value of min
     *
     * @return  self
     */ 
    public function setMin($min)
    {
        $this->_min = $min;

        return $this;
    }

    /**
     * Get the value of step
     */ 
    public function getStep()
    {
        return $this->_step;
    }

    /**
     * Set the value of step
     *
     * @return  self
     */ 
    public function setStep($step)
    {
        $this->_step = $step;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->_link = $link;

        return $this;
    }
}