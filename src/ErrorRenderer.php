<?php

namespace ConfigGenerator;

use ConfigGenerator\ConfigElements;
/**
 * ConfigRenderer
 */
class ErrorRenderer {
    /**
     * __construct
     *
     * @param  mixed $aConfig
     * @return void
     */
    public function __construct(string $aMessage) 
    {
        $this->setMessage($aMessage);
        $this->render();
        exit;
    }
    
    /**
     * setConfigIn
     *
     * @param  mixed $aIn
     * @return bool
     */
    public function setMessage(string $aMessage): bool 
    {
        $this->mMessage = $aMessage;

        return true;
    }
    
    /**
     * render
     *
     * @return void
     */
    public function render() 
    {
        if(empty($this->mMessage)) {
            return '';
        }
        
        $lRet = ConfigElements::DocumentHeader();
        $lRet .= ConfigElements::Error($this->mMessage);
        $lRet .= ConfigElements::DocumentFooter();
        echo $lRet;        
    }
}