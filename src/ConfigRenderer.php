<?php

namespace ConfigGenerator;

use ConfigGenerator\ConfigElements;

/**
 * ConfigRenderer
 * 
 * @package ConfigCreator
 * @author Peter Dohmen peterdohmen.de
 */
class ConfigRenderer
{
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
     * SetConfigIn
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
     * Render
     *
     * @return void
     */
    public function render()
    {
        if (empty($this->mConfigIn)) {
            return '';
        }
        
        $lRet = ConfigTemplate::documentHeader();
        $lRet .= ConfigTemplate::formHeader();
        $lRet .= $this->_renderForm($this->mConfigIn);
        $lRet .= ConfigTemplate::formFooter();
        $lRet .= ConfigTemplate::documentFooter();
        
        return $lRet;
    }

    private function _renderForm(array $aConfig, int $aLevel = 2):string
    {
        $lRet = '';

        $aLevel++;

        foreach ($aConfig as $lCode => $lConfig) {
            if (isset($lConfig['name'])) {
                $lRet .= $this->_renderConfigItem($lCode, $lConfig);
            } else {
                $lRet .= $this->_renderSection($lCode, $aLevel);
                if ($aLevel < 6) {
                    $lRet .= $this->_renderForm($lConfig, $aLevel);
                } else {
                    $lRet .= $this->_renderError('Nesting Limit reached');
                }
            }
        }

        return $lRet;
    }
    
    /**
     * RenderError
     *
     * @param  mixed $aMessage
     * @return string
     */
    private function _renderError(string $aMessage):string
    {
        return ConfigTemplate::error($aMessage);
    }
    
    /**
     * RenderSection
     *
     * @param  mixed $aCode
     * @param  mixed $aLevel
     * @return string
     */
    private function _renderSection(string $aCode, int $aLevel): string
    {
        return ConfigTemplate::sectionHeadline($aCode, $aLevel);
    }
    
    /**
     * RenderConfigItem
     *
     * @param  mixed $aCode
     * @param  mixed $aConfig
     * @return string
     */
    private function _renderConfigItem(string $aCode, array $aConfig): string
    {
        $lType = isset($aConfig['type']) ? $aConfig['type'] : '';
        
        switch ($lType) {
        case 'number':
            return $this->_renderConfigTypeNumber($aCode, $aConfig);
        case 'selection':
            return $this->_renderConfigTypeSelection($aCode, $aConfig);
        default:
            return $this->_renderConfigTypeString($aCode, $aConfig);
        }
    }
    
    /**
     * RenderConfigTypeNumber
     *
     * @param  mixed $aCode
     * @param  mixed $aConfig
     * @return string
     */
    private function _renderConfigTypeNumber(string $aCode, array $aConfig): string
    {
        $lName = isset($aConfig['name']) ? $aConfig['name'] : '';
        $lDefault = isset($aConfig['default']) ? $aConfig['default'] : '';
        $lDescription = isset($aConfig['description']) ? $aConfig['description'] : '';
        $lBreaking = isset($aConfig['breaking']) ? $aConfig['breaking'] : false;
        $lMax = isset($aConfig['max']) ? $aConfig['max'] : '';
        $lMin = isset($aConfig['min']) ? $aConfig['min'] : '';
        $lStep = isset($aConfig['step']) ? $aConfig['step'] : '';
        $lLink = isset($aConfig['link']) ? $aConfig['link'] : '';
        
        return ConfigTemplate::numberField($aCode, $lName, $lDefault, $lDescription, $lMin, $lMax, $lStep, $lBreaking, $lLink);
    }
    
    /**
     * RenderConfigTypeString
     *
     * @param  mixed $aCode
     * @param  mixed $aConfig
     * @return string
     */
    private function _renderConfigTypeString(string $aCode, array $aConfig): string
    {
        $lName = isset($aConfig['name']) ? $aConfig['name'] : '';
        $lDefault = isset($aConfig['default']) ? $aConfig['default'] : '';
        $lBreaking = isset($aConfig['breaking']) ? $aConfig['breaking'] : false;
        $lDescription = isset($aConfig['description']) ? $aConfig['description'] : '';
        $lLink = isset($aConfig['link']) ? $aConfig['link'] : '';

        if (is_array($lDefault)) {
            $lDefault = htmlspecialchars(html_entity_decode(json_encode($lDefault)));
        }

        return ConfigTemplate::textField($aCode, $lName, $lDefault, $lDescription, $lBreaking, $lLink);
    }
    
    /**
     * RenderConfigTypeSelection
     *
     * @param  mixed $aCode
     * @param  mixed $aConfig
     * @return string
     */
    private function _renderConfigTypeSelection(string $aCode, array $aConfig): string
    {
        $lName = isset($aConfig['name']) ? $aConfig['name'] : '';
        $lDefault = isset($aConfig['default']) ? $aConfig['default'] : '';
        $lBreaking = isset($aConfig['breaking']) ? $aConfig['breaking'] : false;
        $lDescription = isset($aConfig['description']) ? $aConfig['description'] : '';
        $lEnum = isset($aConfig['enum']) ? $aConfig['enum'] : '';
        $lLink = isset($aConfig['link']) ? $aConfig['link'] : '';

        return ConfigTemplate::selectionField($aCode, $lName, $lDefault, $lDescription, $lBreaking, $lEnum, $lLink);
    }
}
