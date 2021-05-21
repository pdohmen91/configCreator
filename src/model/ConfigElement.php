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
    private $_code;
    private $_name;
    private $_type;
    private $_default;
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
        $this->_set_code($aCode);
        $this->set_name($aName);
    }

    /**
     * Get the value of _code
     */ 
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * Set the value of _code
     *
     * @return  self
     */ 
    private function _setCode($_code)
    {
        $this->_code = $_code;

        return $this;
    }

    /**
     * Get the value of _name
     */ 
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Set the value of _name
     *
     * @return  self
     */ 
    public function setName($_name)
    {
        $this->_name = $_name;

        return $this;
    }

    /**
     * Get the value of _type
     */ 
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Set the value of _type
     *
     * @return  self
     */ 
    public function setType($_type)
    {
        $this->_type = $_type;

        return $this;
    }

    /**
     * Get the value of _default
     */ 
    public function getDefault()
    {
        return $this->_default;
    }

    /**
     * Set the value of _default
     *
     * @return  self
     */ 
    public function setDefault($_default)
    {
        $this->_default = $_default;

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
    public function setDescription($_description)
    {
        $this->_description = $_description;

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
    public function setMax($_max)
    {
        $this->_max = $_max;

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