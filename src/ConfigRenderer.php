<?php

namespace ConfigGenerator;

use ConfigGenerator\ConfigElements;
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
    public function setConfigIn(array $aIn): bool 
    {
        $this->mConfigIn = $aIn;

        return true;
    }
    
    /**
     * render
     *
     * @return void
     */
    public function render() 
    {
        if(empty($this->mConfigIn)) {
            return '';
        }
        
        $lRet = ConfigElements::DocumentHeader();
        $lRet .= ConfigElements::FormHeader();
        $lRet .= $this->renderForm();
        $lRet .= ConfigElements::FormFooter();
        $lRet .= ConfigElements::DocumentFooter();
        echo $lRet;        
    }

    private function renderForm():string {
        $lRet = '';
        
        foreach($this->mConfigIn as $lCode => $lConfig) {
            $lRet .= $this->renderConfigItem($lCode, $lConfig);
        }

        return $lRet;
    }

    private function renderConfigItem(string $aCode, array $aConfig): string 
    {
        $lType = isset($aConfig['type']) ? $aConfig['type'] : '';
        
        switch($lType) {
        case 'number':
            return $this->renderConfigTypeNumber($aCode, $aConfig);
        case 'selection':
            return $this->renderConfigTypeSelection($aCode, $aConfig);
        default: 
            return $this->renderConfigTypeString($aCode, $aConfig);
        }
    }

    private function renderConfigTypeNumber(string $aCode,array $aConfig): string
    {
        $lName = isset($aConfig['name']) ? $aConfig['name'] : '';
        $lDefault = isset($aConfig['default']) ? $aConfig['default'] : '';
        $lDescription = isset($aConfig['description']) ? $aConfig['description'] : '';
        $lBreaking = isset($aConfig['breaking']) ? $aConfig['breaking'] : false;
        $lMax = isset($aConfig['max']) ? $aConfig['max'] : '';
        $lMin = isset($aConfig['min']) ? $aConfig['min'] : '';
        $lStep = isset($aConfig['step']) ? $aConfig['step'] : '';
        $lLink = isset($aConfig['link']) ? $aConfig['link'] : '';
        
        return ConfigElements::NumberField($aCode, $lName, $lDefault, $lDescription, $lMin, $lMax, $lStep, $lBreaking, $lLink);
    }

    private function renderConfigTypeString(string $aCode,array $aConfig): string
    {
        $lName = isset($aConfig['name']) ? $aConfig['name'] : '';
        $lDefault = isset($aConfig['default']) ? $aConfig['default'] : '';
        $lBreaking = isset($aConfig['breaking']) ? $aConfig['breaking'] : false;
        $lDescription = isset($aConfig['description']) ? $aConfig['description'] : '';
        $lLink = isset($aConfig['link']) ? $aConfig['link'] : '';

        if(is_array($lDefault)) {
            $lDefault = htmlspecialchars(html_entity_decode(json_encode($lDefault)));
        }

        return ConfigElements::TextField($aCode, $lName, $lDefault, $lDescription, $lBreaking, $lLink);
    }

    private function renderConfigTypeSelection(string $aCode,array $aConfig): string
    {
        $lName = isset($aConfig['name']) ? $aConfig['name'] : '';
        $lDefault = isset($aConfig['default']) ? $aConfig['default'] : '';
        $lBreaking = isset($aConfig['breaking']) ? $aConfig['breaking'] : false;
        $lDescription = isset($aConfig['description']) ? $aConfig['description'] : '';
        $lEnum = isset($aConfig['enum']) ? $aConfig['enum'] : '';
        $lLink = isset($aConfig['link']) ? $aConfig['link'] : '';

        return ConfigElements::SelectionField($aCode, $lName, $lDefault, $lDescription, $lBreaking, $lEnum, $lLink);
    }
}