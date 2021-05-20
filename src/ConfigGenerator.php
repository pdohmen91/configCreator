<?php

namespace ConfigGenerator;

use ConfigGenerator\ConfigRenderer;
use ConfigGenerator\ErrorRenderer;

/**
 * ConfigGenerator
 * 
 * @package ConfigCreator
 * @author Peter Dohmen peterdohmen.de
 */
class ConfigGenerator
{

    private string $_configIn;

    /**
     * Run
     *
     * @return void
     */
    public function run(): string
    {
        //Read Config Input File
        $this->set_configIn($this->_readFile('configIn.json'));
        if (empty($this->_configIn)) {
            $lConfigRenderer = new ErrorRenderer("configIn.json is empty, was not found or could not be opened");
        }
        //Parse Config Input
        $lConfigInputArray = $this->parseConfigurationInput($this->_configIn);
        asort($lConfigInputArray);

        if (empty($lConfigInputArray)) {
            $lConfigRenderer = new ErrorRenderer("json structure not valid");
        }

        //Render Config Form
        $lConfigRenderer = new ConfigRenderer($lConfigInputArray);
        return $lConfigRenderer->render();
    }
    
    /**
     * ParseConfigurationInput parses a given json structure into an associative array, returns empty array if structure was not valid. 
     *
     * @param  mixed $aInput
     * @return array
     */
    public function parseConfigurationInput(string $aInput): array
    {
        $lArray = json_decode($aInput, true);

        if ($lArray === null && json_last_error() !== JSON_ERROR_NONE) {
            return array();
        }
        
        return $lArray;
    }
    
    /**
     * ReadFile reads a file from a given path and gives the content as utf-8 encoded string
     *
     * @param  mixed $aFilePath
     * @return string encoded with utf-8
     */
    private function _readFile(string $aFilePath): string
    {
        if (!is_file($aFilePath)) {
            return '';
        }

        return mb_convert_encoding(file_get_contents($aFilePath), 'HTML-ENTITIES', "UTF-8");
    }

    /**
     * Get the value of _configIn
     */ 
    public function get_configIn()
    {
        return $this->_configIn;
    }

    /**
     * Set the value of _configIn
     *
     * @return  self
     */ 
    public function set_configIn($_configIn)
    {
        $this->_configIn = $_configIn;

        return $this;
    }
}
