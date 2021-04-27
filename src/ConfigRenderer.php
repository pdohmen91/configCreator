<?php

namespace ConfigGenerator;

/**
 * ConfigRenderer
 */
class ConfigRenderer {

    private $mConfigIn;
    
    /**
     * __construct
     *
     * @param  mixed $aConfig
     * @return void
     */
    public function __construct(array $aConfig) 
    {
        $this->setConfigIn($aConfig);
    }
    
    /**
     * setConfigIn
     *
     * @param  mixed $aIn
     * @return bool
     */
    public function setConfigIn(array $aIn): bool {
        $this->mConfigIn = $aIn;

        return true;
    }
    
    /**
     * render
     *
     * @return void
     */
    public function render() {

    }
}