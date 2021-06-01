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
    /**
     * Holds the incoming config
     */
    private string $_ConfigIn;

    /**
     * Run
     *
     * @return void
     */
    public function run(): string
    {
        //Read Config Input File
        $this->setConfigIn($this->_readFile('configIn.json'));
        if (empty($this->_ConfigIn)) {
            $configRenderer = new ErrorRenderer("configIn.json is empty, was not found or could not be opened");
        }

        //Parse Config Input
        $configInputArray = $this->parseConfigurationInput($this->_ConfigIn);
        asort($configInputArray);

        if (empty($configInputArray)) {
            $configRenderer = new ErrorRenderer("json structure not valid");
        }

        //Render Config Form
        $configRenderer = new ConfigRenderer($configInputArray);
        return $configRenderer->render();
    }
    
    /**
     * ParseConfigurationInput parses a given json structure into an associative array.
     * Returns empty array if structure was not valid.
     *
     * @param  mixed $aInput
     * @return array
     */
    public function parseConfigurationInput(string $input): array
    {
        $lArray = json_decode($input, true);

        if ($lArray === null && json_last_error() !== JSON_ERROR_NONE) {
            return array();
        }
        
        return $lArray;
    }
    
    /**
     * ReadFile reads a file from a given path and gives the content as utf-8 encoded string
     *
     * @param  mixed $aFilePath
     * @return string
     */
    private function _readFile(string $filePath): string
    {
        if (!is_file($filePath)) {
            return '';
        }

        return mb_convert_encoding(file_get_contents($filePath), 'HTML-ENTITIES', "UTF-8");
    }

    /**
     * getConfigIn
     *
     * @return string
     */
    public function getConfigIn():string
    {
        return $this->_ConfigIn;
    }

    /**
     * Set the value of _ConfigIn
     *
     * @return  self
     */
    public function setConfigIn($configIn)
    {
        $this->_ConfigIn = $configIn;

        return $this;
    }
}
