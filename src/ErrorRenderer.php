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
     * SetConfigIn
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
     * Render
     *
     * @return void
     */
    public function render() 
    {
        if(empty($this->mMessage)) {
            return '';
        }
        
        $lRet = ConfigTemplate::documentHeader();
        $lRet .= ConfigTemplate::error($this->mMessage);
        $lRet .= ConfigTemplate::documentFooter();
        echo $lRet;        
    }
}