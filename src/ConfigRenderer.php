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
        
        $lRet = ConfigTemplate::DocumentHeader();
        $lRet .= ConfigTemplate::FormHeader();
        $lRet .= $this->renderForm($this->mConfigIn);
        $lRet .= ConfigTemplate::FormFooter();
        $lRet .= ConfigTemplate::DocumentFooter();
        
        return $lRet;        
    }

    private function renderForm(array $aConfig, int $aLevel = 2):string {
        $lRet = '';

        $lLevel = $aLevel++;

        foreach($aConfig as $lCode => $lConfig) {
            if(isset($lConfig['name'])) {
                $lRet .= $this->renderConfigItem($lCode, $lConfig);
            }
            else {
                $lRet .= $this->renderSection($lCode, $aLevel);
                if($aLevel < 6) {
                    $lRet .= $this->renderForm($lConfig, $aLevel);
                }
                else {
                    $lRet .= $this->renderError('Nesting Limit reached');
                }
            }
        }

        return $lRet;
    }

    private function renderError(string $aMessage):string 
    {
        return ConfigTemplate::error($aMessage);
    }

    private function renderSection(string $aCode, int $aLevel): string {
        return ConfigTemplate::sectionHeadline($aCode, $aLevel);
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
        
        return ConfigTemplate::NumberField($aCode, $lName, $lDefault, $lDescription, $lMin, $lMax, $lStep, $lBreaking, $lLink);
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

        return ConfigTemplate::TextField($aCode, $lName, $lDefault, $lDescription, $lBreaking, $lLink);
    }

    private function renderConfigTypeSelection(string $aCode,array $aConfig): string
    {
        $lName = isset($aConfig['name']) ? $aConfig['name'] : '';
        $lDefault = isset($aConfig['default']) ? $aConfig['default'] : '';
        $lBreaking = isset($aConfig['breaking']) ? $aConfig['breaking'] : false;
        $lDescription = isset($aConfig['description']) ? $aConfig['description'] : '';
        $lEnum = isset($aConfig['enum']) ? $aConfig['enum'] : '';
        $lLink = isset($aConfig['link']) ? $aConfig['link'] : '';

        return ConfigTemplate::SelectionField($aCode, $lName, $lDefault, $lDescription, $lBreaking, $lEnum, $lLink);
    }
}