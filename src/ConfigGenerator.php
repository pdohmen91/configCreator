<?php

namespace ConfigGenerator;

use ConfigGenerator\ConfigRenderer;
use ConfigGenerator\ErrorRenderer;

/**
 * ConfigGenerator
 */
class ConfigGenerator {

    /**
     * Run
     *
     * @return void
     */
    public function run(): string {
        //Read Config Input File
        $lConfigInput = $this->readFile('configIn.json');
        if(empty($lConfigInput)) {
            $lConfigRenderer = new ErrorRenderer("configIn.json is empty, was not found or could not be opened");
        }
        $lConfigInputArray = $this->parseConfigurationInput($lConfigInput);
        asort($lConfigInputArray);

        if(empty($lConfigInputArray)) {
            $lConfigRenderer = new ErrorRenderer("json structure not valid");
        }

        //Render Config Form
        $lConfigRenderer = new ConfigRenderer($lConfigInputArray);
        return $lConfigRenderer->render();
    }
    
    /**
     * ParseConfigurationInput
     *
     * @param  mixed $aInput
     * @return array
     */
    public function parseConfigurationInput(string $aInput): array {
        $lArray = json_decode($aInput, true);

        if ($lArray === null && json_last_error() !== JSON_ERROR_NONE) {
            return array();
        }
        
        return $lArray;
    }
    
    /**
     * ReadFile
     *
     * @param  mixed $aFilePath
     * @return string
     */
    private function readFile(string $aFilePath): string {
        if(!is_file($aFilePath)) {
            return '';
        }

        return mb_convert_encoding(file_get_contents($aFilePath), 'HTML-ENTITIES', "UTF-8");
    }
}